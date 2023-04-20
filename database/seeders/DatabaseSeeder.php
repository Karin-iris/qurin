<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Admin;
use App\Models\Category;
use App\Models\CategoryPrimary;
use App\Models\CategorySecondary;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

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
        CategoryPrimary::factory()->create(
            [
                'name' => "傾聴",
                'code' => "LA",
                'order' => 1
            ],
            [
                'name' => "描く",
                'code' => "DR",
                'order' => 2
            ]);
        CategoryPrimary::factory()->create([
            'name' => "提案",
            'code' => "SG",
            'order' => 3
        ]);
        CategoryPrimary::factory()->create([
            'name' => "記録",
            'code' => "RC",
            'order' => 4
        ]);
        CategoryPrimary::factory()->create([
            'name' => "計画",
            'code' => "PL",
            'order' => 5
        ]);
        CategorySecondary::factory()->create([
            'name' => "信頼関係の構築",
            'code' => "01",
            'primary_id' => 1,
            'order' => 1
        ]);
        CategorySecondary::factory()->create([
            'name' => "顧客情報の収集",
            'code' => "02",
            'primary_id' => 1,
            'order' => 1
        ]);
        CategorySecondary::factory()->create([
            'name' => "家庭のデジタル環境",
            'code' => "03",
            'primary_id' => 1,
            'order' => 1
        ]);
        CategorySecondary::factory()->create([
            'name' => "信頼関係の構築",
            'code' => "01",
            'primary_id' => 1,
            'order' => 1
        ]);
        CategorySecondary::factory()->create([
            'name' => "Planning Sheetの描画方法",
            'code' => "02",
            'primary_id' => 1,
            'order' => 1
        ]);
        CategorySecondary::factory()->create([
            'name' => "家庭のデジタル環境",
            'code' => "03",
            'primary_id' => 1,
            'order' => 1
        ]);
        Category::factory()->create([
            'name' => "カテゴリ1",
            'code' => "11",
            'secondary_id' => 1,
            'order' => 1
        ]);
        Category::factory()->create([
            'name' => "カテゴリ2",
            'code' => "22",
            'secondary_id' => 2,
            'order' => 2
        ]);

    }
}
