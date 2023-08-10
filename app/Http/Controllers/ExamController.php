<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Exam;
use App\Models\QnaExam;



use Carbon\Carbon;

class ExamController extends Controller
{
    public function loadExamDashboard($id)
    {
        $qnaExam = Exam::where('enterance_id', $id)->with('getQnaExam')->first();

        if ($qnaExam) {
            $currentDate = Carbon::now()->format('Y-m-d');
            
            if ($qnaExam->date <= $currentDate) {
                if (count($qnaExam->getQnaExam) > 0) {
                    $qna = QnaExam::where('exam_id', $qnaExam->id)->with('question.answers')->inRandomOrder()->get();
                    return view('student.exam-dashboard', ['success' => true, 'exam' => $qnaExam, 'qna' => $qna]);
                } else {
                    return view('student.exam-dashboard', ['success' => false, 'msg' => 'This exam is not available for now!', 'exam' => $qnaExam]);
                }
            } else {
                return view('student.exam-dashboard', ['success' => false, 'msg' => 'This exam will start on ' . $qnaExam->date, 'exam' => $qnaExam]);
            }
        } else {
            return view('404');
        }
    }
}