<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\User;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $students = Student::all();

        return view('/admin/students.index', compact('students'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('/admin/students.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            // 'password' => 'required|min:6|confirmed',
            'classroom' => 'required|string|max:5',
            'code' => 'required|string|max:11',
            'prodi' => 'nullable|string|max:255',
        ]);

        // create new user
        $user = User::create([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'role' => 'student',
            'password' => bcrypt($validatedData['code']),
        ]);

        // create new student
        $student = new Student([
            'classroom' => $validatedData['classroom'],
            'code' => $validatedData['code'],
            'prodi' => $validatedData['prodi'],
        ]);

        // associate the user with the student
        $student->user()->associate($user);

        // save the student and user
        $student->save();

        return redirect()->route('students.index')
            ->with('success', 'Student created successfully.');
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Student $student)
    {
        return view('/admin/students.show', compact('student'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Student $student)
    {
        return view('/admin/students.edit', compact('student'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Student $student)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $student->user->id,
            'classroom' => 'required|string|max:5',
            'code' => 'required|string|max:11|unique:students,code,' . $student->id,
            'prodi' => 'nullable|string|max:255',
        ]);

        $student->classroom = $request->input('classroom');
        $student->code = $request->input('code');
        $student->prodi = $request->input('prodi');

        $user = User::findOrFail($student->id_user);

        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->role = 'student';
        $user->password = bcrypt($request->input('code'));
        $student->save();
        $user->save();

        return redirect()->route('students.index')->with('success', 'Student and user data has been updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Student $student)
    {
        $user = $student->user;

        $student->delete();
        $user->delete();

        return redirect()->route('students.index')->with('success', 'Student has been deleted.');
    }
}
