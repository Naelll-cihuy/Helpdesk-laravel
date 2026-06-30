<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::all();

        return view('categories.index', compact('categories'));
    }

    public function create()
    {
        return view('categories.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_kategori' => 'required|unique:categories,nama_kategori',
            'kode_kategori' => 'required|max:3|unique:categories,kode_kategori'
        ]);

        Category::create([
            'nama_kategori' => $request->nama_kategori,
            'kode_kategori' => strtoupper($request->kode_kategori)
        ]);

        return redirect()
            ->route('categories.index')
            ->with('success', 'Kategori berhasil ditambahkan');
    }

    public function show(Category $category)
    {
        //
    }

    public function edit(Category $category)
    {
        return view('categories.edit', compact('category'));
    }

    public function update(Request $request, Category $category)
    {
        $request->validate([
            'nama_kategori' => 'required|unique:categories,nama_kategori,' . $category->id,
            'kode_kategori' => 'required|max:3|unique:categories,kode_kategori,' . $category->id
        ]);

        $category->update([
            'nama_kategori' => $request->nama_kategori,
            'kode_kategori' => strtoupper($request->kode_kategori)
        ]);

        return redirect()
            ->route('categories.index')
            ->with('success', 'Kategori berhasil diupdate');
    }

    public function destroy(Category $category)
    {
        $category->delete();

        return redirect()
            ->route('categories.index')
            ->with('success', 'Kategori berhasil dihapus');
    }
}
