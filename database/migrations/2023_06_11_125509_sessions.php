<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Sessions extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('p_sessions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->timestamp('date');
            $table->string('treatment_area');
            $table->integer('spot_size');
            $table->integer('fluence');
            $table->integer('pluse_width');
            $table->integer('count');
            $table->integer('price');
            $table->text('note');
            $table->bigInteger('patient_id');
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
        //
        Schema::dropIfExists('sessions');
    }
}
