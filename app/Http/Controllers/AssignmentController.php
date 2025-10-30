<?php

namespace App\Http\Controllers;

use App\Models\ActivityLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;
use App\models\Admin;
use App\Models\Assignment;
use App\Models\AssignmentSubmission;
use App\Models\Materi;
use App\Models\Notifikasi;
use App\Models\Quizzes;
use App\Models\User;
use Carbon\Carbon;

class AssignmentController extends Controller
{
    public function index()
    {
        $data = Assignment::orderBy('id', 'desc')->get();
        return view('pages.assignment-guru', compact('data'));
    }

    public function indexAssignmentMurid()
    {
        $data = Assignment::join('materi', 'materi.id', '=', 'assignment.materi_id')
            ->select('assignment.*', 'materi.judul as judul_materi')
            ->get();
        return view('pages.assignment', compact('data'));
    }

    public function create()
    {
        $materi = Materi::all();
        return view('pages.add-assignment', compact('materi'));
    }

    public function store(Request $request)
    {
        // Create new assignment regardless of whether files are uploaded.
        $assignment = new Assignment();
        $assignment->judul = $request->judul;
        $assignment->materi_id = $request->materi_id;
        $assignment->deskripsi = $request->deskripsi;
        $assignment->start_date = $request->start_date;
        $assignment->end_date = $request->end_date;

        // Handle optional gambar upload
        if ($request->hasFile('gambar')) {
            $originalGambar = $request->file('gambar')->getClientOriginalName();
            $safeGambar = @iconv('UTF-8', 'ASCII//TRANSLIT', pathinfo($originalGambar, PATHINFO_FILENAME)) ?: pathinfo($originalGambar, PATHINFO_FILENAME);
            $safeGambar = preg_replace('/[^A-Za-z0-9_\-]/', '_', $safeGambar);
            if (empty($safeGambar)) {
                $safeGambar = uniqid('img_');
            }
            $extGambar = $request->file('gambar')->getClientOriginalExtension();
            $fileGambarName = time() . '_' . $safeGambar . '.' . $extGambar;
            $request->file('gambar')->move('img/assignment', $fileGambarName);
            $assignment->gambar = $fileGambarName;
        }

        // Handle optional file upload
        if ($request->hasFile('file')) {
            $originalFile = $request->file('file')->getClientOriginalName();
            $safeFile = @iconv('UTF-8', 'ASCII//TRANSLIT', pathinfo($originalFile, PATHINFO_FILENAME)) ?: pathinfo($originalFile, PATHINFO_FILENAME);
            $safeFile = preg_replace('/[^A-Za-z0-9_\-]/', '_', $safeFile);
            if (empty($safeFile)) {
                $safeFile = uniqid('file_');
            }
            $fileExt = $request->file('file')->getClientOriginalExtension();
            $fileName = time() . '_' . $safeFile . '.' . $fileExt;
            $request->file('file')->move('file_upload/assignment', $fileName);
            $assignment->file = $fileName;
        }

        $assignment->created_at = Carbon::now();
        $assignment->updated_at = Carbon::now();
        $assignment->save();

        if (Session('user')['role'] == 'Guru') {
            return redirect('/teacher/assignment')->with('success', 'Tugas berhasil dibuat');
        } else {
            return redirect('/admin/assignment')->with('success', 'Tugas berhasil dibuat');
        }
    }

    public function edit(Request $request)
    {
        if (Session('user')['role'] == 'Guru') {
            $assignment = Assignment::where('id', $request->segment(3))->first();
            $materi = Materi::all();
            return view('pages.edit-assignment', compact('assignment', 'materi'));
        } elseif (Session('user')['role'] == 'Admin') {
            $assignment = Assignment::where('id', $request->segment(3))->with('materi')->first();
            $materi = Materi::all();

            return view('pages.edit-assignment', compact('assignment', 'materi'));
        }
        $assignment = Assignment::where('id', $request->segment(4))->with('materi')->first();
        return view('pages.detail-assignment', compact('assignment'));
    }

    public function viewSubmissions($id)
    {
        $murid = User::where('role', '=', 'Murid')->get();
        $data = [];
        foreach ($murid as $list_murid) {
            $cek = AssignmentSubmission::where('assignment_id', $id)->where('user_id', $list_murid->id)->first();
            $data[] = [
                'nama_lengkap' => $list_murid->nama_lengkap,
                'status' => $cek ? $cek->status : 'Belum Mengumpulkan',
                'tgl_submit' => $cek ? Carbon::parse($cek->created_at) : null,
                'file' => $cek ? $cek->file : null,
            ];
        }
        return view('pages.view-submissions', compact('data'));
    }

