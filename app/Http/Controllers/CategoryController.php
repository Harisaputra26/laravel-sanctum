<?php

namespace App\Http\Controllers;

// Import model Category
use App\Models\Category;
// Import class Request untuk memproses input dari user
use Illuminate\Http\Request;

// Deklarasi class controller untuk mengatur logika terkait Category
class CategoryController extends Controller
{
    // Fungsi index: Mengembalikan semua data kategori dalam format JSON
    public function index()
    {
        // Mengambil semua data kategori dari database dan mengirimnya dalam format JSON
        return response()->json(Category::all());
    }

    // Fungsi store: Menyimpan data kategori baru
    public function store(Request $request)
    {
        // Validasi input dari user (wajib ada `name` dengan format string, maksimal 255 karakter)
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        // Membuat kategori baru menggunakan data input dari request
        $category = Category::create($request->all());

        // Mengembalikan response dalam format JSON dengan kode status 201 (Created)
        return response()->json($category, 201);
    }

    // Fungsi show: Menampilkan detail satu kategori berdasarkan ID
    public function show(Category $category)
    {
        // Mengembalikan data kategori yang diminta dalam format JSON
        return response()->json($category);
    }

    // Fungsi update: Memperbarui data kategori
    public function update(Request $request, Category $category)
    {
        // Validasi input (wajib ada `name` dengan format string, maksimal 255 karakter)
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        // Memperbarui data kategori berdasarkan input dari request
        $category->update($request->all());

        // Mengembalikan data kategori yang telah diperbarui dalam format JSON
        return response()->json($category);
    }

    // Fungsi destroy: Menghapus kategori berdasarkan ID
    public function destroy(Category $category)
    {
        // Menghapus data kategori dari database
        $category->delete();

        // Mengembalikan response JSON tanpa data (null) dengan status kode 204 (No Content)
        return response()->json(null, 204);
    }
}
