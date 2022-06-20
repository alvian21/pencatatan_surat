<html>

<head>
    <title>Laporan {{ $status }}</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>

<body>
    <style type="text/css">
        table tr td,
        table tr th {
            font-size: 9pt;
            border: 1px solid black;
        }
    </style>
    <center>
        <h5>Laporan {{ $status }}</h4>
            <h6>Periode {{ $periode_awal }} - {{ $periode_akhir }}</h6>
    </center>

    @if ($status == 'Surat Masuk')

        <table class='table table-bordered'>
            <thead>
                <tr>
                    <th>Nomor Surat</th>
                    <th>Tanggal Masuk</th>
                    <th>Tanggal Surat</th>
                    <th>Dari</th>
                    <th>Kode Surat</th>
                    <th>Posisi</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>

                @foreach ($data as $item)
                    <tr>
                        <td>{{ $item->reference_number_i }}</td>
                        <td>{{ date('j F Y', strtotime($item->date_of_receipt)) }}</td>
                        <td>{{ date('j F Y', strtotime($item->letter_date_i)) }}</td>
                        <td>{{ $item->from }}</td>
                        <td>{{ $item->description_letter_code }}</td>
                        <td>{{ $item->position }}</td>
                        <td>{{ $item->status }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <table class='table table-bordered'>
            <thead>
                <tr>
                    <th>Nomor Surat</th>

                    <th>Tanggal Surat</th>
                    <th>Kepada</th>
                    <th>Kode Surat</th>

                    <th>Status</th>
                </tr>
            </thead>
            <tbody>

                @foreach ($data as $item)
                    <tr>
                        <td>{{ $item->reference_number_o }}</td>

                        <td>{{ date('j F Y', strtotime($item->letter_date_i)) }}</td>
                        <td>{{ $item->to }}</td>
                        <td>{{ $item->description_letter_code }}</td>

                        <td>{{ $item->status }}</td>

                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif

</body>

</html>
