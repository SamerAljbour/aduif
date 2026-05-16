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
            // $table->enum('role', ['user', 'admin', 'editor'])->default('user')->after('email_verified_at');
            // $table->string('photo')->nullable()->after('role');
            $table->enum('status', ['pending', 'approved', 'rejected'])->default('pending')->after('photo');
            // $table->boolean('is_active')->default(false)->after('status');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['role', 'photo', 'status', 'is_active']);
        });
    }
};
