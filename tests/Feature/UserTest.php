<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Artisan;
use Tests\TestCase;

class UserTest extends TestCase
{
    public function test_set_database_config()
    {
     Artisan::call('migrate:reset');
     Artisan::call('migrate');
     Artisan::call('db:seed');
     
     $response=$this->get('/');
     
     $response->assertStatus(200);
    }
 
 

    public function test_login_bad_user(): void
    {
        $response = $this->post('/api/login',['email' => 'nonexist@test.com', 'password' => '123456789']);

        $response->assertStatus(404);
    }

    public function test_login_success(): void
    {
        $response = $this->post('/api/login',['email' => 'example@test.com', 'password' => '123456789']);

        $response->assertStatus(200);
    }
}
