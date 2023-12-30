<?php

namespace App\UseCases;

use App\QueryServices\UserConfigQueryService;
use App\Repositories\UserConfigRepository;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class UserConfigUseCase extends UseCase
{
    protected UserConfigQueryService $userconfigQC;
    protected UserConfigRepository $userconfigR;

    function __construct(){
        $this->userconfigQC = new UserConfigQueryService;
        $this->userconfigR = new UserConfigRepository;
    }

    function setAdminConfig()
    {
        try {
            //$path = Storage::putFile('photos', new File('/var/www/qurin/README.md'));
            //new File('/var/www/html/README.md')
            echo Storage::disk('gcs')->put('example.txt', 'aaaa');
        } catch (Exception $e) {
            echo 'Error uploading file: ' . $e->getMessage();
            // ここでエラーを処理
        }
    }
}
