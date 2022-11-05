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
        Schema::table('recipes', function (Blueprint $table) {
            
            

            $table->unsignedBigInteger('mealTime_id');
            $table->foreign('mealTime_id')->references('id')->on
            ('meal_times')->onDelete('cascade');

            $table->unsignedBigInteger('editStyle_id');
            $table->foreign('editStyle_id')->references('id')->on
            ('edit_styles')->onDelete('cascade');

            $table->unsignedBigInteger('occasion_id');
            $table->foreign('occasion_id')->references('id')->on
            ('occasions')->onDelete('cascade');
            
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('recipes', function (Blueprint $table) {
            //
        });
    }
};
