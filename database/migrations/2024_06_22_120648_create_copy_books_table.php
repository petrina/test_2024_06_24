<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        if (!Schema::hasTable('copy_books')) {
            Schema::create('copy_books', function (Blueprint $table) {
                $table->id();
                $table->foreignId('book_id')->constrained('books')->cascadeOnDelete();
                $table->string('inventory_number')->nullable()->default('0');
                $table->timestamp('borrowed_at')->nullable()->default(null);
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('copy_books');
    }
};
