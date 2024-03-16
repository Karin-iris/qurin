<?php

namespace App\DataTransferObjects;

use App\Exceptions\DataTransferObjectExceptionHandler;

class DataTransferObject
{
    protected function handleExceptions(\Closure $operation)
    {
        return DataTransferObjectExceptionHandler::handle($operation);
    }

    public Array $array;

    public function set(string $prop, mixed $value)
    {
        $this->array[$prop] = $value;
    }

    public function get(string $prop)
    {
        return $this->array[$prop];
    }
}
