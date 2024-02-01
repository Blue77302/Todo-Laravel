<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Post;

class PostTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Post::create([
            'Title' => 'lê dương',
            'Description' => 'le duong',
            'Publish_date' => 'le duong',
            'Status' => 'hoạt động',
        ]);
    }
}
