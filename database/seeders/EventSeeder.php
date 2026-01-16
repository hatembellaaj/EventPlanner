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
                'ba_image' => 'https://images.unsplash.com/photo-1489515217757-5fd1be406fef?auto=format&fit=crop&w=1200&q=80',
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
                'ba_image' => 'https://images.unsplash.com/photo-1521737604893-d14cc237f11d?auto=format&fit=crop&w=1200&q=80',
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
                'ba_image' => 'https://images.unsplash.com/photo-1517248135467-4c7edcad34c4?auto=format&fit=crop&w=1200&q=80',
                'ba_category_id' => $categoryMap->get('Webinaire'),
            ],
            [
                'ba_title' => 'Rencontre Product Builders',
                'ba_description' => 'Une soirée pour réseauter avec des fondateurs et PM.',
                'ba_start_date' => now()->addWeeks(4)->setTime(18, 30),
                'ba_end_date' => now()->addWeeks(4)->setTime(21, 0),
                'ba_place' => 'Bordeaux',
                'ba_capacity' => 120,
                'ba_price' => 25.00,
                'ba_is_free' => false,
                'ba_status' => 'active',
                'ba_image' => 'https://images.unsplash.com/photo-1515168833906-d2a3b82b302a?auto=format&fit=crop&w=1200&q=80',
                'ba_category_id' => $categoryMap->get('Networking'),
            ],
            [
                'ba_title' => 'Hackathon Green Tech',
                'ba_description' => '48h pour prototyper des solutions durables.',
                'ba_start_date' => now()->addWeeks(6)->setTime(10, 0),
                'ba_end_date' => now()->addWeeks(6)->addDays(2)->setTime(18, 0),
                'ba_place' => 'Nantes',
                'ba_capacity' => 200,
                'ba_price' => 0.00,
                'ba_is_free' => true,
                'ba_status' => 'active',
                'ba_image' => 'https://images.unsplash.com/photo-1521737604893-d14cc237f11d?auto=format&fit=crop&w=1200&q=80',
                'ba_category_id' => $categoryMap->get('Hackathon'),
            ],
            [
                'ba_title' => 'Formation Laravel Intensive',
                'ba_description' => 'Bootcamp pratique pour maîtriser Laravel en 3 jours.',
                'ba_start_date' => now()->addWeeks(5)->setTime(9, 0),
                'ba_end_date' => now()->addWeeks(5)->addDays(2)->setTime(17, 30),
                'ba_place' => 'Marseille',
                'ba_capacity' => 60,
                'ba_price' => 320.00,
                'ba_is_free' => false,
                'ba_status' => 'active',
                'ba_image' => 'https://images.unsplash.com/photo-1522075469751-3a6694fb2f61?auto=format&fit=crop&w=1200&q=80',
                'ba_category_id' => $categoryMap->get('Formation'),
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
