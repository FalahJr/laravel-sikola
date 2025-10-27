<?php

namespace App\Http\Controllers;

use App\Models\LessonSchedule;
use App\Models\Lesson;
use App\Models\Classes;
use Illuminate\Http\Request;
use Carbon\Carbon;

class LessonScheduleController extends Controller
{
    /**
     * Display a listing of the lesson schedules.
     */
    public function index()
    {
        $data = LessonSchedule::join('lesson', 'lesson.id', '=', 'lesson_schedule.lesson_id')
            ->join('class', 'class.id', '=', 'lesson_schedule.class_id')
            ->select('lesson_schedule.*', 'lesson.name as lesson_name', 'class.name as class_name')
            ->orderBy('lesson_schedule.day')
            ->orderBy('lesson_schedule.time')
            ->get();

        return view('pages.manage-lesson-schedules', compact('data'));
    }

    /**
     * Show the form for creating a new lesson schedule.
     */
    public function create()
    {
        $lessons = Lesson::with('user')->get();
        $classes = Classes::all();
        return view('pages.add-lesson-schedule', compact('lessons', 'classes'));
    }

    /**
     * Store a newly created lesson schedule in storage.
     */
    public function store(Request $request)
    {
        if ($request) {
            $schedule = new LessonSchedule;
            $schedule->lesson_id = $request->lesson_id;
            $schedule->class_id = $request->class_id;
            $schedule->room = $request->room;
            $schedule->day = $request->day;
            $schedule->time = $request->time;
            $schedule->created_at = Carbon::now();
            $schedule->updated_at = Carbon::now();

            if ($schedule->save()) {
                return redirect('/admin/lesson-schedules');
            }
            return redirect('/admin/lesson-schedules');
        } else {
            return redirect('/admin/lesson-schedules');
        }
    }

    /**
     * Display the specified lesson schedule.
     */
    public function show(Request $request)
    {
        $schedule = LessonSchedule::where([
            'id' => $request->segment(3)
        ])->with(['lesson.user', 'class', 'lessonAttendances.user'])->first();

        return view('pages.detail-lesson-schedule', compact('schedule'));
    }

    /**
     * Show the form for editing the specified lesson schedule.
     */
    public function edit(Request $request)
    {
        $schedule = LessonSchedule::where([
            'id' => $request->segment(3)
        ])->first();

        $lessons = Lesson::with('user')->get();
        $classes = Classes::all();

        return view('pages.edit-lesson-schedule', compact('schedule', 'lessons', 'classes'));
    }

    /**
     * Update the specified lesson schedule in storage.
     */
    public function update(Request $request)
    {
        $schedule = LessonSchedule::where([
            'id' => $request->segment(3)
        ])->first();

        $schedule->lesson_id = $request->lesson_id;
        $schedule->class_id = $request->class_id;
        $schedule->room = $request->room;
        $schedule->day = $request->day;
        $schedule->time = $request->time;
        $schedule->updated_at = Carbon::now();

        if ($schedule->save()) {
            return redirect('/admin/lesson-schedules');
        } else {
            return redirect('/admin/lesson-schedules');
        }
    }

    /**
     * Remove the specified lesson schedule from storage.
     */
    public function destroy(Request $request, $id)
    {
        $schedule = LessonSchedule::findOrFail($id);

        if ($schedule->delete()) {
            return redirect('/admin/lesson-schedules');
        } else {
            return redirect('/admin/lesson-schedules');
        }
    }
}
