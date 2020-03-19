<?php

namespace App\Http\Model;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    protected $fillable =['code','name','stocks','price','description','categories_id'];
    public function categories(){
        return $this->belongsTo('App\Http\Model\Categories');
    }
}
