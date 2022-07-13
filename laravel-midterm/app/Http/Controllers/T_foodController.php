<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\T_food;
use Illuminate\Http\Request;

class T_foodController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $action = 'create';
        
        $list = Category::all();
        return view("create",compact('list', 'action'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        $validatedData = $request->validate([
            'name' => 'required',
            'price' => 'required',
            'old_price' => 'required',
            'description' => 'required', 
        ],[
            'name.required' => 'Name bắt buộc',
            'price.required' => 'giá bắt buộc',
            'old_price.required' => 'Old price bắt buộc',
            'description.required' => 'Description bắt buộc',
            ]);
        $tfood = new T_food();
        $tfood -> name= $request->name;
        $tfood -> price= $request->price;
        $tfood -> old_price= $request->old_price;
        $tfood -> image= $request->image;
        $tfood -> description= $request->description;
        $tfood -> category_id= $request->category_id;
        $tfood->save();
        return redirect('/show');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        // return view('show');
       
            $t_foods = T_food::join('categories', 'categories.id', 't_foods.category_id')
            ->select('categories.categories as categories', 't_foods.*')
            ->get();
        
        return view("show",compact('t_foods'));
    }

    public function detail($id){
        $t_foods = T_food::join('categories', 'categories.id', 't_foods.category_id')
        ->where ('t_foods.id' , '=' , $id)
        ->select('categories.categories as categories', 't_foods.*') 
        ->first();
        // dd ($students);
        return view('detail',compact('t_foods'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
