<?php

namespace Tests\Unit\Models;

use App\Models\Repository;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class RepositoryTest extends TestCase
{

    use WithFaker, RefreshDatabase;
    public function test_repository_belongs_to_user()
    {

        $repository = Repository::factory()->create();
        $this->assertInstanceOf(User::class, $repository->user);
    }

    public function test_validate_store_repository()
    {
        $user = User::factory()->create();
        $this
            ->actingAs($user)
            ->post('repositories', [])
            ->assertStatus(302)
            ->assertSessionHasErrors(['url', 'description']);

    }

    public function test_store_repository()
    {
        $data = [
            'url' => $this->faker->url,
            'description' => $this->faker->text,
        ];

        $user = User::factory()->create();
        $this
            ->actingAs($user)
            ->post('repositories', $data)->assertRedirect('repositories');

        $this->assertDatabaseHas('repositories', $data);
    }

    public function test_update_repository()
    {
        $user = User::factory()->create();
        $repository = Repository::factory()->create([
            'user_id' => $user->id
        ]);
        $data = [
            'url' => $this->faker->url,
            'description' => $this->faker->text,
        ];

        $this
            ->actingAs($user)
            ->put("repositories/$repository->id", $data)
            ->assertRedirect("repositories/$repository->id/edit");

        $this->assertDatabaseHas('repositories', $data);
    }

    public function test_validate_update_repository()
    {
        $repository = Repository::factory()->create();
        $data = [
            'url' => $this->faker->url,
            'description' => $this->faker->text,
        ];

        $user = User::factory()->create();
        $this
            ->actingAs($user)
            ->put("repositories/$repository->id", [])
            ->assertStatus(302)
            ->assertSessionHasErrors(['url', 'description']);

    }

    public function test_repository_can_be_deleted()
    {
        $repository = Repository::factory()->create();

        $user = User::factory()->create();
        $this
            ->actingAs($user)
            ->delete("repositories/$repository->id")
            ->assertRedirect('repositories');

        $this->assertDatabaseMissing('repositories', $repository->toArray());
    }

    public function test_validate_update_repository_policy()
    {
        $user = User::factory()->create();
        $repository = Repository::factory()->create();
        $data = [
            'url' => $this->faker->url,
            'description' => $this->faker->text,
        ];

        $this
            ->actingAs($user)
            ->put("repositories/$repository->id", $data)
            ->assertStatus(403);
    }
}
