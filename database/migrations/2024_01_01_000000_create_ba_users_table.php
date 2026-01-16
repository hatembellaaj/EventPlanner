<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('ba_users', function (Blueprint $table) {
            $table->bigIncrements('ba_id');
            $table->string('ba_name');
            $table->string('ba_email')->unique();
            $table->string('ba_password');
            $table->timestamp('ba_created_at')->nullable();
            $table->timestamp('ba_updated_at')->nullable();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('ba_users');
    }
};
