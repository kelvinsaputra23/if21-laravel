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
        Schema::create('material', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('course_id');
            $table->foreign('course_id')->references('id')->on('courses')->onDelete('cascade');
            $table->bigInteger('material_type_id');
            $table->foreign('material_type_id')->references('id')->on('material_type')->onDelete('cascade');
            $table->string('title');
            $table->string('file_path')->nullable(); // For file-based materials (e.g., PDF)
            $table->string('url')->nullable(); // For link-based materials (e.g., YouTube)
            $table->text('description')->nullable();
            $table->bigInteger('uploaded_by_dosen_id')->nullable(); // Foreign key to users table for the lecturer who uploaded it
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('material');
    }
};