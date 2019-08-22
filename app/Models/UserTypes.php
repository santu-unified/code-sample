<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;

class UserTypes extends Model
{

    public $timestamps = false;
    public $table = "user_types";

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'type_name'
    ];

    //user purchase courses
    public function user(){
        return $this->belongsTo(User::class);
    }
}
