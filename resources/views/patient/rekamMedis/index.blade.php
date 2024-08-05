@extends('patient.layout.app')

@section('content')
    <div class="row">
        <div class="col-lg-12 d-flex align-items-strech">
            <div class="card w-100">
                <div class="card-body">
                    <div class="d-flex align-items-center justify-content-between mb-10">
                        <div class="d-flex align-items-center">
                            <h5 class="card-title fw-semibold">Kriteria Penyakit Menular</h5>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Pasien</th>
                                    <th>Nama Hewan</th>
                                    <th>Faksin</th>
                                    <th>Jumlah</th>
                                    <th>Total</th>
                                    <th>Rekam Medis</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($rekamMedis as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>
                                            {{ $item->user->name }}
                                        </td>
                                        <td>
                                            {{ $item->transaksi->nama }}
                                        </td>
                                        <td>{{ $item->transaksi->faksin->obat_faksin }}</td>
                                        <td>{{ $item->transaksi->jumlah }}</td>
                                        <td>{{ $item->transaksi->total_harga }}</td>
                                        <td>
                                            {{-- view pdf --}}
                                            <a href="{{ route('rekam.medis.show', $item->id) }}" target="_blank"
                                                class="btn btn-primary btn-sm">View Rekam Medis</a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    
@endsection
 