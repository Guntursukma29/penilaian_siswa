@extends('layouts.template')

@section('content')
    <div class="container">
        <h4>Perhitungan WP</h4>

        <!-- Tabel Bobot Normalisasi -->
        <div class="card mb-3">
            <div class="card-header">Normalisasi Bobot</div>
            <div class="card-body">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Kriteria</th>
                            {{-- <th>Kelas</th> --}}
                            <th>Bobot</th>
                            <th>Normalisasi</th>
                            <th>Tipe</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($kriteria as $krit)
                            <tr>
                                <td>{{ $krit->nama_kriteria }}</td>
                                {{-- <td>{{ $krit->kelas->nama_kelas }}</td> --}}
                                <td>{{ $krit->bobot }}</td>
                                <td>{{ number_format($bobotNormalisasi[$krit->id], 4) }}</td>
                                <td>{{ ucfirst($krit->tipe) }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Tabel Perhitungan S -->
        <div class="card mb-3">
            <div class="card-header">Perhitungan Vektor S</div>
            <div class="card-body">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Alternatif</th>
                            @foreach ($kriteria as $krit)
                                <th>{{ $krit->nama_kriteria }}</th>
                            @endforeach
                            <th>S</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($nilaiS as $data)
                            <tr>
                                <td>{{ $data['alternatif'] }}</td>
                                @foreach ($data['detail'] as $val)
                                    <td>{{ number_format($val, 4) }}</td>
                                @endforeach
                                <td>{{ number_format($data['S'], 4) }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Tabel Vektor V -->
        <div class="card mb-3">
            <div class="card-header">Perhitungan Vektor V</div>
            <div class="card-body">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Alternatif</th>
                            <th>S</th>
                            <th>V</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($nilaiV as $data)
                            <tr>
                                <td>{{ $data['alternatif'] }}</td>
                                <td>{{ number_format($data['S'], 4) }}</td>
                                <td>{{ number_format($data['V'], 4) }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Tabel Ranking -->
        <div class="card">
            <div class="card-header">Ranking Alternatif</div>
            <div class="card-body">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Peringkat</th>
                            <th>Alternatif</th>
                            <th>Nilai V</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $rank = 1; @endphp
                        @foreach ($ranking as $data)
                            <tr>
                                <td>{{ $rank++ }}</td>
                                <td>{{ $data['alternatif'] }}</td>
                                <td>{{ number_format($data['V'], 4) }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

    </div>
@endsection
