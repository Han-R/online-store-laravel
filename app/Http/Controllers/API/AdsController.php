<?php

namespace App\Http\Controllers\API;

use App\Models\Ads;
use App\Http\Controllers\Controller;

class AdsController extends Controller
{
    public function random()
    {
        $data = Ads::query()->inRandomOrder()->first();
        return mainResponse(true, 'api.ok', $data,[]);
    }
}