<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQuotationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('quotations', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned()->index();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->integer('request_id')->unsigned()->index();
            $table->foreign('request_id')->references('id')->on('quotation_requests')->onDelete('cascade');
            $table->string('transaction_id')->nullable();
            $table->double('delivery_time');
            $table->integer('way_of_delivery');
            $table->double('way_to_pay');
            $table->string('file')->nullable();
            $table->string('product_photo')->nullable();
            $table->text('comments')->nullable();
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
        Schema::dropIfExists('quotations');
    }
}
