@extends('layouts.template')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header">
                <h5>Riwayat Penilaian</h5>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="basic-datatables" class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Kelas</th>
                                <th>Penilaian</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($kelas as $index => $row)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $row->nama_kelas }}</td>
                                    <td>
                                        <a href="{{ route('riwayat.cetak', $row->id) }}" class="btn btn-sm btn-danger"
                                            target="_blank">
                                            PDF
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
