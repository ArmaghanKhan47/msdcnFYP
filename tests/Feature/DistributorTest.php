<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class DistributorTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testDistributorGetLogin()
    {
        $response = $this->get('/login');
        $response->assertStatus(200);
    }

    public function testDistributorGetDasboard()
    {
        //Distributor access Dashboard when authenticated
        $user = User::find(4);
        $response = $this->actingAs($user)->get('/home');
        $response->assertOk();
    }

    public function testDistributorGetNotifications()
    {
        //Distributor access Notifications when authenticated
        $user = User::find(4);
        $response = $this->actingAs($user)->get(route('notification.index'));
        $response->assertOk();
    }

    public function testDistributorGetOrderHistory()
    {
        //Distributor access Order History when authenticated
        $user = User::find(4);
        $response = $this->actingAs($user)->get(route('orderhistory.show'));
        $response->assertOk();
    }

    public function testDistributorGetReports()
    {
        //Distributor access Reports when authenticated
        $user = User::find(4);
        $response = $this->actingAs($user)->get(route('report.index'));
        $response->assertOk();
    }

    public function testDistributorGetSubscriptions()
    {
        //Distributor access Subscription History when authenticated
        $user = User::find(4);
        $response = $this->actingAs($user)->get(route('subscriptionhistory.index'));
        $response->assertOk();
    }

    public function testDistributorGetSettings()
    {
        //Distributor access Settings when authenticated
        $user = User::find(4);
        $response = $this->actingAs($user)->get(route('settings.index'));
        $response->assertOk();
    }
}
