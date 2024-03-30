<?php

namespace App\Http\Controllers;

use App\Models\Answer;
use App\Models\Question;
use App\Models\QuestionDetail;
use App\Models\QuestionGroup;
use Illuminate\Http\Request;

class QuestionDetailController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $questionDetails = QuestionDetail::all();
        return view('/admin/question_details.index', compact('questionDetails'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('/admin/question_details.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'id_question' => 'required',
            'question' => 'required',
            'sequence' => 'required',
            'id_answer' => 'required',
            'id_question_group' => 'required',
        ]);


        $questiondetail = new QuestionDetail();
        $questiondetail->question = $request->question;
        $questiondetail->sequence = $request->sequence;
        $questiondetail->id_question = $request->id_question;
        $questiondetail->id_question_group = $request->id_question_group;
        $questiondetail->id_answer = $request->id_answer;

        $questiondetail->save();

        return redirect()->route('question_groups.add_detail', $request->id_question_group)
            ->with('success', 'Question detail created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $questionGroup = QuestionGroup::find($id);
        $answers = Answer::all();

        return view('/admin/question_details.create', compact('questionGroup', 'answers'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(QuestionDetail $questionDetail)
    {
        return view('/admin/question_details.edit', compact('questionDetail'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, QuestionDetail $questionDetail)
    {
        $validatedData = $request->validate([
            'id_question' => 'required',
            'question' => 'required',
            'sequence' => 'required',
            'id_answer' => 'required',
            'id_question_group' => 'required',
        ]);

        $questionDetail->update($validatedData);

        return redirect()->route('question_details.index')
            ->with('success', 'Question detail updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(QuestionDetail $questionDetail)
    {
        $questionDetail->delete();
        return redirect()->route('questions.show', $questionDetail->id_question_group)
            ->with('success', 'Question detail deleted successfully');
    }
}
