<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('chat_logs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // links to users table
            $table->text('question');
            $table->text('answer')->nullable(); // null = unanswered
            $table->string('category')->nullable(); // e.g. Products, Orders, Pet Care
            $table->float('response_time')->nullable(); // in seconds
            $table->timestamps(); // created_at = when asked, updated_at = when answered
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('chat_logs');
    }
};
