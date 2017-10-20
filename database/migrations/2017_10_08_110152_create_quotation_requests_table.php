<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQuotationRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('quotation_requests', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned()->index();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->string('transaction_id')->nullable();
            $table->string('delivery_time');
            $table->string('way_of_delivery');
            $table->double('way_to_pay');
            $table->string('exp_date');
            $table->string('product_name')->nullable();;
            $table->string('product_photo')->nullable();
            $table->text('comments')->nullable();
            $table->tinyInteger('geo_type')->default(1); // 1 Nacional 2 Regional 3 Internacional 4 Global
            $table->tinyInteger('public')->default(1); //1 publica //0 privada
            $table->timestamps();
        });
        Schema::create('request_supplier', function (Blueprint $table) {
        
            $table->integer('request_id')->unsigned()->index();
            $table->foreign('request_id')->references('id')->on('quotation_requests')->onDelete('cascade');

            $table->integer('user_id')->unsigned()->index();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

            $table->primary(array('request_id', 'user_id'));
        });

        Schema::create('request_sector', function(Blueprint $table)
        {
            $table->integer('request_id')->unsigned()->index();
            $table->foreign('request_id')->references('id')->on('quotation_requests')->onDelete('cascade');
            $table->integer('sector_id')->unsigned()->index();
            $table->foreign('sector_id')->references('id')->on('sectors')->onDelete('cascade');
            $table->primary(['request_id', 'sector_id']);
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('request_supplier');
        Schema::dropIfExists('quotation_requests');
    }
}
