<?php

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\TestCase;

/**
 * Created by PhpStorm.
 * User: Hammam
 * Date: 2/3/2023
 * Time: 3:07 AM
 */

class MarketerTest extends  TestCase
{
    use RefreshDatabase;

    public function test_create_user()
    {
        $user = User::factory()->create([
            'email_verified_at' => null,
            'balance'=>200
        ]);

        $response = $this->actingAs($user)->get('/verify-email');

        $response->assertStatus(200);
    }
}