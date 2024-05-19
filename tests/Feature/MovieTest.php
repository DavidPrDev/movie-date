<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class MovieTest extends TestCase
{

    public function test_set_database_config()
    {
        
        Artisan::call('migrate:reset');
        Artisan::call('migrate');
        Artisan::call('db:seed');
        
        $response=$this->get('/');
        
        $response->assertStatus(200);
    }


    public function test_show_all_movies(){

        $user = User::where('email', 'example@user.com')->first();

        $this->actingAs($user);

        $response = $this->get('/api/movie');

        $response->assertJsonStructure([
            'status',
            'movies'
        ]);
        
        $response->assertStatus(200);
    } 


    public function test_show_movie(){

        $user = User::where('email', 'example@user.com')->first();

        $this->actingAs($user);

        $response = $this->get('/api/movie/1');

        $response->assertJsonStructure([
            'status',
            'movie'
        ]);
    
        $response->assertStatus(200);
    } 

    public function test_show_movie_without_permission(){

        $user = User::factory()->create([
            'email' => 'whitout@example.com',
            'password' => Hash::make('password123'),
        ]);

        $this->actingAs($user);

        $response = $this->get('/api/movie/1');

    
        $response->assertStatus(403);
    } 

    public function test_create_movie(){

        $user = User::where('email', 'example@user.com')->first();

        $this->actingAs($user);

        $response = $this->postJson('/api/movie',
        [
            'title'=>'Los cazafantasmas',
            'viewing_date'=>'2024-05-28',
            'img_route'=>'6gzodU7MbxcgsOCa0LFZScFkyvK.jpg',
            'id_movie'=>'620'
        ]);

        $response->assertStatus(201);
    } 

    public function test_update_status_movie(){

        $user = User::where('email', 'example@user.com')->first();

        $this->actingAs($user);

        $response = $this->putJson('/api/movie/1',
        [
            'seen_status'=>true,

        ]);

        $response->assertStatus(203);
    } 


}
