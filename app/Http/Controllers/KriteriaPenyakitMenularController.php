<?php

namespace App\Http\Controllers;

use App\Models\KriteriaPenyakitMenular;
use App\Http\Requests\StoreKriteriaPenyakitMenularRequest;
use App\Http\Requests\UpdateKriteriaPenyakitMenularRequest;
use Illuminate\Http\Request;

class KriteriaPenyakitMenularController extends Controller
{
    public function index()
    {

        $kriterias = KriteriaPenyakitMenular::all();

        return view('admin.kriteria.index', compact('kriterias'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'penularan' => 'required',
            'deskripsi' => 'required',
            'img' => 'required',
        ]);

        // proses img
        $img = $request->file('img');

        $imgName = time() . '.' . $img->extension();

        $img->move(public_path('assets/img'), $imgName);

        KriteriaPenyakitMenular::create([
            'nama' => $request->nama,
            'penularan' => $request->penularan,
            'deskripsi' => $request->deskripsi,
            'img' => $imgName,
        ]);

        return redirect()->route('admin.dashboard')->with('success', 'Penyakit baru berhasil ditambahkan');

    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required',
            'penularan' => 'required',
            'deskripsi' => 'required',
        ]);

        // if img is not updated
        if (!$request->file('img')) {
            $kriteria = KriteriaPenyakitMenular::find($id);

            $kriteria->update([
                'nama' => $request->nama,
                'penularan' => $request->penularan,
                'deskripsi' => $request->deskripsi,
            ]);

            return redirect()->route('admin.dashboard')->with('success', 'Penyakit berhasil diupdate');
        }

        // delete old img
        $kriteria = KriteriaPenyakitMenular::find($id);
        
        unlink(public_path('assets/img/' . $kriteria->img));

        // proses img
        $img = $request->file('img');

        $imgName = time() . '.' . $img->extension();

        $img->move(public_path('assets/img'), $imgName);

        $kriteria->update([
            'nama' => $request->nama,
            'penularan' => $request->penularan,
            'deskripsi' => $request->deskripsi,
            'img' => $imgName,
        ]);

        return redirect()->route('admin.dashboard')->with('success', 'Penyakit berhasil diupdate');

        
    }

    public function destroy($id)
    {
        $kriteria = KriteriaPenyakitMenular::find($id);

        unlink(public_path('assets/img/' . $kriteria->img));

        $kriteria->delete();

        return redirect()->route('admin.dashboard')->with('success', 'Penyakit berhasil dihapus');
    }
}
