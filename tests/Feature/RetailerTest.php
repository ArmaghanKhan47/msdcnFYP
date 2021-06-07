<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class RetailerTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testRetailerGetLogin()
    {
        $response = $this->get('/login');
        $response->assertStatus(200);
    }

    public function testRetailerGetDasboard()
    {
        //Retailer access Dashboard when authenticated
        $user = User::find(1);
        $response = $this->actingAs($user)->get('/home');
        $response->assertOk();
    }

    public function testRetailerGetNotifications()
    {
        //Retailer access Notifications when authenticated
        $user = User::find(1);
        $response = $this->actingAs($user)->get(route('notification.index'));
        $response->assertOk();
    }

    public function testRetailerGetOrderHistory()
    {
        //Retailer access Order History when authenticated
        $user = User::find(1);
        $response = $this->actingAs($user)->get(route('orderhistory.show'));
        $response->assertOk();
    }

    public function testRetailerGetReports()
    {
        //Retailer access Reports when authenticated
        $user = User::find(1);
        $response = $this->actingAs($user)->get(route('report.index'));
        $response->assertOk();
    }

    public function testRetailerGetSubscriptions()
    {
        //Retailer access Subscription History when authenticated
        $user = User::find(1);
        $response = $this->actingAs($user)->get(route('subscriptionhistory.index'));
        $response->assertOk();
    }

    public function testRetailerGetSettings()
    {
        //Retailer access Settings when authenticated
        $user = User::find(1);
        $response = $this->actingAs($user)->get(route('settings.index'));
        $response->assertOk();
    }

    public function testRetailerGetCart()
    {
        //Retailer access Cart when authenticated
        $user = User::find(1);
        $response = $this->actingAs($user)->get(route('cart.index'));
        $response->assertOk();
    }

    public function testRetailerGetOrderOnline()
    {
        //Retailer access Order Online when authenticated
        $user = User::find(1);
        $response = $this->actingAs($user)->get(route('order.index'));
        $response->assertOk();
    }

    public function testRetailerGetOrderCheckout()
    {
        //Retailer access Order Checkout when authenticated
        $user = User::find(1);
        $response = $this->actingAs($user)->get(route('order.checkout'));
        $response->assertOk();
    }

    public function testRetailerGetSales()
    {
        //Retailer access Sales when authenticated
        $user = User::find(1);
        $response = $this->actingAs($user)->get(route('sales.index'));
        $response->assertOk();
    }

    public function testRetailerGetNewSale()
    {
        //Retailer access New Sales when authenticated
        $user = User::find(1);
        $response = $this->actingAs($user)->get(route('sales.newsale'));
        $response->assertOk();
    }

    public function testRetailerGetInventory()
    {
        //Retailer access Inventory when authenticated
        $user = User::find(1);
        $response = $this->actingAs($user)->get(route('inventory.index'));
        $response->assertOk();
    }
}
