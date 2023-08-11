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
            $qnaExam = Exam::where('enterance_id', $id)->with('getQnaExam')->inRandomOrder()->get();
    
            $qna = QnaExam::where('exam_id', $qnaExam[0]['id'])->with('question','answers')->get();
    
            return view('student.exam-dashboard', ['success' => true, 'exam' => $qnaExam, 'qna' => $qna]);
        }
        public function examSubmit(Request $request)
    {
        $attempt_id = ExamAttempt::insertGetId([
            'exam_id' => $request->exam_id,
            'user_id' => Auth::user()->id
        ]);

        $qcount = count($request->q);
        if($qcount > 0 ){
            for($i = 0; $i = $qcount; $i++){
                if(!empty($request->input('ans_'.($i+1)))){
                    ExamAnswer::insert([
                        'attempt_id' => $attempt_id,
                        'question_id' => $request->q[$i],
                        'answer_id' => $request()->input('ans_'.($i+1))
                    ]);
                }
            }
        }
        return view('thank-you');
    }

    }

           /* $currentDate = Carbon::now()->format('Y-m-d');
            
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
        } 
    }
}*/