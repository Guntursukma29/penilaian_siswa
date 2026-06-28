@extends('layouts.template')

@section('content')
    <div class="container">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center flex-wrap gap-3">

                    {{-- Judul --}}
                    <h5 class="mb-0">
                        <i class="fas fa-table me-2"></i>Data Nilai Alternatif
                    </h5>

                    {{-- Aksi --}}
                    <div class="d-flex align-items-center gap-2 flex-wrap">

                        {{-- Form Import --}}
                        <form action="{{ route('nilai_alternatif.import') }}" method="POST" enctype="multipart/form-data"
                            class="d-flex align-items-center gap-2 m-0">
                            @csrf

                            <input type="file" name="file" class="form-control form-control-sm" accept=".xls,.xlsx"
                                required>

                            <button type="submit" class="btn btn-success btn-sm">
                                <i class="fas fa-file-excel me-1"></i> Import Excel
                            </button>
                        </form>

                        {{-- Tombol Hapus Semua --}}
                        <form action="{{ route('nilai_alternatif.destroyAll') }}" method="POST" class="m-0"
                            onsubmit="return confirm('Yakin ingin menghapus seluruh data nilai alternatif?')">
                            @csrf
                            @method('DELETE')

                            <button type="submit" class="btn btn-danger btn-sm">
                                <i class="fas fa-trash-alt me-1"></i> Hapus Semua
                            </button>
                        </form>

                    </div>

                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped basic-datatables">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Alternatif</th>
                                    <th>Kelas</th>
                                    @foreach ($kriteria as $krit)
                                        <th>{{ $krit->nama_kriteria }}</th>
                                    @endforeach
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($alternatif as $alt)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $alt->nama_alternatif }}</td>
                                        <td>{{ $alt->kelas->nama_kelas ?? '-' }}</td>
                                        @foreach ($kriteria as $krit)
                                            @php
                                                $nilai = $alt->nilaiKriteria->firstWhere('kriteria_id', $krit->id);
                                            @endphp
                                            <td>{{ $nilai ? $nilai->nilai : '-' }}</td>
                                        @endforeach
                                        <td>
                                            <button class="btn btn-sm btn-primary" data-bs-toggle="modal"
                                                data-bs-target="#nilaiModal{{ $alt->id }}">
                                                {{ $alt->nilaiKriteria->count() ? 'Edit Nilai' : 'Isi Nilai' }}
                                            </button>
                                        </td>
                                    </tr>

                                    <!-- Modal Input Nilai -->
                                    <div class="modal fade" id="nilaiModal{{ $alt->id }}" tabindex="-1">
                                        <div class="modal-dialog modal-lg">
                                            <form action="{{ route('nilai_alternatif.storeOrUpdate', $alt->id) }}"
                                                method="POST">
                                                @csrf
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">Input Nilai untuk
                                                            {{ $alt->nama_alternatif }}</h5>
                                                        <button type="button" class="btn-close"
                                                            data-bs-dismiss="modal"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        @foreach ($kriteria as $krit)
                                                            @php
                                                                $nilai = $alt->nilaiKriteria->firstWhere(
                                                                    'kriteria_id',
                                                                    $krit->id,
                                                                );
                                                            @endphp
                                                            <div class="mb-3">
                                                                <label>{{ $krit->nama_kriteria }}</label>
                                                                <input type="number" name="nilai[{{ $krit->id }}]"
                                                                    class="form-control"
                                                                    value="{{ $nilai ? $nilai->nilai : '' }}" required>
                                                            </div>
                                                        @endforeach
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
@endsection
