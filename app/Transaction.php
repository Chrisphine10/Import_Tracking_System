<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $fillable = [
        'proforma_invoice_number', 'quantity', 'unit_price', 'total_price', 'payment_terms',
    ];

}
