<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateArrives extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('arrives', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('arrive_id');
            $table->bigInteger('ID_TRAIN');
            $table->bigInteger('ID_STATION');
            $table->date('BEGIN_DATE');
            $table->date('ARRIVE_DATE');
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
        Schema::dropIfExists('arrives');
    }
}
