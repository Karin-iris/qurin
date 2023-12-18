<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
class MakeQueryService extends Command
{
    protected $signature = 'make:query-service {name}';
    protected $description = 'make an Onion Architecture queryservice';

    public function handle()
    {

        $name = $this->argument('name');

        $filePath = app_path("QueryServices/{$name}QueryService.php");

        if (File::exists($filePath)) {
            $this->error('QueryService already exists!');
            return;
        }

        //$this->createDirectory(app_path('QueryServices'));
        $queryServiceCode = $this->generateQueryServiceCode($name);

        File::put($filePath, $queryServiceCode);

        $this->info('QueryService created successfully!');
    }

    protected function generateQueryServiceCode($name)
    {
        return <<<CODE
<?php

namespace App\QueryServices;

use Illuminate\Support\Facades\DB;

class {$name}QueryService extends QueryService
{
    // ここにリポジトリのコードを追加
}
CODE;
    }
}
