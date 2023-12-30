<?php

namespace App\QueryServices;

use Illuminate\Support\Facades\DB;
use App\Models\UserConfig;

class UserConfigQueryService extends QueryService
{
    protected UserConfig $userconfig;

    function __construct(){
        $this->userconfig = new UserConfig;
    }
}