<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mensual_log', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamp('start_date')->useCurrent();
            $table->timestamp('finish_date')->nullable();
            $table->integer('total_min')->default(0);
            $table->float('total_pay')->default(0);
            //$table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('mensual_log');
    }
};
