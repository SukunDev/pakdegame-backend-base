<?php

namespace Database\Seeders;

use App\Models\Options;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class OptionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Options::create([
            "key" => "site_name",
            "value" => "Sukun Blog",
        ]);
        Options::create([
            "key" => "site_description",
            "value" =>
                "SukunBlog adalah situs dimana kami membagikan berbagai info mengenai tutorial, Tips & Tricks, Programing, Android, dan Game secara lengkap dan terupdate",
        ]);
        Options::create([
            "key" => "site_keywords",
            "value" => "Tutorial, Tips and Tricks, Programing, Android, Game",
        ]);
        Options::create([
            "key" => "site_author",
            "value" => "SukunDev",
        ]);
        Options::create([
            "key" => "site_thumbnail",
            "value" => "http://localhost:8000/image/thumbnail/thumbnail.png",
        ]);
    }
}
