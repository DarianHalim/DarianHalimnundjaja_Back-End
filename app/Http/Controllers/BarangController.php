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
}
