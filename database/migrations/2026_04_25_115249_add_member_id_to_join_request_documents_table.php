<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('join_request_documents', function (Blueprint $table) {

            // ✅ add member_id (nullable)
            $table->foreignId('member_id')
                ->nullable()
                ->after('join_request_id')
                ->constrained('members')
                ->nullOnDelete();
        });
    }

    public function down(): void
    {
        Schema::table('join_request_documents', function (Blueprint $table) {

            // ❌ drop FK first
            $table->dropForeign(['member_id']);

            // ❌ drop column
            $table->dropColumn('member_id');
        });
    }
};
