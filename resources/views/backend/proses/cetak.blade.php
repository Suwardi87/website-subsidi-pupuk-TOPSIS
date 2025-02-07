<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div style="text-align: center;">
                        <h3>DINAS PERTANIAN</h3>
                        <h4>KABUPATEN TANAH DATAR</h4>
                        <p>Nomor: {{ 'SKHP-' . date('YmdHis') }}</p>
                    </div>
                    <hr>
                    <p><strong>Yang bertanda tangan di bawah ini,</strong></p>
                    <p>Nama: Sri Mulyani, SP, M.Si. </p>
                    <p>Jabatan: Kepala Dinas Pertanian</p>
                    <p>Dengan ini menyatakan bahwa hasil perhitungan bantuan pupuk subsidi untuk kelompok tani di wilayah Nagari Paninjauan telah dilakukan dengan menggunakan metode TOPSIS.</p>
                    <p>Berikut adalah 5 (lima) alternatif terbaik yang direkomendasikan untuk mendapatkan bantuan pupuk subsidi:</p>

                    <table style="width: 100%; border-collapse: collapse; border: 1px solid #ddd; text-align: center;">
                        <thead>
                            <tr>
                                <th style="border: 1px solid #ddd; padding: 8px;">No</th>
                                <th style="border: 1px solid #ddd; padding: 8px;">Alternatif</th>
                                <th style="border: 1px solid #ddd; padding: 8px;">Nilai Preferensi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($top5Alternatives as $index => $item)
                                <tr>
                                    <td style="border: 1px solid #ddd; padding: 8px;">{{ $index + 1 }}</td>
                                    <td style="border: 1px solid #ddd; padding: 8px;">{{ $item['alternatif'] }}</td>
                                    <td style="border: 1px solid #ddd; padding: 8px;">{!! $item['nilai_preferensi'] !!}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <br><br>
                    <p>Demikian surat keterangan hasil perhitungan ini dibuat untuk digunakan sebagaimana mestinya.</p>

                    <br><br><br>
                    <p style="text-align: right;">Mengetahui,</p>
                    <br><br><br>
                    <p style="text-align: right;">Sri Mulyani, SP, M.Si. </p>
                    <p style="text-align: right;">Kepala Dinas Pertanian</p>
                </div>
            </div>
        </div>
    </div>
</div>

