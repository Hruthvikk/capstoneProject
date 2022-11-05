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
        Schema::create('recipes', function (Blueprint $table) {
            $table->id();
            $table->string('recipeName');
			$table->string('recipeDescription');
            $table->integer('preparationTime');
            $table->integer('cookingTime');
            $table->longText('ingredients');
            $table->longText('steps');

            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on
            ('user_roles')->onDelete('cascade');

            $table->unsignedBigInteger('mealTime_id');
            $table->foreign('mealTime_id')->references('id')->on
            ('meal_times')->onDelete('cascade');

            $table->unsignedBigInteger('editStyle_id');
            $table->foreign('editStyle_id')->references('id')->on
            ('edit_styles')->onDelete('cascade');

            $table->unsignedBigInteger('occasion_id');
            $table->foreign('occasion_id')->references('id')->on
            ('occasions')->onDelete('cascade');
            $table->string('recipeImage');
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
        Schema::dropIfExists('recipes');
    }
};
