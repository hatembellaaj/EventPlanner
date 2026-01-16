<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('ba_events', function (Blueprint $table) {
            $table->bigIncrements('ba_id');
            $table->string('ba_title');
            $table->text('ba_description');
            $table->dateTime('ba_start_date');
            $table->dateTime('ba_end_date');
            $table->string('ba_place');
            $table->unsignedInteger('ba_capacity');
            $table->decimal('ba_price', 8, 2)->default(0);
            $table->boolean('ba_is_free')->default(false);
            $table->string('ba_image')->nullable();
            $table->enum('ba_status', ['active', 'archived'])->default('active');
            $table->unsignedBigInteger('ba_category_id');
            $table->unsignedBigInteger('ba_created_by');
            $table->timestamp('ba_created_at')->nullable();
            $table->timestamp('ba_updated_at')->nullable();

            $table->index('ba_status');
            $table->index(['ba_start_date', 'ba_end_date']);
            $table->index('ba_category_id');

            $table->foreign('ba_category_id')
                ->references('ba_id')
                ->on('ba_categories')
                ->restrictOnDelete()
                ->cascadeOnUpdate();

            $table->foreign('ba_created_by')
                ->references('ba_id')
                ->on('ba_users')
                ->restrictOnDelete()
                ->cascadeOnUpdate();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('ba_events');
    }
};
