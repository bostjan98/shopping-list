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
            $table->enum('measure', ['kos']);
            $table->string('Items', 255);
            $table->datetime('insertDate')->default(now());
            $table->datetime('buyDate')->nullable();
            $table->tinyInteger('nakupljeno')->default(0);
            $table->tinyInteger('deleteItem')->default(0);
            $table->datetime('deleteDay')->nullable();
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
