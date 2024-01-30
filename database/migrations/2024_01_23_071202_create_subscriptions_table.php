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
        Schema::create('subscriptions', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('binding_id')->nullable();
            $table->string('payment_type');
            $table->string('type');
            $table->boolean('is_active')->default(false);
            $table->dateTime('started_at')->nullable();
            $table->dateTime('finished_at')->nullable();
            $table->foreignUuid('user_id')
                ->references('id')
                ->on('users')
                ->cascadeOnDelete();
            $table->foreignUuid('tariff_id')
                ->references('id')
                ->on('tariffs');
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
        Schema::dropIfExists('subscriptions');
    }
};
