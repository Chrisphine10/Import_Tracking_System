<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    public function transaction(){
        return $this->belongsTo('App\Transaction');
    }

    public function additional(){
        return $this->hasMany('App\Additional');
    }
}
