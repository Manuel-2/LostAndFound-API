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
        Schema::create('locations', function (Blueprint $table) {
            $table->id();
            $table->string('name', 100);
            $table->text('description');
            $table->timestamps();
        });

        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->string('name', 100);
            $table->text('description');
            $table->timestamps();
        });

        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->references('id')->on('users');
            $table->enum('type', ['Perdido', 'Encontrado']);
            $table->string('title', 100);
            $table->text('description')->nullable();
            $table->foreignId('location_id')->constrained()->nullable();
            $table->foreignId('category_id')->constrained();
            $table->date('incident_date');
            $table->timestamps();
        });

        Schema::create('bookmarks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->foreignId('post_id')->constrained();
            $table->timestamps();
        });

        Schema::create('pictures', function (Blueprint $table) {
            $table->id();
            $table->foreignId('post_id')->cascadeOnDelete()->constrained();
            $table->string('file_name');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('posts');
        Schema::dropIfExists('bookmarks');
        Schema::dropIfExists('pictures');
        Schema::dropIfExists('locations');
        Schema::dropIfExists('categories');
    }
};
