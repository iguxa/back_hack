<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class VotesMembers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('votes_members', function(Blueprint $table){
            $table->increments('id');
            $table->integer('votes_id')->nullable();
            $table->integer('user_id')->nullable();
            $table->integer('vote_value')->nullable();
            $table->text('comment')->nullable();
            $table->timestamp('created_at');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('votes_members');
    }
}
