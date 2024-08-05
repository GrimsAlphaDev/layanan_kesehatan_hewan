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
                        <button data-bs-toggle="modal" data-bs-target="#exampleModal"
                            class="btn btn-primary btn-lg">Tambah</button>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Kriteria Penyakit</th>
                                    <th>Obat Faksin</th>
                                    <th>Harga</th>
                                    <th>Deskripsi</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($faksins as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>
                                            {{ $item->kriteria->nama }}
                                        </td>
                                        <td>{{ $item->obat_faksin }}</td>
                                        <td>Rp {{ number_format($item->harga, 2, ',', '.') }}</td>
                                        <td>{{ $item->deskripsi }}</td>
                                        <td>
                                            <div class="d-flex">
                                                <button data-bs-toggle="modal"
                                                    data-bs-target="#exampleModal{{ $item->id }}"
                                                    class="btn btn-warning btn-sm text-white me-2">Edit</button>
                                                <form action="{{ route('admin.faksin.destroy', $item->id) }}"
                                                    method="post">
                                                    @csrf
                                                    @method('delete')
                                                    <button class="btn btn-danger btn-sm"
                                                        onclick="return confirm('Yakin akan menghapus data ini?')">Hapus</button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                    <div class="modal fade" id="exampleModal{{ $item->id }}" tabindex="-1"
                                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-xl">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Edit Kriteria Penyakit Menular</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body p-4">
                                                    <form action="{{ route('admin.faksin.update', $item->id) }}"
                                                        method="post" enctype="multipart/form-data">
                                                        @csrf
                                                        @method('put')
                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <div class="mb-3">
                                                                    <label for="kriteria" class="form-label">Kriteria Penyakit</label>
                                                                    <select class="form-control" id="kriteria" name="kriteria" required>
                                                                        @foreach ($kriterias as $kriteria)
                                                                            <option value="{{ $kriteria->id }}"
                                                                                {{ $kriteria->id == $item->kriteria_penyakit_menular_id  ? 'selected' : '' }}>
                                                                                {{ $kriteria->nama }}
                                                                            </option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                                <div class="mb-3">
                                                                    <label for="obat_faksin" class="form-label
                                                                        ">Obat Faksin</label>
                                                                    <input type="text" class="form-control" id="obat_faksin"
                                                                        name="obat_faksin" value="{{ $item->obat_faksin }}"
                                                                        required>
                                                                </div>
                                                                <div class="mb-3">
                                                                    <label for="harga" class="form-label">Harga</label>
                                                                    <input type="number" class="form-control" id="harga" name="harga"
                                                                        value="{{ $item->harga }}" required>
                                                                </div>
                                                                <div class="mb-3">
                                                                    <label for="deskripsi" class="form-label">Deskripsi</label>
                                                                    <textarea class="form-control" id="deskripsi" name="deskripsi"
                                                                        rows="5" required>{{ $item->deskripsi }}</textarea>
                                                                </div>
                                                                <button type="submit" class="btn btn-primary">Simpan</button>
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
                    <h5 class="modal-title" id="exampleModalLabel">Tambah Kriteria Penyakit Menular</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-4">
                    <form action="{{ route('admin.faksin.store') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label for="kriteria" class="form-label">Kriteria Penyakit</label>
                                    <select class="form-control" id="kriteria" name="kriteria" required>
                                        @foreach ($kriterias as $item)
                                            <option value="{{ $item->id }}">{{ $item->nama }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="obat_faksin" class="form-label
                                        ">Obat Faksin</label>
                                    <input type="text" class="form-control" id="obat_faksin" name="obat_faksin" required>
                                </div>
                                <div class="mb-3">
                                    <label for="harga" class="form-label">Harga</label>
                                    <input type="number" class="form-control" id="harga" name="harga" required>
                                </div>
                                <div class="mb-3">
                                    <label for="deskripsi" class="form-label">Deskripsi</label>
                                    <textarea class="form-control" id="deskripsi" name="deskripsi" rows="5" required></textarea>
                                </div>
                                <button type="submit" class="btn btn-primary">Simpan</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
