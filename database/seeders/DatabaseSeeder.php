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

        Admin::factory()->create([
            'name' => '澤田(管理者)',
            'email' => 'sawada@primeforce.co.jp',
            'password' => Hash::make('password'),
        ]);
        Admin::factory()->create([
            'name' => '藤木　健(管理者)',
            'email' => 'fujiki@primeforce.co.jp',
            'password' => Hash::make('Pass_001'),
        ]);
        Admin::factory()->create([
            'name' => '中村 美月(管理者)',
            'email' => 'nakamura@primeforce.co.jp',
            'password' => Hash::make('Pass_002'),
        ]);
        Admin::factory()->create([
            'name' => '津嶋 一樹(管理者)',
            'email' => 'tsushimak@pcdepot.co.jp',
            'password' => Hash::make('Pass_003'),
        ]);
        Admin::factory()->create([
            'name' => '田中 武彦(管理者)',
            'email' => 'tanakatak@pcdepot.co.jp',
            'password' => Hash::make('Pass_004'),
        ]);
        Admin::factory()->create([
            'name' => '中村 友音(管理者)',
            'email' => 'nakamurato@pcdepot.co.jp',
            'password' => Hash::make('Pass_005'),
        ]);
        User::factory()->create([
            'name' => '澤田(問題登録者)',
            'email' => 'tetsu707@outlook.com',
            'password' => Hash::make('password'),
        ]);
        User::factory()->create([
            'name' => '藤木 健',
            'email' => 'passionmissionary@gmail.com',
            'password' => Hash::make('Pass_001'),
        ]);
        User::factory()->create([
            'name' => '中村 美月',
            'email' => 'info@primeforce.co.jp',
            'password' => Hash::make('Pass_002'),
        ]);
        User::factory()->create([
            'name' => '津嶋 一樹',
            'email' => 'campjourney24@gmail.com',
            'password' => Hash::make('Pass_003'),
        ]);
        User::factory()->create([
            'name' => '田中 武彦',
            'email' => 'takehiko.tanaka@gmail.com',
            'password' => Hash::make('Pass_004'),
        ]);
        User::factory()->create([
            'name' => '中村 友音',
            'email' => 'shigotoyou.tomone@gmail.com',
            'password' => Hash::make('Pass_005'),
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
            'order' => 2
        ]);
        CategorySecondary::factory()->create([
            'name' => "家庭のデジタル環境",
            'code' => "03",
            'primary_id' => 1,
            'order' => 3
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
            'order' => 2
        ]);
        CategorySecondary::factory()->create([
            'name' => "現状",
            'code' => "03",
            'primary_id' => 2,
            'order' => 3
        ]);
        CategorySecondary::factory()->create([
            'name' => "提案したい未来",
            'code' => "04",
            'primary_id' => 2,
            'order' => 4
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
            'order' => 2
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
            'order' => 2
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
            'order' => 2
        ]);
        // 13 基本的マナー
        CategorySecondary::factory()->create([
            'name' => "基本的マナー",
            'code' => "01",
            'primary_id' => 6,
            'order' => 1
        ]);
        CategorySecondary::factory()->create([
            'name' => "顧客との関係構築",
            'code' => "02",
            'primary_id' => 6,
            'order' => 2
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
            'order' => 2
        ]);
        CategorySecondary::factory()->create([
            'name' => "法令遵守",
            'code' => "03",
            'primary_id' => 7,
            'order' => 3
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
            'order' => 2
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
            'order' => 2
        ]);
        CategorySecondary::factory()->create([
            'name' => "デジタルガジェットとはなにか",
            'code' => "01",
            'primary_id' => 10,
            'order' => 1
        ]);
        CategorySecondary::factory()->create([
            'name' => "キャリア変更",
            'code' => "01",
            'primary_id' => 11,
            'order' => 1
        ]);
        CategorySecondary::factory()->create([
            'name' => "データ移行",
            'code' => "02",
            'primary_id' => 11,
            'order' => 2
        ]);
        CategorySecondary::factory()->create([
            'name' => "セキュリティ設定",
            'code' => "03",
            'primary_id' => 11,
            'order' => 3
        ]);
        CategorySecondary::factory()->create([
            'name' => "パソコン、関連機器の不調",
            'code' => "04",
            'primary_id' => 11,
            'order' => 4
        ]);
        CategorySecondary::factory()->create([
            'name' => "料理とデジタル",
            'code' => "05",
            'primary_id' => 11,
            'order' => 5
        ]);
        CategorySecondary::factory()->create([
            'name' => "ショッピングとデジタル",
            'code' => "06",
            'primary_id' => 11,
            'order' => 6
        ]);
        CategorySecondary::factory()->create([
            'name' => "コミュニケーションとデジタル",
            'code' => "07",
            'primary_id' => 11,
            'order' => 7
        ]);
        CategorySecondary::factory()->create([
            'name' => "写真とデジタル",
            'code' => "08",
            'primary_id' => 11,
            'order' => 8
        ]);
        CategorySecondary::factory()->create([
            'name' => "旅行とデジタル",
            'code' => "09",
            'primary_id' => 11,
            'order' => 9
        ]);

        CategorySecondary::factory()->create([
            'name' => "ペットとデジタル",
            'code' => "10",
            'primary_id' => 11,
            'order' => 10
        ]);
        CategorySecondary::factory()->create([
            'name' => "仕事とデジタル",
            'code' => "11",
            'primary_id' => 11,
            'order' => 11
        ]);
        CategorySecondary::factory()->create([
            'name' => "交通機関とデジタル",
            'code' => "12",
            'primary_id' => 11,
            'order' => 12
        ]);
        CategorySecondary::factory()->create([
            'name' => "エンターテイメントとデジタル",
            'code' => "13",
            'primary_id' => 11,
            'order' => 13
        ]);
        CategorySecondary::factory()->create([
            'name' => "ホームエンターテイメントとデジタル",
            'code' => "14",
            'primary_id' => 11,
            'order' => 14
        ]);
        CategorySecondary::factory()->create([
            'name' => "ヘルスケアとデジタル",
            'code' => "15",
            'primary_id' => 11,
            'order' => 15
        ]);
        CategorySecondary::factory()->create([
            'name' => "運動とデジタル",
            'code' => "16",
            'primary_id' => 11,
            'order' => 16
        ]);
        CategorySecondary::factory()->create([
            'name' => "学びとデジタル",
            'code' => "17",
            'primary_id' => 11,
            'order' => 17
        ]);
        CategorySecondary::factory()->create([
            'name' => "ゲームとデジタル",
            'code' => "18",
            'primary_id' => 11,
            'order' => 18
        ]);
        CategorySecondary::factory()->create([
            'name' => "ホームとデジタル",
            'code' => "19",
            'primary_id' => 11,
            'order' => 19
        ]);
        CategorySecondary::factory()->create([
            'name' => "カーライフとデジタル",
            'code' => "20",
            'primary_id' => 11,
            'order' => 20
        ]);
        CategorySecondary::factory()->create([
            'name' => "地域サービスとデジタル",
            'code' => "21",
            'primary_id' => 11,
            'order' => 21
        ]);
        CategorySecondary::factory()->create([
            'name' => "コミュニティとデジタル",
            'code' => "22",
            'primary_id' => 11,
            'order' => 22
        ]);
        CategorySecondary::factory()->create([
            'name' => "デジタル資産と学び",
            'code' => "01",
            'primary_id' => 12,
            'order' => 1
        ]);
        CategorySecondary::factory()->create([
            'name' => "世代の特徴",
            'code' => "02",
            'primary_id' => 12,
            'order' => 2
        ]);
        CategorySecondary::factory()->create([
            'name' => "家族の対応",
            'code' => "03",
            'primary_id' => 12,
            'order' => 3
        ]);
        CategorySecondary::factory()->create([
            'name' => "デジタルシティズンシップ",
            'code' => "01",
            'primary_id' => 13,
            'order' => 1
        ]);
        CategorySecondary::factory()->create([
            'name' => "メディアバランスとウェルビーイング",
            'code' => "02",
            'primary_id' => 13,
            'order' => 2
        ]);
        CategorySecondary::factory()->create([
            'name' => "対人関係とコミュニケーション",
            'code' => "03",
            'primary_id' => 13,
            'order' => 3
        ]);
        CategorySecondary::factory()->create([
            'name' => "ニュースメディアリテラシー",
            'code' => "04",
            'primary_id' => 13,
            'order' => 4
        ]);
        CategorySecondary::factory()->create([
            'name' => "デジタル足跡とアイデンティティ",
            'code' => "05",
            'primary_id' => 13,
            'order' => 5
        ]);
        CategorySecondary::factory()->create([
            'name' => "セキュリティとプライバシー",
            'code' => "06",
            'primary_id' => 13,
            'order' => 6
        ]);
        CategorySecondary::factory()->create([
            'name' => "ネットいじめ、揉め事、ヘイトスピーチ",
            'code' => "07",
            'primary_id' => 13,
            'order' => 7
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
            'order' => 1
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
            'order' => 3
        ]);
        Category::factory()->create([
            'name' => "就学状況",
            'code' => "04",
            'secondary_id' => 2,
            'order' => 4
        ]);
        Category::factory()->create([
            'name' => "就労状況（会社・仕事内容・休日）",
            'code' => "05",
            'secondary_id' => 2,
            'order' => 5
        ]);
        Category::factory()->create([
            'name' => "所属しているコミュニティ",
            'code' => "06",
            'secondary_id' => 2,
            'order' => 6
        ]);
        Category::factory()->create([
            'name' => "趣味",
            'code' => "07",
            'secondary_id' => 2,
            'order' => 7
        ]);
        Category::factory()->create([
            'name' => "ペット",
            'code' => "08",
            'secondary_id' => 2,
            'order' => 8
        ]);
        Category::factory()->create([
            'name' => "スマートフォン利用状況",
            'code' => "01",
            'secondary_id' => 3,
            'order' => 1
        ]);
        Category::factory()->create([
            'name' => "キャリアの契約状況",
            'code' => "02",
            'secondary_id' => 3,
            'order' => 2
        ]);

        Category::factory()->create([
            'name' => "パソコンの利用状況",
            'code' => "03",
            'secondary_id' => 3,
            'order' => 3
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
            'order' => 5
        ]);
        Category::factory()->create([
            'name' => "記入すべき基本情報（DLPの名前・日付・曜日）",
            'code' => "01",
            'secondary_id' => 4,
            'order' => 1
        ]);
        Category::factory()->create([
            'name' => "書き方の基本（イラスト化・大きな紙（A3）普通紙・太めのボールペン・フェルトペン・蛍光ペン（やさしい色））",
            'code' => "02",
            'secondary_id' => 4,
            'order' => 2
        ]);
        Category::factory()->create([
            'name' => "時系列（左上→右下）",
            'code' => "03",
            'secondary_id' => 4,
            'order' => 3
        ]);
        Category::factory()->create([
            'name' => "Assetとは、お客様の情報資産を指す（デジタルガジェット、過去利用していたデジタルガジェット、契約しているキャリア、情報リテラシー全般等）Asset表とは、Assetをお客様にわかりやすく時系列にイラスト化した表である。",
            'code' => "01",
            'secondary_id' => 5,
            'order' => 1
        ]);
        Category::factory()->create([
            'name' => "家族構成",
            'code' => "01",
            'secondary_id' => 6,
            'order' => 1
        ]);
        Category::factory()->create([
            'name' => "利用しているデジタルガジェット・ネット回線",
            'code' => "02",
            'secondary_id' => 6,
            'order' => 2
        ]);
        Category::factory()->create([
            'name' => "利用上の悩み",
            'code' => "03",
            'secondary_id' => 6,
            'order' => 3
        ]);
        Category::factory()->create([
            'name' => "家族構成（年齢、続柄、趣味、習い事）",
            'code' => "01",
            'secondary_id' => 7,
            'order' => 1
        ]);
        Category::factory()->create([
            'name' => "デジタルガジェット・ネット回線",
            'code' => "02",
            'secondary_id' => 7,
            'order' => 2
        ]);
        Category::factory()->create([
            'name' => "実現するコト",
            'code' => "03",
            'secondary_id' => 7,
            'order' => 3
        ]);
        Category::factory()->create([
            'name' => "PlanningSheetの共有→お困り事の把握⇨優先順位に合わせた提案",
            'code' => "01",
            'secondary_id' => 8,
            'order' => 1
        ]);
        Category::factory()->create([
            'name' => "お客様の利用状況の把握⇨PlannningSheetを描く⇨お客様の将来の生活を想像⇨活用シーンを例として用いながら提案する",
            'code' => "01",
            'secondary_id' => 9,
            'order' => 1
        ]);
        Category::factory()->create([
            'name' => "家族構成・利用状況・Aseet・お客様情報・活動内容を記録し、次回以降の活動に役立てる。",
            'code' => "01",
            'secondary_id' => 10,
            'order' => 1
        ]);
        Category::factory()->create([
            'name' => "PlanningSheetと活動記録を基に次回の提案をする",
            'code' => "01",
            'secondary_id' => 11,
            'order' => 1
        ]);
        Category::factory()->create([
            'name' => "アポイントメントをとる",
            'code' => "01",
            'secondary_id' => 12,
            'order' => 1
        ]);
        Category::factory()->create([
            'name' => "コミュニティ活動",
            'code' => "02",
            'secondary_id' => 12,
            'order' => 2
        ]);
        Category::factory()->create([
            'name' => "イベント活動",
            'code' => "03",
            'secondary_id' => 12,
            'order' => 3
        ]);
        Category::factory()->create([
            'name' => "挨拶",
            'code' => "01",
            'secondary_id' => 14,
            'order' => 1
        ]);
        Category::factory()->create([
            'name' => "身だしなみ",
            'code' => "02",
            'secondary_id' => 14,
            'order' => 2
        ]);
        Category::factory()->create([
            'name' => "表情",
            'code' => "03",
            'secondary_id' => 14,
            'order' => 3
        ]);
        Category::factory()->create([
            'name' => "態度",
            'code' => "04",
            'secondary_id' => 14,
            'order' => 4
        ]);
        Category::factory()->create([
            'name' => "行動",
            'code' => "05",
            'secondary_id' => 14,
            'order' => 5
        ]);
        Category::factory()->create([
            'name' => "言葉づかい",
            'code' => "06",
            'secondary_id' => 14,
            'order' => 6
        ]);
        Category::factory()->create([
            'name' => "エンゲージメント（ニーズに応え、信頼関係を構築する）",
            'code' => "01",
            'secondary_id' => 15,
            'order' => 1
        ]);
        Category::factory()->create([
            'name' => "アクティブリスニング（話しをよく聞く）",
            'code' => "02",
            'secondary_id' => 15,
            'order' => 2
        ]);
        Category::factory()->create([
            'name' => "洞察的姿勢（サービス内容から＋aの部分まで寄り添う。）",
            'code' => "03",
            'secondary_id' => 15,
            'order' => 3
        ]);
        Category::factory()->create([
            'name' => "雰囲気作りとリラックスしたコミュニケーション",
            'code' => "04",
            'secondary_id' => 15,
            'order' => 4
        ]);
        Category::factory()->create([
            'name' => "エンパシー（共感的かつ効果的な反応）",
            'code' => "05",
            'secondary_id' => 15,
            'order' => 5
        ]);
        Category::factory()->create([
            'name' => "継続的なサポート姿勢",
            'code' => "06",
            'secondary_id' => 15,
            'order' => 6
        ]);
        Category::factory()->create([
            'name' => "お客様を最優先とする",
            'code' => "01",
            'secondary_id' => 16,
            'order' => 1
        ]);
        Category::factory()->create([
            'name' => "お客様のプライバシーの遵守",
            'code' => "02",
            'secondary_id' => 16,
            'order' => 2
        ]);
        Category::factory()->create([
            'name' => "誠実な対応",
            'code' => "03",
            'secondary_id' => 16,
            'order' => 3
        ]);
        Category::factory()->create([
            'name' => "適切な提案",
            'code' => "04",
            'secondary_id' => 16,
            'order' => 4
        ]);
        Category::factory()->create([
            'name' => "重要事項の説明",
            'code' => "05",
            'secondary_id' => 16,
            'order' => 5
        ]);
        Category::factory()->create([
            'name' => "法令遵守",
            'code' => "06",
            'secondary_id' => 16,
            'order' => 6
        ]);
        Category::factory()->create([
            'name' => "職業倫理と専門性の向上",
            'code' => "07",
            'secondary_id' => 16,
            'order' => 7
        ]);
        Category::factory()->create([
            'name' => "セキュリティ対策の徹底",
            'code' => "01",
            'secondary_id' => 17,
            'order' => 1
        ]);
        Category::factory()->create([
            'name' => "緊急時の対応策の整備",
            'code' => "02",
            'secondary_id' => 17,
            'order' => 2
        ]);
        Category::factory()->create([
            'name' => "トレーニング",
            'code' => "03",
            'secondary_id' => 17,
            'order' => 3
        ]);
        Category::factory()->create([
            'name' => "事前のリサーチ",
            'code' => "04",
            'secondary_id' => 17,
            'order' => 4
        ]);
        Category::factory()->create([
            'name' => "伴行者の同行",
            'code' => "05",
            'secondary_id' => 17,
            'order' => 5
        ]);
        Category::factory()->create([
            'name' => "防犯グッズの携帯",
            'code' => "06",
            'secondary_id' => 17,
            'order' => 6
        ]);
        Category::factory()->create([
            'name' => "個人情報の保護",
            'code' => "01",
            'secondary_id' => 18,
            'order' => 1
        ]);
        Category::factory()->create([
            'name' => "情報セキュリティの確保",
            'code' => "02",
            'secondary_id' => 18,
            'order' => 2
        ]);
        Category::factory()->create([
            'name' => "消費者保護法や特定商取引法の遵守",
            'code' => "03",
            'secondary_id' => 18,
            'order' => 3
        ]);
        Category::factory()->create([
            'name' => "その他の法令",
            'code' => "04",
            'secondary_id' => 18,
            'order' => 4
        ]);
        Category::factory()->create([
            'name' => "スマートフォンとは",
            'code' => "01",
            'secondary_id' => 19,
            'order' => 1
        ]);
        Category::factory()->create([
            'name' => "スマートフォンのハードウェア構造",
            'code' => "02",
            'secondary_id' => 19,
            'order' => 2
        ]);
        Category::factory()->create([
            'name' => "スマートフォンとキャリア",
            'code' => "01",
            'secondary_id' => 20,
            'order' => 1
        ]);
        Category::factory()->create([
            'name' => "キャリアとの契約",
            'code' => "02",
            'secondary_id' => 20,
            'order' => 2
        ]);
        Category::factory()->create([
            'name' => "キャリアとの契約者名義",
            'code' => "03",
            'secondary_id' => 20,
            'order' => 3
        ]);
        Category::factory()->create([
            'name' => "複数のキャリアの活用",
            'code' => "04",
            'secondary_id' => 20,
            'order' => 4
        ]);
        Category::factory()->create([
            'name' => "認証・パスワードの管理",
            'code' => "05",
            'secondary_id' => 20,
            'order' => 5
        ]);
        Category::factory()->create([
            'name' => "基本操作",
            'code' => "06",
            'secondary_id' => 20,
            'order' => 6
        ]);
        Category::factory()->create([
            'name' => "テザリング",
            'code' => "07",
            'secondary_id' => 20,
            'order' => 7
        ]);
        Category::factory()->create([
            'name' => "アプリの課金の仕組み",
            'code' => "08",
            'secondary_id' => 20,
            'order' => 8
        ]);
        Category::factory()->create([
            'name' => "スマートフォンの更新",
            'code' => "09",
            'secondary_id' => 20,
            'order' => 9
        ]);
        Category::factory()->create([
            'name' => "安全な利用",
            'code' => "10",
            'secondary_id' => 20,
            'order' => 10
        ]);
        Category::factory()->create([
            'name' => "クラウドサービス",
            'code' => "11",
            'secondary_id' => 20,
            'order' => 11
        ]);
        Category::factory()->create([
            'name' => "利用モード",
            'code' => "12",
            'secondary_id' => 20,
            'order' => 12
        ]);
        Category::factory()->create([
            'name' => "データの管理",
            'code' => "13",
            'secondary_id' => 20,
            'order' => 13
        ]);
        Category::factory()->create([
            'name' => "パーソナルコンピューターとは",
            'code' => "01",
            'secondary_id' => 21,
            'order' => 1
        ]);
        Category::factory()->create([
            'name' => "パーソナルコンピューターのハードウェア構造",
            'code' => "02",
            'secondary_id' => 21,
            'order' => 2
        ]);
        Category::factory()->create([
            'name' => "周辺機器のハードウェア構造",
            'code' => "03",
            'secondary_id' => 21,
            'order' => 3
        ]);
        Category::factory()->create([
            'name' => "PCのOS",
            'code' => "01",
            'secondary_id' => 22,
            'order' => 1
        ]);
        Category::factory()->create([
            'name' => "PCの基本設定",
            'code' => "02",
            'secondary_id' => 22,
            'order' => 2
        ]);
        Category::factory()->create([
            'name' => "ネットワーク接続",
            'code' => "03",
            'secondary_id' => 22,
            'order' => 3
        ]);
        Category::factory()->create([
            'name' => "PCの基本操作",
            'code' => "04",
            'secondary_id' => 22,
            'order' => 4
        ]);
        Category::factory()->create([
            'name' => "ソフトウェアの購入・設定",
            'code' => "05",
            'secondary_id' => 22,
            'order' => 5
        ]);
        Category::factory()->create([
            'name' => "OSとソフトウェアの更新",
            'code' => "06",
            'secondary_id' => 22,
            'order' => 6
        ]);
        Category::factory()->create([
            'name' => "安全な利用",
            'code' => "07",
            'secondary_id' => 22,
            'order' => 7
        ]);
        Category::factory()->create([
            'name' => "クラウドサービス",
            'code' => "08",
            'secondary_id' => 22,
            'order' => 8
        ]);
        Category::factory()->create([
            'name' => "データの管理",
            'code' => "09",
            'secondary_id' => 22,
            'order' => 9
        ]);
        Category::factory()->create([
            'name' => "デジタルガジェットとは",
            'code' => "01",
            'secondary_id' => 23,
            'order' => 1
        ]);
        Category::factory()->create([
            'name' => "デジタルガジェット（主要なもの）",
            'code' => "02",
            'secondary_id' => 23,
            'order' => 2
        ]);
        Category::factory()->create([
            'name' => "主要キャリアの特徴",
            'code' => "01",
            'secondary_id' => 24,
            'order' => 1
        ]);
        Category::factory()->create([
            'name' => "格安SIMの特徴",
            'code' => "02",
            'secondary_id' => 24,
            'order' => 2
        ]);
        Category::factory()->create([
            'name' => "変更の手順",
            'code' => "03",
            'secondary_id' => 24,
            'order' => 3
        ]);
        Category::factory()->create([
            'name' => "キャリア変更",
            'code' => "04",
            'secondary_id' => 24,
            'order' => 4
        ]);
        Category::factory()->create([
            'name' => "データ移行必要なケース",
            'code' => "01",
            'secondary_id' => 25,
            'order' => 1
        ]);
        Category::factory()->create([
            'name' => "データ移行の手順",
            'code' => "02",
            'secondary_id' => 25,
            'order' => 2
        ]);
        Category::factory()->create([
            'name' => "データ移行時の注意点",
            'code' => "03",
            'secondary_id' => 25,
            'order' => 3
        ]);
        Category::factory()->create([
            'name' => "セキュリティトラブルの種類",
            'code' => "01",
            'secondary_id' => 26,
            'order' => 1
        ]);
        Category::factory()->create([
            'name' => "セキュリティトラブル解決手順",
            'code' => "02",
            'secondary_id' => 26,
            'order' => 2
        ]);
        Category::factory()->create([
            'name' => "セキュリティ設定の注意点",
            'code' => "03",
            'secondary_id' => 26,
            'order' => 3
        ]);
        Category::factory()->create([
            'name' => "パソコン・関連機器ハードトラブルの種類",
            'code' => "01",
            'secondary_id' => 27,
            'order' => 1
        ]);
        Category::factory()->create([
            'name' => "トラブルの解決手順",
            'code' => "02",
            'secondary_id' => 27,
            'order' => 2
        ]);
        Category::factory()->create([
            'name' => "トラブル対応の注意点",
            'code' => "03",
            'secondary_id' => 27,
            'order' => 3
        ]);
        Category::factory()->create([
            'name' => "料理をデジタルガジェットとともに行う",
            'code' => "01",
            'secondary_id' => 28,
            'order' => 1
        ]);
        Category::factory()->create([
            'name' => "どんな機器を活用するか",
            'code' => "02",
            'secondary_id' => 28,
            'order' => 2
        ]);
        Category::factory()->create([
            'name' => "利用上の注意",
            'code' => "03",
            'secondary_id' => 28,
            'order' => 3
        ]);
        Category::factory()->create([
            'name' => "ショッピングをデジタルガジェットとともに行う",
            'code' => "01",
            'secondary_id' => 29,
            'order' => 1
        ]);
        Category::factory()->create([
            'name' => "どんな機器を活用するか",
            'code' => "02",
            'secondary_id' => 29,
            'order' => 2
        ]);
        Category::factory()->create([
            'name' => "利用上の注意",
            'code' => "03",
            'secondary_id' => 29,
            'order' => 3
        ]);

        Category::factory()->create([
            'name' => "コミュニケーションをデジタルガジェットとともに行う",
            'code' => "01",
            'secondary_id' => 30,
            'order' => 1
        ]);
        Category::factory()->create([
            'name' => "どんな機器を活用するか",
            'code' => "02",
            'secondary_id' => 30,
            'order' => 2
        ]);
        Category::factory()->create([
            'name' => "利用上の注意",
            'code' => "03",
            'secondary_id' => 30,
            'order' => 3
        ]);
        Category::factory()->create([
            'name' => "写真をデジタルガジェットと共に行う",
            'code' => "01",
            'secondary_id' => 31,
            'order' => 1
        ]);
        Category::factory()->create([
            'name' => "どんな機器を活用するのか",
            'code' => "02",
            'secondary_id' => 31,
            'order' => 2
        ]);
        Category::factory()->create([
            'name' => "利用上の注意点",
            'code' => "03",
            'secondary_id' => 31,
            'order' => 3
        ]);
        Category::factory()->create([
            'name' => "旅行やアウトドアエンターテイメントをデジタルガジェットと共に行う",
            'code' => "01",
            'secondary_id' => 32,
            'order' => 1
        ]);
        Category::factory()->create([
            'name' => "どんな機器を利用するか",
            'code' => "02",
            'secondary_id' => 32,
            'order' => 2
        ]);
        Category::factory()->create([
            'name' => "利用上の注意点",
            'code' => "03",
            'secondary_id' => 32,
            'order' => 3
        ]);
        Category::factory()->create([
            'name' => "ペットとデジタルガジェットの活用",
            'code' => "01",
            'secondary_id' => 33,
            'order' => 1
        ]);
        Category::factory()->create([
            'name' => "どんな機器を利用するか",
            'code' => "02",
            'secondary_id' => 33,
            'order' => 2
        ]);
        Category::factory()->create([
            'name' => "利用上の注意点",
            'code' => "03",
            'secondary_id' => 33,
            'order' => 3
        ]);
        Category::factory()->create([
            'name' => "仕事の効率化とデジタルガジェットの活用",
            'code' => "01",
            'secondary_id' => 34,
            'order' => 1
        ]);
        Category::factory()->create([
            'name' => "どんな機器を利用するか",
            'code' => "02",
            'secondary_id' => 34,
            'order' => 2
        ]);
        Category::factory()->create([
            'name' => "利用上の注意点",
            'code' => "03",
            'secondary_id' => 34,
            'order' => 3
        ]);
        Category::factory()->create([
            'name' => "交通機関とデジタルガジェットの活用",
            'code' => "01",
            'secondary_id' => 35,
            'order' => 1
        ]);
        Category::factory()->create([
            'name' => "どんな機器を利用するか",
            'code' => "02",
            'secondary_id' => 35,
            'order' => 2
        ]);
        Category::factory()->create([
            'name' => "利用上の注意点",
            'code' => "03",
            'secondary_id' => 35,
            'order' => 3
        ]);
        Category::factory()->create([
            'name' => "エンターテイメントとデジタルガジェットの活用",
            'code' => "01",
            'secondary_id' => 36,
            'order' => 1
        ]);
        Category::factory()->create([
            'name' => "どんな機器を利用するか",
            'code' => "02",
            'secondary_id' => 36,
            'order' => 2
        ]);
        Category::factory()->create([
            'name' => "利用上の注意点",
            'code' => "03",
            'secondary_id' => 36,
            'order' => 3
        ]);
        Category::factory()->create([
            'name' => "ホームエンターテイメントとデジタルガジェットの活用",
            'code' => "01",
            'secondary_id' => 37,
            'order' => 1
        ]);
        Category::factory()->create([
            'name' => "どんな機器を利用するか",
            'code' => "02",
            'secondary_id' => 37,
            'order' => 2
        ]);
        Category::factory()->create([
            'name' => "利用上の注意",
            'code' => "03",
            'secondary_id' => 37,
            'order' => 3
        ]);
        Category::factory()->create([
            'name' => "ヘルスケアとデジタルガジェットの活用",
            'code' => "01",
            'secondary_id' => 38,
            'order' => 1
        ]);
        Category::factory()->create([
            'name' => "どんな機器を利用するか",
            'code' => "02",
            'secondary_id' => 38,
            'order' => 2
        ]);
        Category::factory()->create([
            'name' => "利用上の注意点",
            'code' => "03",
            'secondary_id' => 38,
            'order' => 3
        ]);
        Category::factory()->create([
            'name' => "運動とデジタルガジェットの活用",
            'code' => "01",
            'secondary_id' => 39,
            'order' => 1
        ]);
        Category::factory()->create([
            'name' => "どんな機器を利用するか",
            'code' => "02",
            'secondary_id' => 39,
            'order' => 2
        ]);
        Category::factory()->create([
            'name' => "利用上の注意点",
            'code' => "03",
            'secondary_id' => 39,
            'order' => 3
        ]);
        Category::factory()->create([
            'name' => "学習とデジタルガジェットの活用",
            'code' => "01",
            'secondary_id' => 40,
            'order' => 1
        ]);
        Category::factory()->create([
            'name' => "どんな機器・サービスを利用するか",
            'code' => "02",
            'secondary_id' => 40,
            'order' => 2
        ]);
        Category::factory()->create([
            'name' => "利用上の注意点",
            'code' => "03",
            'secondary_id' => 40,
            'order' => 3
        ]);
        Category::factory()->create([
            'name' => "ゲーム環境に応じたデジタルガジェットの活用",
            'code' => "01",
            'secondary_id' => 41,
            'order' => 1
        ]);
        Category::factory()->create([
            'name' => "どんな機器・サービスを利用するか",
            'code' => "02",
            'secondary_id' => 41,
            'order' => 2
        ]);
        Category::factory()->create([
            'name' => "利用上の注意点",
            'code' => "03",
            'secondary_id' => 41,
            'order' => 3
        ]);
        Category::factory()->create([
            'name' => "ホームとデジタルガジェットの活用",
            'code' => "01",
            'secondary_id' => 42,
            'order' => 1
        ]);
        Category::factory()->create([
            'name' => "どんな機器を利用するか",
            'code' => "02",
            'secondary_id' => 42,
            'order' => 2
        ]);
        Category::factory()->create([
            'name' => "利用上の注意点",
            'code' => "03",
            'secondary_id' => 42,
            'order' => 3
        ]);
        Category::factory()->create([
            'name' => "カーライフとデジタルガジェットの活用",
            'code' => "01",
            'secondary_id' => 43,
            'order' => 1
        ]);
        Category::factory()->create([
            'name' => "どんな機器を利用するか",
            'code' => "02",
            'secondary_id' => 43,
            'order' => 2
        ]);
        Category::factory()->create([
            'name' => "利用上の注意点",
            'code' => "03",
            'secondary_id' => 43,
            'order' => 3
        ]);
        Category::factory()->create([
            'name' => "地域サービスとデジタルガジェットの活用",
            'code' => "01",
            'secondary_id' => 44,
            'order' => 1
        ]);
        Category::factory()->create([
            'name' => "どんな機器を利用するか",
            'code' => "02",
            'secondary_id' => 44,
            'order' => 2
        ]);
        Category::factory()->create([
            'name' => "利用上の注意点",
            'code' => "03",
            'secondary_id' => 44,
            'order' => 3
        ]);
        Category::factory()->create([
            'name' => "コミュニティとデジタルガジェットの活用",
            'code' => "01",
            'secondary_id' => 45,
            'order' => 1
        ]);
        Category::factory()->create([
            'name' => "どんな機器を利用するか",
            'code' => "02",
            'secondary_id' => 45,
            'order' => 2
        ]);
        Category::factory()->create([
            'name' => "利用上の注意点",
            'code' => "03",
            'secondary_id' => 45,
            'order' => 3
        ]);
        Category::factory()->create([
            'name' => "デジタル資産と学び",
            'code' => "01",
            'secondary_id' => 46,
            'order' => 1
        ]);
        Category::factory()->create([
            'name' => "世代ごとに変化するデジタルデバイスやサービスの関わり",
            'code' => "01",
            'secondary_id' => 47,
            'order' => 1
        ]);
        Category::factory()->create([
            'name' => "様々な世代が集う、家族間のデジタルとの付き合い方",
            'code' => "01",
            'secondary_id' => 48,
            'order' => 1
        ]);
        Category::factory()->create([
            'name' => "デジタルシティズンシップとは",
            'code' => "01",
            'secondary_id' => 49,
            'order' => 1
        ]);
        Category::factory()->create([
            'name' => "メディアバランス",
            'code' => "01",
            'secondary_id' => 50,
            'order' => 1
        ]);
        Category::factory()->create([
            'name' => "ウェルビーイング",
            'code' => "02",
            'secondary_id' => 50,
            'order' => 2
        ]);
        Category::factory()->create([
            'name' => "オンライン・コミュニケーションのタイプ",
            'code' => "01",
            'secondary_id' => 51,
            'order' => 1
        ]);
        Category::factory()->create([
            'name' => "世代によるオンラインコミュニケーション",
            'code' => "02",
            'secondary_id' => 51,
            'order' => 2
        ]);
        Category::factory()->create([
            'name' => "ニュースメディアリテラシー",
            'code' => "01",
            'secondary_id' => 52,
            'order' => 1
        ]);
        Category::factory()->create([
            'name' => "デジタル足跡とアイデンティティ",
            'code' => "01",
            'secondary_id' => 53,
            'order' => 1
        ]);
        Category::factory()->create([
            'name' => "セキュリティとプライバシー",
            'code' => "01",
            'secondary_id' => 54,
            'order' => 1
        ]);
        Category::factory()->create([
            'name' => "ネットいじめ",
            'code' => "01",
            'secondary_id' => 55,
            'order' => 1
        ]);
        Category::factory()->create([
            'name' => "揉め事",
            'code' => "02",
            'secondary_id' => 55,
            'order' => 2
        ]);
        Category::factory()->create([
            'name' => "ヘイトスピーチ",
            'code' => "03",
            'secondary_id' => 55,
            'order' => 3
        ]);
    }
}


