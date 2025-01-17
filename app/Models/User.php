<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use App\Observers\UserObserver;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Spatie\Permission\Traits\HasRoles;

#[ObservedBy([UserObserver::class])]
class User extends Authenticatable
{
    use HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'photo', 
        'phone_number',
        'username', 
        'bio',
        'status'

    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }


    public static function rules($id = 0) {

        return [
            'image'     => ['nullable', 'image', 'mimes:jpeg,jpg,png,gif,svg'],
            'email'     => ['required', 'email', "unique:users,email,$id"],
            'username'  => ['nullable', 'string', 'min:4','max:255'],
            'bio'       => ['nullable', 'string'],
        ];
    }

    public function imageUrl() : string
    {
        if($this->photo) {
            return asset(Storage::url('users/'.$this->photo));
        } else {
            return asset('assets/avatar.png');
        }
        
    }
}
