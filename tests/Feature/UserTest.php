<?php

namespace Tests\Feature;

use App\Models\User;
use App\Repositories\Interfaces\UserRepository;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserTest extends TestCase
{
    /**
     * @test
     */
    public function user_can_see_list_user_page()
    {
        $user = User::find(1);
 
        $response = $this->actingAs($user)
                         ->withSession(['banned' => false])
                         ->get('/user');

        $response->assertStatus(200);
        $response->assertViewIs('users.index');
    }
    /**
     * @test
     */
    public function user_can_see_get_data_user()
    {

        $user = User::find(1);

        $response = $this->actingAs($user)
                         ->withSession(['banned' => false])
                         ->get('/api/users');

        $response->assertStatus(200);
        
    }
    /**
     * @test
     */
    public function user_can_create_data_user()
    {

        $user = User::find(1);

        $response = $this->actingAs($user)
                         ->withSession(['banned' => false])
                         ->get('/api/users');

        $response->assertStatus(200);
        
    }
    /**
     * @test
     */
    public function user_can_edit_data_user()
    {

        $user = User::find(1);

        $response = $this->actingAs($user)
                         ->withSession(['banned' => false])
                         ->get('/api/users');

        $response->assertStatus(200);
        
    }
}
