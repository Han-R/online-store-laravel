<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

//use Dimsav\Translatable\Translatable;
use Auth;

class Review extends Model
{
    //, Translatable
    use SoftDeletes;
    public $table = 'reviews';
    public $translatedAttributes = [];
    protected $fillable = ['product_id', 'user_id', 'rating', 'comment', 'approved', 'spam'];
    protected $hidden = ['created_at', 'updated_at', 'deleted_at'];


    protected $appends = ['views','image'];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function product()
    {
        return $this->belongsTo('App\Models\Product');
    }

    public function scopeApproved($query)
    {
        return $query->where('approved', true);
    }

    public function scopeSpam($query)
    {
        return $query->where('spam', true);
    }

    public function scopeNotSpam($query)
    {
        return $query->where('spam', false);
    }

    public function getTimeagoAttribute()
    {

        $date = \Carbon\Carbon::createFromTimeStamp(strtotime($this->created_at))->diffForHumans();
        return $date;
    }

    public function storeReviewForProduct($productID, $comment, $rating)
    {
        $product = Product::find($productID);

            $this->product_id = $productID;
            $this->user_id = Auth::user()->id;
            $this->comment = $comment;
            $this->rating = $rating;
            $product->reviews()->save($this);

            // recalculate ratings for the specified product
            $product->recalculateRating();

    }


}
