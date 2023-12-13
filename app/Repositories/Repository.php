<?php

namespace App\Repositories;
use App\Exceptions\RepositoryExceptionHandler;

class Repository{
    protected function handleExceptions(\Closure $operation)
    {
        return RepositoryExceptionHandler::handle($operation);
    }
}
