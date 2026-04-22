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
        Schema::create('join_request_translations', function (Blueprint $table) {
            $table->id();

            $table->foreignId('join_request_id')
                ->constrained('join_requests')
                ->onDelete('cascade');

            $table->string('locale'); // ar / fr

            $table->string('specialization')->nullable(); // التخصص
            $table->string('degree')->nullable(); // الدرجة العلمية العليا
            $table->string('graduation_university')->nullable(); // جامعة التخرج في فرنسا
            $table->string('current_job')->nullable(); // الوظيفة الحالية
            $table->string('workplace')->nullable(); // مكان العمل
            $table->text('interests')->nullable(); // الاهتمامات
            $table->text('bio')->nullable(); // فقرة تعريفية

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('join_request_translations');
    }
};
