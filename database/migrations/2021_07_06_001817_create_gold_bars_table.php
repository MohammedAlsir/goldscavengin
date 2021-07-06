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
            $table->float('gold_ingot_weight');
            $table->float('sample_weight');
            $table->float('gold_karat_weight');
            $table->float('net');
            // $table->float('amount', 8, 2);
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
