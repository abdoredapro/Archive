<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class File extends Model
{
    protected $guarded = ['id'];

    protected $cast = [
        'release_year' => 'int',
    ];

    /**
     * Search file with query
     */
    protected static function booted(): void
    {
        self::addGlobalScope('search', function (Builder $query) {

            $query->when(request()->query('project'), function (Builder $query, $project) {
                $query->where('project', $project);
            });

            $query->when(request()->query('release_year'), function (Builder $query, $release_year) {
                $query->where('release_year', $release_year);
            });

        });
    }


    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class)
            ->withDefault(['name' => 'Public']);
    }

    public function project(): BelongsTo
    {
        return $this->belongsTo(Project::class)
            ->withDefault(['name' => 'Public']);
    }


    protected function ImageUrl(): Attribute
    {
        return Attribute::make(
            get: fn() => $this->image ? asset(Storage::url('files/images/' . $this->image)) : asset('default.jfif'),
        );
    }

    protected function VideoUrl(): Attribute
    {
        return Attribute::make(
            get: function () {
                if (Str::startsWith('http://', $this->video) || Str::startsWith('https://', $this->video)) {
                    return $this->video;
                } else {
                    return asset(Storage::url('files/videos/' . $this->video));
                }
            },
        );
    }

    public function clips(): HasMany
    {
        return $this->hasMany(FileClip::class, 'file_id');
    }

}
