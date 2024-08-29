<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FilmClip extends Model
{
    use HasFactory;

    protected $fillable = [
        'film_id', 'name', 'clip', 'minute', 'second'
    ];
}
