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
        Schema::create('news', function (Blueprint $table) {
        $table->id();
        $table->string('title');           // Заголовок
        $table->text('content');           // Текст новости
        $table->string('image')->nullable(); // Путь к изображению
        $table->boolean('is_published')->default(true); // Флаг публикации
        $table->timestamps();              // created_at, updated_at
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('news');
    }
};
