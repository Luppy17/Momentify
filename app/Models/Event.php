<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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

}

