<?php

namespace App\Http\Controllers;

use App\Models\Spending;
use App\Models\Activity;
use App\Models\CategoryCost;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SpendingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $activities = Activity::all();
        $category = CategoryCost::all();

        $search = $request->input('search');

        $spending = Spending::with(['activity','user','category'])->when($search,function($query, $search){
            $query->whereHas('activity',function($q) use ($search){
                $q->where('name','like',"%{$search}%");
            })->orWhereHas('user',function($q) use($search){
                $q->where('name','like',"%{$search}%");
            });
        })
        ->orderBy('tanggal','desc')
        ->paginate(10)
        ->appends(['search'=>$search]);

        return view('spending.index',compact('spending','activities','category','search'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $activities = Activity::all();
        $categories = CategoryCost::all();
        return view('spending.create', compact('activities', 'categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'kegiatan_id' => 'required|exists:kegiatan,id',
            'kategori_id' => 'required|exists:kategori_biaya,id',
            'tanggal' => 'required|date',
            'jumlah' => 'required|numeric|min:0',
            'keterangan' => 'nullable|string|max:255',
        ]);

        Spending::create([
            'kegiatan_id' => $request->kegiatan_id,
            'kategori_id' => $request->kategori_id,
            'tanggal' => $request->tanggal,
            'jumlah' => $request->jumlah,
            'keterangan' => $request->keterangan,
            'created_by' => Auth::id(),
        ]);

        return redirect()->route('spending.index')->with('success', 'Data pengeluaran berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $spending = Spending::with(['activity','category', 'user'])->findOrFail($id);
        return response()->json($spending);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $spending = Spending::findOrFail($id);
        $activities = Activity::all();
        $categories = CategoryCost::all();

        return view('spending.edit', compact('spending', 'activities','categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $spending = Spending::findOrFail($id);

        $request->validate([
            'kegiatan_id' => 'required|exists:kegiatan,id',
            'kategori_id' => 'required|exists:kategori_biaya,id',
            'tanggal' => 'required|date',
            'jumlah' => 'required|numeric|min:0',
            'keterangan' => 'nullable|string|max:255',
        ]);

       $spending->update($request->only('kegiatan_id','kategori_id', 'tanggal', 'jumlah', 'keterangan'));

        return redirect()->route('spending.index')->with('success', 'Data pengeluaran berhasil diperbaharui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(String $id)
    {
        $spending = Spending::findOrFail($id);
        $spending->delete();
        return redirect()->route('spending.index')->with('success', 'Data pengeluaran berhasil dihapus.');
    }
}
