<?php

namespace App\Http\Model;

use Illuminate\Database\Eloquent\Model;

class Categories extends Model
{
    protected $fillable =['code','name','description'];
    public function items(){
        return $this->hasMany('App\Http\Model\Item');
    }
}
