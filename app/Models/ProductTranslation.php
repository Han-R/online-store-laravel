<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductTranslation extends Model
{
    protected $table='product_translations';
    public $fillable = ['product_id','name','details'];
}
