<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SliderTranslation extends Model
{
    use  SoftDeletes;
    protected $table='slider_translations';
    public $fillable = ['title'];
}
