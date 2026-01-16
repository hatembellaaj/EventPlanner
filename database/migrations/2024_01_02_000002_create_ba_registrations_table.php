<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('ba_registrations', function (Blueprint $table) {
            $table->bigIncrements('ba_id');
            $table->unsignedBigInteger('ba_user_id');
            $table->unsignedBigInteger('ba_event_id');
            $table->timestamp('ba_created_at')->nullable();
            $table->timestamp('ba_updated_at')->nullable();

            $table->unique(['ba_user_id', 'ba_event_id']);

            $table->foreign('ba_user_id')
                ->references('ba_id')
                ->on('ba_users')
                ->cascadeOnDelete()
                ->cascadeOnUpdate();

            $table->foreign('ba_event_id')
                ->references('ba_id')
                ->on('ba_events')
                ->cascadeOnDelete()
                ->cascadeOnUpdate();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('ba_registrations');
    }
};
