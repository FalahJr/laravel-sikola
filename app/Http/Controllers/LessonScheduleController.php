<?php

namespace App\Http\Controllers;

use App\Models\LessonSchedule;
use App\Models\Lesson;
use App\Models\Classes;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use Carbon\Carbon;

class LessonScheduleController extends Controller
{
    /**
     * Display a listing of the lesson schedules.
     */
    public function index()
    {
        // Build base query joining lesson and class
        $query = LessonSchedule::join('lesson', 'lesson.id', '=', 'lesson_schedule.lesson_id')
            ->join('class', 'class.id', '=', 'lesson_schedule.class_id')
            // ->join('lesson', 'lesson.id', '=', 'lesson_schedule.lesson_id')
            ->select('lesson_schedule.*', 'lesson.name as lesson_name', 'class.name as class_name', 'lesson.user_id as teacher_id');

        // If current user is a Guru, limit schedules to the Guru's class_id
        $userRole = Session('user')['role'] ?? null;
        $guruId = Session('user')['id'] ?? null;
        // $classId = Session('user')['class_id'] ?? null;
        if ($userRole === 'Guru' && $guruId) {
            $query = $query->where('lesson.user_id', $guruId);
        }

        $data = $query->orderBy('lesson_schedule.day')
            ->orderBy('lesson_schedule.time')
            ->get();

        // dd($data);

        return view('pages.manage-lesson-schedules', compact('data'));
    }

    /**
     * Show the form for creating a new lesson schedule.
     */
    public function create()
    {
        if (Session('user')['role'] == 'Guru') {
            $lessons = Lesson::where('user_id', Session('user')['id'])->get();
        } else {
            $lessons = Lesson::all();
        }
        // $lessons = Lesson::with('user')->get();
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

            $schedule->save();
            // if ($schedule->save()) {
            //     if (Session('user')['role'] == 'Guru') {
            //         return redirect('/teacher/lesson-schedules');
            //     }
            //     return redirect('/admin/lesson-schedules');
            // }
            if (Session('user')['role'] == 'Guru') {
                return redirect('/teacher/lesson-schedules');
            }
            return redirect('/admin/lesson-schedules');
        } else {
            if (Session('user')['role'] == 'Guru') {
                return redirect('/teacher/lesson-schedules');
            }
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
     * Open attendance for a lesson schedule (set is_absensi = 'Y')
     */
    public function openAttendance(Request $request, $id)
    {
        $schedule = LessonSchedule::findOrFail($id);
        $schedule->is_absensi = 'Y';
        $schedule->updated_at = Carbon::now();
        $schedule->save();

        return back();
    }

    /**
     * Close attendance for a lesson schedule (set is_absensi = 'N')
     */
    public function closeAttendance(Request $request, $id)
    {
        $schedule = LessonSchedule::findOrFail($id);
        $schedule->is_absensi = 'N';
        $schedule->updated_at = Carbon::now();
        $schedule->save();

        return back();
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
