<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;

class UserDetails extends Model
{

    public $timestamps = false;
    public $table = "user_details";

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'custom1', 'custom2',
    ];

    //user purchase courses
    public function user(){
        return $this->belongsTo(User::class);
    }
}
