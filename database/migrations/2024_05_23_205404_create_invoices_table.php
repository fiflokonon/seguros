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
        Schema::create('invoices', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable();
            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('phone')->nullable();
            $table->string('sex')->nullable();
            $table->string('email')->nullable();
            $table->foreignId('fuel_type_id')->nullable();
            $table->foreignId('type_car_id')->nullable();
            $table->foreignId('power_id')->nullable();
            $table->foreignId('car_category_id')->nullable();
            $table->foreignId('brand_id')->nullable();
            $table->foreignId('trailer_id')->nullable();
            $table->string('model')->nullable();
            $table->string('state')->nullable();
            $table->bigInteger('place_number')->nullable();
            $table->string('code')->unique();
            $table->double('initial_price')->default(0);
            $table->double('attestation_price')->default(0);
            $table->double('sub_total')->default(0);
            $table->double('accessories_price')->default(0);
            $table->double('vat')->default(0);
            $table->string('regis_number')->nullable();
            $table->boolean('status')->default(false);
            $table->double('total')->default(0);
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('invoices');
    }
};
