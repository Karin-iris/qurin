<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class QuestionCaseQuestion extends Model
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'text',
        'topic',
        'section_id',
        'compitency',
        'user_name',
        'category_id',
        'quiz_id',
        'case_id',
        'correct_choice',
        'wrong_choice_1',
        'wrong_choice_2',
        'wrong_choice_3',
        'explanation',
        'is_request',
        'is_approve',
        'is_remand',
        'user_id',
    ];
}
