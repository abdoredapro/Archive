<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class Film extends Model
{
    protected $fillable = [
        'category_id',
        'name',
        'image',
        'video',
        'film_script',
        'upload_status',
        'info',
        'deleted_at',
        'release_year',
        'tap_type',
        'production_manager',
        'tap_number',
        'project_beneficiary',
        'sound_engineer',
        'project_category',
        'image_url',
        'video_url',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    protected function imageUrl(): Attribute
    {

        return Attribute::make(
            get: fn() => asset('/storage/films/images/' . $this->image),
        );
    }

    protected function videoUrl(): Attribute
    {

        return Attribute::make(
            get: fn() => asset('/storage/films/videos/' . $this->video),
        );
    }

    public function clips()
    {
        return $this->hasMany(FilmClip::class, 'film_id');
    }


    protected static function booted()
    {
        static::addGlobalScope('filter', function (Builder $builder) {
            if (request()->query('release_year')) {
                $builder->where('release_year', request()->query('release_year'));
            }
        });
    }


}
