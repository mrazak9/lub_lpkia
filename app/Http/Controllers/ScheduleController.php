<?php

namespace App\Http\Controllers;

use App\Models\AnswerDetail;
use App\Models\Lecturer;
use App\Models\QuestionGroup;
use App\Models\ResponseStatus;
use App\Models\Schedule;
use App\Models\Student;
use Illuminate\Http\Request;

class ScheduleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $schedules = Schedule::with('lecturer')->orderByDesc('created_at')->get();
        return view('/admin/schedules.index', compact('schedules'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $periods = Schedule::getPeriod();
        $lecturers = Lecturer::all();
        // return $periods;
        return view('/admin/schedules.create', compact('periods', 'lecturers'));
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
            'courses_name' => 'required|string|max:255',
            'id_lecturer' => 'required|exists:lecturers,id',
            'periode' => 'required|string|max:255',
            'classroom' => 'required|string|max:255',
        ]);
        // return $request->input('id_lecturer');
        $schedule = new Schedule();
        $schedule->courses_name = $request->input('courses_name');
        $schedule->id_lecturer = $request->input('id_lecturer');
        $schedule->periode = $request->input('periode');
        $schedule->classroom = $request->input('classroom');
        $schedule->save();

        return redirect()->route('schedules.index')->with('success', 'Schedule created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $statusResponses = ResponseStatus::where('id_student', $id)->get();
        return view('/admin/schedules.show', compact('statusResponses'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Schedule $schedule)
    {
        $periods = Schedule::getPeriod();
        $lecturers = Lecturer::all();
        // return $periods;
        return view('/admin/schedules.edit', compact('schedule', 'periods', 'lecturers'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Schedule $schedule)
    {
        $request->validate([
            'courses_name' => 'required|string|max:255',
            'id_lecturer' => 'required|exists:lecturers,id',
            'periode' => 'required|string|max:255',
            'classroom' => 'required|string|max:255',
        ]);

        $schedule->courses_name = $request->input('courses_name');
        $schedule->id_lecturer = $request->input('id_lecturer');
        $schedule->periode = $request->input('periode');
        $schedule->classroom = $request->input('classroom');
        $schedule->save();

        return redirect()->route('schedules.index')->with('success', 'Schedule updated successfully.');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Schedule $schedule)
    {
        $schedule->delete();
        return redirect()->route('schedules.index')->with('success', 'Schedule deleted successfully.');
    }
}
