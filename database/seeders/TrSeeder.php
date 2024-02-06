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
        Admin::factory()->create([
            'name' => Crypt::encryptString('ADMIN_横尾'),
            'email' => 'tci_admin1@primeforce.co.jp',
            'code' => 'admin_yokoo',
            'password' => Hash::make('Admin_001'),
        ]);
        Admin::factory()->create([
            'name' => Crypt::encryptString('ADMIN_栄福'),
            'email' => 'tci_admin2@primeforce.co.jp',
            'code' => 'admin_eihuku',
            'password' => Hash::make('Admin_002'),
        ]);
        Admin::factory()->create([
            'name' => Crypt::encryptString('ADMIN_野口'),
            'email' => 'tci_admin3@primeforce.co.jp',
            'code' => 'admin_noguchi',
            'password' => Hash::make('Admin_003'),
        ]);
        Admin::factory()->create([
            'name' => Crypt::encryptString('ADMIN_小川'),
            'email' => 'tci_admin4@primeforce.co.jp',
            'code' => 'admin_ogawa',
            'password' => Hash::make('Admin_004'),
        ]);
        Admin::factory()->create([
            'name' => Crypt::encryptString('ADMIN_玉置'),
            'email' => 'tci_admin5@primeforce.co.jp',
            'code' => 'admin_tamaki',
            'password' => Hash::make('Admin_005'),
        ]);
        Admin::factory()->create([
            'name' => Crypt::encryptString('TCI_鈴木'),
            'email' => 'tci_admin6@primeforce.co.jp',
            'code' => 'admin_suzuki',
            'password' => Hash::make('Admin_006'),
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
            'name' => Crypt::encryptString('TCI_横尾'),
            'email' => 'tci_user1@primeforce.co.jp',
            'code' => 'tci_yokoo',
            'icon_image_path' => '',
            'password' => Hash::make('Pass_001'),
        ]);
        User::factory()->create([
            'name' => Crypt::encryptString('TCI_栄福'),
            'email' => 'tci_user2@primeforce.co.jp',
            'code' => 'tci_eihuku',
            'icon_image_path' => '',
            'password' => Hash::make('Pass_002'),
        ]);
        User::factory()->create([
            'name' => Crypt::encryptString('TCI_野口'),
            'email' => 'tci_user3@primeforce.co.jp',
            'code' => 'tci_noguchi',
            'icon_image_path' => '',
            'password' => Hash::make('Pass_003'),
        ]);
        User::factory()->create([
            'name' => Crypt::encryptString('TCI_小川'),
            'email' => 'tci_user4@primeforce.co.jp',
            'code' => 'tci_ogawa',
            'icon_image_path' => '',
            'password' => Hash::make('Pass_004'),
        ]);
        User::factory()->create([
            'name' => Crypt::encryptString('TCI_玉置'),
            'email' => 'tci_user5@primeforce.co.jp',
            'code' => 'tci_tamaki',
            'icon_image_path' => '',
            'password' => Hash::make('Pass_005'),
        ]);
        User::factory()->create([
            'name' => Crypt::encryptString('TCI_鈴木'),
            'email' => 'tci_user6@primeforce.co.jp',
            'code' => 'tci_suzuki',
            'icon_image_path' => '',
            'password' => Hash::make('Pass_006'),
        ]);
        CategoryPrimary::factory()->create([
            'name' => "デジタルサービスデザイン",
            'code' => "DS",//1
            'order' => 1
        ]);
        CategoryPrimary::factory()->create([
            'name' => "業務設計",
            'code' => "SG",//2
            'order' => 1
        ]);
        CategoryPrimary::factory()->create([
            'name' => "チャットプラットフォーム",
            'code' => "CP",//3
            'order' => 1
        ]);
        CategoryPrimary::factory()->create([
            'name' => "プロジェクトマネジメント",
            'code' => "PM",//4
            'order' => 1
        ]);
        CategoryPrimary::factory()->create([
            'name' => "コンテンツビルディング",
            'code' => "CB",//5
            'order' => 1
        ]);
        CategoryPrimary::factory()->create([
            'name' => "UI/UX",
            'code' => "UX",//6
            'order' => 1
        ]);
        CategoryPrimary::factory()->create([
            'name' => "SEO施策",
            'code' => "SE",//7
            'order' => 1
        ]);
        CategoryPrimary::factory()->create([
            'name' => "人材マネジメント",
            'code' => "HR",//8
            'order' => 1
        ]);
        CategoryPrimary::factory()->create([
            'name' => "オペレーション",
            'code' => "OP",//9
            'order' => 1
        ]);
        CategoryPrimary::factory()->create([
            'name' => "KGI/KPI指標の管理",
            'code' => "KX",//10
            'order' => 1
        ]);
        CategoryPrimary::factory()->create([
            'name' => "顧客とのコミュニケーション",
            'code' => "CC",//11
            'order' => 1
        ]);
        CategoryPrimary::factory()->create([
            'name' => "ITスキル",
            'code' => "IT",//12
            'order' => 1
        ]);
        CategoryPrimary::factory()->create([
            'name' => "資質と行動",
            'code' => "PA",//13
            'order' => 1
        ]);
        CategorySecondary::factory()->create([
            'id' => '1',
            'name' => "デジタル時代のコミュニケーション",
            'code' => "01",
            'primary_id' => 1,
            'order' => 1
        ]);
        CategorySecondary::factory()->create([
            'id' => '2',
            'name' => "デジタルチャネル",
            'code' => "02",
            'primary_id' => 1,
            'order' => 2
        ]);
        CategorySecondary::factory()->create([
            'id' => '3',
            'name' => "Chat サービス概要",
            'code' => "03",
            'primary_id' => 1,
            'order' => 3
        ]);
        CategorySecondary::factory()->create([
            'id' => '4',
            'name' => "Support Contents サービス概要",
            'code' => "04",
            'primary_id' => 1,
            'order' => 4
        ]);
        CategorySecondary::factory()->create([
            'id' => '5',
            'name' => "SNSマーケティング",
            'code' => "05",
            'primary_id' => 1,
            'order' => 5
        ]);
        CategorySecondary::factory()->create([
            'id' => '6',
            'name' => "概要設計とROI",
            'code' => "01",
            'primary_id' => 2,
            'order' => 1
        ]);
        CategorySecondary::factory()->create([
            'id' => '7',
            'name' => "Chat 業務要件定義",
            'code' => "02",
            'primary_id' => 2,
            'order' => 2
        ]);
        CategorySecondary::factory()->create([
            'id' => '8',
            'name' => "Chat ツール選定",
            'code' => "03",
            'primary_id' => 2,
            'order' => 3
        ]);
        CategorySecondary::factory()->create([
            'id' => '9',
            'name' => "Chat キャパシティ計画",
            'code' => "04",
            'primary_id' => 2,
            'order' => 4
        ]);
        CategorySecondary::factory()->create([
            'id' => '10',
            'name' => "Support Contents 業務要件定義",
            'code' => "05",
            'primary_id' => 2,
            'order' => 5
        ]);
        CategorySecondary::factory()->create([
            'id' => '11',
            'name' => "SNS 業務要件定義",
            'code' => "06",
            'primary_id' => 2,
            'order' => 6
        ]);
        CategorySecondary::factory()->create([
            'id' => '12',
            'name' => "主要なプラットフォームの理解(性質、活用方法）",
            'code' => "01",
            'primary_id' => 3,
            'order' => 1
        ]);
        CategorySecondary::factory()->create([
            'id' => '13',
            'name' => "WEBチャット",
            'code' => "02",
            'primary_id' => 3,
            'order' => 2
        ]);
        CategorySecondary::factory()->create([
            'id' => '14',
            'name' => "LINEチャット(またはメッセージングツール）",
            'code' => "03",
            'primary_id' => 3,
            'order' => 3
        ]);
        CategorySecondary::factory()->create([
            'id' => '15',
            'name' => "Support Contents ツール群",
            'code' => "04",
            'primary_id' => 3,
            'order' => 4
        ]);
        CategorySecondary::factory()->create([
            'id' => '16',
            'name' => "SNS ツール群",
            'code' => "05",
            'primary_id' => 3,
            'order' => 5
        ]);
        CategorySecondary::factory()->create([
            'id' => '17',
            'name' => "アジャイルプロジェクトマネジメント",
            'code' => "01",
            'primary_id' => 4,
            'order' => 1
        ]);
        CategorySecondary::factory()->create([
            'id' => '18',
            'name' => "POC（Proof of Concept）",
            'code' => "02",
            'primary_id' => 4,
            'order' => 2
        ]);
        CategorySecondary::factory()->create([
            'id' => '19',
            'name' => "組織間コミュニケーション",
            'code' => "03",
            'primary_id' => 4,
            'order' => 3
        ]);
        CategorySecondary::factory()->create([
            'id' => '20',
            'name' => "Support Contents コンテンツの作成",
            'code' => "01",
            'primary_id' => 5,
            'order' => 1
        ]);
        CategorySecondary::factory()->create([
            'id' => '21',
            'name' => "Support Contents とUX",
            'code' => "01",
            'primary_id' => 6,
            'order' => 1
        ]);
        CategorySecondary::factory()->create([
            'id' => '22',
            'name' => "Support Contents とUXハニカム",
            'code' => "02",
            'primary_id' => 6,
            'order' => 2
        ]);
        CategorySecondary::factory()->create([
            'id' => '23',
            'name' => "Support Contents におけるSEO",
            'code' => "01",
            'primary_id' => 7,
            'order' => 1
        ]);
        CategorySecondary::factory()->create([
            'id' => '24',
            'name' => "採用",
            'code' => "01",
            'primary_id' => 8,
            'order' => 1
        ]);
        CategorySecondary::factory()->create([
            'id' => '25',
            'name' => "スキル要件とトレーニング/検証",
            'code' => "02",
            'primary_id' => 8,
            'order' => 2
        ]);
        CategorySecondary::factory()->create([
            'id' => '26',
            'name' => "人材育成",
            'code' => "03",
            'primary_id' => 8,
            'order' => 3
        ]);
        CategorySecondary::factory()->create([
            'id' => '27',
            'name' => "要員管理(シフトとリアルタイム管理）",
            'code' => "01",
            'primary_id' => 9,
            'order' => 1
        ]);
        CategorySecondary::factory()->create([
            'id' => '28',
            'name' => "応対品質",
            'code' => "02",
            'primary_id' => 9,
            'order' => 2
        ]);
        CategorySecondary::factory()->create([
            'id' => '29',
            'name' => "LINEのオペレーション",
            'code' => "03",
            'primary_id' => 9,
            'order' => 3
        ]);
        CategorySecondary::factory()->create([
            'id' => '30',
            'name' => "指標の管理と改善",
            'code' => "01",
            'primary_id' => 10,
            'order' => 1
        ]);
        CategorySecondary::factory()->create([
            'id' => '31',
            'name' => "改善手法",
            'code' => "02",
            'primary_id' => 10,
            'order' => 2
        ]);
        CategorySecondary::factory()->create([
            'id' => '32',
            'name' => "Support Contents 分析・改善",
            'code' => "03",
            'primary_id' => 10,
            'order' => 3
        ]);
        CategorySecondary::factory()->create([
            'id' => '33',
            'name' => "SNSデータ分析技法",
            'code' => "04",
            'primary_id' => 10,
            'order' => 4
        ]);
        CategorySecondary::factory()->create([
            'id' => '34',
            'name' => "コミュニケーション",
            'code' => "01",
            'primary_id' => 11,
            'order' => 1
        ]);
        CategorySecondary::factory()->create([
            'id' => '35',
            'name' => "SNS情報検索力",
            'code' => "02",
            'primary_id' => 11,
            'order' => 2
        ]);
        CategorySecondary::factory()->create([
            'id' => '36',
            'name' => "SNSコミュニケーション",
            'code' => "03",
            'primary_id' => 11,
            'order' => 3
        ]);
        CategorySecondary::factory()->create([
            'id' => '37',
            'name' => "SNS CSスキル",
            'code' => "04",
            'primary_id' => 11,
            'order' => 4
        ]);
        CategorySecondary::factory()->create([
            'id' => '38',
            'name' => "PC利用スキル",
            'code' => "01",
            'primary_id' => 12,
            'order' => 1
        ]);
        CategorySecondary::factory()->create([
            'id' => '39',
            'name' => "資質と行動",
            'code' => "01",
            'primary_id' => 13,
            'order' => 1
        ]);
        Category::factory()->create([
            'name' => "次世代のコンタクトセンター像",
            'code' => "01",
            'secondary_id' => 1,
            'order' => 1
        ]);
        Category::factory()->create([
            'name' => "チャネルの役割/チャネルミックス",
            'code' => "02",
            'secondary_id' => 1,
            'order' => 2
        ]);
        Category::factory()->create([
            'name' => "チャットサポートとは",
            'code' => "01",
            'secondary_id' => 2,
            'order' => 1
        ]);
        Category::factory()->create([
            'name' => "サポートコンテンツとは",
            'code' => "02",
            'secondary_id' => 2,
            'order' => 2
        ]);
        Category::factory()->create([
            'name' => "SNSとは",
            'code' => "03",
            'secondary_id' => 2,
            'order' => 3
        ]);
        Category::factory()->create([
            'name' => "消費者ニーズと市場動向",
            'code' => "04",
            'secondary_id' => 2,
            'order' => 4
        ]);
        Category::factory()->create([
            'name' => "顧客セグメントとチャットの導入目的",
            'code' => "01",
            'secondary_id' => 3,
            'order' => 1
        ]);
        Category::factory()->create([
            'name' => "現状分析とサポート範囲",
            'code' => "02",
            'secondary_id' => 3,
            'order' => 2
        ]);
        Category::factory()->create([
            'name' => "チャット流入経路の設計",
            'code' => "03",
            'secondary_id' => 3,
            'order' => 3
        ]);
        Category::factory()->create([
            'name' => "ペルソナの設定",
            'code' => "04",
            'secondary_id' => 3,
            'order' => 4
        ]);
        Category::factory()->create([
            'name' => "顧客特定",
            'code' => "05",
            'secondary_id' => 3,
            'order' => 5
        ]);
        Category::factory()->create([
            'name' => "VOCの活用",
            'code' => "06",
            'secondary_id' => 3,
            'order' => 6
        ]);
        Category::factory()->create([
            'name' => "サポートコンテンツ概要",
            'code' => "01",
            'secondary_id' => 4,
            'order' => 1
        ]);
        Category::factory()->create([
            'name' => "サポートコンテンツの進め方",
            'code' => "02",
            'secondary_id' => 4,
            'order' => 2
        ]);
        Category::factory()->create([
            'name' => "SNSマーケティング概要",
            'code' => "01",
            'secondary_id' => 5,
            'order' => 1
        ]);
        Category::factory()->create([
            'name' => "ソーシャルリスニング概要",
            'code' => "02",
            'secondary_id' => 5,
            'order' => 2
        ]);
        Category::factory()->create([
            'name' => "アクティブサポート概要",
            'code' => "03",
            'secondary_id' => 5,
            'order' => 3
        ]);
        Category::factory()->create([
            'name' => "リスクマーケティングサービス",
            'code' => "04",
            'secondary_id' => 5,
            'order' => 4
        ]);
        Category::factory()->create([
            'name' => "KGIの設定",
            'code' => "01",
            'secondary_id' => 6,
            'order' => 1
        ]);
        Category::factory()->create([
            'name' => "Chat KPIの設定",
            'code' => "02",
            'secondary_id' => 6,
            'order' => 2
        ]);
        Category::factory()->create([
            'name' => "Support Contents KPIの設定",
            'code' => "03",
            'secondary_id' => 6,
            'order' => 3
        ]);
        Category::factory()->create([
            'name' => "SNS KPIの設定",
            'code' => "04",
            'secondary_id' => 6,
            'order' => 4
        ]);
        Category::factory()->create([
            'name' => "SLAとSOW",
            'code' => "05",
            'secondary_id' => 6,
            'order' => 5
        ]);
        Category::factory()->create([
            'name' => "投資対効果（ROI）の計算",
            'code' => "06",
            'secondary_id' => 6,
            'order' => 6
        ]);
        Category::factory()->create([
            'name' => "導線設計とトリガー",
            'code' => "01",
            'secondary_id' => 7,
            'order' => 1
        ]);
        Category::factory()->create([
            'name' => "流入フロー",
            'code' => "02",
            'secondary_id' => 7,
            'order' => 2
        ]);
        Category::factory()->create([
            'name' => "基本対応フロー策定",
            'code' => "03",
            'secondary_id' => 7,
            'order' => 3
        ]);
        Category::factory()->create([
            'name' => "ルーム・セッションの切断基準",
            'code' => "04",
            'secondary_id' => 7,
            'order' => 4
        ]);
        Category::factory()->create([
            'name' => "チャットにおける後処理",
            'code' => "05",
            'secondary_id' => 7,
            'order' => 5
        ]);
        Category::factory()->create([
            'name' => "エスカレーション・折り返し",
            'code' => "06",
            'secondary_id' => 7,
            'order' => 6
        ]);
        Category::factory()->create([
            'name' => "イレギュラーケースへの対応",
            'code' => "07",
            'secondary_id' => 7,
            'order' => 7
        ]);
        Category::factory()->create([
            'name' => "VOC・アンケートの収集",
            'code' => "08",
            'secondary_id' => 7,
            'order' => 8
        ]);
        Category::factory()->create([
            'name' => "チャットツール選定",
            'code' => "01",
            'secondary_id' => 8,
            'order' => 1
        ]);
        Category::factory()->create([
            'name' => "業務量予測(チャット流入件数予測）",
            'code' => "01",
            'secondary_id' => 9,
            'order' => 1
        ]);
        Category::factory()->create([
            'name' => "要員数計算",
            'code' => "02",
            'secondary_id' => 9,
            'order' => 2
        ]);
        Category::factory()->create([
            'name' => "要員計画",
            'code' => "03",
            'secondary_id' => 9,
            'order' => 1
        ]);
        Category::factory()->create([
            'name' => "業務要件定義",
            'code' => "01",
            'secondary_id' => 10,
            'order' => 1
        ]);
        Category::factory()->create([
            'name' => "KGI/KPI設計",
            'code' => "02",
            'secondary_id' => 10,
            'order' => 2
        ]);
        Category::factory()->create([
            'name' => "FAQシステムの選定",
            'code' => "03",
            'secondary_id' => 10,
            'order' => 3
        ]);
        Category::factory()->create([
            'name' => "業務内容・業務範囲の決定",
            'code' => "04",
            'secondary_id' => 10,
            'order' => 4
        ]);
        Category::factory()->create([
            'name' => "運用スケジュールの決定",
            'code' => "05",
            'secondary_id' => 10,
            'order' => 5
        ]);
        Category::factory()->create([
            'name' => "運用体制・役割の決定",
            'code' => "06",
            'secondary_id' => 10,
            'order' => 6
        ]);
        Category::factory()->create([
            'name' => "目的・課題の明確化",
            'code' => "01",
            'secondary_id' => 11,
            'order' => 1
        ]);
        Category::factory()->create([
            'name' => "業務要件定義",
            'code' => "02",
            'secondary_id' => 11,
            'order' => 2
        ]);
        Category::factory()->create([
            'name' => "業務範囲",
            'code' => "03",
            'secondary_id' => 11,
            'order' => 3
        ]);
        Category::factory()->create([
            'name' => "利用ツールの選定",
            'code' => "04",
            'secondary_id' => 11,
            'order' => 4
        ]);
        Category::factory()->create([
            'name' => "運用体制・役割の決定",
            'code' => "05",
            'secondary_id' => 11,
            'order' => 5
        ]);
        Category::factory()->create([
            'name' => "スケジュール",
            'code' => "06",
            'secondary_id' => 11,
            'order' => 6
        ]);
        Category::factory()->create([
            'name' => "業務フローの理解と設計",
            'code' => "07",
            'secondary_id' => 11,
            'order' => 7
        ]);
        Category::factory()->create([
            'name' => "ソーシャルリスニング運用構築",
            'code' => "08",
            'secondary_id' => 11,
            'order' => 8
        ]);
        Category::factory()->create([
            'name' => "アクティブサポート運用構築",
            'code' => "09",
            'secondary_id' => 11,
            'order' => 9
        ]);
        Category::factory()->create([
            'name' => "リスクモニタリングサービス運用構築",
            'code' => "10",
            'secondary_id' => 11,
            'order' => 10
        ]);
        Category::factory()->create([
            'name' => "主要なプラットフォームの特徴",
            'code' => "01",
            'secondary_id' => 12,
            'order' => 1
        ]);
        Category::factory()->create([
            'name' => "設置方法",
            'code' => "01",
            'secondary_id' => 13,
            'order' => 1
        ]);
        Category::factory()->create([
            'name' => "LINEアカウントの種類",
            'code' => "01",
            'secondary_id' => 14,
            'order' => 1
        ]);
        Category::factory()->create([
            'name' => "LINEアカウントの発行手順",
            'code' => "02",
            'secondary_id' => 14,
            'order' => 2
        ]);
        Category::factory()->create([
            'name' => "LINE特有の機能(スタンプ/リッチメニュー)",
            'code' => "03",
            'secondary_id' => 14,
            'order' => 3
        ]);
        Category::factory()->create([
            'name' => "ランディングページの用意と審査",
            'code' => "04",
            'secondary_id' => 14,
            'order' => 4
        ]);
        Category::factory()->create([
            'name' => "【補足】LINEカスタマーコネクトオプション",
            'code' => "05",
            'secondary_id' => 14,
            'order' => 5
        ]);
        Category::factory()->create([
            'name' => "Support Contents ツール群",
            'code' => "01",
            'secondary_id' => 15,
            'order' => 1
        ]);
        Category::factory()->create([
            'name' => "SNS ツール群",
            'code' => "01",
            'secondary_id' => 16,
            'order' => 1
        ]);
        Category::factory()->create([
            'name' => "アジャイルプロジェクトマネジメント",
            'code' => "01",
            'secondary_id' => 17,
            'order' => 1
        ]);

        Category::factory()->create([
            'name' => "POCの概要とアプローチ",
            'code' => "01",
            'secondary_id' => 18,
            'order' => 1
        ]);
        Category::factory()->create([
            'name' => "コンテンツ最適化のためのコミュニケーション",
            'code' => "01",
            'secondary_id' => 19,
            'order' => 1
        ]);
        Category::factory()->create([
            'name' => "連携体制の構築",
            'code' => "02",
            'secondary_id' => 19,
            'order' => 2
        ]);
        Category::factory()->create([
            'name' => "コンテンツライティング基本",
            'code' => "01",
            'secondary_id' => 20,
            'order' => 1
        ]);
        Category::factory()->create([
            'name' => "作成ガイドラインの作成",
            'code' => "02",
            'secondary_id' => 20,
            'order' => 2
        ]);
        Category::factory()->create([
            'name' => "質問スキル",
            'code' => "03",
            'secondary_id' => 20,
            'order' => 3
        ]);
        Category::factory()->create([
            'name' => "回答",
            'code' => "04",
            'secondary_id' => 20,
            'order' => 4
        ]);
        Category::factory()->create([
            'name' => "画像・動画",
            'code' => "05",
            'secondary_id' => 20,
            'order' => 5
        ]);
        Category::factory()->create([
            'name' => "関連情報",
            'code' => "06",
            'secondary_id' => 20,
            'order' => 6
        ]);
        Category::factory()->create([
            'name' => "校正・校閲",
            'code' => "07",
            'secondary_id' => 20,
            'order' => 7
        ]);
        Category::factory()->create([
            'name' => "サポートコンテンツにおけるUX",
            'code' => "01",
            'secondary_id' => 21,
            'order' => 1
        ]);
        Category::factory()->create([
            'name' => "UXハニカムとは",
            'code' => "01",
            'secondary_id' => 22,
            'order' => 1
        ]);
        Category::factory()->create([
            'name' => "Useful（役にたつ）",
            'code' => "02",
            'secondary_id' => 22,
            'order' => 2
        ]);
        Category::factory()->create([
            'name' => "Usable(使いやすさ）",
            'code' => "03",
            'secondary_id' => 22,
            'order' => 3
        ]);
        Category::factory()->create([
            'name' => "Findable(探しやすさ）",
            'code' => "04",
            'secondary_id' => 22,
            'order' => 4
        ]);
        Category::factory()->create([
            'name' => "Credible(信頼できる）",
            'code' => "05",
            'secondary_id' => 22,
            'order' => 5
        ]);
        Category::factory()->create([
            'name' => "Accessible(アクセスしやすい）",
            'code' => "06",
            'secondary_id' => 22,
            'order' => 6
        ]);
        Category::factory()->create([
            'name' => "Desireble(好ましさ）",
            'code' => "07",
            'secondary_id' => 22,
            'order' => 7
        ]);
        Category::factory()->create([
            'name' => "SEOの定義と効果",
            'code' => "01",
            'secondary_id' => 23,
            'order' => 1
        ]);
        Category::factory()->create([
            'name' => "SEOの手法",
            'code' => "02",
            'secondary_id' => 23,
            'order' => 2
        ]);
        Category::factory()->create([
            'name' => "SEO対策のツール",
            'code' => "03",
            'secondary_id' => 23,
            'order' => 3
        ]);
        Category::factory()->create([
            'name' => "サポートコンテンツにおけるSEO対策",
            'code' => "04",
            'secondary_id' => 23,
            'order' => 4
        ]);
        Category::factory()->create([
            'name' => "チャットオペレーターの適性と採用基準",
            'code' => "01",
            'secondary_id' => 24,
            'order' => 1
        ]);
        Category::factory()->create([
            'name' => "SC担当の適性と採用基準",
            'code' => "02",
            'secondary_id' => 24,
            'order' => 2
        ]);
        Category::factory()->create([
            'name' => "SNS担当の適性と採用・登用基準",
            'code' => "03",
            'secondary_id' => 24,
            'order' => 3
        ]);
        Category::factory()->create([
            'name' => "選考プロセス",
            'code' => "04",
            'secondary_id' => 24,
            'order' => 4
        ]);
        Category::factory()->create([
            'name' => "採用のデータ分析と改善",
            'code' => "05",
            'secondary_id' => 24,
            'order' => 5
        ]);
        Category::factory()->create([
            'name' => "オペレーターと管理者のスキル要件",
            'code' => "01",
            'secondary_id' => 25,
            'order' => 1
        ]);
        Category::factory()->create([
            'name' => "トレーニングの開発と実施",
            'code' => "02",
            'secondary_id' => 25,
            'order' => 2
        ]);
        Category::factory()->create([
            'name' => "スキル検証プロセス",
            'code' => "03",
            'secondary_id' => 25,
            'order' => 3
        ]);
        Category::factory()->create([
            'name' => "トレーニングと検証のデータ分析と改善",
            'code' => "04",
            'secondary_id' => 25,
            'order' => 4
        ]);
        Category::factory()->create([
            'name' => "キャリアプランと育成",
            'code' => "01",
            'secondary_id' => 26,
            'order' => 1
        ]);
        Category::factory()->create([
            'name' => "シフト",
            'code' => "01",
            'secondary_id' => 27,
            'order' => 1
        ]);
        Category::factory()->create([
            'name' => "リアルタイム管理",
            'code' => "02",
            'secondary_id' => 27,
            'order' => 2
        ]);
        Category::factory()->create([
            'name' => "モニタリング",
            'code' => "01",
            'secondary_id' => 28,
            'order' => 1
        ]);
        Category::factory()->create([
            'name' => "フィードバックとコーチング",
            'code' => "02",
            'secondary_id' => 28,
            'order' => 2
        ]);
        Category::factory()->create([
            'name' => "配信リスト作成方法",
            'code' => "01",
            'secondary_id' => 29,
            'order' => 1
        ]);
        Category::factory()->create([
            'name' => "配信の仕方",
            'code' => "02",
            'secondary_id' => 29,
            'order' => 2
        ]);
        Category::factory()->create([
            'name' => "実績データとレポート",
            'code' => "01",
            'secondary_id' => 30,
            'order' => 1
        ]);
        Category::factory()->create([
            'name' => "改善",
            'code' => "02",
            'secondary_id' => 30,
            'order' => 2
        ]);
        Category::factory()->create([
            'name' => "問題解決技法",
            'code' => "01",
            'secondary_id' => 31,
            'order' => 1
        ]);
        Category::factory()->create([
            'name' => "統計分析",
            'code' => "02",
            'secondary_id' => 31,
            'order' => 2
        ]);
        Category::factory()->create([
            'name' => "分析ツール",
            'code' => "03",
            'secondary_id' => 31,
            'order' => 3
        ]);
        Category::factory()->create([
            'name' => "サポートコンテンツ改善概要",
            'code' => "01",
            'secondary_id' => 32,
            'order' => 1
        ]);
        Category::factory()->create([
            'name' => "0件ヒットの改善",
            'code' => "02",
            'secondary_id' => 32,
            'order' => 2
        ]);
        Category::factory()->create([
            'name' => "クリック率の向上",
            'code' => "03",
            'secondary_id' => 32,
            'order' => 3
        ]);
        Category::factory()->create([
            'name' => "ユーザーアンケート評価の向上",
            'code' => "04",
            'secondary_id' => 32,
            'order' => 4
        ]);
        Category::factory()->create([
            'name' => "コンテンツカバー率",
            'code' => "05",
            'secondary_id' => 32,
            'order' => 5
        ]);
        Category::factory()->create([
            'name' => "PV数による改善",
            'code' => "06",
            'secondary_id' => 32,
            'order' => 6
        ]);
        Category::factory()->create([
            'name' => "その他の改善施策",
            'code' => "07",
            'secondary_id' => 32,
            'order' => 7
        ]);
        Category::factory()->create([
            'name' => "SNSデータ分析手順",
            'code' => "01",
            'secondary_id' => 33,
            'order' => 1
        ]);
        Category::factory()->create([
            'name' => "SNSデータ分析内容",
            'code' => "02",
            'secondary_id' => 33,
            'order' => 2
        ]);
        Category::factory()->create([
            'name' => "応対の基本",
            'code' => "01",
            'secondary_id' => 34,
            'order' => 1
        ]);
        Category::factory()->create([
            'name' => "テキストコミュニケーション",
            'code' => "02",
            'secondary_id' => 34,
            'order' => 2
        ]);
        Category::factory()->create([
            'name' => "質問スキル",
            'code' => "03",
            'secondary_id' => 34,
            'order' => 3
        ]);
        Category::factory()->create([
            'name' => "テンプレート/FAQ活用",
            'code' => "04",
            'secondary_id' => 34,
            'order' => 4
        ]);
        Category::factory()->create([
            'name' => "記述内容",
            'code' => "05",
            'secondary_id' => 34,
            'order' => 5
        ]);
        Category::factory()->create([
            'name' => "スピード調整",
            'code' => "06",
            'secondary_id' => 34,
            'order' => 6
        ]);
        Category::factory()->create([
            'name' => "顧客との交渉",
            'code' => "07",
            'secondary_id' => 34,
            'order' => 7
        ]);
        Category::factory()->create([
            'name' => "情報検索の手法",
            'code' => "01",
            'secondary_id' => 35,
            'order' => 1
        ]);
        Category::factory()->create([
            'name' => "データ収集とクエリの製作",
            'code' => "02",
            'secondary_id' => 35,
            'order' => 2
        ]);
        Category::factory()->create([
            'name' => "応対の基本",
            'code' => "01",
            'secondary_id' => 36,
            'order' => 1
        ]);
        Category::factory()->create([
            'name' => "SNSコミュニケーションの基本",
            'code' => "02",
            'secondary_id' => 36,
            'order' => 2
        ]);
        Category::factory()->create([
            'name' => "ペルソナに合わせた応対",
            'code' => "03",
            'secondary_id' => 36,
            'order' => 3
        ]);
        Category::factory()->create([
            'name' => "シーン別対応フロー",
            'code' => "04",
            'secondary_id' => 36,
            'order' => 4
        ]);
        Category::factory()->create([
            'name' => "炎上",
            'code' => "01",
            'secondary_id' => 37,
            'order' => 1
        ]);
        Category::factory()->create([
            'name' => "口調や距離感",
            'code' => "02",
            'secondary_id' => 37,
            'order' => 2
        ]);
        Category::factory()->create([
            'name' => "テンプレート対応",
            'code' => "03",
            'secondary_id' => 37,
            'order' => 3
        ]);
        Category::factory()->create([
            'name' => "PCとツールの操作",
            'code' => "01",
            'secondary_id' => 38,
            'order' => 1
        ]);
        Category::factory()->create([
            'name' => "タッチタイピング",
            'code' => "02",
            'secondary_id' => 38,
            'order' => 2
        ]);
        Category::factory()->create([
            'name' => "マルチファンクション",
            'code' => "01",
            'secondary_id' => 39,
            'order' => 1
        ]);
        Category::factory()->create([
            'name' => "積極性",
            'code' => "02",
            'secondary_id' => 39,
            'order' => 2
        ]);
        Category::factory()->create([
            'name' => "顧客に寄り添うマインド",
            'code' => "03",
            'secondary_id' => 39,
            'order' => 3
        ]);
        Category::factory()->create([
            'name' => "思い切りのよさ",
            'code' => "04",
            'secondary_id' => 39,
            'order' => 4
        ]);
    }
}

