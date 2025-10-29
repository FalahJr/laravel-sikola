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
                $fileName = $request->file('gambar')->getClientOriginalName();
                $request->file('gambar')->move('img/murid', $fileName);

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

                return redirect('/admin/manage-student');



                // ->with('success', 'Berhasil membuat Materi');
            } else {
                return redirect('/admin/manage-student');
                // ->with('failed', 'Gagal membuat Materi');
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
            $fileName = $request->file('gambar')->getClientOriginalName();
            $request->file('gambar')->move('img/murid', $fileName);

            $user->gambar = $fileName;
            $user->save();
            return redirect('/admin/manage-student');
        } else {
            $user->save();
            return redirect('/admin/manage-student');
        }
    }

    public function destroy(Request $request, $id)
    {
        $user = User::findOrFail($id);



        if ($user->delete()) {
            return redirect('/admin/manage-student');
        } else {
            return redirect('/admin/manage-student');
        }
    }
}
