<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('proforma_invoice_number');
            $table->integer('quantity');
            $table->decimal('unit_price',8,2);
            $table->decimal('total_price',8,2);
            $table->enum('payment_terms', ['swift', 'ATGS', 'cheque']);
            $table->integer('user_id');
            $table->integer('supplier_id');
            $table->enum('status', ['ordered', 'in transit', 'received']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transactions');
    }
}
