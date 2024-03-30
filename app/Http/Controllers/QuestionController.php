<?php

namespace App\Http\Controllers;

use App\Models\Question;
use App\Models\QuestionGroup;
use App\Models\ResponseStatus;
use App\Models\Schedule;
use App\Models\Student;
use Illuminate\Http\Request;

class QuestionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $questions = Question::all();
        return view('/admin/questions.index', compact('questions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $schedules = Schedule::all();
        return view('/admin/questions.create', compact('schedules'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // return $request;
        $request->validate([
            'name' => 'required|string|max:255',
            'total' => 'required|integer|min:1',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
        ]);

        $question = new Question;
        $question->name = $request->name;
        $question->total = $request->total;
        $question->start_date = $request->start_date;
        $question->end_date = $request->end_date;
        $question->notes = $request->notes;
        $question->is_active = $request->is_active ?? false;
        $question->save();

        return redirect()->route('questions.index')->with('success', 'Question created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $question = Question::find($id);
        $questionGroups = QuestionGroup::where('id_question', $id)->with(['question_details.answer', 'question_details' => function ($query) {
            $query->orderBy('sequence', 'asc');
        }])->get()->groupBy('id');
        $periods = Schedule::select('periode')->distinct()->get();

        return view('\admin\questions.show', compact('question', 'questionGroups', 'periods'));
    }

    public function addGroup($id)
    {
        $question = Question::find($id);
        $questionGroups = QuestionGroup::where('id_question', $id)->get();

        return view('\admin\questions.addGroup', compact('question', 'questionGroups'));
    }

    public function generate(Request $request)
    {
        $students = Student::all();
        $questionId = $request->id_question;
        $periode = $request->periode;

        $generatedCount = 0;
        $failedCount = 0;

        foreach ($students as $student) {
            $schedules = Schedule::where('periode', $periode)
                ->where('classroom', 'like', '%' . $student->classroom . '%')
                ->get();

            foreach ($schedules as $schedule) {
                $responseStatus = ResponseStatus::where('id_student', $student->id)
                    ->where('id_question', $questionId)
                    ->where('id_schedule', $schedule->id)
                    ->first();

                if (!$responseStatus) {
                    $responseStatus = new ResponseStatus();
                    $responseStatus->id_student = $student->id;
                    $responseStatus->id_question = $questionId;
                    $responseStatus->is_response = false;
                    $responseStatus->id_schedule = $schedule->id;

                    if ($responseStatus->save()) {
                        $generatedCount++;
                    } else {
                        $failedCount++;
                    }
                }
            }
        }

        if ($generatedCount > 0) {
            return redirect()->back()->with('success', 'Berhasil generate ' . $generatedCount . ' response status.');
        } else {
            return redirect()->back()->with('error', 'Tidak ada response status yang berhasil digenerate.');
        }
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Question $question)
    {
        return view('/admin/questions.edit', compact('question'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Question $question)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'total' => 'required|integer|min:1',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
        ]);

        $question->name = $request->name;
        $question->total = $request->total;
        $question->start_date = $request->start_date;
        $question->end_date = $request->end_date;
        $question->notes = $request->notes;
        $question->is_active = $request->is_active ?? false;
        $question->save();

        return redirect()->route('questions.index')->with('success', 'Question updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Question $question)
    {
        $question->delete();
        return redirect()->route('questions.index')->with('success', 'Question deleted successfully.');
    }
}
