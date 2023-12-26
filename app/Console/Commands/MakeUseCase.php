<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class MakeUseCase extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:use-case {name}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        $name = $this->argument('name');
        $filePath = app_path("UseCases/{$name}UseCase.php");

        if (File::exists($filePath)) {
            $this->error('UseCase already exists!');
            return;
        }


        // リポジトリのコードを生成
        $usecaseCode = $this->generateUseCaseCode($name);

        // ファイルにコードを書き込み
        File::put($filePath, $usecaseCode);

        $this->info("UseCase created successfully: {$filePath}");
    }

    protected function generateUseCaseCode($name)
    {
        $name_lower = strtolower($name);
        $code = <<<CODE
<?php

namespace App\UseCases;

use App\QueryServices\\{$name}QueryService;
use App\Repositories\\{$name}Repository;

use Illuminate\Support\Facades\DB;

class {$name}UseCase extends UseCase
{
    protected {$name}QueryService \${$name_lower}QC;
    protected {$name}Repository \${$name_lower}R;

    function __construct(){
        \$this->{$name_lower}QC = new {$name}QueryService;
        \$this->{$name_lower}R = new {$name}Repository;
    }
}
CODE;

        return $code;
    }
}
