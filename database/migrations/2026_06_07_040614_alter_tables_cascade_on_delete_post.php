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
        Schema::table('bookmarks', function (Blueprint $table) {
            $table->dropForeign(['post_id']);
            $table->foreign("post_id")->references('id')->on('posts')->cascadeOnDelete();
        });

        Schema::table('reports', function (Blueprint $table) {
            $table->dropForeign(['post_id']);
            $table->foreign("post_id")->references('id')->on('posts')->cascadeOnDelete();
        });

        Schema::table('notifications', function (Blueprint $table) {
            $table->dropForeign(['post_id']);
            $table->foreign("post_id")->references('id')->on('posts')->cascadeOnDelete();
        });

        Schema::table('requests', function (Blueprint $table) {
            $table->dropForeign(['post_id']);
            $table->foreign("post_id")->references('id')->on('posts')->cascadeOnDelete();
        });

        Schema::table('pictures', function (Blueprint $table) {
            $table->dropForeign(['post_id']);
            $table->foreign("post_id")->references('id')->on('posts')->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
