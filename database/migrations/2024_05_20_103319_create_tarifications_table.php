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
        Schema::create('tarifications', function (Blueprint $table) {
            $table->id();
            $table->foreignId('power_id');
            $table->foreignId('car_category_id');
            $table->foreignId('type_car_id');
            $table->foreignId('trailer_id');
            $table->foreignId('fuel_type_id');
            $table->bigInteger('price');
            $table->bigInteger('min_place')->nullable();
            $table->bigInteger('max_place')->nullable();
            $table->boolean('status')->default(false);
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tarifications');
    }
};
