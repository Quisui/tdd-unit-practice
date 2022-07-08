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
}
