<?php

namespace App\Http\Controllers;

use App\Http\Model\Item;
use App\Http\Model\Categories;
use App\Http\Requests\ItemRequest;

class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Item $model)
    {
        $data = [
            'item' => $model->all()
        ];
        return view('item.index',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Categories $model)
    {
        $data = [
            'categories' => $model->all()
        ];
        return view('item.create',$data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ItemRequest $request,Item $model,Categories $categori)
    {
        $categories = $categori->find($request->categories_id);
        $code = $categories->code."-".randomNumber();
        $input = $request->merge(['code'=>$code])->all();
        $model->create($input);
        return redirect()->route('item.index')->withStatus(__('Item successfully created.'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Http\Model\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function show(Item $item)
    {
        // dd($item);
    
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Http\Model\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function edit(Item $item)
    {
        // dd($item->categories);
        $data = [
            'item'=>$item,
            'categories'=> Categories::where('id','<>',$item->categories_id)->get()
        ];
        return view('item.edit',$data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Http\Model\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function update(ItemRequest $request, Item $item)
    {
        $item->update($request->all());
        return redirect()->route('item.index')->withStatus(__('Item successfully updated.'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Http\Model\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function destroy(Item $item)
    {
        $item->delete();
        return redirect()->route('item.index')->withStatus(__('Item successfully deleted.'));
    }
}
