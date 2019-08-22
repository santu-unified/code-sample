<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Models\User;

class Files extends Model
{

    public $timestamps = false;
    public $table = "files";

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id','file_name','type','is_primary'
    ];

    //user purchase courses
    public function user(){
        return $this->belongsTo(User::class);
    }
}
