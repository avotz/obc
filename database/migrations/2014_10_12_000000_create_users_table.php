<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id'); 
            $table->string('email')->unique();
            $table->string('password');
            $table->tinyInteger('activity')->default(1); //1 consumer / 2 supplier
            $table->rememberToken();
            $table->timestamps();
        });
        Schema::create('partner_user', function(Blueprint $table)
        {
            $table->integer('partner_id')->unsigned();
            $table->integer('user_id')->unsigned();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('partner_id')->references('id')->on('users')->onDelete('cascade');

            $table->primary(array('user_id', 'partner_id'));
           
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('partner_user');
        Schema::dropIfExists('users');
    }
}
