<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $now = now();
        $categories = [
            'Conférence',
            'Atelier',
            'Webinaire',
            'Meetup',
        ];

        foreach ($categories as $name) {
            DB::table('ba_categories')->updateOrInsert(
                ['ba_name' => $name],
                [
                    'ba_created_at' => $now,
                    'ba_updated_at' => $now,
                ]
            );
        }
    }
}
