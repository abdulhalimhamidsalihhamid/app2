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
       Schema::create('faculty_members', function (Blueprint $table) {
        $table->id();
        $table->text('name');
        $table->text('email')->unique();
        $table->text('specialty');
        $table->text('degree');
        $table->string('password');
        $table->text('role')->default('undefined');
        $table->timestamps();
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('faculty_members');
    }
};
