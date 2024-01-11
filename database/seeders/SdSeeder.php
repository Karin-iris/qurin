<?php

namespace Database\Seeders;

use App\Models\Admin;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Crypt;

class SdSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run()
    {
        Admin::factory()->create([
            'name' => Crypt::encryptString('澤田 哲理(管理者)'),
            'email' => 'sawada@primeforce.co.jp',
            'password' => Hash::make('password'),
        ]);
        Admin::factory()->create([
            'name' => Crypt::encryptString('向川 啓太(管理者)'),
            'email' => 'test001@primeforce.co.jp',
            'password' => Hash::make('Pass_001'),
        ]);
        User::factory()->create([
            'name' => Crypt::encryptString('澤田 哲理'),
            'email' => 'tetsu707@outlook.com',
            'icon_image_path' => '',
            'password' => Hash::make('password'),
        ]);
        User::factory()->create([
            'name' => Crypt::encryptString('向川 啓太'),
            'email' => 'test010@gmail.com',
            'icon_image_path' => '',
            'password' => Hash::make('Pass_001'),
        ]);
    }
}


