<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;


/**
 * Users entity
 *
 * @property int        $id
 * @property string     $name
 * @property string     $nick_name
 * @property date       $dob
 * @property string     $email
 * @property int        $verified_mobile_number_id
 * @property string     $gender
 * @property string     $field_position
 * @property string     $skill_level
 */
class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'nick_name',
        'dob',
        'email',
        'verified_mobile_number_id',
        'gender',
        'field_position',
        'skill_level',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'remember_token',
        'password',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * get the verified mobile associated with the user
     */
    public function mobile()
    {
        return $this->belongsTo(VerifiedMobileNumber::class, 'verified_mobile_number_id');
    }
}
