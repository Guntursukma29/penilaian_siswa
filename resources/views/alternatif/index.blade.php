@extends('layouts.template')

@section('content')
    <div class="container">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#addAlternatifModal">
                        + Tambah Alternatif
                    </button>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="basic-datatables" class="table table-striped table-hover basic-datatables">
                            <thead>
                                <tr>
                                    <th>Kode</th>
                                    <th>Nama Alternatif</th>
                                    <th>Kelas</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($alternatif as $row)
                                    <tr>
                                        <td>{{ $row->kode }}</td>
                                        <td>{{ $row->nama_alternatif }}</td>
                                        <td>{{ $row->kelas->nama_kelas ?? '-' }}</td>
                                        <td>
                                            <!-- Tombol Edit -->
                                            <button class="btn btn-sm btn-warning" data-bs-toggle="modal"
                                                data-bs-target="#editAlternatifModal{{ $row->id }}">
                                                Edit
                                            </button>

                                            <!-- Tombol Hapus -->
                                            <form action="{{ route('alternatif.destroy', $row->id) }}" method="POST"
                                                style="display:inline;">
                                                @csrf @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger"
                                                    onclick="return confirm('Hapus data ini?')">Hapus</button>
                                            </form>
                                        </td>
                                    </tr>

                                    <!-- Modal Edit -->
                                    <div class="modal fade" id="editAlternatifModal{{ $row->id }}" tabindex="-1">
                                        <div class="modal-dialog">
                                            <form action="{{ route('alternatif.update', $row->id) }}" method="POST">
                                                @csrf @method('PUT')
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">Edit Alternatif</h5>
                                                        <button type="button" class="btn-close"
                                                            data-bs-dismiss="modal"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="mb-3">
                                                            <label>Kode</label>
                                                            <input type="text" name="kode" class="form-control"
                                                                value="{{ $row->kode }}" required>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label>Nama Alternatif</label>
                                                            <input type="text" name="nama_alternatif"
                                                                class="form-control" value="{{ $row->nama_alternatif }}"
                                                                required>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label>Kelas</label>
                                                            <select name="kelas_id" class="form-control" required>
                                                                <option value="">-- Pilih Kelas --</option>
                                                                @foreach ($kelas as $k)
                                                                    <option value="{{ $k->id }}"
                                                                        {{ $row->kelas_id == $k->id ? 'selected' : '' }}>
                                                                        {{ $k->nama_kelas }}
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button class="btn btn-secondary"
                                                            data-bs-dismiss="modal">Batal</button>
                                                        <button type="submit" class="btn btn-success">Simpan</button>
                                                    </div>
                                                </div>
                                            </form>
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

    <!-- Modal Tambah -->
    <div class="modal fade" id="addAlternatifModal" tabindex="-1">
        <div class="modal-dialog">
            <form action="{{ route('alternatif.store') }}" method="POST">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Tambah Alternatif</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label>Kode</label>
                            <input type="text" name="kode" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label>Nama Alternatif</label>
                            <input type="text" name="nama_alternatif" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label>Kelas</label>
                            <select name="kelas_id" class="form-control" required>
                                <option value="">-- Pilih Kelas --</option>
                                @foreach ($kelas as $k)
                                    <option value="{{ $k->id }}">{{ $k->nama_kelas }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Tambah</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
