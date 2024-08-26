<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Spatie\Permission\Traits\HasRoles;

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


    // protected function getImageUrlAttribute() {

    //     if($this->photo) {
    //         return asset(Storage::link('users/'.$this->image));
    //     } else {
    //         return asset('assets/avatar.png');
    //     }
    // }

    public function imageUrl() : string
    {
        if($this->photo) {
            return asset(Storage::url('users/'.$this->photo));
        } else {
            return asset('assets/avatar.png');
        }
        
    }
}
