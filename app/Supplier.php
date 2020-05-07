<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;
class Supplier extends Model
{
    use Sortable;
    
    public $sortable = [
        'email', 'id', 'name',
    ];

    public function transaction(){
        return $this->hasMany('App\Transaction');
    }
}
