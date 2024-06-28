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
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('booking_id')->constrained()->onDelete('cascade');
            $table->string('payment_method', 50);
            $table->string('payment_number', 50);
            $table->string('payment_name', 50);
            $table->string('payment_bank', 50);
            $table->enum('status', ['pending', 'paid', 'canceled'])->default('pending');
            $table->integer('total_payment');
            $table->timestamp('due_date')->default(now()->addDays(7));
            $table->text('note')->nullable();
            $table->string('attachment')->nullable();
            $table->boolean('is_verified')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};
