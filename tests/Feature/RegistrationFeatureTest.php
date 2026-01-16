<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\Event;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class RegistrationFeatureTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_cannot_register_twice_for_the_same_event(): void
    {
        $user = $this->createUser(['ba_email' => 'user@example.test']);
        $event = $this->createEvent();

        $this->actingAs($user)
            ->post(route('events.register', $event))
            ->assertSessionHasNoErrors();

        $this->actingAs($user)
            ->post(route('events.register', $event))
            ->assertSessionHasErrors('registration');

        $this->assertDatabaseCount('ba_registrations', 1);
        $this->assertDatabaseHas('ba_registrations', [
            'ba_user_id' => $user->ba_id,
            'ba_event_id' => $event->ba_id,
        ]);
    }

    public function test_event_capacity_blocks_additional_registrations(): void
    {
        $event = $this->createEvent(['ba_capacity' => 1]);
        $firstUser = $this->createUser(['ba_email' => 'first@example.test']);
        $secondUser = $this->createUser(['ba_email' => 'second@example.test']);

        $this->actingAs($firstUser)
            ->post(route('events.register', $event))
            ->assertSessionHasNoErrors();

        $this->actingAs($secondUser)
            ->post(route('events.register', $event))
            ->assertSessionHasErrors('registration');

        $this->assertDatabaseCount('ba_registrations', 1);
    }

    public function test_admin_registration_page_requires_admin_role(): void
    {
        $admin = $this->createUser([
            'ba_email' => 'admin@example.test',
            'ba_role' => 'admin',
        ]);
        $user = $this->createUser(['ba_email' => 'viewer@example.test']);

        $this->actingAs($admin)
            ->get(route('admin.registrations.index'))
            ->assertOk();

        $this->actingAs($user)
            ->get(route('admin.registrations.index'))
            ->assertForbidden();
    }

    private function createUser(array $overrides = []): User
    {
        return User::create(array_merge([
            'ba_name' => 'Utilisateur Test',
            'ba_email' => 'user_' . uniqid() . '@example.test',
            'ba_password' => Hash::make('password'),
            'ba_role' => 'user',
        ], $overrides));
    }

    private function createEvent(array $overrides = []): Event
    {
        $category = Category::create(['ba_name' => 'Conférence']);
        $creator = $this->createUser([
            'ba_email' => 'creator_' . uniqid() . '@example.test',
        ]);

        return Event::create(array_merge([
            'ba_title' => 'Événement test',
            'ba_description' => 'Description',
            'ba_start_date' => now()->addDay(),
            'ba_end_date' => now()->addDays(2),
            'ba_place' => 'Paris',
            'ba_capacity' => 10,
            'ba_price' => 0,
            'ba_is_free' => true,
            'ba_status' => 'active',
            'ba_category_id' => $category->ba_id,
            'ba_created_by' => $creator->ba_id,
        ], $overrides));
    }
}
