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
        Schema::create('items', function (Blueprint $table) {
            $table->id();
            $table->integer('quantity');
            $table->enum('measure', ['kos', 'l', 'ml', 'g','kg']);
            $table->string('Items', 255);
            $table->datetime('insertDate')->nullable();
            $table->datetime('buyDate')->nullable();
            $table->tinyInteger('nakupljeno')->default(0);
            $table->tinyInteger('deleteItem')->default(0);
            $table->datetime('deleteDay')->nullable();
            $table->unsignedBigInteger('user_id'); // Add this line for the user foreign key
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade'); // Define the foreign key relationship
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('items');
    }
};
