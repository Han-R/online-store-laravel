<?php

namespace App\Models;

use Dimsav\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use SoftDeletes, Translatable;
    protected $fillable = ['icon'];
    protected $hidden = [  'created_at', 'updated_at', 'deleted_at', 'status'];
    public $translatedAttributes = ['name','details'];
    protected $appends = ['parent'];

    public function department()
    {
        return $this->belongsTo(Department::class, 'department_id', 'id');
    }

    public function subCategories(){
        return $this->hasMany(Category::class, 'parent_id');
    }

    public function getIconAttribute($icon)
    {
        if($icon) {
            return url('uploads/categories/' . $icon);
        }
        return '';
    }

    public function getParentAttribute(){
        if($this->attributes['parent_id']>0){
            return Category::findOrFail($this->attributes['parent_id']);
        }
        return null;
    }



}


