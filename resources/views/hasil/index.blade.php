@extends('layouts.template')

@section('content')
    <div class="container">
        <h4>Hasil Akhir WP</h4>
        <div class="card">
            <div class="card-body">
                <table class="table table-bordered table-striped">
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
