<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\book;
use App\Models\quiz;
use App\Models\User;
use App\Models\level;
use App\Models\chapter;
use App\Models\message;
use App\Models\subject;
use App\Models\category;
use App\Models\learning;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
       // level::factory(6)->create();
       // subject::factory(7)->create();
       // learning::factory(5)->create();
       // chapter::factory(40)->create();
        //quiz::factory(40)->create();
       // User::factory(3)->create();
       // category::factory(5)->create();
       // book::factory(25)->create();
        message::factory(5)->create();


        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
