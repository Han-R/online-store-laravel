<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Contact extends Model
{
    use SoftDeletes;
    protected $table = 'contact_us';

    protected $fillable = [
        'name', 'email', 'mobile','seen','subject','message',
    ];


}
