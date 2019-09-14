<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Voters extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('votes', function(Blueprint $table){
            $table->increments('id');
            $table->integer('type_id')->nullable();
            $table->integer('state')->nullable();
            $table->integer('q_type')->nullable();
            $table->integer('q_value')->nullable();
            $table->string('title', 255)->nullable();
            $table->text('description')->nullable();
            $table->integer('creator')->nullable();
            $table->integer('arbiter')->nullable();
            $table->date('publish')->nullable();
            $table->date('deadline')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('votes');
    }
}
