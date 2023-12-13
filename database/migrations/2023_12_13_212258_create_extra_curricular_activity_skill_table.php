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
        Schema::create('extra_curricular_activity_skill', function (Blueprint $table) {
            $table->unsignedBigInteger('extra_curricular_activity_id');
            $table->unsignedBigInteger('skill_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('extra_curricular_activity_skill');
    }
};
