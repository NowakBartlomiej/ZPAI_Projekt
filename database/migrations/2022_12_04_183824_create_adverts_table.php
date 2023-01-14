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
        Schema::create('adverts', function (Blueprint $table) {
            $table->id();
            // $table->unsignedBigInteger('user_id');
            // $table->foreign('user_id')
            //     ->references('id')
            //     ->on('users')
            //     ->onDelete('no action');

            $table->unsignedBigInteger('car_id');
            $table->foreign('car_id')
                ->references('id')
                ->on('cars')
                ->onDelete('no action');

            $table->integer('price');
            $table->longText('description');

            $table->unsignedBigInteger('city_id');
            $table->foreign('city_id')
                ->references('id')
                ->on('cities')
                ->onDelete('no action');

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('adverts');
    }
};
