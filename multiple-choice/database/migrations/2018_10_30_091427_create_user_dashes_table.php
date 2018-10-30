<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateUserDashesTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_dash', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('column_id')->default(0);
            $table->integer('sort_no')->default(0);
            $table->integer('collapsed')->default(0);
            $table->integer('height')->default(0);
            $table->string('email');
            $table->string('widget');
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('user_dashes');
    }
}
