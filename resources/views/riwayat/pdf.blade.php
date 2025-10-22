<!DOCTYPE html>
<html>

<head>
    <title>Hasil Penilaian - {{ $kelas->nama_kelas }}</title>
    <style>
        body {
            font-family: sans-serif;
            font-size: 12px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th,
        td {
            border: 1px solid #333;
            padding: 6px;
            text-align: center;
        }

        th {
            background-color: #f2f2f2;
        }

        h3 {
            text-align: center;
        }
    </style>
</head>

<body>
    <h3>Hasil Penilaian Kelas {{ $kelas->nama_kelas }}</h3>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Alternatif</th>
                <th>Nilai Preferensi (V)</th>
                <th>Ranking</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($hasil as $index => $row)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $row->alternatif->nama_alternatif }}</td>
                <td>{{ number_format($row->nilai_preferensi, 4) }}</td>
                <td>{{ $row->ranking }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>