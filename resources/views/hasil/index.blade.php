@extends('layouts.template')

@section('content')
    <div class="container">
        <h4>Hasil Akhir WP</h4>

        <div class="card mb-3">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4">
                        <label for="kelasFilter" class="form-label">Filter Kelas</label>
                        <select id="kelasFilter" class="form-select">
                            <option value="">-- Semua Kelas --</option>
                            @foreach ($kelas as $k)
                                <option value="{{ $k->id }}" {{ $kelasId == $k->id ? 'selected' : '' }}>
                                    {{ $k->nama_kelas }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-body">
                <table class="table table-bordered table-striped basic-datatables">
                    <p>Berikut merupakan nama-nam santri yang di rekomendasikan sebagai santri teladan berdasarkan nilai
                        vektor tertinggi</p>
                    <thead>
                        <tr>
                            <th>Peringkat</th>
                            <th>Nama Alternatif</th>
                            <th>Kelas</th>
                            <th>Nilai V</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $rank = 1; @endphp
                        @foreach ($ranking as $data)
                            <tr>
                                <td>{{ $rank++ }}</td>
                                <td>{{ $data['alternatif'] }}</td>
                                <td>{{ $data['kelas'] }}</td>
                                <td>{{ number_format($data['V'], 4) }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script>
        document.getElementById('kelasFilter').addEventListener('change', function() {
            const kelasId = this.value;
            const url = new URL(window.location.href);
            if (kelasId) {
                url.searchParams.set('kelas_id', kelasId);
            } else {
                url.searchParams.delete('kelas_id');
            }
            window.location.href = url.toString();
        });
    </script>
@endsection
