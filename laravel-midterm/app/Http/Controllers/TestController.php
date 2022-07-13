<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Response;
use App\Models\T_food;
use Illuminate\Http\Request;

class TestController extends Controller
{
    public function show()
    {
        $list = T_food::join('categories', 'categories.id', 't_foods.category_id')
            ->select('categories.categories as nameCategory', 't_foods.*')
            ->get();
        return response()->json($list, Response::HTTP_OK);
    }

    public function showDetail($id)
    {
        $list = T_food::join('categories', 'categories.id', 't_foods.category_id')
            ->select('categories.categories as nameCategory', 't_foods.*')
            ->where('t_foods.id', '=', $id)
            ->first();
        return response()->json($list, Response::HTTP_OK);
    }

    public function store(Request $request)
    {
        $name = '';
        if ($request->hasfile('image')) {
            $file = $request->file('image');
            $name = time() . '_' . $file->getClientOriginalName();
            $destinationPath = public_path('images'); //project\public\car, //public_path(): trả về đường dẫn tới thư mục public
            $file->move($destinationPath, $name); //lưu hình ảnh vào thư mục public/image
        }
        $food = new T_food();
        $food->name = $request->name;
        $food->price = $request->price;
        $food->image = $name;
        $food->old_price = $request->old_price;
        $food->description = $request->description;

        $food->category_id = $request->category_id;
        $food->save();
        return response()->json(["status" => "200", "data" => $food]);
    }

    public function showCategory()
    {
        $listCategory = Category::all();
        return response()->json($listCategory, Response::HTTP_OK);
    }

    public function update(Request $request, $id)
    {
        $name = '';
        if ($request->hasfile('image')) {
            $file = $request->file('image');
            $name = time() . '_' . $file->getClientOriginalName();
            $destinationPath = public_path('images'); //project\public\car, //public_path(): trả về đường dẫn tới thư mục public
            $file->move($destinationPath, $name); //lưu hình ảnh vào thư mục public/image
        }
        $food = T_food::find($id);
        $food->name = $request->name;
        $food->price = $request->price;
        $food->image = $name;
        $food->old_price = $request->old_price;
        $food->description = $request->description;
        $food->save();
        return response()->json(["status" => "200", "data" => $food]);
    }

    public function delete($id)
    {
        T_food::find($id)->delete();
        return response()->json([], Response::HTTP_OK);
    }

    public function search(Request $request)
    {
        $food = T_food::join('categories', 'categories.id', 't_foods.category_id')
            ->where('name', 'like', '%' . $request->search . '%')
            ->select('categories.categories as nameCategory', 't_foods.*')
            ->get();
        return response()->json($food, Response::HTTP_OK);
    }

    public function index(Request $request)
    {
        if (!isset($request->search))
            $food = T_food::join('categories', 'categories.id', 't_foods.category_id')
                ->select('categories.categories as nameCategory', 't_foods.*')
                ->get();
        else {
            $food = T_food::join('categories', 'categories.id', 't_foods.category_id')
                ->orWhere('name', 'like', '%' . $request->search . '%')
                ->orWhere('price', '=',  $request->search)
                ->select('categories.categories as nameCategory', 't_foods.*')
                ->get();
        }
        return response()->json($food, Response::HTTP_OK);
    }

    public function statistical()
    {
        $count_category = T_food::join('categories', 'categories.id', 't_foods.category_id')
                    ->selectRaw('categories.categories, count(*) as total')
                    ->groupBy('categories.categories')
                    ->get();
                    return response()->json($count_category, Response::HTTP_OK);
                  
}
}
