<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Surat Keterangan</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }
        .logo {
            max-width: 80px;
            margin-right: 20px;
        }
        .title {
            text-align: center;
            flex-grow: 1;
        }
        h3, h4 {
            margin: 0;
        }
        .title p {
            margin: 0;
        }
        .subtitle {
            text-align: center;
            margin-top: 5px;
        }
        .nomor {
            text-align: right;
            margin-top: 5px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            border: 1px solid #000;
            padding: 8px;
            text-align: left;
        }
        .signature {
            text-align: right;
            margin-top: 30px;
        }
        .print-btn {
            display: block;
            margin: 20px auto;
            padding: 10px 15px;
            background: #007bff;
            color: white;
            border: none;
            cursor: pointer;
            font-size: 16px;
            border-radius: 5px;
        }
        .print-btn:hover {
            background: #0056b3;
        }

        /* Perbaikan tampilan cetak */
        @media print {
            .print-btn {
                display: none !important;
            }
            .container {
                width: 100% !important;
                margin: 0 !important;
                padding: 0 !important;
            }
            img {
                display: block !important;
                max-width: 100px !important;
                margin: 10px auto !important;
                break-inside: avoid;
            }
            table, th, td {
                border: 1px solid #000 !important;
                page-break-inside: avoid;
            }
            .signature {
                page-break-before: avoid;
            }
        }
    </style>
</head>
<body>

<div class="container">
    <div class="header">
        <div class="logo">
            <img src="{{ $logo }}" alt="Logo Kabupaten Tanah Datar" class="logo">
        </div>
        <div class="title">
            <h3>Dinas Pertanian</h3>
            <h4>Kabupaten Tanah Datar</h4>
            <div class="subtitle">
                <p><strong>Nomor: SKHP-{{ date('YmdHis') }}</strong></p>
            </div>
        </div>
        <div class="nomor">
            <p><strong>Nomor Surat:</strong> SKHP-{{ date('YmdHis') }}</p>
        </div>
    </div>
    <hr>

    <p><strong>Yang bertanda tangan di bawah ini,</strong></p>
    <p>Nama: Sri Mulyani, SP, M.Si.</p>
    <p>Jabatan: Kepala Dinas Pertanian</p>
    <p>
        Dengan ini menyatakan bahwa hasil perhitungan bantuan pupuk subsidi untuk kelompok tani di wilayah
        Nagari Paninjauan telah dilakukan dengan menggunakan metode TOPSIS.
    </p>
    <p>Berikut adalah 5 (lima) alternatif terbaik yang direkomendasikan untuk mendapatkan bantuan pupuk subsidi:</p>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Alternatif</th>
                <th>Nilai Preferensi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($top5Alternatives as $index => $item)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ e($item['alternatif']) }}</td>
                    <td>{{ e($item['nilai_preferensi']) }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <p>Demikian surat keterangan hasil perhitungan ini dibuat untuk digunakan sebagaimana mestinya.</p>

    <div class="signature">
        <p>Mengetahui,</p>
        <br><br><br>
        <p><strong>Sri Mulyani, SP, M.Si.</strong></p>
        <p>Kepala Dinas Pertanian</p>
    </div>

    {{-- <button class="print-btn" onclick="window.print()">Cetak Surat</button> --}}
</div>

</body>
</html>
