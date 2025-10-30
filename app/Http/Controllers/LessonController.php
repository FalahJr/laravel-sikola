<?php

namespace App\Http\Controllers;

use App\Models\Lesson;
use App\Models\User;
use Illuminate\Http\Request;
use Carbon\Carbon;

class LessonController extends Controller
{
    /**
     * Display a listing of the lessons.
     */
    public function index()
    {
        $data = Lesson::join('user', 'user.id', '=', 'lesson.user_id')
            ->select('lesson.*', 'user.nama_lengkap')
            ->orderBy('lesson.created_at', 'desc')
            ->get();

        return view('pages.manage-lessons', compact('data'));
    }

    /**
     * Show the form for creating a new lesson.
     */
    public function create()
    {
        $teachers = User::where('role', 'Guru')->get();
        return view('pages.add-lesson', compact('teachers'));
    }

    /**
     * Store a newly created lesson in storage.
     */
    public function store(Request $request)
    {
        if ($request) {
            $lesson = new Lesson;
            $lesson->name = $request->name;
            $lesson->user_id = $request->user_id;
            $lesson->created_at = Carbon::now();
            $lesson->updated_at = Carbon::now();

            if ($lesson->save()) {
                return redirect('/admin/lessons')->with('success', 'Mata pelajaran berhasil dibuat');
            }
            return redirect('/admin/lessons')->with('error', 'Gagal membuat mata pelajaran');
        } else {
            return redirect('/admin/lessons')->with('error', 'Gagal membuat mata pelajaran');
        }
    }

    /**
     * Display the specified lesson.
     */
    public function show(Request $request)
    {
        $lesson = Lesson::where([
            'id' => $request->segment(3)
        ])->with(['user', 'lessonSchedules', 'materials'])->first();

        return view('pages.detail-lesson', compact('lesson'));
    }

    /**
     * Show the form for editing the specified lesson.
     */
    public function edit(Request $request)
    {
        $lesson = Lesson::where([
            'id' => $request->segment(3)
        ])->first();

        $teachers = User::where('role', 'Guru')->get();

        return view('pages.edit-lesson', compact('lesson', 'teachers'));
    }

    /**
     * Update the specified lesson in storage.
     */
    public function update(Request $request)
    {
        $lesson = Lesson::where([
            'id' => $request->segment(3)
        ])->first();

        $lesson->name = $request->name;
        $lesson->user_id = $request->user_id;
        $lesson->updated_at = Carbon::now();

        if ($lesson->save()) {
            return redirect('/admin/lessons')->with('success', 'Mata pelajaran berhasil diperbarui');
        } else {
            return redirect('/admin/lessons')->with('error', 'Gagal memperbarui mata pelajaran');
        }
    }

    /**
     * Remove the specified lesson from storage.
     */
    public function destroy(Request $request, $id)
    {
        $lesson = Lesson::findOrFail($id);

        if ($lesson->delete()) {
            return redirect('/admin/lessons')->with('success', 'Mata pelajaran berhasil dihapus');
        } else {
            return redirect('/admin/lessons')->with('error', 'Gagal menghapus mata pelajaran');
        }
    }
}
