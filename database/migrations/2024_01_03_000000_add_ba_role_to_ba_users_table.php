<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('ba_users', function (Blueprint $table) {
            $table->string('ba_role')->default('user')->after('ba_password');
        });
    }

    public function down(): void
    {
        Schema::table('ba_users', function (Blueprint $table) {
            $table->dropColumn('ba_role');
        });
    }
};
