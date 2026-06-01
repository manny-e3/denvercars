<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('ride_bookings', function (Blueprint $table) {
            $table->id();
            $table->string('reference')->unique();
            $table->foreignId('customer_id')->constrained('customers')->onDelete('cascade');
            $table->foreignId('vehicle_id')->nullable()->constrained('vehicles')->onDelete('set null');
            $table->string('vehicle_name');
            $table->string('service_type'); // airport | hourly
            $table->string('pickup');
            $table->string('dropoff')->nullable();
            $table->date('date');
            $table->string('time');
            $table->unsignedTinyInteger('passengers')->default(1);
            $table->unsignedTinyInteger('luggage')->default(0);
            $table->unsignedSmallInteger('duration')->nullable(); // hours, for hourly service
            $table->decimal('distance_miles', 8, 2)->nullable();
            $table->decimal('total_fare', 10, 2);
            $table->string('flight_number')->nullable();
            $table->text('notes')->nullable();
            $table->string('payment_method')->default('none');
            $table->enum('status', ['pending', 'confirmed', 'completed', 'cancelled'])->default('pending');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('ride_bookings');
    }
};
