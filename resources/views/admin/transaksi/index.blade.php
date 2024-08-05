@extends('admin.layout.app')

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
                                    <th>Pencegahan Penyakit</th>
                                    <th>Jenis Binatang</th>
                                    <th>Nama</th>
                                    <th>Faksin</th>
                                    <th>Harga</th>
                                    <th>Jumlah Faksin</th>
                                    <th>Total Harga</th>
                                    <th>Bukti Pembayaran</th>
                                    <th>Status </th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($transaksi as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $item->kriteria_penyakit_menular->nama }}</td>
                                        <td>{{ $item->jenis_binatang }}</td>
                                        <td>{{ $item->nama }}</td>
                                        <td>{{ $item->faksin->obat_faksin }}</td>
                                        <td>{{ 'Rp ' . number_format($item->faksin->harga, 2, ',', '.') }}</td>
                                        <td>{{ $item->jumlah }}</td>
                                        <td>{{ 'Rp ' . number_format($item->total_harga, 2, ',', '.') }}</td>
                                        <td>
                                            <a href="{{ asset('assets/img/bukti/' . $item->bukti_pembayaran) }}"
                                                target="_blank">Lihat
                                                Bukti Pembayaran</a>
                                        </td>
                                        <td>
                                            @if ($item->status == 'Menunggu Konfirmasi')
                                                <span class="badge bg-warning text-white">{{ $item->status }}</span>
                                            @elseif ($item->status == 'Diterima')
                                                <span class="badge bg-success">{{ $item->status }}</span>
                                            @elseif ($item->status == 'Ditolak')
                                                <span class="badge bg-danger">Transaksi {{ $item->status }}</span>
                                            @elseif ($item->status == 'Rekaman Medis Diterbitkan')
                                                <span class="badge bg-primary">Rekaman Medis {{ $item->status }}</span>
                                            @endif
                                        </td>
                                        <td>
                                            <div class="d-flex">
                                                @if ($item->status == 'Ditolak' || $item->status == 'Menunggu Konfirmasi')
                                                    <button data-bs-toggle="modal"
                                                        data-bs-target="#exampleModal{{ $item->id }}"
                                                        class="btn btn-warning btn-sm text-white me-2">Update
                                                        Status</button>
                                                @endif
                                                @if ($item->status == 'Ditolak' || $item->status == 'Rekaman Medis Diterbitkan')
                                                    <form action="{{ route('admin.transaksi.destroy', $item->id) }}"
                                                        method="post">
                                                        @csrf
                                                        @method('delete')
                                                        <button class="btn btn-danger btn-sm"
                                                            onclick="return confirm('Yakin akan menghapus data ini?')">Hapus</button>
                                                    </form>
                                                @endif
                                                @if ($item->status == 'Diterima')
                                                    <form
                                                        action="{{ route('admin.transaksi.publishRekamanMedis', $item->id) }}"
                                                        method="post">
                                                        @csrf
                                                        <button class="btn btn-primary btn-sm">Terbitkan Rekam
                                                            Medis</button>
                                                    </form>
                                                @endif
                                            </div>
                                        </td>
                                    </tr>

                                    <div class="modal fade" id="exampleModal{{ $item->id }}" tabindex="-1"
                                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-xl">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Edit Kriteria Penyakit
                                                        Menular</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body p-4">
                                                    <form action="{{ route('admin.transaksi.updateStatus', $item->id) }}"
                                                        method="post" enctype="multipart/form-data">
                                                        @csrf
                                                        @method('put')
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <div class="mb-3">
                                                                    <label for="pencegahan_penyakit"
                                                                        class="form-label">Pencegahan
                                                                        Penyakit</label>
                                                                    <input class="form-control"
                                                                        value="{{ $item->kriteria_penyakit_menular->nama }}"
                                                                        type="text"
                                                                        name="pencegahan_penyakit{{ $item->id }}"
                                                                        readonly>
                                                                </div>
                                                                <div class="mb-3">
                                                                    <label for="faksin"
                                                                        class="form-label
                                                                        ">Obat
                                                                        Faksin</label>
                                                                    <input type="text" name="faksin_id"
                                                                        id="faksin_id{{ $item->id }}"
                                                                        class="form-control" readonly
                                                                        value="{{ $item->faksin->obat_faksin }}">
                                                                </div>

                                                                <div class="mb-3">
                                                                    <label for="jenis_binatang" class="form-label">Jenis
                                                                        Binatang</label>
                                                                    <input type="text" readonly name="jenis_binatang"
                                                                        id="jenis_binatang"
                                                                        value="{{ $item->jenis_binatang }}"
                                                                        class="form-control">
                                                                </div>
                                                                <div class="mb-3">
                                                                    <label for="nama" class="form-label">Nama
                                                                        Hewan</label>
                                                                    <input type="text" class="form-control"
                                                                        id="nama" name="nama" readonly
                                                                        value="{{ $item->nama }}">
                                                                </div>

                                                                {{-- update status transaksi --}}
                                                                <div class="mb-3">
                                                                    <label for="status" class="form-label">Status</label>
                                                                    <select class="form-select" name="status"
                                                                        id="status" required>
                                                                        <option disabled selected>-- Pilih Status --
                                                                        </option>
                                                                        <option value="Diterima"
                                                                            @if ($item->status == 'Diterima') selected @endif>
                                                                            Diterima</option>
                                                                        <option value="Ditolak"
                                                                            @if ($item->status == 'Ditolak') selected @endif>
                                                                            Ditolak</option>
                                                                    </select>
                                                                </div>


                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="mb-3">
                                                                    <label for="harga" class="form-label">Harga</label>
                                                                    <input type="number" class="form-control"
                                                                        id="harga{{ $item->id }}" name="harga"
                                                                        readonly value="{{ $item->faksin->harga }}">
                                                                </div>
                                                                <div class="mb-3">
                                                                    <label for="jumlah_faksin"
                                                                        class="form-label
                                                                        ">Jumlah
                                                                        Faksin</label>
                                                                    <input type="number" class="form-control"
                                                                        id="jumlah_faksin{{ $item->id }}"
                                                                        name="jumlah_faksin" readonly
                                                                        value="{{ $item->jumlah }}">
                                                                </div>
                                                                <div class="mb-3">
                                                                    <label for="total_harga"
                                                                        class="form-label
                                                                        ">Total
                                                                        Harga</label>
                                                                    <input type="number" class="form-control"
                                                                        id="total_harga{{ $item->id }}"
                                                                        name="total_harga" readonly
                                                                        value="{{ $item->total_harga }}">
                                                                </div>

                                                                <div class="mb-3">
                                                                    <label for="bukti_pembayaran" class="form-label">Bukti
                                                                        Pembayaran</label><br>
                                                                    <img id="preview{{ $item->id }}"
                                                                        src="{{ asset('assets/img/bukti/' . $item->bukti_pembayaran) }}"
                                                                        alt="Pratinjau Gambar"
                                                                        style="width: 100px; height: 100px; margin-top: 10px;" />
                                                                </div>
                                                            </div>
                                                            <div class="d-flex justify-content-end">
                                                                <button type="submit"
                                                                    class="btn btn-primary">Simpan</button>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
