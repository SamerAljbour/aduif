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
        Schema::create('join_requests', function (Blueprint $table) {
            $table->id();

            // 🔹 Basic Info
            $table->string('name'); // الاسم (can stay here for simplicity)
            $table->string('email');
            $table->string('phone')->nullable();

            // 🔹 Nationality
            $table->enum('nationality', ['jordanian', 'non_jordanian']);

            // 🔹 Files
            $table->string('photo')->nullable(); // صورة
            $table->string('cv')->nullable();    // السيرة الذاتية (CV)

            // 🔹 Status
            $table->enum('status', ['pending', 'approved', 'rejected'])
                ->default('pending');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('join_requests');
    }
};
