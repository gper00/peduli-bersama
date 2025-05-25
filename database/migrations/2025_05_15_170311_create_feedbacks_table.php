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
        Schema::create('feedbacks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained()->nullOnDelete();
            $table->string('name')->nullable();
            $table->string('email')->nullable();
            $table->string('subject');
            $table->enum('type', ['suggestion', 'complaint', 'question', 'appreciation', 'other'])->default('suggestion');
            $table->enum('priority', ['low', 'medium', 'high', 'urgent'])->default('medium');
            $table->text('message');
            $table->enum('status', ['unread', 'read', 'in_progress', 'responded', 'closed'])->default('unread');
            $table->text('admin_notes')->nullable();
            $table->text('admin_response')->nullable();
            $table->foreignId('responded_by')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamp('responded_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('feedbacks');
    }
};
