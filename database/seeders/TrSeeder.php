<?php

namespace Database\Seeders;

use App\Models\Admin;
use App\Models\CategoryPrimary;
use App\Models\CategorySecondary;
use App\Models\Category;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Crypt;

class TrSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        Admin::factory()->create([
            'name' => Crypt::encryptString('澤田 哲理(管理者)'),
            'email' => 'sawada@primeforce.co.jp',
            'code' => 'sawada',
            'password' => Hash::make('password'),
        ]);
        Admin::factory()->create([
            'name' => Crypt::encryptString('山中 かりん(管理者)'),
            'email' => 'yamanaka@primeforce.co.jp',
            'code' => 'yamanaka',
            'password' => Hash::make('password'),
        ]);
        User::factory()->create([
            'name' => Crypt::encryptString('澤田 哲理'),
            'email' => 'tetsu707@outlook.com',
            'code' => 'sawada',
            'icon_image_path' => '',
            'password' => Hash::make('password'),
        ]);
        User::factory()->create([
            'name' => Crypt::encryptString('山中 かりん'),
            'email' => 'yamanaka@primeforce.co.jp',
            'code' => 'yamanaka',
            'icon_image_path' => '',
            'password' => Hash::make('password'),
        ]);
        CategoryPrimary::factory()->create([
            'name' => "デジタルサービスデザイン",
            'code' => "DS",
            'order' => 1
        ]);
        CategorySecondary::factory()->create([
            'name' => "デジタル時代のコミュニケーション",
            'code' => "01",
            'primary_id' => 1,
            'order' => 01
        ]);
        Category::factory()->create([
            'name' => "次世代のコンタクトセンター像",
            'code' => "01",
            'secondary_id' => 1,
            'order' => 01
        ]);

    }
}

