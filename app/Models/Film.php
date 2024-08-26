<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class Film extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id', 
        'name',
        'image', 
        'video',
        'film_script',
        'info',
        'release_year',
        'tap_type',
        'production_manager',
        'tap_number',
        'project_beneficiary',
        'sound_engineer',
        'project_category',
    ];

    public function category() {
        return $this->belongsTo(Category::class);
    }
    
    protected function imageUrl(): Attribute
    {
        
        return Attribute::make(
            get: fn () => asset('/storage/films/images/'.$this->image),
        );
    }

    protected function videoUrl(): Attribute
    {
        
        return Attribute::make(
            get: fn () => asset('/storage/films/videos/'.$this->video),
        );
    }



}
