<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ApiV1Test extends TestCase
{
    use RefreshDatabase;

    private function authHeaders(): array
    {
        $user = User::factory()->create();
        $token = $user->createToken('test')->plainTextToken;
        return ['Authorization' => 'Bearer '.$token, 'Accept' => 'application/json'];
    }

    public function test_companies_index_ok(): void
    {
        $this->seed();
        $response = $this->getJson('/api/v1/companies', $this->authHeaders());
        $response->assertStatus(200);
    }

    public function test_customers_index_ok(): void
    {
        $this->seed();
        $response = $this->getJson('/api/v1/customers', $this->authHeaders());
        $response->assertStatus(200);
    }

    public function test_tasks_index_ok(): void
    {
        $this->seed();
        $response = $this->getJson('/api/v1/tasks', $this->authHeaders());
        $response->assertStatus(200);
    }

    public function test_notes_index_ok(): void
    {
        $this->seed();
        $response = $this->getJson('/api/v1/notes', $this->authHeaders());
        $response->assertStatus(200);
    }
}


