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
        Schema::create('daily_log', function (Blueprint $table) {
            $table->increments('id');
            $table->string('plate_vehicle',10);
            $table->timestamp('check_in')->useCurrent();
            $table->timestamp('check_out')->nullable();
            $table->integer('duration')->default(0);
            $table->boolean('paid')->default(false);
            $table->float('total_pay')->default(0);
            //$table->timestamps();

            $table->foreign('plate_vehicle')->references('plate')->on('vehicle');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('daily_log');
    }
};
