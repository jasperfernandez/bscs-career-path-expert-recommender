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
        Schema::create('extra_curricular_activity_interest_student', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('extra_curricular_activity_id');
            $table->unsignedBigInteger('interest_id');
            $table->unsignedBigInteger('student_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('extra_curricular_activity_interest_student');
    }
};
