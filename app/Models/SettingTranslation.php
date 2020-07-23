<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Client
 *
 * @package App\Models
 * @SWG\Definition(type="object")
 */

class SettingTranslation extends Model
{

    protected $table='setting_translations';
    protected $fillable = ['name','description','keywords','address','about_us','our_vision','our_mision'];


}
