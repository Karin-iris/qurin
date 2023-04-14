<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\CategoryPrimary;
use App\Models\CategorySecondary;
use App\Models\Category;
use Illuminate\Support\Facades\Hash;
use App\Models\Admin;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => Hash::make('password'),
        ]);
        Admin::factory()->create([
            'name' => 'Test Admin User',
            'email' => 'admin@example.com',
            'password' => Hash::make('password'),
        ]);
        CategoryPrimary::factory()->create([
            'name'=>"大カテゴリ1",
            'code'=>"AA",
            'order'=>1
        ]);
        CategoryPrimary::factory()->create([
            'name'=>"大カテゴリ2",
            'code'=>"AB",
            'order'=>2
        ]);
        CategorySecondary::factory()->create([
            'name'=>"中カテゴリ1",
            'code'=>"01",
            'primary_id'=>1,
            'order'=>1
        ]);
        CategorySecondary::factory()->create([
            'name'=>"中カテゴリ2",
            'code'=>"02",
            'primary_id'=>2,
            'order'=>1
        ]);
        Category::factory()->create([
            'name'=>"カテゴリ1",
            'code'=>"11",
            'secondary_id'=>1,
            'order'=>1
        ]);
        Category::factory()->create([
            'name'=>"カテゴリ2",
            'code'=>"22",
            'secondary_id'=>2,
            'order'=>2
        ]);

    }
}
