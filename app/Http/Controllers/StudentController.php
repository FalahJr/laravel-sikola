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
use App\Models\Classes;
use Carbon\Carbon;

class StudentController extends Controller
{

    public function index()
    {
        $data = User::where("role", "=", "Murid")->with('class')
            ->get();

        // dd($data);
        return view('pages.list-murid', compact('data'));
    }





    public function create()
    {

        $classes = Classes::orderBy('name')->get();
        // dd($classes);
        return view('pages.add-student', compact('classes'));
    }

    public function store(Request $request)
    {
        // dd($request->all());
        if ($request) {
            if ($request->hasFile('gambar')) {

                // $getPegawaiBaru = Pegawai::orderBy('created_at', 'desc')->first();
                // $getKonfigCuti = Konfig_cuti::where('tahun',(new \DateTime())->format('Y'))->first();
                // sanitize filename: avoid emojis/special chars which can cause DB charset errors
                $uploaded = $request->file('gambar');
                $originalName = $uploaded->getClientOriginalName();
                $extension = $uploaded->getClientOriginalExtension();
                // take filename (without extension) and keep only ascii alnum, dash and underscore
                $base = pathinfo($originalName, PATHINFO_FILENAME);
                // transliterate to ASCII where possible then remove unsafe chars
                $base = @iconv('UTF-8', 'ASCII//TRANSLIT', $base) ?: $base;
                $base = preg_replace('/[^A-Za-z0-9_\-]/', '', $base);
                if (empty($base)) {
                    $base = uniqid('img_');
                }
                $fileName = time() . '_' . $base . '.' . $extension;
                $uploaded->move('img/murid', $fileName);

                $user = new User;
                $user->nama_lengkap = $request->nama_lengkap;
                $user->role = "Murid";
                $user->email = $request->email;
                $user->password = $request->password;
                $user->alamat = $request->alamat;
                $user->nomor_induk = $request->nomor_induk;
                // assign selected class from form (if provided)
                $user->class_id = $request->class_id ?? Session('user')['class_id'] ?? null;
                $user->jurusan = Session('user')['jurusan'];
                $user->gambar = $fileName;
                $user->created_at = Carbon::now();
                $user->updated_at = Carbon::now();

                $user->save();

                session()->flash('success', 'Murid berhasil ditambahkan.');
                return redirect('/admin/manage-student');



                // ->with('success', 'Berhasil membuat Materi');
            } else {
                session()->flash('error', 'Gagal menambahkan murid: file gambar tidak ditemukan.');
                return redirect('/admin/manage-student');
            }
        } else {
            return redirect('/admin/materi');
            // ->with('failed', 'Gagal membuat Materi');
        }
    }
    public function edit(Request $request)
    {
        // $data['karyawan'] = Pegawai::where([
        //     'id' => $request->segment(3)
        // ])->first();
        $murid = User::where([
            'id' => $request->segment(3)
        ])->first();

        $classes = Classes::orderBy('name')->get();

        return view('pages.edit-student', compact('murid', 'classes'));
    }

    /**
     * Display the specified Murid (detail view).
     */
    public function show($id)
    {
        $murid = User::where('id', $id)->where('role', 'Murid')->first();
        if (! $murid) {
            return redirect('/admin/manage-student')->with('error', 'Murid tidak ditemukan.');
        }
        return view('pages.detail-student', compact('murid'));
    }

    public function update(Request $request)
    {
        // dd($request->all());

        $user = User::where([
            'id' => $request->segment(3)
        ])->first();
        $user->nama_lengkap = $request->nama_lengkap;
        $user->email = $request->email;
        $user->password = $request->password;
        $user->class_id = $request->class_id ?? $user->class_id;
        $user->alamat = $request->alamat;
        $user->nomor_induk = $request->nomor_induk;
        // $user->gambar = "Tes";
        $user->created_at = Carbon::now();
        $user->updated_at = Carbon::now();
        // $karyawan->image=$request->image;

        if ($request->hasFile('gambar')) {
            $uploaded = $request->file('gambar');
            $originalName = $uploaded->getClientOriginalName();
            $extension = $uploaded->getClientOriginalExtension();
            $base = pathinfo($originalName, PATHINFO_FILENAME);
            $base = @iconv('UTF-8', 'ASCII//TRANSLIT', $base) ?: $base;
            $base = preg_replace('/[^A-Za-z0-9_\-]/', '', $base);
            if (empty($base)) {
                $base = uniqid('img_');
            }
            $fileName = time() . '_' . $base . '.' . $extension;
            $uploaded->move('img/murid', $fileName);

            $user->gambar = $fileName;
            $user->save();
            session()->flash('success', 'Data murid berhasil diperbarui.');
            return redirect('/admin/manage-student');
        } else {
            $user->save();
            session()->flash('success', 'Data murid berhasil diperbarui.');
            return redirect('/admin/manage-student');
        }
    }

    public function destroy(Request $request, $id)
    {
        $user = User::findOrFail($id);



        if ($user->delete()) {
            session()->flash('success', 'Murid berhasil dihapus.');
            return redirect('/admin/manage-student');
        } else {
            session()->flash('error', 'Gagal menghapus murid.');
            return redirect('/admin/manage-student');
        }
    }
}
