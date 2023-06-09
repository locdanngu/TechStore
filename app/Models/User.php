<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable implements MustVerifyEmail
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
        'email_verified_at',
        'password',
        'verifyemail',
        'codeverifyemail',
        'codeverifyemailend',
        'phone',
        'avatar',
        'role',
        'balance',
        'status'
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


    public function cart()
    {
        return $this->hasMany(Cart::class, 'id');
    }

    public function notification()
    {
        return $this->hasMany(Cart::class, 'id');
    }


    public function messages_sent()
    {
        return $this->hasMany(Message::class, 'sender_id');
    }

    public function messages_received()
    {
        return $this->hasMany(Message::class, 'receiver_id');
    }
}
