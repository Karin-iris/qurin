<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use App\Models\QuestionCaseQuestion;
class QuestionCase extends Model
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'text',
        'case_text',
        'topic',
        'section_id',
        'category_id',
        'is_request',
        'is_approve',
        'user_id'
    ];
    protected $casts = [
        'created_at' => 'datetime:Y-m-d H:i', // 例としてのフォーマット
        'updated_at' => 'datetime:Y-m-d H:i', // 例としてのフォーマット
    ];
    public function questions()
    {
        return $this->hasMany(QuestionCaseQuestion::class, 'case_id');
    }
}
