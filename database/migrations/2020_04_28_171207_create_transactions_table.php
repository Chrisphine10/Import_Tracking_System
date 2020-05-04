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
            $table->string('proforma_invoice_number')->unique();
            $table->integer('quantity');
            $table->decimal('unit_price',10,2);
            $table->decimal('total_price',10,2);
            $table->string('description');
            $table->enum('payment_terms', ['swift', 'RTGS', 'cheque']);
            $table->integer('user_id');
            $table->date('date');
            $table->integer('supplier_id');
            $table->enum('status', ['ordered', 'in transit', 'received']);
            $table->integer('document_id');
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
