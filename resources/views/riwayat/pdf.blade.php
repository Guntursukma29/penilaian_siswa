<!DOCTYPE html>
<html>

    <head>
        <title>Laporan Hasil Penilaian - {{ $kelas->nama_kelas }}</title>
        <style>
            body {
                font-family: DejaVu Sans, sans-serif;
                font-size: 12px;
            }

            table {
                width: 100%;
                border-collapse: collapse;
                margin-top: 10px;
            }

            th,
            td {
                border: 1px solid #000;
                padding: 6px;
                text-align: center;
            }
        </style>
    </head>

    <body>
        <h2 align="center">Laporan Hasil Penilaian</h2>
        <p><strong>Kelas:</strong> {{ $kelas->nama_kelas }}</p>

        <table>
            <thead>
                <tr>
                    <th>Ranking</th>
                    <th>Alternatif</th>
                    <th>Nilai Akhir</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($hasil as $row)
                    <tr>
                        <td>{{ $row->ranking }}</td>
                        <td>{{ $row->alternatif->nama_alternatif }}</td>
                        <td>{{ number_format($row->nilai_preferensi, 4) }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </body>

</html>
