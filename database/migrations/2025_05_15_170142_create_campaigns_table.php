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
        Schema::create('campaigns', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('category_id')->constrained()->onDelete('cascade');
            $table->string('title');
            $table->string('slug')->unique();
            $table->string('short_description')->nullable();
            $table->text('description');
            $table->bigInteger('target_amount');
            $table->bigInteger('current_amount')->default(0);
            $table->date('start_date');
            $table->date('end_date');
            $table->string('cover_image')->nullable();
            $table->enum('status', ['draft', 'active', 'completed', 'rejected'])->default('draft');
            $table->enum('verification_status', ['pending', 'verified', 'rejected'])->default('pending');
            $table->boolean('featured')->default(false);
            $table->integer('donor_count')->default(0);
            $table->integer('view_count')->default(0);
            $table->integer('share_count')->default(0);
            $table->text('rejection_reason')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('campaigns');
    }
};
