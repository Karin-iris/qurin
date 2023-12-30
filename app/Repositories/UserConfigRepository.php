<?php

namespace App\Repositories;

use Illuminate\Support\Facades\DB;
use App\Models\UserConfig;

class UserConfigRepository extends Repository
{
    protected UserConfig $userconfig;

    function __construct(){
        $this->userconfig = new UserConfig;
    }
}