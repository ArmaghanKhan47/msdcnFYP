<?php

namespace Tests\Feature;

use App\Models\AdminUser;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UserTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testAuthenticatedButSubscriptionEndedGetDashboard()
    {
        $user = User::find(3);
        $responce = $this->actingAs($user)->get(route('home'));
        $responce->assertStatus(302)->assertRedirect('/subscription');
    }

    public function testAuthenticatedButSubscriptionEndedGetSettings()
    {
        $user = User::find(3);
        $responce = $this->actingAs($user)->get(route('settings.index'));
        $responce->assertStatus(200);
    }

    public function testAuthenticatedButSubscriptionEndedGetOrderHistory()
    {
        $user = User::find(3);
        $responce = $this->actingAs($user)->get(route('orderhistory.show'));
        $responce->assertStatus(302)->assertRedirect('/subscription');
    }

    public function testAuthenticatedButSubscriptionEndedGetReports()
    {
        $user = User::find(3);
        $responce = $this->actingAs($user)->get(route('report.index'));
        $responce->assertStatus(302)->assertRedirect('/subscription');
    }

    public function testAuthenticatedButSubscriptionEndGetSubscriptionHistory()
    {
        $user = User::find(3);
        $responce = $this->actingAs($user)->get(route('subscriptionhistory.index'));
        $responce->assertStatus(200);
    }

    public function testAuthenticatedButSubscriptionEndGetCart()
    {
        $user = User::find(3);
        $responce = $this->actingAs($user)->get(route('cart.index'));
        $responce->assertStatus(302)->assertRedirect('/subscription');
    }

    public function testAuthenticatedButSubscriptionEndGetOrderOnline()
    {
        $user = User::find(3);
        $responce = $this->actingAs($user)->get(route('order.index'));
        $responce->assertStatus(302)->assertRedirect('/subscription');
    }

    public function testAuthenticatedButSubscriptionEndGetOrderCheckout()
    {
        $user = User::find(3);
        $responce = $this->actingAs($user)->get(route('order.checkout'));
        $responce->assertStatus(302)->assertRedirect('/subscription');
    }

    public function testAuthenticatedButSubscriptionEndGetSales()
    {
        $user = User::find(3);
        $responce = $this->actingAs($user)->get(route('sales.index'));
        $responce->assertStatus(302)->assertRedirect('/subscription');
    }

    public function testAuthenticatedButSubscriptionEndGetNewSale()
    {
        $user = User::find(3);
        $responce = $this->actingAs($user)->get(route('sales.newsale'));
        $responce->assertStatus(302)->assertRedirect('/subscription');
    }

    public function testUnauthenticatedGetDashboard()
    {
        $responce = $this->get(route('home'));
        $responce->assertStatus(302)->assertRedirect(route('login'));
    }

    public function testUnauthenticatedGetSettings()
    {
        $responce = $this->get(route('settings.index'));
        $responce->assertStatus(302)->assertRedirect(route('login'));
    }

    public function testUnauthenticatedGetOrderHistory()
    {
        $responce = $this->get(route('orderhistory.show'));
        $responce->assertStatus(302)->assertRedirect(route('login'));
    }

    public function testUnauthenticatedGetReports()
    {
        $responce = $this->get(route('report.index'));
        $responce->assertStatus(302)->assertRedirect(route('login'));
    }

    public function testUnauthenticatedGetSubscriptionHistory()
    {
        $responce = $this->get(route('subscriptionhistory.index'));
        $responce->assertStatus(302)->assertRedirect(route('login'));
    }

    public function testUnauthenticatedGetCart()
    {
        $responce = $this->get(route('cart.index'));
        $responce->assertStatus(302)->assertRedirect(route('login'));
    }

    public function testUnauthenticatedGetOrderOnline()
    {
        $responce = $this->get(route('order.index'));
        $responce->assertStatus(302)->assertRedirect(route('login'));
    }

    public function testUnauthenticatedGetOrderCheckout()
    {
        $responce = $this->get(route('order.checkout'));
        $responce->assertStatus(302)->assertRedirect(route('login'));
    }

    public function testUnauthenticatedGetSales()
    {
        $responce = $this->get(route('sales.index'));
        $responce->assertStatus(302)->assertRedirect(route('login'));
    }

    public function testUnauthenticatedGetNewSale()
    {
        $responce = $this->get(route('sales.newsale'));
        $responce->assertStatus(302)->assertRedirect(route('login'));
    }
}
