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
            $table->id();
            $table->string('product_code');
            $table->string('name');
            $table->string('image');
            $table->integer('quantity');
            $table->string('sale_price');
            $table->string('purchase_price');
            $table->text('description');
            $table->unsignedBigInteger('location_id');
            $table->unsignedBigInteger('brand_id');
            $table->unsignedBigInteger('category_id');
            $table->tinyInteger('is_trading')->default(config('common.is_trading'));
            $table->unsignedBigInteger('ware_house_id');
            $table->foreign('ware_house_id')->references('id')->on('ware_houses');
            $table->foreign('location_id')->references('id')->on('locations');
            $table->foreign('brand_id')->references('id')->on('brands');
            $table->foreign('category_id')->references('id')->on('categories');
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
