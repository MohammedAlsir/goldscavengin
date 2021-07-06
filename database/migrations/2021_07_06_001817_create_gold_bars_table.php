<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGoldBarsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gold_bars', function (Blueprint $table) {
            $table->id();
            $table->string('gold_bar_owner');
            $table->string('gold_ingot_weight');
            $table->string('sample_weight');
            $table->string('gold_karat_weight');
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
        Schema::dropIfExists('gold_bars');
    }
}
