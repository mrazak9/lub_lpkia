<?php

namespace App\Http\Controllers;

use App\Models\Lecturer;
use App\Models\User;
use Illuminate\Http\Request;

class LecturerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $lecturers = Lecturer::all();
        return view('/admin/lecturers.index', compact('lecturers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('/admin/lecturers.create');
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
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'prodi' => 'nullable|string|max:255',
            'code' => 'required|string|max:11',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'role' => 'dosen',
            'password' => bcrypt($request->code),
        ]);

        $lecturer = new Lecturer();
        $lecturer->id_user = $user->id;
        $lecturer->prodi = $request->prodi;
        $lecturer->code = $request->code;
        $lecturer->save();

        return redirect()->route('lecturers.index')->with('success', 'Lecturer created successfully.');
   
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Lecturer $lecturer)
    {
        return view('/admin/lecturers.show', compact('lecturer'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Lecturer $lecturer)
    {
        return view('/admin/lecturers.edit', compact('lecturer'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Lecturer $lecturer)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,'.$lecturer->user->id,
            'prodi' => 'nullable|string|max:255',
            'code' => 'required|string|max:11|unique:lecturers,code,' . $lecturer->id,
        ]);

        $lecturer->user->update([
            'name' => $request->name,
            'email' => $request->email,
            'role' => 'dosen',
            'password' => bcrypt($request->code),
        ]);

        $lecturer->prodi = $request->prodi;
        $lecturer->code = $request->code;
        $lecturer->save();

        return redirect()->route('lecturers.index')->with('success', 'Lecturer updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Lecturer $lecturer)
    {
        $lecturer->delete();
        return redirect()->route('lecturers.index')->with('success', 'Lecturer deleted successfully.');
    }
}
