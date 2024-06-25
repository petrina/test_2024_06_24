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
        if (!Schema::hasTable('book_states')) {
            Schema::create('book_states', function (Blueprint $table) {
                $table->id();
                $table->foreignId('copy_book_id')->constrained('copy_books')->cascadeOnDelete();
                $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
                $table->timestamp('in_time')->nullable()->default(null);
                $table->timestamp('out_time')->nullable()->default(null);
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('book_states');
    }
};
