<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class Transaction extends Model
{
    use Sortable;

    protected $fillable = [
        'proforma_invoice_number', 'quantity', 'unit_price', 'total_price', 'payment_terms', 'status'
    ];

    public $sortable = ['id', 'proforma_invoice_number', 'supplier_id', 'user_id', 'quantity', 'status', 'payment_terms', 'total_price', 'unit_price', 'date', 'created_at', 'updated_at'];

}
