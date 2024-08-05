<?php

namespace App\Http\Controllers;

use App\Models\Faksin;
use Illuminate\Http\Request;
use App\Models\KriteriaPenyakitMenular;

class ManagementFaksinController extends Controller
{
    public function index()
    {

        $faksins = Faksin::all();

        $kriterias = KriteriaPenyakitMenular::all();

        return view('admin.faksin.index', compact('faksins', 'kriterias'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'kriteria' => 'required',
            'obat_faksin' => 'required',
            'harga' => 'required',
            'deskripsi' => 'required',
        ]);

        Faksin::create([
            'kriteria_penyakit_menular_id' => $request->kriteria,
            'obat_faksin' => $request->obat_faksin,
            'harga' => $request->harga,
            'deskripsi' => $request->deskripsi,
        ]);

        return redirect()->back()->with('success', 'Faksin berhasil ditambahkan');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'kriteria' => 'required',
            'obat_faksin' => 'required',
            'harga' => 'required',
            'deskripsi' => 'required',
        ]);

        Faksin::find($id)->update([
            'kriteria_penyakit_menular_id' => $request->kriteria,
            'obat_faksin' => $request->obat_faksin,
            'harga' => $request->harga,
            'deskripsi' => $request->deskripsi,
        ]);

        return redirect()->back()->with('success', 'Faksin berhasil diupdate');
    }

    public function destroy($id)
    {
        Faksin::find($id)->delete();

        return redirect()->back()->with('success', 'Faksin berhasil dihapus');
    }
}
