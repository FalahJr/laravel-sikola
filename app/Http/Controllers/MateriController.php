<?php

namespace App\Http\Controllers;

use App\Models\ActivityLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;
use App\models\Admin;
use App\Models\Materi;
use App\Models\Notifikasi;
use App\Models\User;
use App\Models\Lesson;
use Carbon\Carbon;

class MateriController extends Controller
{

    public function index()
    {
        $data = Materi::leftJoin('lesson', 'lesson.id', '=', 'materi.lesson_id')
            ->leftJoin('user', 'user.id', '=', 'lesson.user_id')
            ->select('materi.*', 'user.nama_lengkap', 'lesson.name as lesson_name')
            ->where(function ($query) {
                $query->where('lesson.user_id', Session('user')['id'])
                    ->orWhereNull('materi.lesson_id');
            })
            ->orderBy('materi.id', 'desc')
            ->get();

        // Debug to see what we're getting
        // dd($data->toArray());

        return view('pages.manage-materi', compact('data'));
    }

    public function indexMateriMurid()
    {
        $data = Materi::leftJoin('lesson', 'lesson.id', '=', 'materi.lesson_id')
            ->leftJoin('user', 'user.id', '=', 'lesson.user_id')
            ->select('materi.*', 'user.nama_lengkap', 'lesson.name as lesson_name')
            ->orderBy('materi.id', 'desc')
            ->get();

        return view('pages.materi', compact('data'));
    }

    public function detailMateri(Request $request)
    {
        $materi = Materi::leftJoin('lesson', 'lesson.id', '=', 'materi.lesson_id')
            ->leftJoin('user', 'user.id', '=', 'lesson.user_id')
            ->select('materi.*', 'user.nama_lengkap', 'lesson.name as lesson_name')
            ->where('materi.id', $request->segment(3))
            ->first();

        $activityLog = ActivityLog::create([
            'user_id' => Session('user')['id'],
            'materi_id' => $request->segment(3),
            'start_time' => Carbon::now('Asia/Jakarta'),
        ]);

        // $activityLogs = ActivityLog::

        //     // ->join('user', 'user.id', '=', 'activity_log.user_id')
        //     ->join('materi', 'materi.id', '=', 'activity_log.materi_id')
        //     ->
        //     ->select('activity_log.*', 'materi.judul')
        //     ->first();

        // dd($activityLogs);
        return view('pages.detail-materi', compact('materi', 'activityLog'));
    }

    public function logEndTime(Request $request)
    {
        // $activityLog = ActivityLog::findOrFail($request->log_id);
        // $activityLog->update([
        //     'end_time' => Carbon::now('Asia/Jakarta'),
        // ]);
        $activityLog = ActivityLog::where('activity_log.id', $request->log_id)
            // ->join('user', 'user.id', '=', 'activity_log.user_id')
            ->join('materi', 'materi.id', '=', 'activity_log.materi_id')
            ->select('activity_log.*', 'materi.judul')
            ->first();

        // $getData = ActivityLog::where('id', $request->log_id)
        //     // ->join('user', 'user.id', '=', 'activity_log.user_id')
        //     ->join('materi', 'materi.id', '=', 'activity_log.materi_id')
        //     ->select('activity_log.*', 'materi.judul as judul_materi')
        //     ->first();

        if ($activityLog) {
            $activityLog->update(['end_time' => Carbon::now('Asia/Jakarta')]);

            // Create a notification for the teacher
            // dd($activityLog);
            Notifikasi::create([
                'role' => 'Guru',
                'judul' => Session('user')['nama'] . ' selesai membaca materi',
                'deskripsi' =>  Session('user')['nama'] . ' telah selesai membaca materi : ' . $activityLog->judul . ' dari jam : ' . Carbon::parse($activityLog->created_at)->format('H:i:s A') . ' sampai ' . Carbon::parse($activityLog->end_time)->format('H:i:s A'),
                'is_seen' => 'N',
                'created_at' => Carbon::now('Asia/Jakarta'),
                'updated_at' => Carbon::now('Asia/Jakarta')
            ]);

            // $notifikasi = new Notifikasi;
            // $notifikasi->role = "Guru";
            // $notifikasi->judul = "Murid selesai membaca materi";
            // $notifikasi->is_seen = "N";
            // $notifikasi->created_at = Carbon::now();
            // $notifikasi->updated_at = Carbon::now();

            // $notifikasi->save();


            return response()->json(['message' => 'End time logged successfully']);
        }

        return response()->json(['message' => 'Log not found'], 404);



        // $logId = $request->input('log_id');
        // // Update the end time in the activity log
        // $activityLog = ActivityLog::find($logId);
        // if ($activityLog) {
        //     $activityLog->end_time = now();
        //     $activityLog->save();
        // }

        // return response()->json(['status' => 'success']);
    }

    public function create()
    {
        $lessons = Lesson::where('user_id', Session('user')['id'])->get();
        return view('pages.add-materi', compact('lessons'));
    }

