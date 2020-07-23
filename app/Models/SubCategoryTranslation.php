<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SubCategoryTranslation extends Model
{
    use  SoftDeletes;
    public $fillable = ['name'];

    public function subcategory()
    {
        return $this->belongsTo(SubCategory::class);
    }
}
