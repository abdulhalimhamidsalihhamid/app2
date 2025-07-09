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
    Schema::create('grades', function (Blueprint $table) {
        $table->id();
        $table->foreignId('faculty_member_id')->constrained()->onDelete('cascade');
        $table->unsignedBigInteger('student_id');
        $table->foreignId('course_id')->constrained()->onDelete('cascade');
        $table->text('mid_term');
        $table->text('final_term');
        $table->timestamps();
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('grades');
    }
};
