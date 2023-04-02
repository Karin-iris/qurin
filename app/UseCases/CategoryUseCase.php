<?php

namespace App\UseCases;

use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use App\UseCases\UseCase;

class CategoryUseCase extends UseCase
{
    public Category $category;

    function __construct()
    {
        $this->category = new Category;
    }

    function getAllCategories()
    {
        return $this->category->select([
            'p.name as p_name',
            's.name as s_name',
            'c.name as name',
            'c.id as id',
            'p.id as p_id',
            's.id as s_id',
            'c.order as order',
            'c.code as code',
            'c.updated_at as updated_at',
            'c.created_at as created_at',
        ])->from('categories as c')->rightJoin('secondary_categories as s', function ($join) {
            $join->on('c.secondary_id', '=', 's.id');
            $join->rightJoin('primary_categories as p', function ($join) {
                $join->on('s.primary_id', '=', 'p.id');
            });
        })->orderBy('p.order')->orderBy('s.order')->orderBy('c.order')->get();
    }

    function getSimpleCategories()
    {
        return $this->category->select([
            'p.name as p_name',
            's.name as s_name',
            'c.name as name',
            'c.id as id',
            'p.id as p_id',
            's.id as s_id',
            'c.order as order',
            'c.code as code',
            'c.updated_at as updated_at',
            'c.created_at as created_at',
        ])->from('categories as c')->leftJoin('secondary_categories as s', function ($join) {
            $join->on('c.secondary_id', '=', 's.id');
            $join->leftJoin('primary_categories as p', function ($join) {
                $join->on('s.primary_id', '=', 'p.id');
            });
        })->orderBy('p.order')->orderBy('s.order')->orderBy('c.order')->get();
    }

    function getPrimaryCategories(){
        return $this->category
            ->select([
                'id',
                'name'
        ])
            ->from('primary_categories')
            ->get();
    }
    function getSecondaryAllCategories(){
        return $this->category
            ->select([
                'id',
                'name'
            ])
            ->from('secondary_categories')
            ->get();
    }

    function getSecondaryCategories(int $p_id){
        return $this->category
            ->select([
                'id',
                'name'
            ])
            ->where('primary_id',$p_id)
            ->from('secondary_categories')
            ->get()->pluck('name','id');
    }
    function getDetail(int $id)
    {
        return $this->category->select([
            'p.name as p_name',
            's.name as s_name',
            'c.name as name',
            'c.id as id',
            'p.id as p_id',
            's.id as s_id',
            'c.order as order',
            'c.code as code',
            'c.updated_at as updated_at',
            'c.created_at as created_at',
        ])->from('categories as c')->rightJoin('secondary_categories as s', function ($join) {
            $join->on('c.secondary_id', '=', 's.id');
            $join->rightJoin('primary_categories as p', function ($join) {
                $join->on('s.primary_id', '=', 'p.id');
            });
        })->where('c.id', $id)->firstOrFail();
    }

    function saveCategory(CategoryRequest $request)
    {
        $this->category->fill($request->all())->save();
    }

    function updateCategory(CategoryRequest $request, int $id)
    {
        $this->category->find($id)->fill([
            'name' => $request->input('name'),
            'code' => $request->input('code'),
            'secondary_id' => $request->input('secondary_id')
        ])->save();
    }

    function updateCategoryOrder(int $order, int $id)
    {
        $this->category->timestamps = false;
        $this->category->where('id', $id)->first()->fill([
            'order' => $order
        ])->save();
    }


}
