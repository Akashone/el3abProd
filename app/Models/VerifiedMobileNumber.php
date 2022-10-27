<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * VerifiedMobileNumber Entity
 * 
 * @property int        $id
 * @property string     $mobile_number
 * @property bool       $verified
 * @property int        $user_id
 */

class VerifiedMobileNumber extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assigned
     * 
     * @var array<int, string>
     */
    protected $fillable = [
        'mobile_number',
        'verified',
        'user_id',
    ];

    /**
     * get associated user
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
