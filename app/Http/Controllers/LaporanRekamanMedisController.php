<?php

namespace App\Http\Controllers;

use App\Models\RekamMedis;
use Illuminate\Http\Request;
use TCPDF;

class LaporanRekamanMedisController extends Controller
{
    public function index()
    {
        $rekamMedis = RekamMedis::all();

        return view('admin.laporan.index', compact('rekamMedis'));
    }

    public function viewRekam($id)
    {
        $rekamMedis = RekamMedis::find($id);

        // decode base64 to pdf
        $pdf = base64_decode($rekamMedis->rekam_medis);

        return response($pdf)
            ->header('Content-Type', 'application/pdf')
            ->header('Content-Disposition', 'inline; filename="surat_jalan.pdf"');
    }

    public function print()
    {
        $rekamMedis = RekamMedis::all();

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
            <h2 style="text-align:center;">Laporan Rekaman Medis</h2>
            <table style="width: 100%;" border="1"; cellpadding="2";>
                <tr style="background-color: #d8d8d8; text-align:center;">
                    <th>No</th>
                    <th>Nama Customer</th>
                    <th>Nama Hewan</th>
                    <th>Faksin</th>
                    <th>Harga</th>
                    <th>Jumlah</th>
                    <th>Total</th>
                </tr>
            ';

        $no = 1;

        foreach ($rekamMedis as $rekam) {
            $html .= '
                <tr>
                    <td>' . $no++ . '</td>
                    <td>' . $rekam->user->name . '</td>
                    <td>' . $rekam->transaksi->nama . '</td>
                    <td>' . $rekam->transaksi->faksin->obat_faksin . '</td>
                    <td>' . $rekam->transaksi->faksin->harga . '</td>
                    <td>' . $rekam->transaksi->jumlah . '</td>
                    <td>' . $rekam->transaksi->total_harga . '</td>
                </tr>
            ';
        }

        $html .= '</table>';

        // Ensure you output the HTML content to the PDF
        $pdf->writeHTML($html, true, false, true, false, '');

        // Output PDF
        $pdfContent = $pdf->Output('rekam_medis.pdf', 'I');

        return response($pdfContent)
            ->header('Content-Type', 'application/pdf');
            
    }
}
