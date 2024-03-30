<?php

namespace App\Http\Controllers;

use App\Models\AnswerDetail;
use App\Models\Question;
use App\Models\QuestionDetail;
use App\Models\QuestionGroup;
use App\Models\Recapt;
use App\Models\RecaptDetail;
use App\Models\Response;
use App\Models\ResponseStatus;
use App\Models\Schedule;
use App\Models\Student;
use Illuminate\Http\Request;

class ResponseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $questions = [];
        $comments = [];
        // return $request;
        foreach ($request->all() as $key => $value) {
            if (strpos($key, 'question') === 0) {
                $questions[$key] = $value;
            } elseif (strpos($key, 'comment') === 0) {
                $comments[$key] = $value;
            }
        }

        $responseData = [
            'id_schedule' => $request->id_schedule,
            'id_student' => $request->id_student,
            'id_question' => $request->id_question,
        ];

        foreach ($questions as $key => $value) {
            $responseData[$key] = $value;
        }

        foreach ($comments as $key => $value) {
            $responseData[$key] = $value;
        }

        $questionDetails = QuestionDetail::where('id_question', $request->id_question)->get();
        $recapt = Recapt::where('id_question', $request->id_question)->where('id_schedule', $request->id_schedule)->first();
        if (empty($recapt)) {
            $recapt = new Recapt();
        }

        $recapt->id_question = $request->id_question;
        $recapt->id_schedule = $request->id_schedule;
        $recapt->total_responsdent += 1;

        if ($recapt->save()) {
            $questionIds = $questionDetails->pluck('id')->toArray();

            $recapDetails = RecaptDetail::whereIn('question_detail_id', $questionIds)
                ->where('recapt_id', $recapt->id)
                ->get()
                ->keyBy('question_detail_id');

            foreach ($questionDetails as $qdetail) {
                $recapDetail = $recapDetails->get($qdetail->id);
                if (!$recapDetail) {
                    $recapDetail = new RecaptDetail();
                    $recapDetail->recapt_id = $recapt->id;
                    $recapDetail->question_detail_id = $qdetail->id;
                }

                // jika question, maka jumlahkan
                if (isset($questions['question' . $qdetail->sequence])) {
                    $questionDetail = QuestionDetail::where('id', $qdetail->id)
                        ->whereHas('answer', function ($query) {
                            $query->where('type', 'selection');
                        })
                        ->first();

                    if ($questionDetail) {
                        $recapDetail->value = intval($recapDetail->value);
                        $recapDetail->value += $questions['question' . $qdetail->sequence];

                        $recapDetail->question_detail_id = $questionDetail->id;
                    }
                }

                // jika comment, tambahkan dengan <br> jika lebih dari satu komen
                if (isset($comments['comment' . $qdetail->sequence])) {
                    $questionDetail = QuestionDetail::where('id', $qdetail->id)
                        ->whereHas('answer', function ($query) {
                            $query->where('type', 'text');
                        })
                        ->first();

                    if ($questionDetail) {
                        if (!empty($recapDetail->value)) {
                            $recapDetail->value .= '<br>';
                        }
                        $recapDetail->value .= $comments['comment' . $qdetail->sequence];
                        $recapDetail->question_detail_id = $questionDetail->id;
                    }
                }

                $recapDetail->save();
            }
        }


        $response = Response::create($responseData);

        $responseStatus = ResponseStatus::where('id_student', $request->id_student)->where('id_schedule', $request->id_schedule)->first();
        $responseStatus->id_student = $request->id_student;
        $responseStatus->id_schedule = $request->id_schedule;
        $responseStatus->id_question = $request->id_question;
        $responseStatus->id_response = $response->id;
        $responseStatus->is_response = true;
        $responseStatus->save();

        return ('test');
    }

    public function showQuestion($id)
    {
        $student = Student::find($id);

        $schedule = Schedule::where('classroom', $student->classroom)->get();
    }

    public function showLub(Request $request, $id, $student_id)
    {
        // return "Question ID: $id, Student ID: $student_id";
        $id_question = $id;
        $questionGroups = QuestionGroup::where('id_question', $id_question)->with(['question_details.answer', 'question_details' => function ($query) {
            $query->orderBy('sequence', 'asc');
        }])->get()->groupBy('id');

        $answerDetails = AnswerDetail::whereHas('answer.questionDetails', function ($query) use ($id_question) {
            $query->where('id_question', $id_question);
        })
            ->get();
        $responseStatus = ResponseStatus::where('id_student', $student_id)->where('id_question',  $id_question)->first();
        $schedule = Schedule::find($responseStatus->id_schedule);
        $question = Question::find($id);

        return view('/admin/responses.showLub', compact('question', 'questionGroups', 'answerDetails', 'student_id', 'schedule'));
    }

    public function showFeedback($id)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
