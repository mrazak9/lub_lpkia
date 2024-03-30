<?php

namespace App\Http\Controllers;

use App\Models\Answer;
use App\Models\AnswerDetail;
use Illuminate\Http\Request;

class AnswerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $answers = Answer::all();
        return view('\admin\answers.index', compact('answers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('\admin\answers.create');
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
            'name' => 'required|string|max:30',
            'type' => 'required|string',
            'notes' => 'nullable|string'
        ]);

        Answer::create([
            'name' => $request->name,
            'type' => $request->type,
            'notes' => $request->notes
        ]);

        return redirect()->route('answers.index')->with('success', 'Answer created successfully.');
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
        $answerDetails = AnswerDetail::where('id_answer', $id)->get();

        return view('\admin\answers.show', compact('answer', 'answerDetails'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Answer $answer)
    {
        return view('\admin\answers.edit', compact('answer'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Answer $answer)
    {
        $request->validate([
            'name' => 'required|string|max:30',
            'type' => 'required|in:text,selection',
            'notes' => 'nullable|string'
        ]);

        $answer->update([
            'name' => $request->name,
            'type' => $request->type,
            'notes' => $request->notes
        ]);

        return redirect()->route('answers.show', $answer->id)->with('success', 'Answer updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Answer $answer)
    {
        $answer->delete();
        return redirect()->route('answers.index')->with('success', 'Answer deleted successfully.');
    }
}
