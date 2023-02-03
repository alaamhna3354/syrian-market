<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class MarketersTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_add_user()
    {
        $user = User::factory()->create([
            'email_verified_at' => null,
            'balance'=>200
        ]);

        $user->ass(200);
    }
}
