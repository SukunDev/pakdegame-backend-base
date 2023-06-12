<?php

namespace Database\Seeders;

use App\Models\Pages;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PagesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Pages::create([
            "title" => "about",
            "slug" => "about",
            "body" => "<p>Ini adalah halaman about</p>",
            "user_id" => 1,
            "published_at" => now(),
        ]);
    }
}
