<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\EventImage;
use App\Models\Photographer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\PhotographerAssignedToEvent;
use Illuminate\Support\Facades\Storage;
use Aws\Rekognition\RekognitionClient;
use App\Models\Image;


class EventDetailController extends Controller
{
    public function index(Request $request)
    {
        // Get the search query if provided
        $search = $request->input('search');

        // Filter events if a search query exists
        $events = Event::with('photographers', 'images')
            ->when($search, function ($query, $search) {
                $query->where('event_name', 'like', '%' . $search . '%')
                    ->orWhere('date', 'like', '%' . $search . '%')
                    ->orWhereHas('photographers', function ($photographerQuery) use ($search) {
                        $photographerQuery->where('name', 'like', '%' . $search . '%');
                    });
            })
            ->when(auth()->user()->is_photographer == 1, function ($query) {
                $query->whereHas('photographers', function ($photographerQuery) {
                    $photographerQuery->where('name', auth()->user()->name);
                });
            })
            ->get();

        return view('eventdetails.index', compact('events', 'search'));
    }

    public function show(Event $event)
    {
        $photographers = Photographer::all();
        return view('eventdetails.show', compact('event', 'photographers'));
    }

    public function assignPhotographer(Request $request, Event $event)
    {
        $request->validate([
            'photographer_id' => 'required|exists:photographers,id',
        ]);

        $photographer = Photographer::findOrFail($request->photographer_id);

        $event->photographers()->attach($photographer->id);

        // Send email to photographer
        Mail::to($photographer->email)->send(new PhotographerAssignedToEvent($event, $photographer));

        return redirect()->back()->with('success', 'Photographer assigned successfully!');
    }

    public function removePhotographer($eventId, $photographerId)
    {
        $event = Event::findOrFail($eventId);
        $photographer = Photographer::findOrFail($photographerId);

        // Detach the photographer from the event
        $event->photographers()->detach($photographer);

        return redirect()->route('eventdetails.show', $eventId)
            ->with('success', 'Photographer removed successfully.');
    }

    public function uploadPhotos(Request $request, $eventId)
    {
        $request->validate([
            'images.*' => 'required|image|mimes:jpeg,png,jpg|max:10240'
        ]);

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                // Store image in storage/app/public/event-photos
                $path = $image->store('event-photos', 's3');

                // Save only the relative path
                EventImage::create([
                    'event_id' => $eventId,
                    'path' => $path, // Store without 'storage/' prefix
                    'photographer_id' => auth()->id()
                ]);

                $rekognition = new RekognitionClient([
                    'region'    => env('AWS_DEFAULT_REGION'),
                    'version'   => 'latest',
                    'credentials' => [
                        'key'    => env('AWS_ACCESS_KEY_ID'),
                        'secret' => env('AWS_SECRET_ACCESS_KEY'),
                    ],
                ]);

                $result = $rekognition->indexFaces([
                    'CollectionId' => env('AWS_REKOGNITION_COLLECTION'),
                    'Image' => ['S3Object' => [
                        'Bucket' => env('AWS_BUCKET'),
                        'Name'   => $path
                    ]],
                    'ExternalImageId' => basename($path), // Unique ID for reference
                    'DetectionAttributes' => []
                ]);
            }
        }

        return back()->with('success', 'Images uploaded successfully');
    }

    public function deleteImage(EventImage $image)
    {
        // Delete the file from storage
        Storage::disk('s3')->delete($image->path);


        // Delete the database record
        $image->delete();

        return back()->with('success', 'Image deleted successfully');
    }

    public function showImage(Event $event, EventImage $image)
    {
        // Initialize AWS Rekognition
        $rekognition = new RekognitionClient([
            'region'    => env('AWS_DEFAULT_REGION'),
            'version'   => 'latest',
            'credentials' => [
                'key'    => env('AWS_ACCESS_KEY_ID'),
                'secret' => env('AWS_SECRET_ACCESS_KEY'),
            ],
        ]);

        // First, check if the image contains any faces
        $detectResult = $rekognition->detectFaces([
            'Image' => ['S3Object' => [
                'Bucket' => env('AWS_BUCKET'),
                'Name'   => $image->path
            ]]
        ]);

        $similarImages = [];

        // Only search for similar faces if the image contains faces
        if (!empty($detectResult['FaceDetails'])) {
            // Search for similar faces in the collection
            $result = $rekognition->searchFacesByImage([
                'CollectionId' => env('AWS_REKOGNITION_COLLECTION'),
                'Image' => ['S3Object' => [
                    'Bucket' => env('AWS_BUCKET'),
                    'Name'   => $image->path
                ]],
                'MaxFaces' => 5,  // Number of matches to return
                'FaceMatchThreshold' => 80 // Minimum confidence percentage
            ]);

            // Get similar images from the event
            if (!empty($result['FaceMatches'])) {
                foreach ($result['FaceMatches'] as $match) {
                    $similarImage = EventImage::where('path', 'like', '%' . $match['Face']['ExternalImageId'])
                        ->where('id', '!=', $image->id)
                        ->first();

                    if ($similarImage) {
                        $similarImages[] = [
                            'image' => $similarImage,
                            'confidence' => $match['Similarity']
                        ];
                    }
                }
            }
        }

        return view('eventdetails.showImage', compact('event', 'image', 'similarImages'));
    }

    public function downloadImage(Event $event, EventImage $image)
    {
        // Get the file from S3
        $file = Storage::disk('s3')->get($image->path);

        // Get the file name from the path
        $filename = basename($image->path);

        // Return the file as a download
        return response($file)
            ->header('Content-Type', 'image/jpeg')
            ->header('Content-Disposition', 'attachment; filename="' . $filename . '"');
    }
}
