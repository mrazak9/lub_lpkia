<?php

namespace App\Http\Controllers;

use App\Models\Mean;
use Illuminate\Http\Request;

class MeanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $means = Mean::all();
        return view('\admin\means.index', compact('means'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('\admin\means.create');
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
            'min_value' => 'required|numeric',
            'max_value' => 'required|numeric',
            'statement' => 'required'
        ]);

        Mean::create([
            'min_value' => $request->min_value,
            'max_value' => $request->max_value,
            'statement' => $request->statement
        ]);

        return redirect()->route('means.index')
            ->with('success', 'Mean created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $means = Mean::find($id);
        return view('\admin\means.show', compact('means'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Mean $mean)
    {
        return view('\admin\means.edit', compact('mean'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Mean $mean)
    {
        // return $request;
        $request->validate([
            'min_value' => 'required|numeric',
            'max_value' => 'required|numeric',
            'statement' => 'required'
        ]);

        $mean->update([
            'min_value' => $request->min_value,
            'max_value' => $request->max_value,
            'statement' => $request->statement
        ]);

        return redirect()->route('means.index')
            ->with('success', 'Mean updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Mean $mean)
    {
        $mean->delete();
        return redirect()->route('means.index')
            ->with('success', 'Mean deleted successfully.');
    }
}
