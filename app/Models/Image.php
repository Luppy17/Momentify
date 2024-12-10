<?php

namespace App\Models;

use App\Models\Event;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    protected $fillable = [
        'filename',
        'path',
        'event_id',
    ];

    public function event()
    {
        return $this->belongsTo(Event::class);
    }
}
