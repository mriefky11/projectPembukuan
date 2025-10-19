<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use Illuminate\Http\Request;

class ActivityController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->input('search');

        $activity = Activity::when($search, function($query, $search){
            $query->where('name','like',"%{$search}%");
        })
        ->orderBy('tanggal_mulai', 'desc')
        ->paginate(10)
        ->appends(['search' => $search]);

        return view('activity.index', compact('activity'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('activity.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:100',
            'deskripsi' => 'nullable',
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'required|date|after_or_equal:tanggal_mulai',
        ]);

        Activity::create([
            'name' => $request->name,
            'deskripsi' => $request->deskripsi,
            'tanggal_mulai' => $request->tanggal_mulai,
            'tanggal_selesai' => $request->tanggal_selesai,
        ]);

        return redirect()->route('activity.index')->with('success','Kegiatan Berhasil Ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $activity = Activity::findOrFail($id);
        return response()->json($activity);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $activity = Activity::findOrFail($id);
        return view('activity.edit', compact('activity'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $activity = Activity::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:100',
            'deskripsi' => 'nullable',
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'required|date|after_or_equal:tanggal_mulai',
        ]);

        $activity->update($request->only(['name', 'deskripsi', 'tanggal_mulai', 'tanggal_selesai']));


        return redirect()->route('activity.index')->with('success', 'Data Kegiatan Berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $activity = Activity::findOrFail($id);
        $activity->delete();

        return redirect()->route('activity.index')->with('success', 'Data Kegiatan Berhasil Dihapus.');
    }
}
