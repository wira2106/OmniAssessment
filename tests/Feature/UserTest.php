<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserTest extends TestCase
{
    use RefreshDatabase;
    /**
     * @test
     */
    public function user_can_see_list_user_page()
    {
        $token = "e081ba3d516c2d84ee33d6ad0d9490c7200fe7503daf2b91c2ecdac590dcba6c";
        $response = $this->get('/user')->withHeaders([
            'Authorization' => 'Bearer '. $token,
        ]);
        
        $response->assertStatus(200);
        $response->assertViewIs('users.index');
    }
    /**
     * @test
     */
    public function user_can_see_get_data_user()
    {
        $token = "e081ba3d516c2d84ee33d6ad0d9490c7200fe7503daf2b91c2ecdac590dcba6c";
        $response = $this->json('get', '/api/users')->withHeaders([
            'Authorization' => 'Bearer '. $token,
        ]);;
        dd($response);
        $response->assertStatus(200);
        
    }
}
