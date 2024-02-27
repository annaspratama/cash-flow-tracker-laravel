<?php

namespace App\Models;

use App\Notifications\ForgotPasswordNotification;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Laravel\Sanctum\HasApiTokens;
use App\Notifications\RegistrationNotification;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'password',
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
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    /**
     * Set user fullname.
     * 
     * @return string
     */
    public function getFullnameAttribute(): string
    {
        return $this->last_name ? "{$this->first_name} {$this->last_name}" : $this->first_name;
    }

    /**
     * Send email for registration verification.
     * 
     * @return void
     */
    public function sendEmailVerificationNotification(): void
    {
        $this->notify(instance: new RegistrationNotification);
    }

    /**
     * Send a password reset notification to the user.
     * 
     * @param string $token
     * 
     * @return void
     */
    public function sendPasswordResetNotification($token): void
    {
        $url = url(path: '/recover-password', parameters: ['token' => $token]);
        $this->notify(instance: new ForgotPasswordNotification(url: $url)); 
    }
}
