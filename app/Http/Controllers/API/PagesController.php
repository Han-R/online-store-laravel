<?php

namespace App\Http\Controllers\API;

use App\Models\Page;
use App\Http\Controllers\Controller;
use GuzzleHttp\Exception\RequestException;

class PagesController extends Controller
{
    public function about()
    {
        $about = Page::query()->where('id',1)->first();
        return mainResponse(true, 'api.ok', $about,[]);
    }

    public function privacy()
    {
        $privacy = Page::query()->where('id',2)->first();
        return mainResponse(true, 'api.ok', $privacy,[]);
    }

    public function terms()
    {
        $terms = Page::query()->where('id',3)->first();
        return mainResponse(true, 'api.ok', $terms,[]);
    }
}