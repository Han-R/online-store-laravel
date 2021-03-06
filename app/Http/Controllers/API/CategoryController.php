<?php

namespace App\Http\Controllers\API;

use App\Models\Testimonial;
use App\Models\CategoryList;
use App\Models\Work;
use Validator;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class CategoryController extends Controller
{
    public function index()
    {
        $data = Testimonial::query()->public()->get();
        return mainResponse(true, 'api.ok', $data, []);
    }

    public function addToBestCategory(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'category_id' => 'required|numeric',
        ]);
        if ($validator->fails()) {
            return mainResponse(false, '', [], $validator);
        }
        $category_id = $request->get('category_id');
        $user = Auth::guard('api')->user();
        $category = Testimonial::where('id', $category_id)->first();
        if ($category) {
            $new = CategoryList::query()->firstOrCreate([
                'user_id' => $user->id, 'category_id' => $category_id
            ]);
            if ($new->wasRecentlyCreated) {
                return mainResponse(true, 'api.ok', [], []);
            } else {
                return mainResponse(true, 'api.foundCategory', [], []);
            }
        } else {
            return mainResponse(true, 'api.numberNotFound', [], []);
        }
    }

    public function removeFromBestCategory(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'category_id' => 'required|numeric',
        ]);
        if ($validator->fails()) {
            return mainResponse(false, '', [], $validator);
        }
        $category_id = $request->get('category_id');
        $user = Auth::guard('api')->user();
        $category = Testimonial::where('id', $category_id)->first();
        if ($category) {
            $remove = CategoryList::where('user_id', $user->id)->where('category_id', $category_id)->delete();
            if ($remove) {
                return mainResponse(true, 'api.ok', [], []);
            } else {
                return mainResponse(true, 'api.notFoundCategory', [], []);
            }
        } else {
            return mainResponse(true, 'api.numberNotFound', [], []);
        }
    }

    public function ProductsOfCategory(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'category_id' => 'required|numeric',
        ]);
        if ($validator->fails()) {
            return mainResponse(false, '', [], $validator);
        }
        $category_id = $request->get('category_id');
        $data = Work::query()->public()->where('id', $category_id)->
        with(['images', 'currency', 'category', 'publish'])->get();
        return mainResponse(true, 'api.ok', $data, []);
    }

    public function getCategoryForUser()
    {
        return $user = Auth::guard('api')->user()->categories;

    }
}