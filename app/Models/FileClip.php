<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class FileClip extends Model
{
    use HasFactory;

    protected $fillable = [
        'file_id', 'name', 'clip', 'minute', 'second',
        'description',
        'time'
    ];

    protected $casts = [
        'minute' => 'int',
        'second' => 'int'
    ];

    public function file(): BelongsTo {
        return $this->belongsTo(File::class);
    }


    public function clipUrl() {
        
        if(Str::startsWith($this->attributes['clip'], 'http://')) {
            return $this->attributes['clip'];
        }
        return asset(Storage::url('files/clips/'.$this->clip));
    }
}
