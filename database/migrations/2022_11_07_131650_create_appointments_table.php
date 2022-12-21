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
        Schema::create('appointments', function (Blueprint $table) {
            $table->id();
            $table->time('time');
            $table->date('date');
            $table->text('status')->default('normal');
            $table->text('type')->default('next');
            $table->text('booking_type');
            $table->text('location');
            $table->text('case_description');
           // $table->text('file_path')->nullable();
            $table->integer('doctor_id');
            $table->integer('user_id');
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
        Schema::dropIfExists('appointments');
    }
};
