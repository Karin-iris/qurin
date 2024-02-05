<?php

namespace App\UseCases;

use App\Http\Requests\CategoryRequest;
use App\Http\Requests\CategoryPrimaryRequest;
use App\Http\Requests\CategorySecondaryRequest;
use App\Models\Category;
use App\Models\CategoryPrimary;
use App\Models\CategorySecondary;
use App\UseCases\UseCase;

class CategoryUseCase extends UseCase
{
    public Category $category;

    public function __construct()
    {
        $this->category = new Category;
        $this->category_primary = new CategoryPrimary();
        $this->category_secondary = new CategorySecondary();
    }

    public function getAllCategories()
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
            'p.code as p_code',
            's.code as s_code',
            'c.updated_at as updated_at',
            'c.created_at as created_at',
        ])->from('categories as c')->rightJoin('secondary_categories as s', function ($join) {
            $join->on('c.secondary_id', '=', 's.id');
            $join->rightJoin('primary_categories as p', function ($join) {
                $join->on('s.primary_id', '=', 'p.id');
            });
        })->orderBy('p.order')->orderBy('s.order')->orderBy('c.order')->get();
    }

    public function getSimpleCategories()
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
            'p.code as p_code',
            's.code as s_code',
            'c.updated_at as updated_at',
            'c.created_at as created_at',
        ])->from('categories as c')->leftJoin('secondary_categories as s', function ($join) {
            $join->on('c.secondary_id', '=', 's.id');
            $join->leftJoin('primary_categories as p', function ($join) {
                $join->on('s.primary_id', '=', 'p.id');
            });
        })->orderBy('p.order')->orderBy('s.order')->orderBy('c.order')->get();
    }

    function getPrimaryCategories()
    {
        return $this->category_primary
            ->select([
                'id',
                'code',
                'name'
            ])
            ->from('primary_categories')
            ->get();
    }

    public function getSecondaryAllCategories()
    {
        return $this->category_secondary
            ->select([
                'id',
                'name',
                'code'
            ])
            ->from('secondary_categories')
            ->get();
    }

    public function getSecondaryCategories(int $p_id)
    {
        return $this->category_secondary
            ->select([
                'id',
                'name',
                'code'
            ])
            ->where('primary_id', $p_id)
            ->from('secondary_categories')
            ->get();
    }

    function getChildCategories(int $s_id)
    {
        return $this->category
            ->select([
                'id',
                'code',
                'name'
            ])
            ->where('secondary_id', $s_id)
            ->from('categories')
            ->get();
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
            'p.code as p_code',
            's.code as s_code',
            'c.updated_at as updated_at',
            'c.created_at as created_at',
        ])->from('categories as c')->rightJoin('secondary_categories as s', function ($join) {
            $join->on('c.secondary_id', '=', 's.id');
            $join->rightJoin('primary_categories as p', function ($join) {
                $join->on('s.primary_id', '=', 'p.id');
            });
        })->where('c.id', $id)->firstOrFail();
    }
    public function getGptQuery(int $id): array|string
    {
        $category_array = $this->getDetail($id);
        if(env('APP_COM_NAME')=="dlp"){
            $str="デジタルライフプランナー検定試験問題を作成しています。

テキストも参照し、指定した知識スキル体系の大中小分類のコンピテンシーを測定するための問題を10問作ってください。

[p_name][s_name][c_name]

に関係する問題で、特に[c_name]を問う問題が欲しいです。[c_name]の指定がない場合はテキスト内容と知識スキル体系の分類から作成してください。
正解が紛らわしくて、分かりにくい問題が良いです。

問題文の最後の言葉に、「次のうち最も適切なものをどれですか」と質問してください。

アウトプットは以下としてください。
問題文200文字以内
正答と解説 を４０文字前後で
正答１問
誤答３問
正答の解説とそれぞれの誤答の解説";
        }else{
            $str = "[p_name][s_name][c_name]に関する問題をつくってください。";
        }

        $str = str_replace('[p_name]',$category_array['p_name'],$str);
        $str = str_replace('[s_name]',$category_array['s_name'],$str);
        return str_replace('[c_name]',$category_array['name'],$str);
    }

    public function getPrimaryDetail(int $id)
    {
        return $this->category->select([
            'p.name as name',
            'p.id as p_id',
            'p.code as code',
            'updated_at',
            'created_at',
        ])->from('primary_categories as p')
            ->where('p.id', $id)->firstOrFail();
    }

    function getSecondaryDetail(int $id)
    {
        return $this->category->select([
            'p.name as p_name',
            's.name as name',
            'p.id as p_id',
            's.id as s_id',
            'p.code as p_code',
            's.code as code',
            's.updated_at as updated_at',
            's.created_at as created_at',
        ])->from('secondary_categories as s')
            ->rightJoin('primary_categories as p', function ($join) {
                $join->on('s.primary_id', '=', 'p.id');
            })
            ->where('s.id', $id)->firstOrFail();
    }

    function saveCategory(CategoryRequest $request)
    {
        $this->category->fill($request->all())->save();
    }

    function savePrimaryCategory(CategoryPrimaryRequest $request)
    {
        $this->category_primary->fill([
            'name' => $request->input('name'),
            'code' => $request->input('code'),
            'order' => 1,
        ])->save();
    }

    function saveSecondaryCategory(CategorySecondaryRequest $request)
    {
        $this->category_secondary->fill([
            'name' => $request->input('name'),
            'code' => $request->input('code'),
            'primary_id' => $request->input('primary_id'),
            'order' => 1,
        ])->save();
    }

    function updateCategory(CategoryRequest $request, int $id)
    {
        $this->category->find($id)->fill([
            'name' => $request->input('name'),
            'code' => $request->input('code'),
            'secondary_id' => $request->input('secondary_id'),
            'order' => 1,
        ])->save();
    }

    function updatePrimaryCategory(CategoryPrimaryRequest $request, int $id)
    {
        $this->category->find($id)->fill([
            'name' => $request->input('name'),
            'code' => $request->input('code'),
        ])->save();
    }

    function updateSecondaryCategory(CategorySecondaryRequest $request, int $id)
    {
        $this->category_secondary->find($id)->fill([
            'name' => $request->input('name'),
            'code' => $request->input('code'),
            'primary_id' => $request->input('primary_id')
        ])->save();
    }

    function updateCategoryOrder(int $order, int $id)
    {
        $this->category->timestamps = false;
        $this->category->where('id', $id)->first()->fill([
            'order' => $order
        ])->save();
    }

    function delCategory($id)
    {
        $this->category->find($id)->delete();
    }

    function delPrimaryCategory($id)
    {
        $this->category_primary->find($id)->delete();
    }

    function delSecondaryCategory($id)
    {
        $this->category_secondary->find($id)->delete();
    }

}
