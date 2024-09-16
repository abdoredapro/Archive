<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Storage;

class FileClip extends Model
{
    use HasFactory;

    protected $fillable = [
        'file_id', 'name', 'clip', 'minute', 'second',
        'description'
    ];

    public function file(): BelongsTo {
        return $this->belongsTo(File::class);
    }


    public function clipUrl() {
        return asset(Storage::url('files/clips/'.$this->clip));
    }
}
