<?php

namespace App\Http\Controllers;

use App\Models\Transaksi;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Faksin;
use App\Models\KriteriaPenyakitMenular;
use App\Models\RekamMedis;

class DaftarController extends Controller
{
    public function index()
    {
        $transaksis = Transaksi::where('user_id', auth()->user()->id)->get();

        $kriterias = KriteriaPenyakitMenular::all();

        $faksins = Faksin::all();

        return view('patient.daftar.index', compact('transaksis', 'kriterias', 'faksins'));
    }

    public function daftarPelayanan(Request $request)
    {
        // dd($request->all());

        $request->validate([
            'pencegahan_penyakit' => 'required',
            'faksin' => 'required',
            'jenis_binatang' => 'required',
            'nama' => 'required',
            'jumlah_faksin' => 'required|min:1',
            'total_harga' => 'required',
            'bukti_pembayaran' => 'required|image|mimes:jpeg,png,jpg,gif,svg',
        ]);

        $img = $request->file('bukti_pembayaran');

        $imgName = time() . '.' . $img->extension();

        $img->move(public_path('assets/img/bukti'), $imgName);

        $transaksi = new Transaksi();
        $transaksi->user_id = auth()->user()->id;
        $transaksi->kriteria_penyakit_menular_id  = $request->pencegahan_penyakit;
        $transaksi->faksin_id = $request->faksin;
        $transaksi->jenis_binatang = $request->jenis_binatang;
        $transaksi->nama = $request->nama;
        $transaksi->jumlah = $request->jumlah_faksin;
        $transaksi->total_harga = $request->total_harga;
        $transaksi->status = 'Menunggu Konfirmasi';
        $transaksi->bukti_pembayaran = $imgName;
        $transaksi->save();

        return redirect()->route('dashboard')->with('success', 'Pendaftaran pelayanan kesehatan berhasil');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'pencegahan_penyakit' => 'required',
            'faksin' => 'required',
            'jenis_binatang' => 'required',
            'nama' => 'required',
            'jumlah_faksin' => 'required|min:1',
            'total_harga' => 'required'
        ]);

        $transaksi = Transaksi::find($id);

        // if img is not updated
        if (!$request->file('bukti_pembayaran')) {
            $transaksi->update([
                'kriteria_penyakit_menular_id' => $request->pencegahan_penyakit,
                'faksin_id' => $request->faksin,
                'jenis_binatang' => $request->jenis_binatang,
                'nama' => $request->nama,
                'jumlah' => $request->jumlah_faksin,
                'total_harga' => $request->total_harga,
            ]);

            return redirect()->route('dashboard')->with('success', 'Transaksi berhasil diupdate');
        }

        // delete old img
        unlink(public_path('assets/img/bukti/' . $transaksi->bukti_pembayaran));

        // proses img
        $img = $request->file('bukti_pembayaran');

        $imgName = time() . '.' . $img->extension();

        $img->move(public_path('assets/img/bukti'), $imgName);

        $transaksi->update([
            'kriteria_penyakit_menular_id' => $request->pencegahan_penyakit,
            'faksin_id' => $request->faksin,
            'jenis_binatang' => $request->jenis_binatang,
            'nama' => $request->nama,
            'jumlah' => $request->jumlah_faksin,
            'total_harga' => $request->total_harga,
            'bukti_pembayaran' => $imgName,
        ]);

        return redirect()->route('dashboard')->with('success', 'Transaksi berhasil diupdate');
    }

    public function destroy($id)
    {
        $transaksi = Transaksi::find($id);

        unlink(public_path('assets/img/bukti/' . $transaksi->bukti_pembayaran));

        $transaksi->delete();

        return redirect()->route('dashboard')->with('success', 'Transaksi berhasil dihapus');
    }

    public function rekamMedis()
    {
        $rekamMedis = RekamMedis::where('pasien_id', auth()->user()->id)->get();

        return view('patient.rekamMedis.index', compact('rekamMedis'));
    }
}
