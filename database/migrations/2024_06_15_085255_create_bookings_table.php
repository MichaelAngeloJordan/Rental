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
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('car_id')->constrained()->onDelete('cascade');
            $table->foreignId('driver_id')->nullable()->constrained()->onDelete('cascade');
            $table->timestamp('pickup_time');
            $table->timestamp('return_time');
            $table->string('pickup_address')->nullable();
            $table->string('return_address')->nullable();
            $table->enum('status', ['pending', 'approved', 'rejected', 'canceled', 'completed'])->default('pending');
            $table->text('note')->nullable();
            $table->integer('total_price')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};
