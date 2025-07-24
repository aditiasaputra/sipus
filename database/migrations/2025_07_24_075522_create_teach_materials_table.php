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
        Schema::create('teach_materials', function (Blueprint $table) {
            $table->id();
            $table->foreignId('grade_id')->nullable()->constrained('grades')->onDelete('set null'); // kelas
            $table->foreignId('teacher_id')->nullable()->constrained('teachers')->onDelete('set null'); // guru
            $table->string('code');
            $table->string('name');
            $table->text('note');
            $table->string('file');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('teach_materials');
    }
};
