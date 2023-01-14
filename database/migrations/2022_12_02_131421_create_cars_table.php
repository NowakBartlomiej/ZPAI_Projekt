<?php

use App\Models\BodyType;
use App\Models\CarModel;
use App\Models\Fuel;
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
        Schema::create('cars', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('car_model_id');
            $table->foreign('car_model_id')
                ->references('id')
                ->on('car_models')
                ->onDelete('no action');
            
            $table->unsignedBigInteger('body_type_id');
            $table->foreign('body_type_id')
                ->references('id')
                ->on('body_types')
                ->onDelete('no action');
            
            $table->unsignedBigInteger('fuel_id');
            $table->foreign('fuel_id')
                ->references('id')
                ->on('fuels')
                ->onDelete('no action');

            // $table->foreignIdFor(CarModel::class);
            // $table->foreignIdFor(BodyType::class);
            // $table->foreignIdFor(Fuel::class);
            
            $table->integer('year')->length(4);
            $table->integer('odometer')->length(7);
            $table->string('VIN', 17)->unique();
            $table->decimal('engine');
            $table->integer('power')->length(4);
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
        Schema::dropIfExists('cars');
    }
};
