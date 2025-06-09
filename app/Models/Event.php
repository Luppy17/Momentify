<?php

namespace App\Models;

use App\Models\EventImage;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Event extends Model
{
    use HasFactory;

    protected $fillable = [
        'event_name',
        'date',
        'time',
        'event_place',
    ];

    public function photographers()
    {
        return $this->belongsToMany(Photographer::class, 'event_photographers');
    }

    public function images()
    {
        return $this->hasMany(EventImage::class);
    }

}

