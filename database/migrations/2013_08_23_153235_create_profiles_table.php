<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('profiles', function (Blueprint $table) {
            $table->id();
            $table->integer('bmi')->nullable();
            $table->integer('bmr')->nullable();
            $table->string('sex')->nullable();
            $table->float('height')->nullable();
            $table->string('unitHeight')->nullable();
            $table->float('weight')->nullable();
            $table->string('unitWeight')->nullable();
            $table->integer('age')->nullable();
            $table->enum('activity',['SUPER','HIGH','INTERMEDIATE','NORMAL','SLOW'])->nullable();
            $table->enum('result',['UNDERWEIGHT','NORMAL','OVERWEIGHT','OBESE_1','OBESE_2'])->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('profiles');
    }
};
