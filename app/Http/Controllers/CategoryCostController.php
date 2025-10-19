<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use App\Models\CategoryCost;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CategoryCostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $category = CategoryCost::orderBy('created_at', 'desc')->paginate(10);

        return view('category.index',compact('category'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('category.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_kategori' => 'required|string|max:100',
            'jenis_biaya' => 'required|in:biaya_langsung,biaya_tidak_langsung',
        ]);

        CategoryCost::create([
            'id' => Str::uuid(),
            'nama_kategori' => $request->nama_kategori,
            'jenis_biaya' => $request->jenis_biaya,
        ]);

        return redirect()->route('category.index')->with('success', 'Kategori berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(CategoryCost $categoryCost)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(CategoryCost $categoryCost)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, CategoryCost $categoryCost)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $category = CategoryCost::findOrFail($id);
        $category->delete();

        return redirect()->route('category.index')->with('success', 'Kategori berhasil dihapus!');
    }
}
