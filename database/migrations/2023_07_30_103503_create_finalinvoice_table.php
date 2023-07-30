<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFinalinvoiceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('finalinvoice', function (Blueprint $table) {
            $table->id();
            $table->string('customer_name',100);
            $table->string('customer_email',100);
            $table->string('customer_number',100);
            $table->bigInteger('discount');
            $table->bigInteger('vat');
            $table->bigInteger('amount');
            $table->bigInteger('payment_method');
            $table->timestamps();
            $table->string('invoice_id',100);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('finalinvoice');
    }
}
