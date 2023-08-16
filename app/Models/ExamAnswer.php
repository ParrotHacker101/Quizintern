<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExamAttempt extends Model
{
    use HasFactory;
    public $table = "exams_answers";

    protected $fillable = [
        'attempt_id',
        'question_id',
        'answer_id',
    ];

    public function user()
    {
        return $this->hasOne(User::class,'id','user_id');
    }

    public function exam()
    {
        return $this->hasOne(Exam::class,'id','exam_id');
    }
}