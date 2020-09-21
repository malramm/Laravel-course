<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInvoiceEntriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoice_entries', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('productId');
            $table->decimal('invoiceEntryPrice', 8, 2);
            $table->integer('productQuantity');
            $table->foreignId('invoice_id')->constrained('invoices');
            // $table->foreign('invoice_id')->references('id')->on('invoices');
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
        Schema::dropIfExists('invoice_entries');
    }
}
