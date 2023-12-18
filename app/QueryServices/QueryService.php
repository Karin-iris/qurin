<?php

namespace App\QueryServices;
use App\Exceptions\RepositoryExceptionHandler;

class QueryService{
    protected function handleExceptions(\Closure $operation)
    {
        return RepositoryExceptionHandler::handle($operation);
    }
}
