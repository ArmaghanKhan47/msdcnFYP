<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class DistributorTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_distributor_dasboard_active(){
        //Distributor access Dashboard when authenticated
        $user = User::factory()->distributor()->active()->create();
        $response = $this->actingAs($user, 'web')
        ->get(route('home'));
        $response->assertOk()
        ->assertViewIs('home');
        $this->assertAuthenticatedAs($user);
    }

    public function test_distributor_dasboard_pending(){
        //Distributor access Dashboard when authenticated
        $user = User::factory()->distributor()->pending()->create();
        $response = $this->actingAs($user, 'web')
        ->get(route('home'));
        $response->assertStatus(302)
        ->assertRedirect(route('settings.index'));
        $this->assertAuthenticatedAs($user);
    }

    public function test_distributor_dasboard_deactive(){
        //Distributor access Dashboard when authenticated
        $user = User::factory()->distributor()->deactive()->create();
        $response = $this->actingAs($user, 'web')
        ->get(route('home'));
        $response->assertStatus(302)
        ->assertRedirect(route('settings.index'));
        $this->assertAuthenticatedAs($user);
    }

    public function test_distributor_notifications_active()
    {
        //Distributor access Notifications when authenticated
        $user = User::factory()->distributor()->active()->create();
        $response = $this->actingAs($user, 'web')
        ->get(route('notification.index'));
        $response->assertOk();
        $this->assertAuthenticatedAs($user);
    }

    public function test_distributor_order_history_active()
    {
        //Distributor access Order History when authenticated
        $user = User::factory()->distributor()->active()->create();
        $response = $this->actingAs($user, 'web')
        ->get(route('orderhistory.show'));
        $response->assertOk();
        $this->assertAuthenticatedAs($user);
    }

    public function test_distributor_reports_active()
    {
        //Distributor access Reports when authenticated
        $user = User::factory()->distributor()->active()->create();
        $response = $this->actingAs($user, 'web')
        ->get(route('report.index'));
        $response->assertOk();
        $this->assertAuthenticatedAs($user);
    }

    public function test_distributor_settings_acitve()
    {
        //Distributor access Settings when authenticated
        $user = User::factory()->distributor()->active()->create();
        $response = $this->actingAs($user, 'web')
        ->get(route('settings.index'));
        $response->assertOk();
        $this->assertAuthenticatedAs($user);
    }
}
