<?php

namespace App\Http\Controllers;
use App\Http\Model\Item;
use App\Http\Model\Categories;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\View\View
     */
    public function index(Item $item,Categories $category)
    {
        $data = [
            'item' => $item->where('stocks','>',0)->get(),
            'category' => $category->all()
        ];
        return view('home',$data);
    }
    public function testing(Request $request)
    {
        dd($request->all());
    }
}
