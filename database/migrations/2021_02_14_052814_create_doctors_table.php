<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDoctorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('doctors', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('name_myan')->nullable();
            $table->string('phone')->nullable();
            $table->string('viber')->nullable();
            $table->string('facebook_url')->nullable();

            $table->date('from_date')->nullable();
            $table->date('to_date')->nullable();

            $table->decimal('lat', 10, 8)->nullable();
            $table->decimal('lng', 10, 8)->nullable();

            $table->text('address')->nullable();
            $table->text('note')->nullable();

            $table->enum('fee_status', ['FREE_OF_CHARGE', 'CHARGE', 'PARTIAL_CHARGE'])->default('FREE_OF_CHARGE');
            $table->enum('status', ['AVAILABLE', 'NOT_AVAILABLE', 'BUSY'])->default('AVAILABLE');

            $table->integer('specialization_id');
            $table->string('town_pcode');
            
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
        Schema::dropIfExists('doctors');
    }
}
