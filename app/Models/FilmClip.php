<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class FilmClip extends Model
{
    use HasFactory;

    protected $fillable = [
        'film_id',
        'name',
        'clip',
        'minute',
        'second',
        'description'
    ];

    public function clipUrl(): string
    {
        return asset(Storage::url('films/clips/' . $this->clip));
    }
}
