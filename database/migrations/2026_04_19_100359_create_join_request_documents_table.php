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
        Schema::create('join_request_documents', function (Blueprint $table) {
            $table->id();

            $table->foreignId('join_request_id')
                ->constrained('join_requests')
                ->onDelete('cascade');

            $table->string('file_path');

            $table->enum('type', [
                'certificate',
                'other'
            ])->default('other');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('join_request_documents');
    }
};
