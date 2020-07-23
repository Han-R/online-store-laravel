<?php

namespace App\Http\Controllers\WEB\Admin;

use App\Models\AdvertisementUs;
use App\Models\Category;
use App\Models\CategoryTranslation;
use App\Models\Contact;
use App\Models\Language;
use App\Models\Setting;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdvertisementController extends Controller
{
    public function __construct()
    {
        $this->settings = Setting::query()->first();
        view()->share([
            'settings' => $this->settings,
        ]);
    }

    public function index(Request $request)
    {
        $items = AdvertisementUs::query();
        if ($request->has('email')) {
            if ($request->get('email') != null)
                $items->where('email', 'like', '%' . $request->get('email') . '%');
        }
        if ($request->has('comment')) {
            if ($request->get('comment') != null)
                $items->where('comment', 'like', '%' . $request->get('comment') . '%');
        }
        if ($request->has('mobile')) {
            if ($request->get('mobile') != null)
                $items->where('mobile', 'like', '%' . $request->get('mobile') . '%');
        }
        $items = $items->orderBy('id', 'desc')->get();
        return view('admin.advertisements.home', [
            'items' => $items,
        ]);

    }

    public function destroy($id)
    {
        $item = AdvertisementUs::query()->findOrFail($id);
        if ($item) {
            AdvertisementUs::query()->where('id', $id)->delete();
            return "success";
        }
        return "fail";
    }
}
