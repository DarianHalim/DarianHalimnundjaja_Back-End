<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Category;

class BarangController extends Controller
{
    public function getCreatePage()
    {
        $categories = Category::all();
        return view('adminCreate', ['categories' => $categories]);
    }

    public function createBarang(Request $request)
    {
        $request->validate([
            'namaBarang' => 'required|string|max:255',
            'hargaBarang' => 'required|integer',
            'jumlahBarang' => 'required|integer',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048', // Image validation
            'category_id' => 'required|exists:categories,id', // Validate untuk category_id
        ]);

        // Upload image
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $extension = $image->getClientOriginalExtension();
            $fileName = $request->namaBarang . '_' . time() . '.' . $extension; // Name image for DB
            $image->storeAs('public/images', $fileName); // simpen image
        } else {
            $fileName = null; // No image
        }

        Barang::create([
            'namaBarang' => $request->namaBarang,
            'hargaBarang' => $request->hargaBarang,
            'jumlahBarang' => $request->jumlahBarang,
            'image' => $fileName, // Save image to DB
            'category_id' => $request->category_id,
        ]);

        return redirect(route('getBarang'))->with('success', 'Barang Berhasil Dibuat!');
    }

    public function getBarang()
    {
        $barang = Barang::all();
        $categories = Category::all(); // ambil categories for other views
        return view('viewBarangPage', compact('barang', 'categories'));
    }

    public function getKatalog()
    {
        $barang = Barang::all();
        $categories = Category::all(); // Fetch categories for the catalog view
        return view('userViewBarang', compact('barang', 'categories'));
    }

    public function getBarangById($id)
    {
        $barang = Barang::find($id);
        $categories = Category::all();
        return view('editBarang', compact('barang', 'categories'));
    }

    public function updateBarang(Request $request, $id)
    {
        $request->validate([
            'namaBarang' => 'required|string|max:255',
            'hargaBarang' => 'required|integer',
            'jumlahBarang' => 'required|integer',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048', // validasi for image
            'category_id' => 'required|exists:categories,id', 
        ]);

        $barang = Barang::find($id);

        // Handle image upload
        if ($request->hasFile('image')) {
            // Delete old image if it exists
            if ($barang->image) {
                Storage::disk('public')->delete('images/' . $barang->image);
            }

            $image = $request->file('image');
            $extension = $image->getClientOriginalExtension();
            $fileName = $request->namaBarang . '_' . time() . '.' . $extension; // nama ulang image file
            $image->storeAs('public/images', $fileName); // Save image
        } else {
            // Keep old image if no new image is uploaded
            $fileName = $barang->image;
        }

        $barang->update([
            'namaBarang' => $request->namaBarang,
            'hargaBarang' => $request->hargaBarang,
            'jumlahBarang' => $request->jumlahBarang,
            'image' => $fileName, // Update image field
            'category_id' => $request->category_id,
        ]);

        return redirect(route('getBarang'))->with('success', 'Barang Berhasil Diupdate!');
    }

    public function deleteBarang($id)
    {
        $barang = Barang::find($id);

        // Hapus image kl exist
        if ($barang->image) {
            Storage::disk('public')->delete('images/' . $barang->image);
        }

        $barang->delete(); // Hapus dari DB

        return redirect(route('getBarang'))->with('success', 'Barang Berhasil Dihapus!');
    }
}
