<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->bigIncrements('product_id');
            $table->string('product_name', 50)->unique();
            $table->string('product_brand', 100)->nullable();
            $table->string('prod_uniq', 100)->unique();
            $table->unsignedInteger('product_sub_category')->nullable();
            $table->unsignedInteger('stock_quantity');
            $table->decimal('sales_price', 10, 2);
            $table->text('product_description')->nullable();
            $table->enum('available_sizes', ['S', 'M', 'L', 'XL', 'XXL','XXXL']);
            $table->unsignedBigInteger('category_id');
            $table->foreign('category_id')->references('category_id')->on('categories')->onDelete('cascade');
            $table->string('bar_code', 50);
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
        Schema::dropIfExists('products');
    }
}
