<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class Transaction extends Model
{
    use Sortable;

    protected $fillable = [
        'proforma_invoice_number', 'quantity', 'unit_price', 'total_price', 'payment_terms',
    ];

    public $sortable = ['id', 'proforma_invoice_number', 'user_id', 'quantity', 'payment_terms', 'total_price', 'unit_price', 'created_at', 'updated_at'];

}
