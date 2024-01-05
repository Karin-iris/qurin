<?php

namespace Database\Seeders;

use App\Models\Admin;
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
            'password' => Hash::make('password'),
        ]);
        Admin::factory()->create([
            'name' => Crypt::encryptString('栄福(管理者)'),
            'email' => 'fujiki@primeforce.co.jp',
            'password' => Hash::make('Pass_001'),
        ]);
        Admin::factory()->create([
            'name' => Crypt::encryptString('野口(管理者)'),
            'email' => 'nakamura@primeforce.co.jp',
            'password' => Hash::make('Pass_002'),
        ]);
        Admin::factory()->create([
            'name' => Crypt::encryptString('小川(管理者)'),
            'email' => 'tsushimak@pcdepot.co.jp',
            'password' => Hash::make('Pass_003'),
        ]);
        Admin::factory()->create([
            'name' => Crypt::encryptString('鈴木(管理者)'),
            'email' => 'tanakatak@pcdepot.co.jp',
            'password' => Hash::make('Pass_004'),
        ]);
        User::factory()->create([
            'name' => Crypt::encryptString('澤田 哲理'),
            'email' => 'tetsu707@outlook.com',
            'icon_image_path' => '',
            'password' => Hash::make('password'),
        ]);
        User::factory()->create([
            'name' => Crypt::encryptString('栄福'),
            'email' => 'passionmissionary@gmail.com',
            'icon_image_path' => '',
            'password' => Hash::make('Pass_001'),
        ]);
        User::factory()->create([
            'name' => Crypt::encryptString('野口'),
            'email' => 'info@primeforce.co.jp',
            'icon_image_path' => '',
            'password' => Hash::make('Pass_002'),
        ]);
        User::factory()->create([
            'name' => Crypt::encryptString('小川'),
            'email' => 'campjourney24@gmail.com',
            'icon_image_path' => '',
            'password' => Hash::make('Pass_003'),
        ]);
        User::factory()->create([
            'name' => Crypt::encryptString('鈴木'),
            'email' => 'takehiko.tanaka@gmail.com',
            'icon_image_path' => '',
            'password' => Hash::make('Pass_004'),
        ]);
    }
}

