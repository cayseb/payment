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
        Schema::create('orders', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('external_id')->nullable();
            $table->string('status');
            $table->bigInteger('amount');
            $table->jsonb('status_response')->nullable();
            $table->foreignUuid('subscription_id')
                ->references('id')
                ->on('subscriptions');
            $table->foreignUuid('card_id')
                ->nullable()
                ->references('id')
                ->on('cards');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
