<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'background_color'
    ];

    
    protected static function booted()
    {

        self::creating(function(Category $category) {
            $category->slug = Str::slug($category->name);
            $category->background_color = Arr::random(['green1', 'pink1', 'blue1', 'green2', 'blue2', 'pink2', 'orange2', 'purple1']);
        });
        
    }


    public function films(): HasMany {
        return $this->hasMany(Film::class);
    }

    
}
