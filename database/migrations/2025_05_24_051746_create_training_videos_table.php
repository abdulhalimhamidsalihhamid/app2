<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
public function up()
{
    Schema::create('training_videos', function (Blueprint $table) {
        $table->id();
        $table->unsignedBigInteger('faculty_id');
        $table->text('title');
        $table->text('description')->nullable();
        $table->text('url');
        $table->string('category')->nullable();
        $table->timestamps();

        $table->foreign('faculty_id')->references('id')->on('faculty_members')->onDelete('cascade');
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('training_videos');
    }
};
