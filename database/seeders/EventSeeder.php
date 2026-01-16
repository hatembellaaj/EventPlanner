<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EventSeeder extends Seeder
{
    public function run(): void
    {
        $adminId = DB::table('ba_users')
            ->where('ba_email', AdminUserSeeder::DEFAULT_ADMIN_EMAIL)
            ->value('ba_id');

        $categoryMap = DB::table('ba_categories')
            ->pluck('ba_id', 'ba_name');

        if (!$adminId || $categoryMap->isEmpty()) {
            return;
        }

        $now = now();
        $events = [
            [
                'ba_title' => 'Sommet Tech 2024',
                'ba_description' => 'Une journée pour explorer les tendances tech.',
                'ba_start_date' => now()->addWeeks(2)->setTime(9, 0),
                'ba_end_date' => now()->addWeeks(2)->setTime(17, 0),
                'ba_place' => 'Paris',
                'ba_capacity' => 250,
                'ba_price' => 79.00,
                'ba_is_free' => false,
                'ba_status' => 'active',
                'ba_category_id' => $categoryMap->get('Conférence'),
            ],
            [
                'ba_title' => 'Atelier Design Thinking',
                'ba_description' => 'Atelier pratique pour booster la créativité.',
                'ba_start_date' => now()->addWeeks(3)->setTime(14, 0),
                'ba_end_date' => now()->addWeeks(3)->setTime(17, 30),
                'ba_place' => 'Lyon',
                'ba_capacity' => 40,
                'ba_price' => 0.00,
                'ba_is_free' => true,
                'ba_status' => 'active',
                'ba_category_id' => $categoryMap->get('Atelier'),
            ],
            [
                'ba_title' => 'Webinaire Sécurité Cloud',
                'ba_description' => 'Sécuriser vos workloads cloud en 2024.',
                'ba_start_date' => now()->addWeeks(1)->setTime(11, 0),
                'ba_end_date' => now()->addWeeks(1)->setTime(12, 30),
                'ba_place' => 'En ligne',
                'ba_capacity' => 500,
                'ba_price' => 0.00,
                'ba_is_free' => true,
                'ba_status' => 'active',
                'ba_category_id' => $categoryMap->get('Webinaire'),
            ],
        ];

        foreach ($events as $event) {
            DB::table('ba_events')->updateOrInsert(
                ['ba_title' => $event['ba_title']],
                array_merge(
                    $event,
                    [
                        'ba_created_by' => $adminId,
                        'ba_created_at' => $now,
                        'ba_updated_at' => $now,
                    ]
                )
            );
        }
    }
}
