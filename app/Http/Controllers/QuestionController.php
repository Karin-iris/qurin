<?php

namespace App\Http\Controllers;

use App\Http\Requests\QuestionCaseRequest;
use App\Http\Requests\QuestionRequest;
use App\Http\Requests\QuestionFileRequest;
use App\UseCases\SectionUseCase;
use App\UseCases\CategoryUseCase;
use App\UseCases\QuestionUseCase;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Requests\Questions\SearchRequest;

class QuestionController extends Controller
{
    protected CategoryUseCase $categoryUC;
    protected QuestionUseCase $questionUC;
    protected SectionUseCase $sectionUC;
    public function __construct()
    {
        $this->categoryUC = new CategoryUseCase();
        $this->questionUC = new QuestionUseCase();
        $this->sectionUC = new SectionUseCase();
    }

    /**
     * Display a listing of the resource.
     */
    public function index(SearchRequest $request):View
    {
        $string = null;
        $competency = null;

        if($request->has('mode') && $request->get('mode')=="search"){
            $string = $request->get('string');
            $competency = $request->get('competency');
            $p_category = $request->get('p_category');
            $s_category = $request->get('s_category');
            $category = $request->get('category');
        }
        $questions = $this->questionUC->getQuestions($request);
        //$question_cases = $this->questionUC->getQuestionCases();
        $p_categories = $this->categoryUC->getPrimaryCategories();
        $s_categories = $this->categoryUC->getSecondaryAllCategories();
        $categories = $this->categoryUC->getSimpleCategories();
        return view('question.index', compact('questions','string','competency','p_categories', 's_categories', 'categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $p_categories = $this->categoryUC->getPrimaryCategories();
        $s_categories = $this->categoryUC->getSecondaryAllCategories();
        $categories = $this->categoryUC->getSimpleCategories();
        return view('question.create', compact('p_categories', 's_categories', 'categories'));//
    }



    /**
     * Store a newly created resource in storage.
     */
    public function store(QuestionRequest $request)
    {
        $this->questionUC->add($request);
        return Redirect::route('question.create')->with('question', 'saved');//
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $question = $this->questionUC->getQuestion($id);
        $p_categories = $this->categoryUC->getPrimaryCategories();
        $s_categories = $this->categoryUC->getSecondaryAllCategories();
        $categories = $this->categoryUC->getSimpleCategories();
        $sections =$this->sectionUC->getList();
        return view('question.edit', compact('question', 'p_categories', 's_categories', 'categories','sections'));//
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(QuestionRequest $request, string $id)
    {
        $status = $this->questionUC->update($request, $id);
        return Redirect::route('question.index')->with('status', $status);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id)
    {
        $this->questionUC->delQuestion($id);
        return Redirect::route('question.index')->with('question', 'deleted');//
    }

    public function destroy_c(int $id)
    {
        $this->questionUC->delQuestionCase($id);
        return Redirect::route('question.index')->with('question', 'deleted');//
    }

    function question_update_from_bk(){
        $c = DB::table('questions')->select(['id'])
            ->get();
        foreach($c as $d){

            $o = DB::table('questions_BK')->select(['id','user_id','compitency','user_name'])
                ->where('id', $d->id)->first();
            DB::table('questions')->where('id', $d->id)->update([
                'user_id' => $o->user_id,
                'compitency'=> $o->compitency,
                'user_name'=>$o->user_name
            ]);
        }

    }
}
