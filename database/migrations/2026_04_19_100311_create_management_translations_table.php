<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('management_translations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('management_id')
                ->constrained('managements')
                ->onDelete('cascade');
            $table->string('locale');
            $table->string('name');
            $table->text('bio')->nullable();
            $table->unique(['management_id', 'locale']);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('management_translations');
    }
};
