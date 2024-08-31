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
        return view('adminCreate',['categories' => $categories]);
    }

    public function createBarang(Request $request)
    {
        $request->validate([
            'namaBarang' => 'required|string|max:255',
            'hargaBarang' => 'required|string|max:255',
            'jumlahBarang' => 'required|integer',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048', // validasi format img
        ]);
    
        // uplod gambar
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $extension = $image->getClientOriginalExtension();
            $fileName = $request->namaBarang.'_'.time().'.'.$extension; // beri nama imej di DB
            $image->storeAs('public/images', $fileName); // simpan Imej
        } else {
            $fileName = null; // takeda gambar
        }
    
        Barang::create([
            'namaBarang' => $request->namaBarang,
            'hargaBarang' => $request->hargaBarang,
            'jumlahBarang' => $request->jumlahBarang,
            'image' => $fileName, // simpan imej ke DB
            'category_id' => $request->category_id,
        ]);
    
        return redirect(route('getBarang'))->with('success', 'Barang Berhasil Dibuat!');
    }

    public function getBarang()
    {

        $barang = Barang::all();
        $categories = Category::with('Barang')->get();
        return view('viewBarangPage', compact('barang'));
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
        'hargaBarang' => 'required|string|max:255',
        'jumlahBarang' => 'required|integer',
        'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048', // Validation for image
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
        $fileName = $request->namaBarang . '_' . time() . '.' . $extension; // Rename image file
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
    
        // Delete the image if it exists
        if ($barang->image) {
            Storage::disk('public')->delete('images/' . $barang->image);
        }
    
        $barang->delete(); // Delete the record from the database
    
        return redirect(route('getBarang'))->with('success', 'Barang Berhasil Dihapus!');
    }
    
   
}
