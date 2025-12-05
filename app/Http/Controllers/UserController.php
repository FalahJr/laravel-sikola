<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;
use App\Models\Materi;
use App\Models\Notifikasi;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class UserController extends Controller
{

    public function index()
    {
        $id = Session('user')['id'];


        $user = User::where("id", "=", $id)->first();

        // dd($profil);
        return view('pages.profile', compact('user'));
    }

    public function update(Request $request)
    {
        // dd($request->all());
        $user = User::where([
            'id' => $request->id
        ])->first();

        // dd($user);
        $user->nama_lengkap = $request->nama_lengkap;
        $user->email = $request->email;
        $user->nomor_induk = $request->nomor_induk;
        $user->alamat = $request->alamat;

        $user->save();

        // provide a flash message for the profile update (CUD success)
        // session()->flash('success', 'Profil berhasil diperbarui.');
        session()->flash('success', 'Profil berhasil diperbarui.');

        return view('pages.profile', compact('user'));
        // return redirect(url('/admin/profile'));



        // $newest_notifikasi = Notifikasi::where('role', '=', 'Murid')->orderBy('id', 'desc')->first();




        // dd($data);
        // return view('pages.dashboard', compact('newest_notifikasi'));
    }

    public function forgot()
    {
        return view('pages.forgot-password');
    }

    public function forgot_action(Request $request)
    {
        // dd($request->all());

        $user = User::where('email', '=', $request->email)->first();
        if ($user) {
            return view('pages.reset-password', compact('user'));
        } else {
            return view('pages.forgot-password');
        }
    }

    public function reset_action(Request $request)
    {
        // dd($request->all());
        if ($request->confirm_password == $request->password) {
            $user = User::where('email', '=', $request->email)->first();
            if ($user) {
                $user->password = $request->password;
                $user->save();


                return view('pages.login');
            } else {
                return view('pages.forgot-password');
            }
        }
    }

    /**
     * Display a listing of Guru users for admin.
     */
    public function indexGurus()
    {
        // only admins should reach this via middleware
        $data = User::where('role', 'Guru')->orderBy('nama_lengkap')->get();
        return view('pages.manage-gurus', compact('data'));
    }

    /**
     * Show form to create a Guru user.
     */
    public function createGuru()
    {
        return view('pages.add-guru');
    }

    /**
     * Store a new Guru user.
     */
    public function storeGuru(Request $request)
    {
        $request->validate([
            'nama_lengkap' => 'required|string|max:255',
            'email' => 'required|email|unique:user,email',
            'nomor_induk' => 'nullable|string',
            'password' => 'required|string|min:6|confirmed',
        ]);

        $user = new User();
        $user->nama_lengkap = $request->nama_lengkap;
        $user->email = $request->email;
        $user->nomor_induk = $request->nomor_induk;
        $user->role = 'Guru';
        $user->password = $request->password;
        $user->save();

        session()->flash('success', 'Guru berhasil ditambahkan.');
        return redirect(url('/admin/gurus'));
    }

    /**
     * Show the form for editing the specified Guru.
     */
    public function editGuru($id)
    {
        $user = User::where('id', $id)->where('role', 'Guru')->first();
        if (!$user) {
            return redirect(url('/admin/gurus'));
        }
        return view('pages.edit-guru', compact('user'));
    }

    /**
     * Display the specified Guru (detail view).
     */
    public function showGuru($id)
    {
        $user = User::where('id', $id)->where('role', 'Guru')->first();
        if (!$user) {
            return redirect(url('/admin/gurus'))->with('error', 'Guru tidak ditemukan.');
        }
        return view('pages.detail-guru', compact('user'));
    }

    /**
     * Update the specified Guru in storage.
     */
    public function updateGuru(Request $request, $id)
    {
        $user = User::where('id', $id)->where('role', 'Guru')->first();
        if (!$user) {
            return redirect(url('/admin/gurus'));
        }

        $request->validate([
            'nama_lengkap' => 'required|string|max:255',
            'email' => 'required|email|unique:user,email,' . $user->id,
            'nomor_induk' => 'nullable|string|max:100',
            'password' => 'nullable|string|min:6|confirmed',
        ]);

        $user->nama_lengkap = $request->nama_lengkap;
        $user->email = $request->email;
        $user->nomor_induk = $request->nomor_induk;
        if ($request->filled('password')) {
            $user->password = $request->password;
        }
        $user->save();

        session()->flash('success', 'Data Guru berhasil diperbarui.');
        return redirect(url('/admin/gurus'));
    }

    /**
     * Remove the specified Guru from storage.
     */
    public function destroyGuru($id)
    {
        $user = User::where('id', $id)->where('role', 'Guru')->first();
        if ($user) {
            // Delete all related data in proper order to avoid foreign key constraints

            // 1. Delete user answers through quiz attempts
            // \App\Models\UserAnswers::whereHas('quizAttempts', function ($q) use ($id) {
            //     $q->where('user_id', $id);
            // })->delete();

            // // 2. Delete quiz attempts for this user
            // \App\Models\QuizAttempts::where('user_id', $id)->delete();

            // // 3. Delete assignment submissions for this user
            // \App\Models\AssignmentSubmission::where('user_id', $id)->delete();

            // // 4. Delete lesson attendances for this user
            // \App\Models\LessonAttendance::where('user_id', $id)->delete();

            // 5. Delete activity logs for this user
            // \App\Models\ActivityLog::where('user_id', $id)->delete();

            // 6. Delete notifications for this user
            // \App\Models\Notifikasi::whereHas('user_id', $id)->delete();

            // 7. For lessons owned by this guru, we need to handle cascading deletes
            // $lessons = \App\Models\Lesson::where('user_id', $id)->get();
            // foreach ($lessons as $lesson) {
            //     // Delete lesson schedules and their attendances
            //     $lessonSchedules = \App\Models\LessonSchedule::where('lesson_id', $lesson->id)->get();
            //     foreach ($lessonSchedules as $schedule) {
            //         \App\Models\LessonAttendance::where('lesson_schedule_id', $schedule->id)->delete();
            //         $schedule->delete();
            //     }

            //     // Delete materi and their related data
            //     $materis = \App\Models\Materi::where('lesson_id', $lesson->id)->get();
            //     foreach ($materis as $materi) {
            //         // Delete assignments related to this materi
            //         $assignments = \App\Models\Assignment::where('materi_id', $materi->id)->get();
            //         foreach ($assignments as $assignment) {
            //             \App\Models\AssignmentSubmission::where('assignment_id', $assignment->id)->delete();
            //             $assignment->delete();
            //         }

            //         // Delete quizzes related to this materi
            //         $quizzes = \App\Models\Quizzes::where('materi_id', $materi->id)->get();
            //         foreach ($quizzes as $quiz) {
            //             // Delete user answers for quiz questions
            //             $questions = \App\Models\Questions::where('quizzes_id', $quiz->id)->get();
            //             foreach ($questions as $question) {
            //                 \App\Models\UserAnswers::where('question_id', $question->id)->delete();
            //                 $question->delete();
            //             }

            //             // Delete quiz attempts for this quiz
            //             \App\Models\QuizAttempts::where('quizzes_id', $quiz->id)->delete();
            //             $quiz->delete();
            //         }

            //         // Delete activity logs for this materi
            //         \App\Models\ActivityLog::where('materi_id', $materi->id)->delete();

            //         // Delete the materi itself
            //         $materi->delete();
            //     }

            //     // Delete the lesson
            //     $lesson->delete();
            // }

            // 8. Finally, delete the user
            $user->delete();

            session()->flash('success', 'Guru dan semua data terkaitnya berhasil dihapus.');
        } else {
            session()->flash('error', 'Guru tidak ditemukan.');
        }
        return redirect(url('/admin/gurus'));
    }
}
