<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCompaniesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('companies', function (Blueprint $table) {
            $table->increments('id');
            //$table->integer('user_id')->unsigned()->index();
           // $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->string('company_name');
            $table->string('identification_number');
            $table->string('phones');
            $table->string('physical_address');
            $table->string('country');
            $table->string('towns');
            $table->string('web_address')->nullable();
            $table->string('legal_name');
            $table->string('legal_first_surname');
            $table->string('legal_second_surname');
            $table->string('legal_email');
            $table->string('public_code')->nullable();
            $table->string('private_code')->nullable();
            $table->tinyInteger('activity')->default(0); //1 consumer / 2 supplier
            
            $table->timestamps();
        });

        Schema::create('company_user', function(Blueprint $table)
        {
            
            $table->integer('company_id')->unsigned()->index();
            $table->foreign('company_id')->references('id')->on('companies')->onDelete('cascade');
            $table->integer('user_id')->unsigned()->index();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->primary(['company_id', 'user_id']);
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('company_user');
        Schema::dropIfExists('companies');
    }
}
