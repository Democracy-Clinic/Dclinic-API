<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSchedulesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('schedules', function (Blueprint $table) {
            $table->id();
            $table->string('day');
            $table->enum('fee_status', ['FREE_OF_CHARGE', 'CHARGE', 'PARTIAL_CHARGE'])->default('FREE_OF_CHARGE');
            $table->date('from_date')->nullable();
            $table->date('to_date')->nullable();

            $table->integer('schedulable_id')->nullable();
            $table->string('schedulable_type')->nullable();

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
        Schema::dropIfExists('schedules');
    }
}
