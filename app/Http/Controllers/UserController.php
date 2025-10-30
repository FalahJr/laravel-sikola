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
        session()->flash('success', 'Profil berhasil diperbarui.');
        return view('pages.profile', compact('user'));


        // $newest_notifikasi = Notifikasi::where('role', '=', 'Murid')->orderBy('id', 'desc')->first();




        // dd($data);
        return view('pages.dashboard', compact('newest_notifikasi'));
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
        $user->password = Hash::make($request->password);
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
            $user->password = Hash::make($request->password);
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
            $user->delete();
            session()->flash('success', 'Guru berhasil dihapus.');
        }
        return redirect(url('/admin/gurus'));
    }
}
