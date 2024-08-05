@extends('patient.layout.app')

@section('content')
    <div class="row">
        <div class="col-lg-12 d-flex align-items-strech">
            <div class="card w-100">
                <div class="card-body">
                    <div class="d-flex align-items-center justify-content-between mb-10">
                        <div class="d-flex align-items-center">
                            <h5 class="card-title fw-semibold">Pelayanan Kesehatan Hewan</h5>
                        </div>
                        <button data-bs-toggle="modal" data-bs-target="#exampleModal" class="btn btn-primary btn-lg">Daftarkan
                            Hewan</button>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered" style="overflow-y: scroll; width: 100%;">
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
                                @foreach ($transaksis as $item)
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
                                                <span class="badge bg-info">Pesanan Telah Di Validasi Admin</span>
                                            @elseif ($item->status == 'Rekam Medis Terbit')
                                                <span class="badge bg-success">{{ $item->status }}</span>
                                            @elseif ($item->status == 'Rekaman Medis Diterbitkan')
                                                <span class="badge bg-primary">Rekaman Medis {{ $item->status }}</span>
                                            @else
                                                <span class="badge bg-danger">{{ $item->status }}</span>
                                            @endif
                                        </td>
                                        <td>
                                            @if ($item->status == 'Menunggu Konfirmasi')
                                                <div class="d-flex">
                                                    <button data-bs-toggle="modal"
                                                        data-bs-target="#exampleModal{{ $item->id }}"
                                                        class="btn btn-warning btn-sm text-white me-1">Edit</button>
                                                    <form action="{{ route('deleteTransaksi', $item->id) }}"
                                                        method="post">
                                                        @csrf
                                                        @method('delete')
                                                        <button type="submit" class="btn btn-danger btn-sm"
                                                            onclick="return confirm('Yakin Ingin Menghapus Data Ini ?')">Delete</button>
                                                    </form>
                                                </div>
                                            @endif
                                            @if ($item->status == 'Ditolak' || $item->status == 'Rekaman Medis Diterbitkan')
                                                <form action="{{ route('deleteTransaksi', $item->id) }}" method="post">
                                                    @csrf
                                                    @method('delete')
                                                    <button type="submit" class="btn btn-danger btn-sm"
                                                        onclick="return confirm('Yakin Ingin Menghapus Data Ini ?')">Delete</button>
                                                </form>
                                            @endif
                                            @if ($item->status == 'Diterima')
                                                <span class="badge bg-info">Menunggu Rekam Medis</span>
                                            @endif
                                        </td>
                                    </tr>

                                    {{-- modal --}}
                                    <div class="modal fade" id="exampleModal{{ $item->id }}" tabindex="-1"
                                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-xl">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Daftar Pelayanan
                                                        Kesehatan</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body p-4">
                                                    <form action="{{ route('updateTransaksi', $item->id) }}" method="post"
                                                        enctype="multipart/form-data">
                                                        @method('put')
                                                        @csrf
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <div class="mb-3">
                                                                    <label for="pencegahan_penyakit"
                                                                        class="form-label">Pencegahan
                                                                        Penyakit</label>
                                                                    <select class="form-control"
                                                                        id="pencegahan_penyakit{{ $item->id }}"
                                                                        name="pencegahan_penyakit" required>
                                                                        <option selected disabled>-- Pilih Pencegahan
                                                                            Penyakit --
                                                                        </option>
                                                                    </select>
                                                                </div>
                                                                <div class="mb-3">
                                                                    <label for="faksin"
                                                                        class="form-label
                                                                        ">Obat
                                                                        Faksin</label>
                                                                    <select name="faksin" id="faksin{{ $item->id }}"
                                                                        class="form-control" required readonly>
                                                                        <option selected disabled>-- Pilih Pencegahan
                                                                            Penyakit
                                                                            Terlebih Dahulu -- </option>
                                                                    </select>
                                                                </div>

                                                                <div class="mb-3">
                                                                    <label for="jenis_binatang" class="form-label">Jenis
                                                                        Binatang</label>
                                                                    <select class="form-control" id="jenis_binatang"
                                                                        name="jenis_binatang" required>
                                                                        <option value="Anjing"
                                                                            @if ($item->jenis_binatang == 'Anjing') selected @endif>
                                                                            Anjing</option>
                                                                        <option value="Kucing"
                                                                            @if ($item->jenis_binatang == 'Kucing') selected @endif>
                                                                            Kucing</option>
                                                                        <option value="Kelinci"
                                                                            @if ($item->jenis_binatang == 'Kelinci') selected @endif>
                                                                            Kelinci</option>
                                                                        <option value="Hamster"
                                                                            @if ($item->jenis_binatang == 'Hamster') selected @endif>
                                                                            Hamster</option>
                                                                        <option value="Burung"
                                                                            @if ($item->jenis_binatang == 'Burung') selected @endif>
                                                                            Burung</option>
                                                                    </select>
                                                                </div>
                                                                <div class="mb-3">
                                                                    <label for="nama" class="form-label">Nama
                                                                        Hewan</label>
                                                                    <input type="text" class="form-control"
                                                                        id="nama" name="nama" required
                                                                        value="{{ $item->nama }}">
                                                                </div>

                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="mb-3">
                                                                    <label for="harga" class="form-label">Harga</label>
                                                                    <input type="number" class="form-control"
                                                                        id="harga{{ $item->id }}" name="harga"
                                                                        required readonly
                                                                        value="{{ $item->faksin->harga }}">
                                                                </div>
                                                                <div class="mb-3">
                                                                    <label for="jumlah_faksin"
                                                                        class="form-label
                                                                        ">Jumlah
                                                                        Faksin</label>
                                                                    <input type="number" class="form-control"
                                                                        id="jumlah_faksin{{ $item->id }}"
                                                                        name="jumlah_faksin" required
                                                                        value="{{ $item->jumlah }}">
                                                                </div>
                                                                <div class="mb-3">
                                                                    <label for="total_harga"
                                                                        class="form-label
                                                                        ">Total
                                                                        Harga</label>
                                                                    <input type="number" class="form-control"
                                                                        id="total_harga{{ $item->id }}"
                                                                        name="total_harga" required readonly
                                                                        value="{{ $item->total_harga }}">
                                                                </div>

                                                                <div class="mb-3">
                                                                    <label for="bukti_pembayaran" class="form-label">Bukti
                                                                        Pembayaran</label>
                                                                    <input type="file" class="form-control"
                                                                        id="bukti_pembayaran{{ $item->id }}"
                                                                        name="bukti_pembayaran" accept="image/*">
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

    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Daftar Pelayanan Kesehatan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-4">
                    <form action="{{ route('daftarPelayanan') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="pencegahan_penyakitInsert" class="form-label">Pencegahan Penyakit</label>
                                    <select class="form-control" id="pencegahan_penyakitInsert"
                                        name="pencegahan_penyakit" required>
                                        <option selected disabled>-- Pilih Pencegahan Penyakit -- </option>
                                        @foreach ($kriterias as $item)
                                            <option value="{{ $item->id }}">{{ $item->nama }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="faksinInsert"
                                        class="form-label
                                        ">Obat
                                        Faksin</label>
                                    <select name="faksin" id="faksinInsert" class="form-control" required readonly>
                                        <option selected disabled>-- Pilih Pencegahan Penyakit Terlebih Dahulu -- </option>
                                    </select>
                                </div>

                                <div class="mb-3">
                                    <label for="jenis_binatang" class="form-label">Jenis Binatang</label>
                                    <select class="form-control" id="jenis_binatang" name="jenis_binatang" required>
                                        <option selected disabled>-- Pilih Jenis Binatang -- </option>
                                        <option value="Anjing">Anjing</option>
                                        <option value="Kucing">Kucing</option>
                                        <option value="Kelinci">Kelinci</option>
                                        <option value="Hamster">Hamster</option>
                                        <option value="Burung">Burung</option>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="nama" class="form-label">Nama Hewan</label>
                                    <input type="text" class="form-control" id="nama" name="nama" required>
                                </div>

                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="hargaInsert" class="form-label">Harga</label>
                                    <input type="number" class="form-control" id="hargaInsert" name="harga" required
                                        readonly>
                                </div>
                                <div class="mb-3">
                                    <label for="jumlah_faksinInsert" class="form-label">Jumlah Faksin</label>
                                    <input type="number" class="form-control" id="jumlah_faksinInsert"
                                        name="jumlah_faksin" required>
                                </div>
                                <div class="mb-3">
                                    <label for="total_hargaInsert"
                                        class="form-label
                                        ">Total Harga</label>
                                    <input type="number" class="form-control" id="total_hargaInsert" name="total_harga"
                                        required readonly>
                                </div>

                                <div class="mb-3">
                                    <label for="bukti_pembayaranInsert" class="form-label">Bukti Pembayaran</label>
                                    <input type="file" class="form-control" id="bukti_pembayaranInsert"
                                        name="bukti_pembayaran" required accept="image/*">
                                    <img id="preview" src="#" alt="Pratinjau Gambar"
                                        style="display: none; width: 100px; height: 100px; margin-top: 10px;" />
                                </div>
                            </div>
                        </div>
                        <div class="d-flex justify-content-end">
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script>
        const faksins = @json($faksins);
        const kriterias = @json($kriterias);
        const transaksis = @json($transaksis);
        const pencegahan_penyakitInsert = document.getElementById('pencegahan_penyakitInsert');
        const faksinInsert = document.getElementById('faksinInsert');
        const jumlah_faksinInsert = document.getElementById('jumlah_faksinInsert');

        pencegahan_penyakitInsert.addEventListener('change', function() {
            const faksin = faksins.filter(faksin => faksin.kriteria_penyakit_menular_id == pencegahan_penyakitInsert
                .value);
            const faksinSelect = document.getElementById('faksinInsert');
            faksinSelect.innerHTML = '<option selected disabled>-- Pilih Faksin --</option>';
            faksin.forEach(faksin => {
                faksinSelect.innerHTML += `<option value="${faksin.id}">${faksin.obat_faksin}</option>`;
            });
            faksinSelect.removeAttribute('readonly');
        });

        faksinInsert.addEventListener('change', function() {
            // get faksin id from selected faksin
            const faksinId = faksinInsert.value;
            // get faksin object from faksins array
            const selectedFaksin = faksins.find(faksin => faksin.id == faksinId);
            const harga = selectedFaksin.harga;

            document.getElementById('hargaInsert').value = harga;
        });

        jumlah_faksinInsert.addEventListener('keyup', function() {
            const harga = document.getElementById('hargaInsert').value;
            const jumlahFaksin = jumlah_faksinInsert.value;
            const totalHarga = harga * jumlahFaksin;
            document.getElementById('total_hargaInsert').value = totalHarga;
        });

        document.getElementById('bukti_pembayaranInsert').addEventListener('change', function(event) {
            const file = event.target.files[0];
            const preview = document.getElementById('preview');

            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    preview.src = e.target.result;
                    preview.style.display = 'block';
                }
                reader.readAsDataURL(file);
            } else {
                preview.src = '#';
                preview.style.display = 'none';
            }
        });

        transaksis.forEach(transaksi => {
            const pencegahan_penyakit = document.getElementById(`pencegahan_penyakit${transaksi.id}`);
            const faksin = document.getElementById(`faksin${transaksi.id}`);

            // set kriteria option selected
            pencegahan_penyakit.innerHTML = `<option selected disabled>-- Pilih Pencegahan Penyakit --</option>`;
            kriterias.forEach(kriteria => {
                pencegahan_penyakit.innerHTML +=
                    `<option value="${kriteria.id
                }" ${kriteria.id == transaksi.kriteria_penyakit_menular_id ? 'selected' : ''}>${kriteria.nama}</option>`;
            });

            // set faksin option selected
            faksin.innerHTML = `<option selected disabled>-- Pilih Faksin --</option>`;

            faksins.forEach(faksinItem => {
                if (faksinItem.kriteria_penyakit_menular_id == transaksi.kriteria_penyakit_menular_id) {
                    faksin.innerHTML +=
                        `<option value="${faksinItem.id}" ${faksinItem.id == transaksi.faksin_id ? 'selected' : ''}>${faksinItem.obat_faksin}</option>`;
                }
            });

            // kriteria on change
            pencegahan_penyakit.addEventListener('change', function() {
                const faksinData = faksins.filter(faksin => faksin.kriteria_penyakit_menular_id ==
                    pencegahan_penyakit.value);
                faksin.innerHTML = '<option selected disabled>-- Pilih Faksin --</option>';
                faksinData.forEach(faksinItem => {
                    faksin.innerHTML +=
                        `<option value="${faksinItem.id}">${faksinItem.obat_faksin}</option>`;
                });
                faksin.removeAttribute('readonly');

            });

            // faksin on change
            const faksinElement = document.getElementById(`faksin${transaksi.id}`);
            const hargaElement = document.getElementById(`harga${transaksi.id}`);
            const jumlah_faksin = document.getElementById(`jumlah_faksin${transaksi.id}`);
            const total_harga = document.getElementById(`total_harga${transaksi.id}`);
            const previewElement = document.getElementById(`preview${transaksi.id}`);

            faksinElement.addEventListener('change', function() {
                // get faksin id from selected faksin
                const faksinId = faksin.value;
                // get faksin object from faksins array
                const selectedFaksin = faksins.find(faksin => faksin.id == faksinId);
                const harga = selectedFaksin.harga;

                hargaElement.value = harga;
            });

            jumlah_faksin.addEventListener('keyup', function() {
                const harga = hargaElement.value;
                const jumlahFaksinValue = jumlah_faksin.value;
                const totalHargaValue = harga * jumlahFaksinValue;
                total_harga.value = totalHargaValue;
            });

            // view image
            document.getElementById(`bukti_pembayaran${transaksi.id}`).addEventListener('change', function(event) {
                const file = event.target.files[0];
                const preview = previewElement;

                if (file) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        preview.src = e.target.result;
                        preview.style.display = 'block';
                    }
                    reader.readAsDataURL(file);
                } else {
                    preview.src = '#';
                    preview.style.display = 'none';
                }
            });


        });
    </script>
@endsection
