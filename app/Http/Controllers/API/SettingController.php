<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Setting;


class SettingController extends Controller
{
    public function index()
    {
        $items = Setting::query()->get();
        $aryData = [];
        foreach ($items as $item){
            $aryData[$item->key]=$item;
        }
        return mainResponse(true, 'api.ok', $aryData, []);
    }
}
