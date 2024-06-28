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
        Schema::create('cars', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->foreignId('brand_id')->constrained('brand_cars')->cascadeOnUpdate()->cascadeOnDelete();
            $table->string('type', 50)->comment('Sedan, SUV, Hatchback, etc.');
            $table->string('color', 50);
            $table->integer('capacity')->comment('Number of passengers');
            $table->integer('baggages')->comment('Number of baggages');
            $table->string('license_plate', 15)->unique();
            $table->string('transmission', 10)->comment('Automatic or Manual');
            $table->integer('year');
            $table->integer('price');
            $table->string('image')->nullable();
            $table->text('description')->nullable();
            $table->text('features')->nullable();
            $table->text('policy')->nullable();
            $table->boolean('available')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cars');
    }
};
