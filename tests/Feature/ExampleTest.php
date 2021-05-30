<?php

namespace Tests\Feature;

use App\Models\AdminUser;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testSettingsTest()
    {
        $user = User::find(1);
        $responce = $this->actingAs($user)->get('/settings');
        $responce->assertStatus(200);
    }
}
