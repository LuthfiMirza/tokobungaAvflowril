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
        Schema::create('order_tracking', function (Blueprint $table) {
            $table->id();
            $table->foreignId('order_id')->constrained()->onDelete('cascade');
            $table->string('status');
            $table->string('title');
            $table->text('description')->nullable();
            $table->string('location')->nullable();
            $table->json('metadata')->nullable(); // For additional tracking info
            $table->timestamp('tracked_at');
            $table->timestamps();

            $table->index(['order_id', 'tracked_at']);
            $table->index('status');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_tracking');
    }
};