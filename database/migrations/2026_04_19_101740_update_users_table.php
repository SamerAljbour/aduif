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
        Schema::table('users', function (Blueprint $table) {

            // 🔐 Role system
            $table->enum('role', ['admin', 'editor'])->default('admin');

            // 🖼 Profile image (optional)
            $table->string('photo')->nullable();

            // 📊 Status control
            $table->boolean('is_active')->default(true);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['role', 'photo', 'is_active']);
        });
    }
};
