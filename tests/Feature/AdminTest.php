<?php

namespace Tests\Feature;

use App\Models\AdminUser;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AdminTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testAdminGetLogin()
    {
        $response = $this->get(route('admin.login'));
        $response->assertStatus(200);
    }

    public function testAdminGetDashboard()
    {
        $user = AdminUser::factory()->create();
        $response = $this->actingAs($user, 'admin')->get(route('admin.dashboard'));
        $response->assertStatus(200);
    }

    public function testAdminGetDashboardUnauthenticated()
    {

        $response = $this->get(route('admin.dashboard'));
        $response->assertStatus(302)->assertRedirect(route('login'));
    }

    public function testAdminGetMedicineCreate()
    {
        $user = AdminUser::find(1);
        $response = $this->actingAs($user, 'admin')->get(route('admin.medicine.create'));
        $response->assertStatus(200);
    }

    public function testAdminGetMedicineCreateUnauthenticated()
    {
        $response = $this->get(route('admin.medicine.create'));
        $response->assertStatus(302)->assertRedirect(route('login'));
    }

    public function testAdminGetMedicineIndex()
    {
        $user = AdminUser::find(1);
        $response = $this->actingAs($user, 'admin')->get(route('admin.medicine.index'));
        $response->assertStatus(200);
    }

    public function testAdminGetMedicineIndexUnauthenticated()
    {
        $response = $this->get(route('admin.medicine.index'));
        $response->assertStatus(302)->assertRedirect(route('login'));
    }

    // public function testAdminGetMedicineEdit()
    // {
    //     $user = AdminUser::find(1);
    //     $response = $this->actingAs($user, 'admin')->get(route('admin.medicine.edit'));
    //     $response->assertStatus(200);
    // }

    public function testAdminGetSubscriptionIndex()
    {
        $user = AdminUser::find(1);
        $response = $this->actingAs($user, 'admin')->get(route('admin.subscription.index'));
        $response->assertStatus(200);
    }

    public function testAdminGetSubscriptionIndexUnauthenticated()
    {
        $response = $this->get(route('admin.subscription.index'));
        $response->assertStatus(302)->assertRedirect(route('login'));
    }

    public function testAdminGetSubscriptionCreate()
    {
        $user = AdminUser::find(1);
        $response = $this->actingAs($user, 'admin')->get(route('admin.subscription.create'));
        $response->assertStatus(200);
    }

    public function testAdminGetSubscriptionCreateUnauthenticated()
    {
        $response = $this->get(route('admin.subscription.create'));
        $response->assertStatus(302)->assertRedirect(route('login'));
    }

    // public function testAdminGetSubscriptionEdit()
    // {
    //     $user = AdminUser::find(1);
    //     $response = $this->actingAs($user, 'admin')->get(route('admin.subscription.edit'));
    //     $response->assertStatus(200);
    // }

    public function testAdminGetPendingRequestIndex()
    {
        $user = AdminUser::find(1);
        $response = $this->actingAs($user, 'admin')->get(route('admin.pending.index'));
        $response->assertStatus(200);
    }

    public function testAdminGetPendingRequestIndexUnauthenticated()
    {
        $response = $this->get(route('admin.pending.index'));
        $response->assertStatus(302)->assertRedirect(route('login'));
    }

    public function testAdminGetFeedbackIndex()
    {
        $user = AdminUser::find(1);
        $response = $this->actingAs($user, 'admin')->get(route('admin.feedback.index'));
        $response->assertStatus(200);
    }

    public function testAdminGetFeedbackIndexUnauthenticated()
    {
        $response = $this->get(route('admin.feedback.index'));
        $response->assertStatus(302)->assertRedirect(route('login'));
    }
}
