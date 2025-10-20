<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Laporan Keuangan</title>
    <style>
        body {
            font-family: sans-serif;
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
            padding: 5px;
            text-align: left;
        }

        th {
            background-color: #f0f0f0;
        }
    </style>
</head>

<body>
    <h2>Laporan Keuangan</h2>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Kegiatan</th>
                <th>Periode</th>
                <th>Total Pemasukan</th>
                <th>Total Pengeluaran Langsung</th>
                <th>Total Pengeluaran Tidak Langsung</th>
                <th>Total Pengeluaran</th>
                <th>Saldo</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($laporan as $index => $row)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $row->kegiatan->name ?? '-' }}</td>
                    <td>{{ $row->periode }}</td>
                    <td>{{ number_format($row->total_pemasukan, 0, ',', '.') }}</td>
                    <td>{{ number_format($row->total_pengeluaran_langsung, 0, ',', '.') }}</td>
                    <td>{{ number_format($row->total_pengeluaran_tidak_langsung, 0, ',', '.') }}</td>
                    <td>{{ number_format($row->total_pengeluaran, 0, ',', '.') }}</td>
                    <td>{{ number_format($row->saldo, 0, ',', '.') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>