    public function update(Request $request)
    {
        $assignment = Assignment::where('id', $request->segment(3))->first();
        $assignment->judul = $request->judul;
        $assignment->materi_id = $request->materi_id;
        $assignment->deskripsi = $request->deskripsi;
        $assignment->start_date = $request->start_date;
        $assignment->end_date = $request->end_date;

        // Optional gambar
        if ($request->hasFile('gambar')) {
            $originalGambar = $request->file('gambar')->getClientOriginalName();
            $safeGambar = @iconv('UTF-8', 'ASCII//TRANSLIT', pathinfo($originalGambar, PATHINFO_FILENAME)) ?: pathinfo($originalGambar, PATHINFO_FILENAME);
            $safeGambar = preg_replace('/[^A-Za-z0-9_\-]/', '_', $safeGambar);
            if (empty($safeGambar)) {
                $safeGambar = uniqid('img_');
            }
            $extGambar = $request->file('gambar')->getClientOriginalExtension();
            $fileGambarName = time() . '_' . $safeGambar . '.' . $extGambar;
            $request->file('gambar')->move('img/assignment', $fileGambarName);
            $assignment->gambar = $fileGambarName;
        }

        // Optional file
        if ($request->hasFile('file')) {
            $originalFile = $request->file('file')->getClientOriginalName();
            $safeFile = @iconv('UTF-8', 'ASCII//TRANSLIT', pathinfo($originalFile, PATHINFO_FILENAME)) ?: pathinfo($originalFile, PATHINFO_FILENAME);
            $safeFile = preg_replace('/[^A-Za-z0-9_\-]/', '_', $safeFile);
            if (empty($safeFile)) {
                $safeFile = uniqid('file_');
            }
            $fileExt = $request->file('file')->getClientOriginalExtension();
            $fileName = time() . '_' . $safeFile . '.' . $fileExt;
            $request->file('file')->move('file_upload/assignment', $fileName);
            $assignment->file = $fileName;
        }

        $assignment->updated_at = Carbon::now();
        $assignment->save();

        if (Session('user')['role'] == 'Guru') {
            return redirect('/teacher/assignment')->with('success', 'Tugas berhasil diperbarui');
        } else {
            return redirect('/admin/assignment')->with('success', 'Tugas berhasil diperbarui');
        }
    }

    public function destroy(Request $request, $id)
    {
        $getAssignmentSubmission = AssignmentSubmission::where('assignment_id', $id)->get();
        if ($getAssignmentSubmission) {
            AssignmentSubmission::where('assignment_id', $id)->delete();
        }
        Assignment::where('id', $id)->delete();
        return redirect('/admin/assignment')->with('success', 'Tugas berhasil dihapus');
    }

    public function submitSubmission(Request $request, $id)
    {
        if ($request->hasFile('file')) {
            $originalFile = $request->file('file')->getClientOriginalName();
            $safeFile = @iconv('UTF-8', 'ASCII//TRANSLIT', pathinfo($originalFile, PATHINFO_FILENAME)) ?: pathinfo($originalFile, PATHINFO_FILENAME);
            $safeFile = preg_replace('/[^A-Za-z0-9_\-]/', '_', $safeFile);
            if (empty($safeFile)) {
                $safeFile = uniqid('submission_');
            }
            $fileExt = $request->file('file')->getClientOriginalExtension();
            $file = time() . '_' . $safeFile . '.' . $fileExt;
            $request->file('file')->move('file_upload/submission/', $file);

            $assignment = Assignment::findOrFail($id);
            $currentDateTime = Carbon::now();
            $endTime = Carbon::parse($assignment->end_date);
            $status = $currentDateTime->lessThanOrEqualTo($endTime) ? 'Sudah Mengumpulkan' : 'Terlambat';

            $submission = new AssignmentSubmission();
            $submission->user_id = Session('user')['id'];
            $submission->assignment_id = $id;
            $submission->file = $file;
            $submission->status = $status;
            $submission->save();

            return redirect('/student/assignment/submission/' . $id)->with('success', 'Berhasil mengumpulkan tugas (' . $status . ')');
        }
        return redirect('/student/assignment/submission/' . $id)->with('error', 'Gagal mengumpulkan tugas');
    }
}
