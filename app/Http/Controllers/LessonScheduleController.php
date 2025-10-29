<?php

namespace App\Http\Controllers;

use App\Models\LessonSchedule;
use App\Models\Lesson;
use App\Models\Classes;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\LessonAttendance;

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
            ->orderBy('lesson_schedule.start_time')
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
            $schedule->start_time = $request->start_time;
            $schedule->end_time = $request->end_time;
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
     * Student index - show schedules for student's class
     */
    public function studentIndex()
    {
        $classId = Session('user')['class_id'] ?? null;
        $userId = Session('user')['id'] ?? null;
        $data = collect();
        if ($classId) {
            $data = LessonSchedule::with(['lesson', 'class', 'lessonAttendances' => function ($q) use ($userId) {
                if ($userId) {
                    $q->where('user_id', $userId);
                }
            }])
                ->where('class_id', $classId)
                ->orderBy('day')
                ->orderBy('start_time')
                ->get();
        }

        return view('pages.lesson-schedules-student', compact('data'));
    }

    /**
     * Student attend (mark hadir)
     */
    public function attend(Request $request, $id)
    {
        $userId = Session('user')['id'] ?? null;
        if (!$userId) {
            return back();
        }

        $existing = LessonAttendance::where('lesson_schedule_id', $id)
            ->where('user_id', $userId)
            ->first();

        if ($existing) {
            // already marked
            return back();
        }

        $att = new LessonAttendance();
        $att->lesson_schedule_id = $id;
        $att->user_id = $userId;
        $att->status = 'Hadir';
        $att->created_at = Carbon::now();
        $att->updated_at = Carbon::now();
        $att->save();

        return back();
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
        $schedule->start_time = $request->start_time;
        $schedule->end_time = $request->end_time;
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

        // For any student in the schedule's class who hasn't marked attendance yet,
        // create a LessonAttendance record with status 'Tidak Hadir'.
        try {
            $students = \App\Models\User::where('class_id', $schedule->class_id)
                ->where('role', 'Murid')
                ->get();

            foreach ($students as $student) {
                $exists = LessonAttendance::where('lesson_schedule_id', $schedule->id)
                    ->where('user_id', $student->id)
                    ->first();

                if (! $exists) {
                    $att = new LessonAttendance();
                    $att->lesson_schedule_id = $schedule->id;
                    $att->user_id = $student->id;
                    $att->status = 'Tidak Hadir';
                    $att->created_at = Carbon::now();
                    $att->updated_at = Carbon::now();
                    $att->save();
                }
            }
        } catch (\Exception $e) {
            // swallow any error to avoid breaking the close flow; consider logging in production
        }

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
