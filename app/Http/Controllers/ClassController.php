<?php

namespace App\Http\Controllers;

use App\Models\Classes;
use Illuminate\Http\Request;
use Carbon\Carbon;

class ClassController extends Controller
{
    /**
     * Display a listing of the classes.
     */
    public function index()
    {
        $data = Classes::orderBy('created_at', 'desc')->get();
        return view('pages.manage-classes', compact('data'));
    }

    /**
     * Show the form for creating a new class.
     */
    public function create()
    {
        return view('pages.add-class');
    }

    /**
     * Store a newly created class in storage.
     */
    public function store(Request $request)
    {
        // normalize input
        $request->merge(['name' => trim($request->name ?? '')]);

        // validate name is required and unique in the class table (messages in Indonesian)
        $request->validate([
            'name' => 'required|string|max:255|unique:class,name',
        ], [
            'name.required' => 'Nama kelas wajib diisi.',
            'name.unique' => 'Nama kelas sudah digunakan.',
            'name.max' => 'Nama kelas maksimal :max karakter.',
        ]);

        $class = new Classes;
        $class->name = $request->name;
        $class->created_at = Carbon::now();
        $class->updated_at = Carbon::now();

        if ($class->save()) {
            return redirect('/admin/classes')->with('success', 'Kelas berhasil dibuat');
        }
        return redirect('/admin/classes')->with('error', 'Gagal membuat kelas');
    }

    /**
     * Display the specified class.
     */
    public function show(Request $request)
    {
        $class = Classes::where([
            'id' => $request->segment(3)
        ])->first();

        return view('pages.detail-class', compact('class'));
    }

    /**
     * Show the form for editing the specified class.
     */
    public function edit(Request $request)
    {
        $class = Classes::where([
            'id' => $request->segment(3)
        ])->first();

        return view('pages.edit-class', compact('class'));
    }

    /**
     * Update the specified class in storage.
     */
    public function update(Request $request)
    {
        $id = $request->segment(3);
        $class = Classes::where([
            'id' => $id
        ])->first();

        // normalize input
        $request->merge(['name' => trim($request->name ?? '')]);

        // validate name is required and unique except for current record (messages in Indonesian)
        $request->validate([
            'name' => 'required|string|max:255|unique:class,name,' . $id,
        ], [
            'name.required' => 'Nama kelas wajib diisi.',
            'name.unique' => 'Nama kelas sudah digunakan.',
            'name.max' => 'Nama kelas maksimal :max karakter.',
        ]);

        $class->name = $request->name;
        $class->updated_at = Carbon::now();

        if ($class->save()) {
            return redirect('/admin/classes')->with('success', 'Kelas berhasil diperbarui');
        } else {
            return redirect('/admin/classes')->with('error', 'Gagal memperbarui kelas');
        }
    }

    /**
     * Remove the specified class from storage.
     */
    public function destroy(Request $request, $id)
    {
        $class = Classes::findOrFail($id);

        if ($class->delete()) {
            return redirect('/admin/classes')->with('success', 'Kelas berhasil dihapus');
        } else {
            return redirect('/admin/classes')->with('error', 'Gagal menghapus kelas');
        }
    }
}
