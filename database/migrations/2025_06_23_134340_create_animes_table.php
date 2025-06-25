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
        Schema::create('animes', function (Blueprint $table) {
            $table->id();                         // アニメID（主キー）
            $table->string('title');              // タイトル
            $table->integer('year')->nullable();  // 放送年（null可）
            $table->string('images')->nullable(); // サムネイル画像URL（null可）
            $table->text('description')->nullable(); // 説明（null可）
            $table->timestamps();                 // created_at, updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('animes');
    }
};
