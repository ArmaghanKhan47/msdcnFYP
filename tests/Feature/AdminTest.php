<?php

namespace Tests\Feature;

use App\Models\AdminUser;
use App\Models\Medicine;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AdminTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_admin_login_page(){
        $response = $this->get(route('admin.login'));
        $response->assertStatus(200)
        ->assertViewIs('admin.auth.login');
    }

    public function test_admin_dashboard_auth(){
        $user = AdminUser::factory()->create();

        $response = $this->actingAs($user, 'admin')
        ->get(route('admin.dashboard'));

        $response->assertStatus(200)
        ->assertViewIs('admin.main.home');

        $this->assertAuthenticatedAs($user, 'admin');
    }

    public function test_admin_dashboard_unauth()
    {

        $response = $this->get(route('admin.dashboard'));
        $response->assertStatus(302)
        ->assertRedirect(route('login'));
    }

    public function test_admin_medicine_create(){
        $user = AdminUser::factory()->create();
        $response = $this->actingAs($user, 'admin')
        ->get(route('admin.medicine.create'));
        $response->assertStatus(200)
        ->assertViewIs('admin.main.addmedicine');
        $this->assertAuthenticatedAs($user, 'admin');
    }

    public function test_admin_medicine_create_unauth(){
        $response = $this->get(route('admin.medicine.create'));
        $response->assertStatus(302)
        ->assertRedirect(route('login'));
    }

    public function test_admin_medicine_index(){
        $user = AdminUser::factory()->create();
        $response = $this->actingAs($user, 'admin')
        ->get(route('admin.medicine.index'));
        $response->assertStatus(200)
        ->assertViewIs('admin.main.allmedicines');
        $this->assertAuthenticatedAs($user, 'admin');
    }

    public function test_admin_medicine_index_unauth(){
        $response = $this->get(route('admin.medicine.index'));
        $response->assertStatus(302)
        ->assertRedirect(route('login'));
    }

    public function test_admin_medicine_edit(){
        $user = AdminUser::factory()->create();
        $medicine = Medicine::factory()->create();
        $response = $this->actingAs($user, 'admin')
        ->get(route('admin.medicine.edit', [
            'id' => $medicine->id
        ]));
        $response->assertStatus(200)
        ->assertViewIs('admin.main.editmedicine');
        $this->assertAuthenticatedAs($user, 'admin');
    }

    public function test_admin_pending_request_index(){
        $user = AdminUser::factory()->create();
        $response = $this->actingAs($user, 'admin')
        ->get(route('admin.pending.index'));
        $response->assertStatus(200)
        ->assertViewIs('admin.main.pendingrequest');
        $this->assertAuthenticatedAs($user, 'admin');
    }

    public function test_admin_pending_request_index_unauth(){
        $response = $this->get(route('admin.pending.index'));
        $response->assertStatus(302)
        ->assertRedirect(route('login'));
    }

    public function test_admin_feedback_index(){
        $user = AdminUser::factory()->create();
        $response = $this->actingAs($user, 'admin')
        ->get(route('admin.feedback.index'));
        $response->assertStatus(200);
    }

    public function test_admin_feedback_index_unauth()
    {
        $response = $this->get(route('admin.feedback.index'));
        $response->assertStatus(302)
        ->assertRedirect(route('login'));
    }
}
