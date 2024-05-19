<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class UserTest extends TestCase
{
    use RefreshDatabase;
 
    public function test_login_bad_user(): void
    {
        $response = $this->postJson('/api/login',['email' => 'noexist@test.com', 'password' => '123456789']);
       
        $response->assertJson([
            "status"=> "ko"
        ]);
        $response->assertStatus(404);
    }

    public function test_login_success(): void
    {
        
        $user = User::factory()->create([
            'name'=>'test',
            'email' => 'example@test.com',
            'password' => Hash::make('123456789'),
        ]);
        $response = $this->postJson('/api/login',['email' => $user->email, 'password' => '123456789']);
       
        $response->assertJsonStructure([
            'status',
            'token'
        ]);

        $response->assertStatus(200);
    }

    public function test_login_no_password_param(): void
    {

        $response = $this->postJson('/api/login',['email' => 'example@test.com']);

        $response->assertJson([
                "message"=> "The password field is required.",
                "errors"=> [
                    "password"=> [
                        "The password field is required."
                    ]
                ]
            
        ]);
        $response->assertStatus(422);
    }

    public function test_register_no_email_param():void{

        $response = $this->postJson('/api/register',['password' => '123456789','name'=>'pepe']);

        $response->assertJson([
            "message"=> "The email field is required.",
            "errors"=> [
                "email"=> [
                    "The email field is required."
                ]
            ]
        ]);

        $response->assertStatus(422);
    }

    public function test_register_success():void
    {
        $response = $this->postJson('/api/register',['name'=>'pepe','email'=>'pepe@test.com','password' => '123456789']);

        $response->assertJsonStructure([
            'status',
            'token'
        ]);

        $response->assertStatus(201);
    }
}
