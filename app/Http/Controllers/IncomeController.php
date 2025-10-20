<?php

namespace App\Http\Controllers;

use App\Models\Income;
use App\Models\Activity;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IncomeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->input('search');

        $incomes = Income::with(['activity', 'user'])
            ->when($search, function ($query, $search) {
                $query->whereHas('activity', function ($q) use ($search) {
                    $q->where('name', 'like', "%{$search}%");
                })
                ->orWhereHas('user', function ($q) use ($search) {
                    $q->where('name', 'like', "%{$search}%");
                });
            })
            ->orderBy('tanggal', 'desc')
            ->paginate(10)
            ->appends(['search' => $search]);

        $activities = Activity::all();

        return view('income.index', compact('incomes', 'activities', 'search'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $activities = Activity::all();
        return view('income.create', compact('activities'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'kegiatan_id' => 'required|exists:kegiatan,id',
            'tanggal' => 'required|date',
            'jumlah' => 'required|numeric|min:0',
            'keterangan' => 'nullable|string|max:255',
        ]);

        Income::create([
            'kegiatan_id' => $request->kegiatan_id,
            'tanggal' => $request->tanggal,
            'jumlah' => $request->jumlah,
            'keterangan' => $request->keterangan,
            'created_by' => Auth::id(),
        ]);

        return redirect()->route('income.index')->with('success', 'Data pemasukan berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $income = Income::with(['activity', 'user'])->findOrFail($id);
        return response()->json($income);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $income = Income::findOrFail($id);
        $activities = Activity::all();
        return view('income.edit', compact('income', 'activities'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $income = Income::findOrFail($id);

        $request->validate([
            'kegiatan_id' => 'required|exists:kegiatan,id',
            'tanggal' => 'required|date',
            'jumlah' => 'required|numeric|min:0',
            'keterangan' => 'nullable|string|max:255',
        ]);

        $income->update($request->only('kegiatan_id', 'tanggal', 'jumlah', 'keterangan'));

        return redirect()->route('income.index')->with('success', 'Data pemasukan berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $income = Income::findOrFail($id);
        $income->delete();
        return redirect()->route('income.index')->with('success', 'Data pemasukan berhasil dihapus.');
    }
}
