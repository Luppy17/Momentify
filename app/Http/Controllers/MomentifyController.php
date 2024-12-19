<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MomentifyController extends Controller
{
    public function index(Request $request)
    {
        // Get the search query if provided
        $search = $request->input('search');

        return view('momentify.index', compact('search'));
    }
}
