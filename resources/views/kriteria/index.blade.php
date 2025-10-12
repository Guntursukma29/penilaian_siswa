@extends('layouts.template')

@section('content')
    <div class="container">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#addKriteriaModal">
                        + Tambah Kriteria
                    </button>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="basic-datatables" class="table table-striped table-hover basic-datatables">
                            <thead>
                                <tr>
                                    <th>Kode</th>
                                    <th>Nama Kriteria</th>
                                    <th>Tipe</th>
                                    <th>Bobot</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($kriteria as $row)
                                    <tr>
                                        <td>{{ $row->kode }}</td>
                                        <td>{{ $row->nama_kriteria }}</td>
                                        <td>{{ ucfirst($row->tipe) }}</td>
                                        <td>{{ $row->bobot }}</td>
                                        <td>
                                            <!-- Tombol Edit -->
                                            <button class="btn btn-sm btn-warning" data-bs-toggle="modal"
                                                data-bs-target="#editKriteriaModal{{ $row->id }}">
                                                Edit
                                            </button>

                                            <!-- Tombol Hapus -->
                                            <form action="{{ route('kriteria.destroy', $row->id) }}" method="POST"
                                                style="display:inline;">
                                                @csrf @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger"
                                                    onclick="return confirm('Hapus data ini?')">Hapus</button>
                                            </form>
                                        </td>
                                    </tr>

                                    <!-- Modal Edit -->
                                    <div class="modal fade" id="editKriteriaModal{{ $row->id }}" tabindex="-1">
                                        <div class="modal-dialog">
                                            <form action="{{ route('kriteria.update', $row->id) }}" method="POST">
                                                @csrf @method('PUT')
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">Edit Kriteria</h5>
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
                                                            <label>Nama Kriteria</label>
                                                            <input type="text" name="nama_kriteria" class="form-control"
                                                                value="{{ $row->nama_kriteria }}" required>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label>Tipe</label>
                                                            <select name="tipe" class="form-control" required>
                                                                <option value="benefit"
                                                                    {{ $row->tipe == 'benefit' ? 'selected' : '' }}>
                                                                    Benefit</option>
                                                                <option value="cost"
                                                                    {{ $row->tipe == 'cost' ? 'selected' : '' }}>
                                                                    Cost</option>
                                                            </select>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label>Bobot</label>
                                                            <input type="number" step="0.01" name="bobot"
                                                                class="form-control" value="{{ $row->bobot }}" required>
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
    <div class="modal fade" id="addKriteriaModal" tabindex="-1">
        <div class="modal-dialog">
            <form action="{{ route('kriteria.store') }}" method="POST">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Tambah Kriteria</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label>Kode</label>
                            <input type="text" name="kode" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label>Nama Kriteria</label>
                            <input type="text" name="nama_kriteria" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label>Tipe</label>
                            <select name="tipe" class="form-control" required>
                                <option value="benefit">Benefit</option>
                                <option value="cost">Cost</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label>Bobot</label>
                            <input type="number" step="0.01" name="bobot" class="form-control" required>
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
