<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\User;

class Order extends Model
{
    use SoftDeletes;
    public $table = 'orders';
    protected $fillable = [
        'user_id','status','mobile','address','total','payment_method',
    ];
    //relatioship between user and order one to many
    public function user()
    {
        return $this->belongsTo('App\User','user_id');
    }

    //relatioship between order and product many to many
    public function products()
    {
        return $this->belongsToMany('App\Models\Product','order_products','order_id','product_id')->withPivot('quantity','price');
    }


}