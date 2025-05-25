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
        Schema::create('withdrawals', function (Blueprint $table) {
            $table->id();
            $table->string('reference_number')->unique();
            $table->foreignId('campaign_id')->constrained()->onDelete('cascade');
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->bigInteger('amount');
            $table->enum('status', ['pending', 'processing', 'approved', 'completed', 'rejected'])->default('pending');
            $table->string('bank_name');
            $table->string('account_number');
            $table->string('account_name');
            $table->string('bank_branch')->nullable();
            $table->string('bank_code')->nullable();
            $table->text('purpose');
            $table->string('evidence_file')->nullable();
            $table->text('notes')->nullable();
            $table->text('rejection_reason')->nullable();
            $table->foreignId('approved_by')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamp('approved_at')->nullable();
            $table->foreignId('processed_by')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamp('processed_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('withdrawals');
    }
};
