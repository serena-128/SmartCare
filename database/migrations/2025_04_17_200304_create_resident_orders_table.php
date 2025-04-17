<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateResidentOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
{
    Schema::create('resident_orders', function (Blueprint $table) {
        $table->id();
        $table->unsignedBigInteger('resident_id');
        $table->unsignedBigInteger('product_id');
        $table->integer('quantity');
        $table->string('status')->default('Ordered');
        $table->timestamps();

        $table->foreign('resident_id')->references('id')->on('residents')->onDelete('cascade');
        $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
    });
}


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('resident_orders');
    }
}
