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
        Schema::create('shopping_logs', function (Blueprint $table) {
            $table->id('LogId');
            $table->unsignedBigInteger('item_id');
            $table->enum('action', ['create', 'edit', 'delete', 'buy']);
            $table->unsignedBigInteger('user_id');
            $table->timestamp('date')->useCurrent();

            // Foreign key relationships
            $table->foreign('item_id')->references('id')->on('items')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('shopping_logs');
    }
};
