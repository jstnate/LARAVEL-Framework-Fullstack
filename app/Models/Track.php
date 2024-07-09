<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Track extends Model
{
    use HasFactory;

    protected $fillable = [
        'uuid',
        'title',
        'artist',
        'image',
        'music',
        'display',
        'play_count',
    ];

    public function getRouteKeyName()
    {
        return 'uuid';
    }
}
