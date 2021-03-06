<?php

namespace App\Http\Controllers;

use App\Http\Model\Categories;
use App\Http\Requests\CategoriesRequest;
use Illuminate\Support\Str;

class CategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Categories $model)
    {
        $data = [
            'categories' => $model->all()
        ];
        return view('categories.index',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('categories.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CategoriesRequest $request,Categories $model)
    {
        $code = strtoupper(Str::random(3));
        $input = $request->merge(['code'=>$code])->all();
        $model->create($input);
        return redirect()->route('categories.index')->withStatus(__('Categori successfully created.'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Http\Model\Categories  $categories
     * @return \Illuminate\Http\Response
     */
    public function show(Categories $category)
    {
        $data =[
            'categories'=>$category
        ];
        return view('categories.show',$data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Http\Model\Categories  $categories
     * @return \Illuminate\Http\Response
     */
    public function edit(Categories $category)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Http\Model\Categories  $categories
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Categories $category)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Http\Model\Categories  $categories
     * @return \Illuminate\Http\Response
     */
    public function destroy(Categories $category)
    {
        //
    }
}
