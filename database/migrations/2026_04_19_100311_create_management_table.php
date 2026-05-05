<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('managements', function (Blueprint $table) {
            $table->id();

            $table->string('photo')->nullable();
            $table->string('email')->nullable();

            $table->enum('position', [
                'president',
                'vice_president',
                'secretary',
                'treasurer',
                'board_member',
            ]);

            // Hierarchy: self-referencing parent (used by current board tree)
            $table->foreignId('parent_id')
                ->nullable()
                ->constrained('managements')
                ->onDelete('set null');

            // Sibling order
            $table->integer('order')->default(0);

            $table->enum('type', ['current', 'former', 'honorary', 'consultant']);

            // Tenure dates — used by former members
            $table->date('date_from')->nullable();
            $table->date('date_to')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('managements');
    }
};
