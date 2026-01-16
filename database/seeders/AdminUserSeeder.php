<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    public const DEFAULT_ADMIN_EMAIL = 'admin@eventplanner.test';
    public const DEFAULT_ADMIN_PASSWORD = 'Admin123!';

    public function run(): void
    {
        $now = now();

        DB::table('ba_users')->updateOrInsert(
            ['ba_email' => self::DEFAULT_ADMIN_EMAIL],
            [
                'ba_name' => 'Admin',
                'ba_password' => Hash::make(self::DEFAULT_ADMIN_PASSWORD),
                'ba_role' => 'admin',
                'ba_created_at' => $now,
                'ba_updated_at' => $now,
            ]
        );
    }
}
