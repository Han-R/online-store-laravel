<?php

namespace App\Models;

use Dimsav\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Department extends Model
{
    use SoftDeletes, Translatable;
    protected $hidden = [  'created_at', 'updated_at', 'deleted_at', 'status'];
    public $translatedAttributes = ['name','details'];

    public function categories()
    {
        return $this->hasMany(Category::class,'department_id');
    }

    public function products()
    {
        return $this->hasMany('App\Models\Product');
    }




}


