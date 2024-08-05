<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rekaman Medis Kesehatan Hewan</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        .invoice-box {
            max-width: 800px;
            margin: auto;
            padding: 10px;
            border: 1px solid #eee;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.15);
            font-size: 12px;
            line-height: 18px;
            color: #555;
        }
        .invoice-box table {
            width: 100%;
            line-height: inherit;
            text-align: left;
            border-collapse: collapse;
        }
        .invoice-box table td {
            padding: 5px;
            vertical-align: top;
        }
        .invoice-box table tr td:nth-child(2) {
            text-align: right;
        }
        .invoice-box table tr.top table td {
            padding-bottom: 10px;
        }
        .invoice-box table tr.top table td.title {
            font-size: 25px;
            line-height: 25px;
            color: #333;
        }
        .invoice-box table tr.information table td {
            padding-bottom: 20px;
        }
        .invoice-box table tr.heading td {
            background: #eee;
            border-bottom: 1px solid #ddd;
            font-weight: bold;
        }
        .invoice-box table tr.details td {
            padding-bottom: 10px;
        }
        .invoice-box table tr.item td {
            border-bottom: 1px solid #eee;
        }
        .invoice-box table tr.item.last td {
            border-bottom: none;
        }
        .invoice-box table tr.total td:nth-child(2) {
            border-top: 2px solid #eee;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div class="invoice-box">
        <table cellpadding="0" cellspacing="0">
            <tr class="top">
                <td colspan="2">
                    <table>
                        <tr>
                            <td class="title">
                                <h2>Rekaman Medis Kesehatan Hewan</h2>
                            </td>
                            <td>
                                Tanggal: {{ date('d-m-Y') }}<br>
                                ID Transaksi: {{ $transaksi->id }}
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
            
            <tr class="information">
                <td colspan="2">
                    <table>
                        <tr>
                            <td>
                                <strong>Nama Customer:</strong> {{ $transaksi->user->name }}<br>
                                <strong>Jenis Binatang:</strong> {{ $transaksi->jenis_binatang }}<br>
                                <strong>Nama Binatang:</strong> {{ $transaksi->nama }}
                            </td>
                            <td>
                                <strong>Kriteria Penyakit:</strong> {{ $transaksi->kriteria_penyakit }}<br>
                                <strong>Vaksin:</strong> {{ $transaksi->faksin->obat_faksin }}<br>
                                <strong>Jumlah Vaksin:</strong> {{ $transaksi->jumlah }}
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
            
            <tr class="heading">
                <td>Deskripsi</td>
                <td>Jumlah</td>
            </tr>
            
            <tr class="item">
                <td>{{ $transaksi->faksin->obat_faksin }}</td>
                <td>{{ $transaksi->jumlah }}</td>
            </tr>
            
            <tr class="total">
                <td></td>
                <td>Total: {{ $transaksi->total_harga }}</td>
            </tr>
        </table>
    </div>
</body>
</html>