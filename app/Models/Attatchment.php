<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Nursery;


class Attatchment extends Model
{
    use SoftDeletes;
    public $table = 'attatchments';
    protected $fillable = ['name'];

    public function getNameAttribute($value)
    {
        if ($value) {
            return url('uploads/products/' . $value);
        }
        else{
            return "";
        }
    }

}
