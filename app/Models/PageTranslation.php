<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PageTranslation extends Model
{
    protected $table='page_translations';
    public $fillable = ['page_id','title','keywords','description'];

}
