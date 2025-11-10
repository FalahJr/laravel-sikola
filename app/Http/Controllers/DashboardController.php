<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;
use App\models\Admin;
use App\Models\Materi;
use App\Models\Notifikasi;
use App\Models\QuizAttempts;
use App\Models\Quizzes;
use App\Models\User;
use App\Models\LessonSchedule;
use App\Models\Classes;
use App\Models\Lesson;
use App\Models\Assignment;
use Carbon\Carbon;

class DashboardController extends Controller
{

    public function index()
    {
        return view('pages.dashboard-guru');
    }

    public function indexDashboardMurid()
    {
        $newest_notifikasi = Notifikasi::where('role', '=', 'Murid')->orderBy('id', 'desc')->first();
        $get_new_materi = Materi::latest()->first();
        $get_new_quiz = [];
        // Ambil jadwal pelajaran untuk murid berdasarkan class_id milik murid
        $classId = Session('user')['class_id'] ?? null;
        if ($classId) {
            $lessonSchedules = LessonSchedule::with('lesson')
                ->where('class_id', $classId)
                ->orderBy('day')
                ->orderBy('start_time')
                ->get();
        } else {
            $lessonSchedules = collect();
        }

        // if ($get_new_quiz !== null) {
        //     $list_leaderboard = QuizAttempts::join('user', 'user.id',  '=', 'quiz_attempts.user_id')->where("quizzes_id", "=", $get_new_quiz->id)->select('quiz_attempts.*', 'user.nama_lengkap')->get();
        // } else {
        //     $get_newest_quiz = Quizzes::orderBy('id', 'desc')->first();
        //     $list_leaderboard = QuizAttempts::join('user', 'user.id',  '=', 'quiz_attempts.user_id')->where("quizzes_id", "=", $get_newest_quiz->id)->select('quiz_attempts.*', 'user.nama_lengkap')->get();
        // }
        // dd($list_leaderboard);



        // Statistik untuk murid
        $studentsInClass = 0;
        $totalLessons = Lesson::count();
        $totalMaterials = Materi::count();
        // $lessonsForClass = 0;

        if ($classId) {
            $studentsInClass = User::where('role', '=', 'Murid')->where('class_id', $classId)->count();
            // Hitung jumlah mata pelajaran yang dijadwalkan untuk kelas ini (unique lesson_id di lesson_schedules)
            $lessonsForClass = LessonSchedule::where('class_id', $classId)->distinct()->count('lesson_id');
        }

        return view('pages.dashboard', compact(
            'newest_notifikasi',
            'lessonSchedules',
            'studentsInClass',
            'totalLessons',
            'totalMaterials',
            // 'lessonsForClass'
        ));
    }
    public function indexDashboardGuru()
    {
        $newest_notifikasi = Notifikasi::where('role', '=', 'Murid')->orderBy('id', 'desc')->first();
        $get_new_materi = Materi::latest()->first();
        // $get_new_quiz = Quizzes::where("materi_id", "=", $get_new_materi->id)->first();
        $get_new_quiz = [];

        // if ($get_new_quiz !== null) {
        //     $list_leaderboard = QuizAttempts::join('user', 'user.id',  '=', 'quiz_attempts.user_id')->where("quizzes_id", "=", $get_new_quiz->id)->select('quiz_attempts.*', 'user.nama_lengkap')->get();
        // } else {
        //     $get_newest_quiz = Quizzes::orderBy('id', 'desc')->first();
        //     $list_leaderboard = QuizAttempts::join('user', 'user.id',  '=', 'quiz_attempts.user_id')->where("quizzes_id", "=", $get_newest_quiz->id)->select('quiz_attempts.*', 'user.nama_lengkap')->get();
        // }
        $listMurid = User::where('role', '=', 'Murid')->where('class_id', '=', Session('user')['class_id'])->limit('4')->get();

        // Hitung statistik untuk guru saat ini
        $guruId = Session('user')['id'] ?? null;

        // Jumlah semua murid (global)
        $totalMurid = User::where('role', '=', 'Murid')->count();

        // Jumlah mata pelajaran yang dimiliki guru ini
        $lessonCount = Lesson::where('user_id', $guruId)->count();

        // Jumlah materi yang berelasi dengan lesson milik guru ini
        $materiCount = Materi::whereHas('lesson', function ($q) use ($guruId) {
            $q->where('user_id', $guruId);
        })->count();

        // Jumlah assignment yang terkait ke materi->lesson.user_id == guruId
        $assignmentCount = Assignment::whereHas('materi', function ($q) use ($guruId) {
            $q->whereHas('lesson', function ($q2) use ($guruId) {
                $q2->where('user_id', $guruId);
            });
        })->count();

        // dd($get_new_materi->id);



        // dd($data);
        // return view('pages.dashboard-guru', compact('newest_notifikasi', 'list_leaderboard', 'listMurid'));
        return view('pages.dashboard-guru', compact(
            'newest_notifikasi',
            'listMurid',
            'totalMurid',
            'lessonCount',
            'materiCount',
            'assignmentCount'
        ));
    }

    public function indexDashboardAdmin()
    {
        $newest_notifikasi = Notifikasi::where('role', '=', 'Murid')->orderBy('id', 'desc')->first();
        $get_new_materi = Materi::latest()->first();
        // $get_new_quiz = Quizzes::where("materi_id", "=", $get_new_materi->id)->first();
        $get_new_quiz = [];

        // if ($get_new_quiz !== null) {
        //     $list_leaderboard = QuizAttempts::join('user', 'user.id',  '=', 'quiz_attempts.user_id')->where("quizzes_id", "=", $get_new_quiz->id)->select('quiz_attempts.*', 'user.nama_lengkap')->get();
        // } else {
        //     $get_newest_quiz = Quizzes::orderBy('id', 'desc')->first();
        //     $list_leaderboard = QuizAttempts::join('user', 'user.id',  '=', 'quiz_attempts.user_id')->where("quizzes_id", "=", $get_newest_quiz->id)->select('quiz_attempts.*', 'user.nama_lengkap')->get();
        // }
        $listMurid = User::where('role', '=', 'Murid')->where('class_id', '=', Session('user')['class_id'])->limit('4')->get();

        // Hitung statistik untuk dashboard admin
        $guruCount = User::where('role', '=', 'Guru')->count();
        $muridCount = User::where('role', '=', 'Murid')->count();
        $kelasCount = Classes::count();
        $mataPelajaranCount = Lesson::count();
        $tugasCount = Assignment::count();

        // dd($get_new_materi->id);



        // dd($data);
        // return view('pages.dashboard-guru', compact('newest_notifikasi', 'list_leaderboard', 'listMurid'));
        return view('pages.dashboard-admin', compact(
            'newest_notifikasi',
            'listMurid',
            'guruCount',
            'muridCount',
            'kelasCount',
            'mataPelajaranCount',
            'tugasCount'
        ));
    }
}
