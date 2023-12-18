<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class MakeRepository extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:repository {name}';
    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'make an Onion Architecture repository';


    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        $name = $this->argument('name');
        $filePath = app_path("Repositories/{$name}Repository.php");

        if (File::exists($filePath)) {
            $this->error('Repository already exists!');
            return;
        }


        // リポジトリのコードを生成
        $repositoryCode = $this->generateRepositoryCode($name);

        // ファイルにコードを書き込み
        File::put($filePath, $repositoryCode);

        $this->info("Repository created successfully: {$filePath}");
    }

    protected function generateRepositoryCode($name)
    {
        // ここでリポジトリのコードを生成するロジックを記述
        // 例えば、テンプレートを使用して動的に生成するなど

        $code = <<<CODE
<?php

namespace App\Repositories;

use Illuminate\Support\Facades\DB;

class {$name}Repository extends Repository
{
    // ここにリポジトリのコードを追加
}
CODE;

        return $code;
    }
}
