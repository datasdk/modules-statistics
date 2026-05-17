<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Statistics extends Migration
{


    public function up()
    {
        
        if(!Schema::hasTable('statistics'))
        Schema::create('statistics', function (Blueprint $table) {

		    $table->id();
            $table->string('slug')->unique(); 
            $table->string('title')->nullable();
            $table->text('description')->nullable();
            $table->integer('sorting')->default(0);
            $table->date('deleted_at')->nullable();
            $table->timestamps();

        });
        
    }

    public function down()
    {

        if(Schema::hasTable('statistics'))
        Schema::dropIfExists('statistics');

    }
}