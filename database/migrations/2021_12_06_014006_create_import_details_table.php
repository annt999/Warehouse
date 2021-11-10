<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateImportDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('import_details', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('import_history_id');
            $table->unsignedBigInteger('product_id');
            $table->integer('quantity');
            $table->string('purchase_price');
            $table->string('sale_price');
            $table->timestamps();
            $table->foreign('product_id')->references('id')->on('products');
            $table->foreign('import_history_id')->references('id')->on('import_history');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('import_details');
    }
}
