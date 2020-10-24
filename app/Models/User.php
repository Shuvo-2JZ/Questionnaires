<?php

namespace App\Models;

// namespace:
// They allow for better organization by grouping classes that work together to perform a task
// They allow the same name to be used for more than one class
// The 'use' statement allows us to import the class into the current namespace

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    // a user has many questionnaires
    // one to many relation
    public function questionnaires()
    {
        return $this->hasMany(Questionnaire::class);
    }
}
