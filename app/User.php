<?php

namespace App;

use App\Models\Order;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Carbon\Carbon;

class User extends Authenticatable
{
    use SoftDeletes,Notifiable;

    protected $fillable = [
        'avatar', 'name',  'mobile' ,'email', 'address','password', 'status'
    ];


    protected $hidden = [
        'password', 'remember_token', 'created_at', 'updated_at', 'deleted_at'
    ];
    ///////////////////////////////////////////////////////////////////////////
    public function favourites()
    {
        return $this->belongsToMany(Work::class,'favourites');
    }
    //////////////////////////////////////////////////////////////////////////
    public function getAvatarAttribute($value)
    {
        if ($value) {
            return url('uploads/users/' . $value);
        }
        else{
            return "";
        }
    }

    //relationship between user and cart one to one
    public function cart()
    {
        return $this->hasOne('App\Models\Cart');
    }
    public function wishlist()
    {
        return $this->hasOne('App\Models\wishlist');
    }
    //relatioship between user and order one to many
    public function orders()
    {
        return $this->hasMany('App\Models\Order','user_id','id');
    }

}