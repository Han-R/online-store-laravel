<?php

namespace App\Models;

use App\User;
use Carbon\Carbon;
use Dimsav\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;

class SubCategory extends Model
{
    use SoftDeletes, Translatable;
    protected $fillable = ['icon', 'createdBy' ,'category_id'];
    public $translatedAttributes = ['name'];

    protected $hidden = ['createdBy', 'created_at', 'updated_at', 'deleted_at', 'status'];
//    protected $appends = ['is_added'];

    public function subcategory_translations()
    {
        return $this->hasMany(SubCategoryTranslation::class);
    }

    public function products()
    {
        return $this->hasMany(Work::class);
    }
    /////////////////////////////////////////////////////
//    public function user()
//    {
//        return $this->belongsTo(User::class, 'createdBy', 'id');
//    }

    public function scopePublic($query, $isActive = 'active', $orderBy = 'asc')
    {
        return $query->where(['status' => $isActive])->orderBy('order_by', $orderBy);
    }
    public function getStatusAttribute($value)
    {
        if ($value == 'not_active')
            return "Not Active";
        return "Active";
    }
//    public function getImageAttribute($value)
//    {
//        return url($value);
//    }

    public function getCreatedAtAttribute($value)
    {
        return Carbon::parse($value)->format('d-m-Y');
    }
    public function getIconAttribute($icon)
    {
        if($icon) {
            return url('uploads/categories/' . $icon);
        }
        return '';
    }
}
