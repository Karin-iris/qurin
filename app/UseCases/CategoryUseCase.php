<?php

namespace App\UseCases\CategoryUseCase;

use App\Models\Category;
use App\UseCases\UseCase;

class CategoryUseCase
{
    function getAllCategories()
    {
        $sql = Category::select()->from('categories as e')->join('salaries as s', function ($join) {
                $join->on('s.emp_no', '=', 'e.emp_no');
            })->orderBy('e.birth_date')->limit(3)->toSql();
        echo $sql;
    }
}
