<?php

namespace App\QueryServices;

use App\Models\CategoryPrimary;
use App\Models\CategorySecondary;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use App\Models\Category;
use Intervention\Image\Exception\NotFoundException;


class CategoryQueryService extends QueryService
{
    protected Category $category;

    public function __construct()
    {
        $this->category = new Category;
        $this->category_primary = new CategoryPrimary();
        $this->category_secondary = new CategorySecondary();
    }

    public function getDetail($id)
    {
        try {
            return $this->category->select([
                'p.name as p_name',
                's.name as s_name',
                'c.name as name',
                'c.id as id',
                'p.id as p_id',
                's.id as s_id',
                'c.order as order',
                'c.code as code',
                'p.code as p_code',
                's.code as s_code',
                'c.updated_at as updated_at',
                'c.created_at as created_at',
            ])->from('categories as c')
                ->rightJoin('secondary_categories as s', function ($join) {
                    $join->on('c.secondary_id', '=', 's.id');
                    $join->rightJoin('primary_categories as p', function ($join) {
                        $join->on('s.primary_id', '=', 'p.id');
                    });
                })
                ->where('c.id', $id)->firstOrFail();
        } catch (NotFoundException $e) {
            return response()->json(['message' => 'User not found'], 404);
        }
    }



}
