<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QnaExam extends Model
{
    use HasFactory;
    public function answers(){
        return $this->hasMany(Answer::class, 'questions_id','question_id');
    }
}
