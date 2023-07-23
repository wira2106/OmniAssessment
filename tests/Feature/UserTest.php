<?php

namespace Tests\Feature;

use App\Models\User;
use App\Repositories\Interfaces\UserRepository;
use Illuminate\Foundation\Testing\WithFaker;
use Faker\Factory as Faker;
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
        $faker = Faker::create('id_ID');
        $firstName = $faker->firstName;
            $lastName = $faker->lastName;
            $name = $firstName . " " . $lastName;
            $email = strtolower($firstName . $lastName) . '@gmail.com';
            $address = $faker->randomElement([
                'Jl. Kenangan, Gang Hujan',
                'Jl. Sudirman, Gang Kenangan',
                'Jl. Gajah Mada, Gang I',
                'Jl. Mawar Merah, Gang II',
                'Jl. Kebo Iwa , Gang II'
            ]);
        $data = [
            'name' => $name,
            'email' =>  $email,
            'password' => '12345678',
            'password_confirmation' => '12345678',
            'alamat' => $address
        ];
        $response = $this->actingAs($user)
                         ->withSession(['banned' => false])
                         ->post('/api/user/create',$data);

        $response->assertStatus(200);
        
    }
    /**
     * @test
     */
    public function user_can_edit_data_user()
    {

        $user = User::find(1);
        $user_update= $user;
        $data = [
                    'name' => $user_update->name."1",
                    'email' => $user_update->email,
                    'alamat' => $user_update->alamat,
                ];

        $response = $this->actingAs($user)
                         ->withSession(['banned' => false])
                         ->post('/api/user/update/'.$user_update->id,$data);

        $response->assertStatus(200);
        
    }
}
