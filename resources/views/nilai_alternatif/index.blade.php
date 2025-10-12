@extends('layouts.template')

@section('content')
    <div class="container">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h5>Data Nilai Alternatif</h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped basic-datatables">
                            <thead>
                                <tr>
                                    <th>Alternatif</th>
                                    @foreach ($kriteria as $krit)
                                        <th>{{ $krit->nama_kriteria }}</th>
                                    @endforeach
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($alternatif as $alt)
                                    <tr>
                                        <td>{{ $alt->nama_alternatif }}</td>
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
