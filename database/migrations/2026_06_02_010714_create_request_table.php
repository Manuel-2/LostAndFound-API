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
        Schema::create('requests', function (Blueprint $table) {
            $table->id();
            $table->enum('status', ['Pendiente', 'Aprobada', 'Rechazada']);
            $table->text('content');
            $table->text('message')->nullable();
            $table->foreignId('post_id')->constrained();
            $table->foreignId('user_id')->constrained();
            $table->timestamps();
        });

        Schema::create('notifications', function (Blueprint $table) {
            $table->id();
            $table->enum('type', [
                'Solicitud aprobada',
                'Solicitud rechazada',
                'Sistema',
                'Posible coincidencia'
            ]);
            $table->boolean('is_read')->default(false);
            $table->foreignId('user_id')->constrained();
            $table->foreignId('post_id')->nullable()->constrained();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('request');
        Schema::dropIfExists('notifications');
    }
};
