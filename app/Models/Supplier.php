<?php

namespace App\Models;

use Dimsav\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Supplier extends Model
{
    use SoftDeletes, Translatable;
    protected $hidden = ['updated_at', 'deleted_at'];
    public $translatedAttributes = ['name'];
}


