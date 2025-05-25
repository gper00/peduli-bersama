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
        Schema::create('donations', function (Blueprint $table) {
            $table->id();
            $table->string('invoice_number')->unique();
            $table->foreignId('campaign_id')->constrained()->onDelete('cascade');
            $table->foreignId('user_id')->nullable()->constrained()->nullOnDelete();
            $table->bigInteger('amount');
            $table->enum('status', ['pending', 'processing', 'success', 'failed', 'expired', 'refunded'])->default('pending');
            $table->string('payment_method')->nullable();
            $table->string('payment_code')->nullable();
            $table->string('payment_url')->nullable();
            $table->string('transaction_id')->nullable();
            $table->string('external_reference')->nullable();
            $table->timestamp('payment_date')->nullable();
            $table->boolean('anonymous')->default(false);
            $table->string('donor_name')->nullable();
            $table->string('donor_email')->nullable();
            $table->string('donor_phone')->nullable();
            $table->text('message')->nullable();
            $table->json('payment_details')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('donations');
    }
};
