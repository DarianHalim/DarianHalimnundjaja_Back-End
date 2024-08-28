<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use Illuminate\Http\Request;

class BarangController extends Controller
{
    public function getCreatePage()
    {
        return view('adminCreate');
    }

    public function createBarang(Request $request)
    {
        $request->validate([
            'namaBarang' => 'required|string|max:255',
            'hargaBarang' => 'required|string|max:255',
            'jumlahBarang' => 'required|integer',
        ]);




        Barang::create([
            'namaBarang' => $request->namaBarang,
            'hargaBarang' => $request->hargaBarang,
            'jumlahBarang' => $request->jumlahBarang,
        ]);
        return redirect(route('getBarang'))->with('success', 'Barang Berhasil Dibuat!');
    }

    public function getBarang()
    {

        $barang = Barang::all();
        return view('viewBarangPage', compact('barang'));
    }

    public function getBarangById($id)
    {
        $barang = Barang::find($id);
        return view('editBarang', compact('barang'));
    }
    
    public function updateBarang(Request $request, $id)
    {
        $request->validate([
            'namaBarang' => 'required|string|max:255',
            'hargaBarang' => 'required|string|max:255',
            'jumlahBarang' => 'required|integer',
        ]);
    
        $barang = Barang::find($id);
        $barang->update([
            'namaBarang' => $request->namaBarang,
            'hargaBarang' => $request->hargaBarang,
            'jumlahBarang' => $request->jumlahBarang,
        ]);
    
        return redirect(route('getBarang'))->with('success', 'Barang Berhasil Diupdate!');
    }
    
    public function deleteBarang($id){
        Barang::destroy($id);
        return redirect(route('getBarang'));
    }
   
}
