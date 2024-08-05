<?php

namespace App\Http\Controllers;

use App\Models\PromosiKesehatanHewan;
use Illuminate\Http\Request;

class PromosiKesehatanController extends Controller
{
    public function index()
    {

        $promosis = PromosiKesehatanHewan::all();

        return view('admin.promosi.index', compact('promosis'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required',
            'deskripsi' => 'required',
            'img' => 'required',
        ]);

        // proses image
        $img = $request->file('img');

        $imgName = time() . '.' . $img->extension();

        $img->move(public_path('assets/img'), $imgName);

        $promosi = new PromosiKesehatanHewan();
        $promosi->judul = $request->judul;
        $promosi->deskripsi = $request->deskripsi;
        $promosi->img = $imgName;
        $promosi->save();

        return redirect()->route('admin.promosi.index')->with('success', 'Promosi baru berhasil ditambahkan');
    }

    public function update(Request $request)
    {
        $request->validate([
            'judul' => 'required',
            'deskripsi' => 'required',
        ]);

        if (!$request->file('img')){
            $promosi = PromosiKesehatanHewan::find($request->id);

            $promosi->update([
                'judul' => $request->judul,
                'deskripsi' => $request->deskripsi,
            ]);

            return redirect()->route('admin.promosi.index')->with('success', 'Promosi berhasil diupdate');
        }

        // proses image
        $promosi = PromosiKesehatanHewan::find($request->id);

        unlink(public_path('assets/img/' . $promosi->img));

        $img = $request->file('img');

        $imgName = time() . '.' . $img->extension();

        $img->move(public_path('assets/img'), $imgName);

        $promosi->update([
            'judul' => $request->judul,
            'deskripsi' => $request->deskripsi,
            'img' => $imgName,
        ]);

        return redirect()->route('admin.promosi.index')->with('success', 'Promosi berhasil diupdate');
    }
}
