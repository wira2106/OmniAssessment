<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserTest extends TestCase
{
    /**
     * user_can_see_list_user_page test.
     *
     * @return void
     */
    public function user_can_see_list_user_page()
    {
        $response = $this->get('/api/users');

        $response->assertStatus(200);
    }
}
