<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCreditDaysTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('credit_days', function (Blueprint $table) {
            $table->increments('id');
            // $table->integer('company_id')->unsigned()->index();
            // $table->foreign('company_id')->references('id')->on('companies')->onDelete('cascade');
            // $table->double('interest');
            $table->double('days');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('credit_days');
    }
}
