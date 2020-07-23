<?php

namespace App\Http\Controllers\API;

use App\Models\Contact;
use App\Models\Setting;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use GuzzleHttp\Exception\RequestException;
use Validator;

class ContactController extends Controller
{
    public function store(Request $request)
    {
          $validator = Validator::make($request->all(), [
                'fullname' => 'required',
                'email' => 'required|email',
                'mobile' => 'required',
                'comment' => 'required',
            ]);
            if ($validator->fails())
            {
                return mainResponse(false, '', [], $validator);
            }
            Contact::query()->create([
                'fullname' => $request->get('fullname'),
                'email' => $request->get('email'),
                'mobile' => $request->get('mobile'),
                'comment' => $request->get('comment')
            ]);
            return mainResponse(true, 'api.ok', [],[]);
    }

    public function index()
    {
        $app_details = Setting::all()->pluck('value', 'key');
        return mainResponse(true, 'api.ok', $app_details,[]);
    }
}