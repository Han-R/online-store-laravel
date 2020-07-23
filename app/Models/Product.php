<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Dimsav\Translatable\Translatable;
use Auth;

class Product extends Model
{
    use SoftDeletes, Translatable;
	 public $table = 'products';
	 public $translationModel = 'App\Models\ProductTranslation';

	 protected $fillable = ['category_id,price'];
	 public $translatedAttributes =['locale','name','details'];

    protected $appends = ['views','image'];

    public function product_translations()
    {
        return $this->hasMany(ProductTranslation::class);
    }

    public function images()
    {
        return $this->hasMany(Attatchment::class, 'product_id', 'id');
    }

    public function getImageAttribute()
    {
        return $this->hasMany(Attatchment::class, 'product_id', 'id')->pluck('name')->first();
    }

    public function getViewsAttribute()
    {
        return View::query()->where("product_id" ,$this->attributes['id'])->count();
    }

    public function department()
    {
        return $this->belongsTo(Department::class, 'department_id', 'id');
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }

    public function sub_category()
    {
        return $this->belongsTo(Category::class, 'sub_category_id', 'id');
    }

    public function quantities()
    {
        return $this->hasMany(Quantity::class, 'product_id', 'id');
    }


    //relatioship between order and product many to many
    public function orders()
    {
        return $this->belongsToMany('App\Models\Order','order_products','order_id','product_id')->withPivot('quantity','price');
    }

    public function carts()
    {
        return $this->hasMany('App\Models\Cart');
    }

    public function wishlists()
    {
        return $this->hasMany('App\Models\wishlist');
    }

    public function reviews()
    {
        return $this->hasMany('App\Models\Review');
    }

    // The way average rating is calculated (and stored) is by getting an average of all ratings,
    // storing the calculated value in the rating_cache column (so that we don't have to do calculations later)
    // and incrementing the rating_count column by 1

    public function recalculateRating()
    {
        $reviews = $this->reviews()->notSpam()->approved();
        $avgRating = $reviews->avg('rating');
        $this->rating_cache = round($avgRating,1);
        $this->rating_count = $reviews->count();
        $this->save();
    }

    public function currentUserHasSubmittedReview(){
        $countOfReviews = $this->reviews()->notSpam()->approved()
            ->where('user_id', Auth::user()->id)
            ->where('product_id', $this->id)
            ->count();


        return ($countOfReviews == 0 ? true : false);
    }

    public function currentUserReview(){
        $Review = $this->reviews()->notSpam()->approved()
            ->where('user_id', Auth::user()->id)
            ->where('product_id', $this->id)
            ->first();


        return $Review ;
    }


}
