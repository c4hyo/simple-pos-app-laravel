<?php

namespace App\Http\Controllers;

use App\Http\Model\Transaction;
use App\Http\Model\Item;
use App\Http\Model\TransactionPivot;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Transaction $model)
    {
        $data = $model->with('items')->get();
        return response()->json($data, 200);

    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $items = Item::where('id',$request->item_id)->update($request->only(['stocks']));
        Transaction::updateOrCreate($request->only(['code']));
        $models = Transaction::where('code',$request->code)->first();
        TransactionPivot::create($request->merge(['transaction_id'=>$models->id])->only(['item_id','quantity','subtotal','transaction_id']));
        $data = [
            'data'=>$request->all()
        ];
        return response()->json($models->id,200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Http\Model\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function show(Transaction $transaction)
    {
        $model = $transaction->items;
        return response()->json($model, 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Http\Model\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function edit(Transaction $transaction)
    {
        // dd($transaction);
        $data = [
            'transaction' => $transaction
        ];
        return view('transaction.show',$data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Http\Model\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Transaction $transaction)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Http\Model\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function destroy(Transaction $transaction)
    {
        //
    }
}
