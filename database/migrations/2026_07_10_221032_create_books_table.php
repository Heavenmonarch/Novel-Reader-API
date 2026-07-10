<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('books', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->foreignId('genre_id')->nullable()->constrained()->nullOnDelete();
            $table->string('title');
            $table->string('slug')->unique();
            $table->text('synopsis');
            $table->string('cover_image')->nullable();
            $table->enum('status', ['draft', 'published', 'completed'])->default('draft');
            $table->enum('content_rating', ['everyone', 'teen', 'mature'])->default('everyone');
            $table->unsignedBigInteger('total_reads')->default(0);
            $table->unsignedBigInteger('total_collections')->default(0);
            $table->unsignedBigInteger('total_dragons')->default(0);
            $table->boolean('is_locked')->default(false);
            $table->timestamp('published_at')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('books');
    }
};
