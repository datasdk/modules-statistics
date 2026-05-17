<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class StatisticVotes extends Migration
{
    public function up()
    {

        if(!Schema::hasTable('statistic_votes'))
        Schema::create('statistic_votes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('statistic_id');
            $table->unsignedBigInteger('user_id');
            $table->tinyInteger('vote')->nullable(); // fx 1=op, 0=nulstil, -1=nedstem
            $table->text('comment')->nullable();
            $table->timestamps();

            $table->unique(['statistic_id', 'user_id']); // En bruger kan kun stemme én gang pr. statistik

            $table->foreign('statistic_id')->references('id')->on('statistics')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });

    }


    public function down()
    {
        if(Schema::hasTable('statistic_votes'))
        Schema::dropIfExists('statistic_votes');
    }

}
