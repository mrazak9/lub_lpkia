<?php

namespace App\Http\Controllers;

use App\Models\Answer;
use App\Models\AnswerDetail;
use Illuminate\Http\Request;

class AnswerDetailController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $answerDetails = AnswerDetail::all();
        return view('/admin/answer_details.index', compact('answerDetails'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {

        // return view('/admin/answer_details.create', compact($id));
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
            'id_answer' => 'required|exists:answers,id',
            'code' => 'required|string|max:3',
            'value' => 'required|integer'
        ]);


        AnswerDetail::create($request->all());

        $answer = Answer::find($request->id_answer);
        $answerDetails = AnswerDetail::where('id_answer', $request->id_answer)->get();

        return view('/admin/answers.show', compact('answer', 'answerDetails'))->with('success', 'Answer detail created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $answer = Answer::find($id);
        return view('/admin/answer_details.create', compact('answer'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(AnswerDetail $answerDetail)
    {
        $answer = Answer::find($answerDetail->id_answer);
        return view('/admin/answer_details.edit', compact('answerDetail', 'answer'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, AnswerDetail $answerDetail)
    {
        $request->validate([
            // 'id_answer' => 'required|exists:answers,id',
            'code' => 'required|string|max:3',
            'value' => 'required|integer'
        ]);
        $answerDetail->update($request->all());

        $answer = Answer::find($answerDetail->id_answer);
        $answerDetails = AnswerDetail::where('id_answer', $answerDetail->id_answer)->get();

        return view('/admin/answers.show', compact('answer', 'answerDetails'))
            ->with('success', 'Answer detail updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(AnswerDetail $answerDetail)
    {
        $answerDetail->delete();

        return redirect()->route('answers.show', $answerDetail->id_answer)
            ->with('success', 'Answer detail deleted successfully.');
    }
}