    public function store(Request $request)
    {
        // Validate that the lesson belongs to the current teacher
        if ($request->lesson_id) {
            $lesson = Lesson::where('id', $request->lesson_id)
                ->where('user_id', Session('user')['id'])
                ->first();

            if (!$lesson) {
                return redirect('/admin/materi')->with('error', 'Invalid lesson selected');
            }
        }

        $materi = new Materi;
        $materi->lesson_id = $request->lesson_id;
        $materi->judul = $request->judul;
        $materi->deskripsi = $request->deskripsi;
        $materi->created_at = Carbon::now('Asia/Jakarta');
        $materi->updated_at = Carbon::now('Asia/Jakarta');

        if ($request->hasFile('gambar')) {
            $gambarName = $request->file('gambar')->getClientOriginalName();
            $request->file('gambar')->move('img/materi', $gambarName);
            $materi->gambar = $gambarName;
        }

        if ($request->hasFile('file')) {
            $fileName = $request->file('file')->getClientOriginalName();
            $request->file('file')->move('file_upload/materi', $fileName);
            $materi->file = $fileName;
        }

        if ($materi->save()) {
            $notifikasi = new Notifikasi;
            $notifikasi->role = "Murid";
            $notifikasi->judul = "Materi baru dengan judul '" . $request->judul . "' telah diunggah, yuk pelajari !!!";
            $notifikasi->is_seen = "N";
            $notifikasi->created_at = Carbon::now('Asia/Jakarta');
            $notifikasi->updated_at = Carbon::now('Asia/Jakarta');
            $notifikasi->save();

            return redirect('/admin/materi')->with('success', 'Material created successfully');
        }

        return redirect('/admin/materi')->with('error', 'Failed to create material');
    }
    public function edit(Request $request)
    {
        $materi = Materi::leftJoin('lesson', 'lesson.id', '=', 'materi.lesson_id')
            ->where('materi.id', $request->segment(3))
            ->where('lesson.user_id', Session('user')['id'])
            ->select('materi.*')
            ->first();

        if (!$materi) {
            return redirect('/admin/materi')->with('error', 'Material not found or access denied');
        }

        $lessons = Lesson::where('user_id', Session('user')['id'])->get();

        return view('pages.edit-materi', compact('materi', 'lessons'));
    }

    public function show($id)
    {
        $materi = Materi::leftJoin('lesson', 'lesson.id', '=', 'materi.lesson_id')
            ->leftJoin('user', 'user.id', '=', 'lesson.user_id')
            ->select('materi.*', 'user.nama_lengkap', 'lesson.name as lesson_name')
            ->where('materi.id', $id)
            ->where('lesson.user_id', Session('user')['id'])
            ->first();

        return view('pages.detail-materi-teacher', compact('materi'));
    }

    public function update(Request $request)
    {
        $materi = Materi::leftJoin('lesson', 'lesson.id', '=', 'materi.lesson_id')
            ->where('materi.id', $request->segment(3))
            ->where('lesson.user_id', Session('user')['id'])
            ->select('materi.*')
            ->first();

        if (!$materi) {
            return redirect('/admin/materi')->with('error', 'Material not found or access denied');
        }

        // Validate that the new lesson belongs to the current teacher
        if ($request->lesson_id) {
            $lesson = Lesson::where('id', $request->lesson_id)
                ->where('user_id', Session('user')['id'])
                ->first();

            if (!$lesson) {
                return redirect('/admin/materi')->with('error', 'Invalid lesson selected');
            }
        }

        $materi->lesson_id = $request->lesson_id;
        $materi->judul = $request->judul;
        $materi->deskripsi = $request->deskripsi;
        $materi->updated_at = Carbon::now('Asia/Jakarta');

        if ($request->hasFile('gambar')) {
            $gambarName = $request->file('gambar')->getClientOriginalName();
            $request->file('gambar')->move('img/materi', $gambarName);
            $materi->gambar = $gambarName;
        }

        if ($request->hasFile('file')) {
            $fileName = $request->file('file')->getClientOriginalName();
            $request->file('file')->move('file_upload/materi', $fileName);
            $materi->file = $fileName;
        }

        $materi->save();
        return redirect('/admin/materi')->with('success', 'Material updated successfully');
    }

    public function destroy(Request $request, $id)
    {
        $materi = Materi::leftJoin('lesson', 'lesson.id', '=', 'materi.lesson_id')
            ->where('materi.id', $id)
            ->where('lesson.user_id', Session('user')['id'])
            ->select('materi.*')
            ->first();

        if (!$materi) {
            return redirect('/admin/materi')->with('error', 'Material not found or access denied');
        }

        if ($materi->delete()) {
            return redirect('/admin/materi')->with('success', 'Material deleted successfully');
        } else {
            return redirect('/admin/materi')->with('error', 'Failed to delete material');
        }
    }
}
