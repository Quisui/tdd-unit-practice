<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Repository;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class RepositoryControllerTest extends TestCase
{

    use WithFaker, RefreshDatabase;

    public function test_protect_route_from_guest()
    {
        $this->get('repositories')->assertRedirect('login');
        $this->get('repositories/1')->assertRedirect('login');
        $this->get('repositories/1/edit')->assertRedirect('login');
        $this->put('repositories/1')->assertRedirect('login');
        $this->delete('repositories/1')->assertRedirect('login');
        $this->get('repositories/create')->assertRedirect('login');
        $this->post('repositories', [])->assertRedirect('login');
    }

    public function test_index_data_empty()
    {
        Repository::factory()->create();
        $user = User::factory()->create();

        $this
            ->actingAs($user)
            ->get('repositories')
            ->assertStatus(200)
            ->assertSee('There are no repos created yet');
    }


    public function test_repo_index_with_data()
    {
        $user = User::factory()->create();
        $repository = Repository::factory()->create(['user_id' => $user->id]);
        $this
            ->actingAs($user)
            ->get('repositories')
            ->assertStatus(200)
            ->assertSee($repository->id)
            ->assertSee($repository->url);
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

    public function test_create_view_status()
    {
        $user = User::factory()->create();

        $this
            ->actingAs($user)
            ->get("repositories/create")
            ->assertStatus(200);
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

    public function test_repository_can_be_deleted()
    {
        $user = User::factory()->create();
        $repository = Repository::factory()->create(['user_id' => $user->id]);
        $this
            ->actingAs($user)
            ->delete("repositories/$repository->id")
            ->assertStatus(302)
            ->assertRedirect('repositories');

        $this->assertDatabaseMissing('repositories', $repository->toArray());
    }

    public function test_repository_can_be_deleted_policy()
    {
        $user = User::factory()->create();
        $repository = Repository::factory()->create();
        $this
            ->actingAs($user)
            ->delete("repositories/$repository->id")
            ->assertStatus(403);
    }

    public function test_show_repository()
    {
        $user = User::factory()->create();
        $repository = Repository::factory()->create([
            'user_id' => $user->id
        ]);

        $this
            ->actingAs($user)
            ->get("repositories/$repository->id")
            ->assertStatus(200);
    }

    public function test_show_repository_policy()
    {
        $user = User::factory()->create();
        $repository = Repository::factory()->create(['user_id' => $user->id]);

        $this
            ->actingAs($user)
            ->get("repositories/$repository->id")
            ->assertStatus(200)
            ->assertSee($repository->url)
            ->assertSee($repository->description);
    }

    public function test_edit_repository()
    {
        $user = User::factory()->create();
        $repository = Repository::factory()->create([
            'user_id' => $user->id
        ]);

        $this
            ->actingAs($user)
            ->get("repositories/$repository->id/edit")
            ->assertStatus(200)
            ->assertSee($repository->url)
            ->assertSee($repository->description);
    }

    public function test_edit_repository_policy()
    {
        $user = User::factory()->create();
        $repository = Repository::factory()->create();

        $this
            ->actingAs($user)
            ->get("repositories/$repository->id/edit")
            ->assertStatus(403);
    }
}
