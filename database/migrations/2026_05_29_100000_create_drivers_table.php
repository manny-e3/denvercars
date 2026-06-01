<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('drivers', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique()->nullable();
            $table->string('phone')->nullable();
            $table->string('photo')->nullable();

            // License Information
            $table->string('license_number')->unique();
            $table->enum('license_type', ['Class A CDL', 'Class B CDL', 'Class C CDL', 'Non-CDL'])->default('Non-CDL');
            $table->date('license_expiry');

            // CDL Certifications (stored as JSON array)
            $table->json('cdl_certifications')->nullable();

            // Medical Card
            $table->string('medical_card_number')->nullable();
            $table->date('medical_card_expiry')->nullable();

            // Assignment & Status
            $table->foreignId('vehicle_id')->nullable()->constrained('vehicles')->onDelete('set null');
            $table->enum('status', ['Active', 'Inactive', 'Suspended'])->default('Active');

            $table->text('notes')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('drivers');
    }
};
