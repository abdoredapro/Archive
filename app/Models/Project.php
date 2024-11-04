<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;

class Project extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 
        'slug',
        'background_color'
    ];

    protected $hidden = [
        'created_at', 
        'updated_at',
    ];

    protected static function booted()
    {
        self::creating(function(Project $project) {
            $project->slug = Str::slug($project->name);
            
            $project->background_color = Arr::random(['green1', 'pink1', 'blue1', 'green2', 'blue2', 'pink2', 'orange2', 'purple1']);
        });
    }


    public function files(): HasMany 
    {
        return $this->hasMany(File::class);
    }

    

}
