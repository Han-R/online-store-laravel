<?php

namespace App\Models;

use Carbon\Carbon;
use Dimsav\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Slider extends Model
{
    use SoftDeletes, Translatable;
    protected $fillable = ['image', 'title'];
    protected $hidden = ['created_at', 'updated_at', 'deleted_at'];
    public $translatedAttributes = ['title'];

    public function getImageAttribute($image)
    {
        if ($image) {
            return url('uploads/sliders/' . $image);
        }
        else{
            return "";
        }
    }
    
    public function getCreatedAtAttribute($value)
    {
        return Carbon::parse($value)->format('d-m-Y');
    }
}
