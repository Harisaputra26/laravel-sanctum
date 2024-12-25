<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProdukController extends Controller
{
    // Method untuk menampilkan daftar produk
    public function index()
    {
        // Mengambil semua data produk dari database
        $products = Product::all();  
        // Mengirim data produk ke view 'products.index'
        return view('products.index', compact('products'));
    }

    // Method untuk menampilkan form create produk
    public function create()
    {
        // Menampilkan view untuk membuat produk baru
        return view('products.create');
    }

    // Method untuk menyimpan produk baru ke database
    public function store(Request $request)
    {
        // Validasi input yang dikirimkan oleh pengguna
        $validated = $request->validate([
            'name' => 'required|string|max:255', // Nama produk harus ada dan berupa string maksimal 255 karakter
            'description' => 'required|string', // Deskripsi produk harus ada dan berupa string
            'price' => 'required|numeric', // Harga produk harus ada dan berupa angka
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Gambar opsional, harus berupa file gambar dengan ukuran maksimal 2MB
        ]);

        // Jika ada file gambar yang diupload
        if ($request->hasFile('image')) {
            // Simpan gambar ke folder 'products' di storage public dan dapatkan path-nya
            $imagePath = $request->file('image')->store('products', 'public');
            $validated['image'] = $imagePath; // Menambahkan path gambar ke data yang akan disimpan
        }

        // Membuat produk baru dengan data yang telah divalidasi
        Product::create($validated);

        // Redirect ke halaman daftar produk dengan pesan sukses
        return redirect()->route('products.index')->with('success', 'Product created successfully');
    }

    // Method untuk menampilkan form edit produk
    public function edit(Product $product)
    {
        // Menampilkan view untuk mengedit produk dengan membawa data produk yang akan diubah
        return view('products.edit', compact('product'));
    }

    // Method untuk memperbarui produk yang ada
    public function update(Request $request, Product $product)
    {
        // Validasi input yang dikirimkan oleh pengguna
        $validated = $request->validate([
            'name' => 'required|string|max:255', // Nama produk harus ada dan berupa string maksimal 255 karakter
            'description' => 'required|string', // Deskripsi produk harus ada dan berupa string
            'price' => 'required|numeric', // Harga produk harus ada dan berupa angka
        ]);

        // Memperbarui data produk dengan data yang telah divalidasi
        $product->update($validated);

        // Redirect ke halaman daftar produk dengan pesan sukses
        return redirect()->route('products.index')->with('success', 'Product updated successfully');
    }

    // Method untuk menghapus produk
    public function destroy(Product $product)
    {
        // Menghapus produk dari database
        $product->delete();

        // Redirect ke halaman daftar produk dengan pesan sukses
        return redirect()->route('products.index')->with('success', 'Product deleted successfully');
    }

    // Method untuk menampilkan detail produk
    public function show(Product $product)
    {
        // Menampilkan view untuk menampilkan detail produk
        return view('products.show', compact('product'));
    }
}
