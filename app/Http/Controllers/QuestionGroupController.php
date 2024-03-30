<?php

namespace App\Http\Controllers;

use App\Models\Question;
use App\Models\QuestionDetail;
use App\Models\QuestionGroup;
use Illuminate\Http\Request;

class QuestionGroupController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $questionGroups = QuestionGroup::all();

        return view('/admin/question_groups.index', compact('questionGroups'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('/admin/question_groups.create');
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
            'name' => 'required',
            'id_question' => 'required|exists:questions,id',
        ]);

        QuestionGroup::create([
            'name' => $request->name,
            'id_question' => $request->id_question,
            'notes' => $request->notes,
        ]);

        return redirect()->route('questions.add_group', $request->id_question)->with('success', 'Question group has been created successfully.');
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
       
        return view('/admin/question_groups.create',  compact('question'));
    }

    public function addDetail($id)
    {
        $questionGroup = QuestionGroup::find($id);
        $questoinDetails = QuestionDetail::where('id_question_group', $id)->get();
        return view('/admin/question_groups.show', compact('questionGroup', 'questoinDetails'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(QuestionGroup $questionGroup)
    {
        return view('/admin/question_groups.edit', compact('questionGroup'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, QuestionGroup $questionGroup)
    {
        $request->validate([
            'name' => 'required',
            'id_question' => 'required|exists:questions,id',
        ]);

        $questionGroup->update([
            'name' => $request->name,
            'id_question' => $request->id_question,
            'notes' => $request->notes,
        ]);

        return redirect()->route('question_groups.index')->with('success', 'Question group has been updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(QuestionGroup $questionGroup)
    {
        $questionGroup->delete();

        return redirect()->route('questions.add_group', $questionGroup->question->id)->with('success', 'Question group has been deleted successfully.');
    }
}
