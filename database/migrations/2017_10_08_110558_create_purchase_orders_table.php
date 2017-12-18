<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePurchaseOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('purchase_orders', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('quotation_id')->unsigned()->index();
            $table->foreign('quotation_id')->references('id')->on('quotations')->onDelete('cascade');
            $table->integer('user_id')->unsigned()->index();
            $table->string('transaction_id')->nullable();
            $table->string('file')->nullable();
            $table->text('comments')->nullable();
            $table->string('currency');
            $table->tinyInteger('geo_type')->default(1); // 1 Nacional 2 Regional 3 Internacional 4 Global
            $table->tinyInteger('status')->default(0); //1 Granted
            $table->integer('country_id');
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
        Schema::dropIfExists('purchase_orders');
    }
}
