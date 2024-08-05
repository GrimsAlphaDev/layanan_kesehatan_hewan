@extends('admin.layout.app')

@section('content')
    <div class="row">
        <div class="col-lg-12 d-flex align-items-strech">
            <div class="card w-100">
                <div class="card-body">
                    <div class="d-flex align-items-center justify-content-between mb-10">
                        <div class="d-flex align-items-center">
                            <h5 class="card-title fw-semibold">Promosi Kesehatan Hewan</h5>
                        </div>
                        <button data-bs-toggle="modal" data-bs-target="#exampleModal"
                            class="btn btn-primary btn-lg">Tambah</button>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Judul</th>
                                    <th>Deskripsi</th>
                                    <th>Gambar</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($promosis as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $item->judul }}</td>
                                        <td>{{ $item->deskripsi }}</td>
                                        <td>
                                            <img src="{{ asset('assets/img/' . $item->img) }}" class="img-fluid"
                                                style="width: 100px" alt="">
                                        </td>
                                        <td>
                                            <div class="d-flex">
                                                <button data-bs-toggle="modal"
                                                    data-bs-target="#exampleModal{{ $item->id }}"
                                                    class="btn btn-warning btn-sm text-white me-2">Edit</button>
                                                <form action="{{ route('admin.kriteria.destroy', $item->id) }}"
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
                                                    <h5 class="modal-title" id="exampleModalLabel">Edit Promosi Kesehatan
                                                        Hewan
                                                    </h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body p-4">
                                                    <form action="{{ route('admin.promosi.update', $item->id) }}"
                                                        method="post" enctype="multipart/form-data">
                                                        @csrf
                                                        @method('put')
                                                        <div class="mb-3">
                                                            <label for="judul" class="form-label">Judul</label>
                                                            <input type="text" class="form-control" id="judul"
                                                                name="judul" value="{{ $item->judul }}" required>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="deskripsi" class="form-label">Deskripsi</label>
                                                            <textarea class="form-control" id="deskripsi" name="deskripsi" rows="5" required>{{ $item->deskripsi }}</textarea>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="img" class="form-label">Image</label><br>
                                                            <input type="file" class="form-control"
                                                                id="imgEdit{{ $item->id }}" name="img"
                                                                accept="image/*">
                                                            <img id="previewEdit{{ $item->id }}"
                                                                src="{{ asset('assets/img/' . $item->img) }}"
                                                                style="width: 250px; height: 200px; margin-top: 10px;" />
                                                        </div>
                                                        <button type="submit" class="btn btn-primary">Simpan</button>
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
                    <h5 class="modal-title" id="exampleModalLabel">Tambah Promosi Kesehatan Hewan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-4">
                    <form action="{{ route('admin.promosi.store') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label for="judul" class="form-label">Judul</label>
                            <input type="text" class="form-control" id="judul" name="judul" required>
                        </div>
                        <div class="mb-3">
                            <label for="deskripsi" class="form-label">Deskripsi</label>
                            <textarea class="form-control" id="deskripsi" name="deskripsi" rows="5" required></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="img" class="form-label">Image</label><br>
                            <input type="file" class="form-control" id="imgInsert" name="img" accept="image/*">
                            <img id="preview" src="#" alt="Pratinjau Gambar"
                                style="display: none; width: 250px; height: 200px; margin-top: 10px;" />
                        </div>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script>
        document.getElementById('imgInsert').addEventListener('change', function(event) {
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

        document.addEventListener('DOMContentLoaded', function() {
            @if ($promosis != null)
                @foreach ($promosis as $item)
                    document.getElementById('imgEdit{{ $item->id }}').addEventListener('change', function(
                        event) {
                        const file = event.target.files[0];
                        const preview = document.getElementById('previewEdit{{ $item->id }}');

                        if (file) {
                            const reader = new FileReader();
                            reader.onload = function(e) {
                                preview.src = e.target.result;
                            }
                            reader.readAsDataURL(file);
                        } else {
                            preview.src = '{{ asset('assets/img/' . $item->img) }}';
                        }
                    });
                @endforeach
            @endif

        });
    </script>
@endsection
