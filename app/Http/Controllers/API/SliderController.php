<?php

namespace App\Http\Controllers\API;

use App\Models\Slider;
use App\Http\Controllers\Controller;
use GuzzleHttp\Exception\RequestException;
use Illuminate\Http\Request;


class SliderController extends Controller
{
    public function index()
    {
        $data = Slider::query()->where('status','active')->orderBy('order_by','asc')->get();
        return mainResponse(true, 'api.ok', $data,[]);
    }
}