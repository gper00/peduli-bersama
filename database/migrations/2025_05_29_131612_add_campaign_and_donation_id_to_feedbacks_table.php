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
        Schema::table('feedbacks', function (Blueprint $table) {
            $table->foreignId("campaign_id")->nullable()->after("user_id")->constrained("campaigns")->onDelete("set null");
            $table->foreignId("donation_id")->nullable()->after("campaign_id")->constrained("donations")->onDelete("set null");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('feedbacks', function (Blueprint $table) {
            $table->foreignId("campaign_id")->nullable()->after("user_id")->constrained("campaigns")->onDelete("set null");
            $table->foreignId("donation_id")->nullable()->after("campaign_id")->constrained("donations")->onDelete("set null");
        });
    }
};
