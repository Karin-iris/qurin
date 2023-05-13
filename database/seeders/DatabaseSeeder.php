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
    public function run()
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
            'name' => "傾聴",
            'code' => "LA",
            'order' => 1
        ]);
        CategoryPrimary::factory()->create([
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
        CategoryPrimary::factory()->create([
            'name' => "マナー・接遇",
            'code' => "BM",
            'order' => 6
        ]);
        CategoryPrimary::factory()->create([
            'name' => "コンプライアンス",
            'code' => "CP",
            'order' => 7
        ]);

        CategoryPrimary::factory()->create([
            'name' => "スマートフォン",
            'code' => "SP",
            'order' => 8
        ]);
        CategoryPrimary::factory()->create([
            'name' => "パーソナルコンピューター",
            'code' => "PC",
            'order' => 9
        ]);
        CategoryPrimary::factory()->create([
            'name' => "デジタルガジェット",
            'code' => "DG",
            'order' => 10
        ]);
        CategoryPrimary::factory()->create([
            'name' => "デジタルライフ",
            'code' => "DL",
            'order' => 11
        ]);
        CategoryPrimary::factory()->create([
            'name' => "デジタル資産と教養",
            'code' => "DE",
            'order' => 12
        ]);
        CategoryPrimary::factory()->create([
            'name' => "デジタルシチズンシップ",
            'code' => "DC",
            'order' => 13
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
            'name' => "Planning Sheetの描画方法",
            'code' => "01",
            'primary_id' => 2,
            'order' => 1
        ]);
        CategorySecondary::factory()->create([
            'name' => "Asset表の作成",
            'code' => "02",
            'primary_id' => 2,
            'order' => 1
        ]);
        CategorySecondary::factory()->create([
            'name' => "現状",
            'code' => "03",
            'primary_id' => 2,
            'order' => 1
        ]);
        CategorySecondary::factory()->create([
            'name' => "提案したい未来",
            'code' => "04",
            'primary_id' => 2,
            'order' => 1
        ]);
        CategorySecondary::factory()->create([
            'name' => "Planning Sheetに基づく提案",
            'code' => "01",
            'primary_id' => 3,
            'order' => 1
        ]);
        CategorySecondary::factory()->create([
            'name' => "ストーリー説明",
            'code' => "02",
            'primary_id' => 3,
            'order' => 1
        ]);
        CategorySecondary::factory()->create([
            'name' => "記録（相談内容・購入内容）",
            'code' => "01",
            'primary_id' => 4,
            'order' => 1
        ]);
        CategorySecondary::factory()->create([
            'name' => "次回の約束",
            'code' => "02",
            'primary_id' => 4,
            'order' => 1
        ]);
        CategorySecondary::factory()->create([
            'name' => "行動計画",
            'code' => "01",
            'primary_id' => 5,
            'order' => 1
        ]);
        CategorySecondary::factory()->create([
            'name' => "中期計画（VER2で構築予定）",
            'code' => "02",
            'primary_id' => 5,
            'order' => 1
        ]);
        CategorySecondary::factory()->create([
            'name' => "基本的マナー",
            'code' => "01",
            'primary_id' => 6,
            'order' => 1
        ]);
        CategorySecondary::factory()->create([
            'name' => "顧客との関係構築",
            'code' => "01",
            'primary_id' => 6,
            'order' => 1
        ]);
        CategorySecondary::factory()->create([
            'name' => "デジタルライフプランナーの倫理行動基準",
            'code' => "01",
            'primary_id' => 7,
            'order' => 1
        ]);
        CategorySecondary::factory()->create([
            'name' => "安全確保",
            'code' => "02",
            'primary_id' => 7,
            'order' => 1
        ]);
        CategorySecondary::factory()->create([
            'name' => "法令遵守",
            'code' => "03",
            'primary_id' => 7,
            'order' => 1
        ]);
        CategorySecondary::factory()->create([
            'name' => "スマートフォンとはなにか",
            'code' => "01",
            'primary_id' => 8,
            'order' => 1
        ]);
        CategorySecondary::factory()->create([
            'name' => "スマートフォンの利用",
            'code' => "02",
            'primary_id' => 8,
            'order' => 1
        ]);
        CategorySecondary::factory()->create([
            'name' => "パーソナルコンピュータとはなにか",
            'code' => "01",
            'primary_id' => 9,
            'order' => 1
        ]);
        CategorySecondary::factory()->create([
            'name' => "パーソナルコンピュータの利用",
            'code' => "02",
            'primary_id' => 9,
            'order' => 1
        ]);
        CategorySecondary::factory()->create([
            'name' => "デジタルガジェットとはなにか",
            'code' => "01",
            'primary_id' => 10,
            'order' => 1
        ]);
        CategorySecondary::factory()->create([
            'name' => "キャリア変更",
            'code' => "02",
            'primary_id' => 11,
            'order' => 1
        ]);
        CategorySecondary::factory()->create([
            'name' => "データ移行",
            'code' => "02",
            'primary_id' => 11,
            'order' => 1
        ]);
        CategorySecondary::factory()->create([
            'name' => "セキュリティ設定",
            'code' => "02",
            'primary_id' => 11,
            'order' => 1
        ]);
        CategorySecondary::factory()->create([
            'name' => "パソコン、関連機器の不調",
            'code' => "02",
            'primary_id' => 11,
            'order' => 1
        ]);
        CategorySecondary::factory()->create([
            'name' => "料理とデジタル",
            'code' => "02",
            'primary_id' => 11,
            'order' => 1
        ]);
        CategorySecondary::factory()->create([
            'name' => "ショッピングとデジタル",
            'code' => "02",
            'primary_id' => 11,
            'order' => 1
        ]);
        CategorySecondary::factory()->create([
            'name' => "コミュニケーションとデジタル",
            'code' => "02",
            'primary_id' => 11,
            'order' => 1
        ]);
        CategorySecondary::factory()->create([
            'name' => "写真とデジタル",
            'code' => "08",
            'primary_id' => 11,
            'order' => 1
        ]);
        CategorySecondary::factory()->create([
            'name' => "旅行とデジタル",
            'code' => "09",
            'primary_id' => 11,
            'order' => 1
        ]);

        CategorySecondary::factory()->create([
            'name' => "ペットとデジタル",
            'code' => "10",
            'primary_id' => 11,
            'order' => 1
        ]);
        CategorySecondary::factory()->create([
            'name' => "仕事とデジタル",
            'code' => "11",
            'primary_id' => 11,
            'order' => 1
        ]);
        CategorySecondary::factory()->create([
            'name' => "交通機関とデジタル",
            'code' => "12",
            'primary_id' => 10,
            'order' => 1
        ]);
        CategorySecondary::factory()->create([
            'name' => "エンターテイメントとデジタル",
            'code' => "13",
            'primary_id' => 10,
            'order' => 1
        ]);
        CategorySecondary::factory()->create([
            'name' => "ホームエンターテイメントとデジタル",
            'code' => "14",
            'primary_id' => 10,
            'order' => 1
        ]);
        CategorySecondary::factory()->create([
            'name' => "ヘルスケアとデジタル",
            'code' => "15",
            'primary_id' => 10,
            'order' => 1
        ]);
        CategorySecondary::factory()->create([
            'name' => "運動とデジタル",
            'code' => "16",
            'primary_id' => 10,
            'order' => 1
        ]);
        CategorySecondary::factory()->create([
            'name' => "学びとデジタル",
            'code' => "17",
            'primary_id' => 10,
            'order' => 1
        ]);
        CategorySecondary::factory()->create([
            'name' => "ゲームとデジタル",
            'code' => "18",
            'primary_id' => 10,
            'order' => 1
        ]);
        CategorySecondary::factory()->create([
            'name' => "ホームとデジタル",
            'code' => "19",
            'primary_id' => 10,
            'order' => 1
        ]);
        CategorySecondary::factory()->create([
            'name' => "カーライフとデジタル",
            'code' => "20",
            'primary_id' => 10,
            'order' => 1
        ]);
        CategorySecondary::factory()->create([
            'name' => "地域サービスとデジタル",
            'code' => "21",
            'primary_id' => 10,
            'order' => 1
        ]);
        CategorySecondary::factory()->create([
            'name' => "コミュニティとデジタル",
            'code' => "22",
            'primary_id' => 10,
            'order' => 1
        ]);
        CategorySecondary::factory()->create([
            'name' => "デジタル資産と学び",
            'code' => "01",
            'primary_id' => 11,
            'order' => 1
        ]);
        CategorySecondary::factory()->create([
            'name' => "世代の特徴",
            'code' => "02",
            'primary_id' => 11,
            'order' => 1
        ]);
        CategorySecondary::factory()->create([
            'name' => "家族の対応",
            'code' => "03",
            'primary_id' => 11,
            'order' => 1
        ]);
        CategorySecondary::factory()->create([
            'name' => "デジタルシティズンシップ",
            'code' => "03",
            'primary_id' => 12,
            'order' => 1
        ]);
        CategorySecondary::factory()->create([
            'name' => "メディアバランスとウェルビーイング",
            'code' => "03",
            'primary_id' => 12,
            'order' => 1
        ]);
        CategorySecondary::factory()->create([
            'name' => "対人関係とコミュニケーション",
            'code' => "03",
            'primary_id' => 12,
            'order' => 1
        ]);
        CategorySecondary::factory()->create([
            'name' => "ニュースメディアリテラシー",
            'code' => "03",
            'primary_id' => 12,
            'order' => 1
        ]);
        CategorySecondary::factory()->create([
            'name' => "デジタル足跡とアイデンティティ",
            'code' => "03",
            'primary_id' => 12,
            'order' => 1
        ]);
        CategorySecondary::factory()->create([
            'name' => "セキュリティとプライバシー",
            'code' => "03",
            'primary_id' => 12,
            'order' => 1
        ]);
        CategorySecondary::factory()->create([
            'name' => "ネットいじめ、揉め事、ヘイトスピーチ",
            'code' => "03",
            'primary_id' => 12,
            'order' => 1
        ]);


        Category::factory()->create([
            'name' => "共感的でポジティブなコミュニケーション",
            'code' => "01",
            'secondary_id' => 1,
            'order' => 1
        ]);
        Category::factory()->create([
            'name' => "基本的なビジネスマナー",
            'code' => "02",
            'secondary_id' => 1,
            'order' => 2
        ]);
        Category::factory()->create([
            'name' => "お客様の関心事に興味を持つ",
            'code' => "03",
            'secondary_id' => 1,
            'order' => 3
        ]);
        Category::factory()->create([
            'name' => "小さな約束を守る",
            'code' => "04",
            'secondary_id' => 1,
            'order' => 4
        ]);
        Category::factory()->create([
            'name' => "顧客の家族構成の把握",
            'code' => "01",
            'secondary_id' => 2,
            'order' => 2
        ]);
        Category::factory()->create([
            'name' => "同居人数・年齢",
            'code' => "02",
            'secondary_id' => 2,
            'order' => 2
        ]);
        Category::factory()->create([
            'name' => "世代ごとの状況",
            'code' => "03",
            'secondary_id' => 2,
            'order' => 2
        ]);
        Category::factory()->create([
            'name' => "就学状況",
            'code' => "04",
            'secondary_id' => 2,
            'order' => 3
        ]);
        Category::factory()->create([
            'name' => "就労状況（会社・仕事内容・休日）",
            'code' => "05",
            'secondary_id' => 2,
            'order' => 4
        ]);
        Category::factory()->create([
            'name' => "所属しているコミュニティ",
            'code' => "06",
            'secondary_id' => 2,
            'order' => 4
        ]);
        Category::factory()->create([
            'name' => "趣味",
            'code' => "07",
            'secondary_id' => 2,
            'order' => 4
        ]);
        Category::factory()->create([
            'name' => "ペット",
            'code' => "08",
            'secondary_id' => 2,
            'order' => 4
        ]);
        Category::factory()->create([
            'name' => "スマートフォン利用状況",
            'code' => "01",
            'secondary_id' => 3,
            'order' => 4
        ]);
        Category::factory()->create([
            'name' => "キャリアの契約状況",
            'code' => "02",
            'secondary_id' => 3,
            'order' => 4
        ]);

        Category::factory()->create([
            'name' => "パソコンの利用状況",
            'code' => "03",
            'secondary_id' => 3,
            'order' => 4
        ]);
        Category::factory()->create([
            'name' => "デジタルガジェットの利用状況",
            'code' => "04",
            'secondary_id' => 3,
            'order' => 4
        ]);
        Category::factory()->create([
            'name' => "お困りごとやデジタル利用の課題",
            'code' => "05",
            'secondary_id' => 3,
            'order' => 4
        ]);
        Category::factory()->create([
            'name' => "記入すべき基本情報（DLPの名前・日付・曜日）",
            'code' => "01",
            'secondary_id' => 4,
            'order' => 4
        ]);
        Category::factory()->create([
            'name' => "書き方の基本（イラスト化・大きな紙（A3）普通紙・太めのボールペン・フェルトペン・蛍光ペン（やさしい色））",
            'code' => "02",
            'secondary_id' => 4,
            'order' => 4
        ]);
        Category::factory()->create([
            'name' => "時系列（左上→右下）",
            'code' => "03",
            'secondary_id' => 4,
            'order' => 4
        ]);
        Category::factory()->create([
            'name' => "Assetとは、お客様の情報資産を指す（デジタルガジェット、過去利用していたデジタルガジェット、契約しているキャリア、情報リテラシー全般等）Asset表とは、Assetをお客様にわかりやすく時系列にイラスト化した表である。",
            'code' => "01",
            'secondary_id' => 5,
            'order' => 4
        ]);
        Category::factory()->create([
            'name' => "家族構成（年齢、続柄、趣味、習い事）",
            'code' => "01",
            'secondary_id' => 6,
            'order' => 4
        ]);
        Category::factory()->create([
            'name' => "利用しているデジタルガジェット・ネット回線",
            'code' => "02",
            'secondary_id' => 6,
            'order' => 4
        ]);
        Category::factory()->create([
            'name' => "利用上の悩み",
            'code' => "03",
            'secondary_id' => 6,
            'order' => 4
        ]);
        Category::factory()->create([
            'name' => "家族構成（年齢、続柄、趣味、習い事）",
            'code' => "01",
            'secondary_id' => 7,
            'order' => 4
        ]);
        Category::factory()->create([
            'name' => "デジタルガジェット・ネット回線",
            'code' => "02",
            'secondary_id' => 7,
            'order' => 4
        ]);
        Category::factory()->create([
            'name' => "実現するコト",
            'code' => "03",
            'secondary_id' => 7,
            'order' => 4
        ]);
        Category::factory()->create([
            'name' => "PlanningSheetの共有→お困り事の把握⇨優先順位に合わせた提案",
            'code' => "01",
            'secondary_id' => 8,
            'order' => 4
        ]);
        Category::factory()->create([
            'name' => "お客様の利用状況の把握⇨PlannningSheetを描く⇨お客様の将来の生活を想像⇨活用シーンを例として用いながら提案する",
            'code' => "01",
            'secondary_id' => 9,
            'order' => 4
        ]);
        Category::factory()->create([
            'name' => "家族構成・利用状況・Aseet・お客様情報・活動内容を記録し、次回以降の活動に役立てる。",
            'code' => "01",
            'secondary_id' => 10,
            'order' => 4
        ]);
        Category::factory()->create([
            'name' => "PlanningSheetと活動記録を基に次回の提案をする",
            'code' => "01",
            'secondary_id' => 11,
            'order' => 4
        ]);
        Category::factory()->create([
            'name' => "アポイントメントをとる",
            'code' => "01",
            'secondary_id' => 12,
            'order' => 4
        ]);
        Category::factory()->create([
            'name' => "コミュニティ活動",
            'code' => "02",
            'secondary_id' => 12,
            'order' => 4
        ]);
        Category::factory()->create([
            'name' => "イベント活動",
            'code' => "03",
            'secondary_id' => 12,
            'order' => 4
        ]);
    }
}
