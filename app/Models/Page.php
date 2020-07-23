<?php

namespace App\Models;

use Dimsav\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Page extends Model
{
    use SoftDeletes, Translatable;
    protected $table = 'pages';
    protected $fillable = ['image'];
    protected $hidden = ['updated_at','deleted_at'];


    public $translatedAttributes = ['title','keywords','description'];

    public function page_translations()
    {
        return $this->hasMany(PageTranslation::class);
    }

    public function getImageAttribute($image)
    {
        return url($image);
    }

}
