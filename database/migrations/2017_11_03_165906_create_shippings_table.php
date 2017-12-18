<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateShippingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shippings', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('quotation_id')->unsigned()->index();
            $table->foreign('quotation_id')->references('id')->on('quotations')->onDelete('cascade');
            $table->integer('shipping_request_id')->unsigned()->index();
            $table->integer('user_id')->unsigned()->index();
            $table->string('transaction_id')->nullable();
            $table->integer('delivery_time'); //1 normal 2 express
            $table->integer('type')->default(0); //0 nacional 1 internacional
            $table->double('cost');
            $table->string('currency');
            $table->dateTime('date');
            $table->string('file')->nullable();
            $table->text('comments')->nullable();
            $table->tinyInteger('status')->default(0); //0 pending 1 Granted 2 reject
            $table->integer('country_id');
            $table->timestamps();
        });

        Schema::create('shipping_requests', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('quotation_id')->unsigned()->index();
            $table->foreign('quotation_id')->references('id')->on('quotations')->onDelete('cascade');
            $table->integer('user_id')->unsigned()->index();
            $table->string('transaction_id')->nullable();
            $table->integer('delivery_time'); //1 normal 2 express
            $table->integer('type')->default(0); //0 nacional 1 internacional
            $table->dateTime('date');
            $table->string('file')->nullable();
            $table->text('comments')->nullable();
            $table->tinyInteger('status')->default(0); //0 pending 1 Granted 2 reject
            $table->tinyInteger('public')->default(1); //1 publica //0 privada
            $table->integer('country_id');
            $table->timestamps();
        });

        Schema::create('shipping_request_supplier', function (Blueprint $table) {
            $table->integer('request_id')->unsigned()->index();
            $table->foreign('request_id')->references('id')->on('shipping_requests')->onDelete('cascade');

            $table->integer('supplier_id')->unsigned()->index();
            $table->foreign('supplier_id')->references('id')->on('companies')->onDelete('cascade');

            $table->primary(['request_id', 'supplier_id']);
        });

        Schema::create('shipping_supplier', function (Blueprint $table) {
            $table->integer('shipping_id')->unsigned()->index();
            $table->foreign('shipping_id')->references('id')->on('shippings')->onDelete('cascade');

            $table->integer('supplier_id')->unsigned()->index();
            $table->foreign('supplier_id')->references('id')->on('companies')->onDelete('cascade');

            $table->primary(['shipping_id', 'supplier_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('shipping_request_supplier');
        Schema::dropIfExists('shipping_supplier');
        Schema::dropIfExists('shipping_requests');
        Schema::dropIfExists('shippings');
    }
}
