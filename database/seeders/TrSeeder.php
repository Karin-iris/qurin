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
            'code' => 'sawada',
            'password' => Hash::make('password'),
        ]);
        Admin::factory()->create([
            'name' => Crypt::encryptString('山中 かりん(管理者)'),
            'email' => 'yamanaka@primeforce.co.jp',
            'code' => 'yamanaka',
            'password' => Hash::make('password'),
        ]);
        Admin::factory()->create([
            'name' => Crypt::encryptString('栄福(管理者)'),
            'email' => 'eifuku@primeforce.co.jp',
            'code' => 'eifuku',
            'password' => Hash::make('Pass_001'),
        ]);
        Admin::factory()->create([
            'name' => Crypt::encryptString('野口(管理者)'),
            'email' => 'noguchi@primeforce.co.jp',
            'code' => 'noguchi',
            'password' => Hash::make('Pass_002'),
        ]);
        Admin::factory()->create([
            'name' => Crypt::encryptString('小川(管理者)'),
            'email' => 'ogawa@primeforce.co.jp',
            'code' => 'ogawa',
            'password' => Hash::make('Pass_003'),
        ]);
        Admin::factory()->create([
            'name' => Crypt::encryptString('鈴木(管理者)'),
            'email' => 'suzuki@primeforce.co.jp',
            'code' => 'suzuki',
            'password' => Hash::make('Pass_004'),
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
        User::factory()->create([
            'name' => Crypt::encryptString('栄福'),
            'email' => 'test001@primeforce.co.jp',
            'code' => 'eifuku',
            'icon_image_path' => '',
            'password' => Hash::make('Pass_001'),
        ]);
        User::factory()->create([
            'name' => Crypt::encryptString('野口'),
            'email' => 'test002@primeforce.co.jp',
            'code' => 'noguchi',
            'icon_image_path' => '',
            'password' => Hash::make('Pass_002'),
        ]);
        User::factory()->create([
            'name' => Crypt::encryptString('小川'),
            'email' => 'test003@primeforce.co.jp',
            'code' => 'ogawa',
            'icon_image_path' => '',
            'password' => Hash::make('Pass_003'),
        ]);
        User::factory()->create([
            'name' => Crypt::encryptString('鈴木'),
            'email' => 'test004@primeforce.co.jp',
            'code' => 'suzuki',
            'icon_image_path' => '',
            'password' => Hash::make('Pass_004'),
        ]);
    }
}

