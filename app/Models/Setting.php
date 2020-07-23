<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Dimsav\Translatable\Translatable;

class Setting extends Model
{
    use  Translatable;
    protected $table='settings';

    public $translatedAttributes = ['name','description','keywords','address','about_us','our_vision','our_mision'];

    public function setting_translations()
    {
        return $this->hasMany(SettingTranslation::class);
    }
}
