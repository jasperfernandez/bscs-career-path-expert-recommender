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
        Schema::create('bscs_career_student', function (Blueprint $table) {
            $table->unsignedBigInteger('bscs_career_id');
            $table->unsignedBigInteger('student_id');
            $table->integer('score');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bscs_career_student');
    }
};
