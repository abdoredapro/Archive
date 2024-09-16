<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;

class File extends Model
{
    protected $fillable = [
        'project_id',
        'name',
        'image',
        'video',
        'description',
        'info',
        'hours',
        'minutes',
        'seconds',
        'deleted_at',
        'release_year',
        'tap_type',
        'production_manager',
        'tap_number',
        'project_beneficiary',
        'sound_engineer',
        'project_category',
    ];

    protected $with = [
        'clips'
    ];


    public function project(): BelongsTo
    {
        return $this->belongsTo(Project::class)
            ->withDefault(['name' => 'Public']);
    }

    public function ImageUrl(): string
    {
        return asset(Storage::url('files/images/' . $this->image));
    }

    public function VideoUrl(): string
    {
        return asset(Storage::url('files/videos/' . $this->video));
    }

    public function FileDuration(): string
    {

        return (int)$this->hours . 'س ' . (int)$this->minutes . 'د ' . (int)$this->seconds . 'ث';

    }

    public function clips(): HasMany
    {
        return $this->hasMany(FileClip::class, 'file_id');
    }

    protected static function booted(): void
    {
        static::addGlobalScope('filter', function (Builder $builder) {
            if (request()->query('release_year')) {
                $builder->where('release_year', request()->query('release_year'));
            }
        });
    }
}
