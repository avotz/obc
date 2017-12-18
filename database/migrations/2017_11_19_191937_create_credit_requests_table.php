<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCreditRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('credit_requests', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('quotation_id')->unsigned()->index();
            $table->foreign('quotation_id')->references('id')->on('quotations')->onDelete('cascade');
            $table->integer('user_id')->unsigned()->index();
            $table->string('transaction_id')->nullable();
            $table->double('amount');
            $table->string('currency');
            $table->double('credit_time');
            $table->dateTime('date');
            $table->string('file')->nullable();
            $table->text('comments')->nullable();
            $table->tinyInteger('status')->default(0); //0 pending 1 Granted 2 reject
            $table->tinyInteger('public')->default(1); //1 publica //0 privada
            $table->integer('country_id');
            $table->timestamps();
        });

        Schema::create('credits', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('quotation_id')->unsigned()->index();
            $table->foreign('quotation_id')->references('id')->on('quotations')->onDelete('cascade');
            $table->integer('credit_request_id')->unsigned()->index();
            $table->integer('user_id')->unsigned()->index();
            $table->string('transaction_id')->nullable();
            $table->double('amount');
            $table->string('currency');
            $table->double('credit_time');
            $table->dateTime('date');
            $table->dateTime('approval_date');
            $table->dateTime('payment_date');
            $table->double('interest');
            $table->double('total');
            $table->string('file')->nullable();
            $table->text('comments')->nullable();
            $table->tinyInteger('status')->default(0); //0 pending 1 Granted 2 reject
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
        Schema::dropIfExists('credit_requests');
        Schema::dropIfExists('credits');
    }
}
