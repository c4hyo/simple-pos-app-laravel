<?php

namespace App\Http\Model;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $fillable =['code','date','total_price'];
    public function items()
    {
        return $this->belongsToMany('App\Http\Model\Item')->withPivot('quantity','subtotal');
    }
}
