<?php

namespace App\Models;

use App\Admin;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Ads extends Model
{
    use SoftDeletes;
    protected $table = 'ads';
    protected $fillable = ['image', 'description','createdBy'];
    protected $hidden = ['description','order_by','status','createdBy', 'created_at', 'updated_at', 'deleted_at'];

    //public $translatedAttributes = ['details'];

    public function admin()
    {
        return $this->belongsTo(Admin::class, 'createdBy', 'id');
    }

    public function scopePublic($query, $isActive = 'active', $orderBy = 'asc')
    {
        return $query->where(['status' => $isActive])->orderBy('order_by', $orderBy);
    }

//    public function getImageAttribute($image)
//    {
//        return url($image);
//    }

    public function getStatusAttribute($value)
    {
        if ($value == 'not_active')
            return "Not Active";
        return "Active";
    }
}
