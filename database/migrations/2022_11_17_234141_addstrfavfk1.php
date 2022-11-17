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
        Schema::table('rating_favs', function (Blueprint $table) {
            
            $table->unsignedBigInteger('recipe_id');
            $table->foreign('recipe_id')->references('id')->on
            ('recipes')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('rating_favs', function (Blueprint $table) {
            //
        });
    }
};
