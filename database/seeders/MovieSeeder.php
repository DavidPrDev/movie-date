<?php

namespace Database\Seeders;

use App\Models\Movie;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MovieSeeder extends Seeder
{
    public function run(): void
    {
        Movie::create([
            'title'=>'Yojimbo',
            'viewing_date'=>'2024-05-25',
            'img_route'=>'zd7mu6dJKxkVtBdXqlEQ9W3msKl.jpg',
            'id_movie'=>'11878',
            'user_id'=>1,
        ]);
        Movie::create([
            'title'=>'Todo a la vez en todas partes',
            'viewing_date'=>'2024-05-27',
            'img_route'=>'fIwiFha3WPu5nHkBeMQ4GzEk0Hv.jpg',
            'id_movie'=>'545611',
            'user_id'=>1,
        ]);
    }
}
