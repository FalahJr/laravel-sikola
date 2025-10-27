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
        if ($request) {
            $class = new Classes;
            $class->name = $request->name;
            $class->created_at = Carbon::now();
            $class->updated_at = Carbon::now();

            if ($class->save()) {
                return redirect('/admin/classes');
            }
            return redirect('/admin/classes');
        } else {
            return redirect('/admin/classes');
        }
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
        $class = Classes::where([
            'id' => $request->segment(3)
        ])->first();

        $class->name = $request->name;
        $class->updated_at = Carbon::now();

        if ($class->save()) {
            return redirect('/admin/classes');
        } else {
            return redirect('/admin/classes');
        }
    }

    /**
     * Remove the specified class from storage.
     */
    public function destroy(Request $request, $id)
    {
        $class = Classes::findOrFail($id);

        if ($class->delete()) {
            return redirect('/admin/classes');
        } else {
            return redirect('/admin/classes');
        }
    }
}
