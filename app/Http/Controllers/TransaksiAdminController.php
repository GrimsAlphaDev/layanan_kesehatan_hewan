<?php

namespace App\Http\Controllers;

use App\Models\RekamMedis;
use App\Models\Transaksi;
use Illuminate\Http\Request;
use Spatie\LaravelPdf\Facades\Pdf;
use TCPDF;

class TransaksiAdminController extends Controller
{
    public function index()
    {
        $transaksi = Transaksi::all();

        return view('admin.transaksi.index', compact('transaksi'));
    }

    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required',
        ]);

        Transaksi::find($id)->update([
            'status' => $request->status,
        ]);

        return redirect()->back()->with('success', 'Status transaksi berhasil diupdate');
    }

    public function destroy($id)
    {
        $transaksi = Transaksi::find($id);

        unlink(public_path('assets/img/bukti/' . $transaksi->img));

        $transaksi->delete();

        return redirect()->back()->with('success', 'Transaksi berhasil dihapus');
    }

    public function publishRekamanMedis(Request $request, $id)
    {
        $transaksi = Transaksi::find($id);

        $logoPath = public_path('assets/img/logo-kes.png');

        $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

        // Set document information
        $pdf->SetCreator('M Haikal');
        $pdf->SetAuthor('M Haikal');
        $pdf->SetTitle('Rekaman Medis');
        $pdf->SetSubject('Rekaman Medis');
        $pdf->SetKeywords('TCPDF, PDF, example, test, guide');

        // Set default header data
        $pdf->SetHeaderData($logoPath, PDF_HEADER_LOGO_WIDTH, 'Rekaman Medis', "Layanan Kesehatan Hewan \nJalan Cirebon No. 123, Kota Cirebon, Jawa Barat\n ");

        // Set header and footer fonts
        $pdf->setHeaderFont(array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
        $pdf->setFooterFont(array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

        // Set default monospaced font
        $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

        // Set margins
        $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
        $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
        $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

        // Set auto page breaks
        $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

        // Set image scale factor
        $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

        // Add a page
        $pdf->AddPage();

        // Add logo using Image() method
        $pdf->Image($logoPath, 15, 3, 30, '', 'PNG', '', 'T', false, 300, '', false, false, 0, false, false);

        // Set font
        $pdf->SetFont('helvetica', '', 10);
        // Set position for main content
        $pdf->SetY(30); // Adjust Y position as needed

        // Define main HTML content
        $html = '
            <h2 style="text-align:center;">Rekaman Medis</h2>
                <table>
                    <tr style="border-bottom: 1px solid #eee;">
                        <td colspan="2" style="padding-bottom: 20px;">
                            <table style="width: 100%;">
                                <tr>
                                    <td style="font-weight: bold;">Nama Customer</td>
                                    <td style="width:10px;">:</td>
                                    <td style="width:200px;">'. $transaksi->user->name .'</td>

                                    <td style="width:180px; font-weight: bold;">Pencegahan Dari Penyakit</td>
                                    <td style="width:10px;">:</td>
                                    <td style="width:220px;">'. $transaksi->kriteria_penyakit_menular->nama .'</td>
                                </tr>
                                <tr>
                                    <td style="font-weight: bold;">Jenis Binatang</td>
                                    <td style="width:10px;">:</td>
                                    <td style="width:200px;">'. $transaksi->jenis_binatang .'</td>

                                    <td style="width:180px; font-weight: bold;">Nama Binatang</td>
                                    <td style="width:10px;">:</td>
                                    <td style="width:220px;">'. $transaksi->nama .'</td>
                                </tr>
                                <tr>
                                    <td style="font-weight: bold;">Vaksin</td>
                                    <td style="width:10px;">:</td>
                                    <td style="width:200px;">'. $transaksi->faksin->obat_faksin .'</td>

                                    <td style="width:180px; font-weight: bold;">Jumlah Vaksin</td>
                                    <td style="width:10px;">:</td>
                                    <td style="width:220px;">'. $transaksi->jumlah .'</td>
                                </tr>
                                <br>
                                <br>
                                <br>
                                <table style="width: 100%;">
                                    <tr>
                                        <td style="font-weight: bold;">Status</td>
                                        <td style="width:10px;">:</td>
                                        <td style="width:200px;">'. $transaksi->status .'</td>
                                    </tr>
                                    <tr>
                                        <td style="font-weight: bold;">Tanggal Transaksi</td>
                                        <td style="width:10px;">:</td>
                                        <td style="width:200px;">'. $transaksi->created_at .'</td>
                                    </tr>
                                </table>

                                <br><br><br>

                                <table style="width: 100%;" border="1" cellpadding="2">
                                    <tr style="background-color: #d8d8d8; text-align:center;">
                                        <th>No</th>
                                        <th>Faksin</th>
                                        <th>Harga</th>
                                        <th>Jumlah</th>
                                        <th>Total</th>
                                    </tr>

                                    <tr>
                                        <td>1</td>
                                        <td>'. $transaksi->faksin->obat_faksin .'</td>
                                        <td>'. $transaksi->faksin->harga .'</td>
                                        <td>'. $transaksi->jumlah .'</td>
                                        <td>'. $transaksi->faksin->harga * $transaksi->jumlah .'</td>
                                    </tr>

                                </table>
                            </table>
                        </td>
                    </tr>
                </table>
            ';

        // Ensure you output the HTML content to the PDF
        $pdf->writeHTML($html, true, false, true, false, '');

        // Output PDF
        $pdfContent = $pdf->Output('rekam_medis.pdf', 'S');

        // convert pdf to base64
        $base64 = base64_encode($pdfContent);

        // insert to database
        $rekamanMedis = new RekamMedis();
        $rekamanMedis->pasien_id = $transaksi->user->id;
        $rekamanMedis->transaksi_id = $transaksi->id;
        $rekamanMedis->rekam_medis = $base64;
        $rekamanMedis->save();

        // update transaksi status
        $transaksi->update([
            'status' => 'Rekaman Medis Diterbitkan',
        ]);

        return redirect()->route('admin.laporan-rekaman-medis.index')->with('success', 'Rekaman medis berhasil dipublish');
    }
}
