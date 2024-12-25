<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    // Method untuk menampilkan daftar semua produk beserta kategori terkait
    public function index()
    {
        // Mengambil semua data produk beserta kategori terkait menggunakan eager loading
        return response()->json(Product::with('category')->get());
    }

    // Method untuk menyimpan produk baru
    public function store(Request $request)
    {
        // Validasi input dari pengguna
        $request->validate([
            'name' => 'required|string|max:255', // Nama produk harus ada dan berupa string maksimal 255 karakter
            'price' => 'required|numeric', // Harga produk harus ada dan berupa angka
            'category_id' => 'required|exists:categories,id', // category_id harus valid, yakni ID yang ada pada tabel categories
            'image' => 'required|image', // Gambar harus ada dan berupa file gambar
        ]);

        // Menyimpan file gambar yang diupload dan mendapatkan path-nya
        $imagePath = $request->file('image')->store('images', 'public');

        // Membuat produk baru dan menyimpannya ke database
        $product = Product::create([
            'name' => $request->name, // Nama produk
            'price' => $request->price, // Harga produk
            'category_id' => $request->category_id, // ID kategori produk
            'image' => $imagePath, // Path gambar produk yang baru disimpan
        ]);

        // Mengembalikan response dalam format JSON dengan status 201 (Created)
        return response()->json($product, 201);
    }

    // Method untuk menampilkan detail produk tertentu beserta kategori terkait
    public function show(Product $product)
    {
        // Menggunakan eager loading untuk memuat data kategori terkait produk
        return response()->json($product->load('category'));
    }

    // Method untuk memperbarui data produk yang sudah ada
    public function update(Request $request, Product $product)
    {
        // Validasi input dari pengguna untuk update produk
        $request->validate([
            'name' => 'string|max:255', // Nama produk harus berupa string maksimal 255 karakter jika ada perubahan
            'price' => 'numeric', // Harga produk harus berupa angka jika ada perubahan
            'category_id' => 'exists:categories,id', // ID kategori yang valid jika ada perubahan
            'image' => 'image', // Gambar harus berupa file gambar jika ada perubahan
        ]);

        // Mengecek jika ada file gambar baru yang diupload
        if ($request->hasFile('image')) {
            // Menyimpan gambar baru dan mendapatkan path-nya
            $imagePath = $request->file('image')->store('images', 'public');
            // Mengupdate path gambar produk
            $product->image = $imagePath;
        }

        // Memperbarui data produk dengan data yang dikirimkan dari request
        $product->update($request->only(['name', 'price', 'category_id', 'image']));

        // Mengembalikan response produk yang telah diperbarui dalam format JSON
        return response()->json($product);
    }

    // Method untuk menghapus produk
    public function destroy(Product $product)
    {
        // Menghapus produk dari database
        $product->delete();

        // Mengembalikan response dengan status 204 (No Content) setelah berhasil dihapus
        return response()->json(null, 204);
    }
}
