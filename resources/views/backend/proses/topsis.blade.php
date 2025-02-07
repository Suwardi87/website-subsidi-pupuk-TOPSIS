@extends('backend.layout.main')

@section('title', 'Topsis')

@push('css')
    <link rel="stylesheet" href="{{ asset('assets/backend') }}/vendors/apexcharts/apexcharts.css">
@endpush

@push('js')
    <script src="{{ asset('assets/backend') }}/vendors/apexcharts/apexcharts.min.js"></script>
    <script src="{{ asset('assets/backend') }}/js/pages/dashboard.js"></script>
@endpush

@section('content')
    <div id="main">

        @include('backend.home.section._header')

        <div class="py-4">
            <nav aria-label="breadcrumb" class="d-none d-md-inline-block">
                <ol class="breadcrumb breadcrumb-dark breadcrumb-transparent">
                    <li>
                        <a href="#">
                            <svg class="icon icon-xxs" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                            </svg>
                        </a>
                    </li>
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active" aria-current="page"><a href="{{ route('backend.proses.index') }}">Proses</a></li>
                    <li class="breadcrumb-item active" aria-current="page"><a href="{{ route('backend.topsis.index') }}">@yield('title')</a></li>
                </ol>
            </nav>
            <div class="d-flex justify-content-between w-100 flex-wrap">
                <div class="mb-3 mb-lg-0">
                    <h1 class="h4">@yield('title')</h1>
                    <p class="mb-0">Topsis - Subsidi Pupuk Dinas Pertanian</p>
                </div>
                <div>
                    <a href="{{ route('backend.proses.index') }}" class="btn btn-outline-primary">
                        <i class="fas fa-arrow-left me-1"></i> Back
                    </a>
                </div>
            </div>
        </div>

        <h1 class="mt-4">Hasil Perhitungan TOPSIS</h1>

        {{-- <div class="card">
            <div class="card-header">
                <h4>Bobot Kriteria</h4>
            </div>
            <div class="card-body">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Kriteria</th>
                            <th>Bobot</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($bobot as $kriteria => $bobotValue)
                            <tr>
                                <td>{{ ucfirst(str_replace('_', ' ', $kriteria)) }}</td>
                                <td>{{ $bobotValue }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

       <hr> --}}

       <div class="card">
        <div class="card-header">
            <h4>Data Petani</h4>
        </div>
        <div class="card-body">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Alternatif</th>
                        <th>Luas Lahan</th>
                        <th>Biaya Produksi</th>
                        <th>Hasil Produksi</th>
                        <th>Dosis Pemupukan</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($dataMentah as $item)
                        <tr>
                            <td>A{{ $loop->index + 1 }}</td>
                            <td>{{ $item['luas_lahan'] }}</td>
                            <td>{{ $item['biaya_produksi'] }}</td>
                            <td>{{ $item['hasil_produksi'] }}</td>
                            <td>{{ $item['dosis_pemupukan'] }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

       <hr>
       @if(!in_array(Auth::user()->role, ['petani','petugasDinas']))
        <div class="card">
            <div class="card-header">
                <h4>Matriks X</h4>
            </div>
            <div class="card-body">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Alternatif</th>
                            <th>Luas Lahan</th>
                            <th>Biaya Produksi</th>
                            <th>Hasil Produksi</th>
                            <th>Dosis Pemupukan</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($matriksX as $item)
                            <tr>
                                <td>A{{ $loop->index + 1 }}</td>
                                <td>{{ $item['luas_lahan'] }}</td>
                                <td>{{ $item['biaya_produksi'] }}</td>
                                <td>{{ $item['hasil_produksi'] }}</td>
                                <td>{{ $item['dosis_pemupukan'] }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>


        <hr>

        <div class="card">

        <hr>
        <div class="card">
            <div class="card-header">
                <h4>Normalisasi R</h4>
            </div>
            <div class="card-body">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Alternatif</th>
                            <th>Luas Lahan</th>
                            <th>Biaya Produksi</th>
                            <th>Hasil Produksi</th>
                            <th>Dosis Pemupukan</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($normalisasi as $key => $item)
                            <tr>
                                <td>A{{ $loop->index + 1 }}</td>
                                @foreach ($item as $val)
                                    <td>{{ number_format($val, 4, ',', '.') }}</td>
                                @endforeach
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <hr>
        <div class="card">
            <div class="card-header">
                <h4>Normalisasi Y</h4>
            </div>
            <div class="card-body">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Alternatif</th>
                            <th>Luas Lahan</th>
                            <th>Biaya Produksi</th>
                            <th>Hasil Produksi</th>
                            <th>Dosis Pemupukan</th>
                        </tr>
                    </thead>
                    <tbody>

                        @foreach ($matriksKeputusan as $key => $item)
                            <tr>
                                <td>A{{ $loop->index + 1 }}</td>
                                @foreach ($item as $val)
                                    <td>{{ number_format($val * ($bobot[$key] ?? 1), 4, ',', '.') }}</td>
                                @endforeach
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <hr>
        <div class="card">
            <div class="card-header">
                <h4>Solusi Ideal</h4>
            </div>
            <div class="card-body">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th></th>
                            <th>Luas Lahan</th>
                            <th>Biaya Produksi</th>
                            <th>Hasil Produksi</th>
                            <th>Dosis Pemupukan</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Max</td>
                            @foreach ($solusiIdeal['max'] as $key => $val)
                                <td>{{ number_format($val, 4, ',', '.') }}</td>
                            @endforeach
                        </tr>
                        <tr>
                            <td>Min</td>
                            @foreach ($solusiIdeal['min'] as $key => $val)
                                <td>{{ number_format($val, 4, ',', '.') }}</td>
                            @endforeach
                        </tr>
                    </tbody>
                </table>
            </div>

        <hr>
        <hr>
        <div class="card">
            <div class="card-header">
                <h4>Nilai Separasi</h4>
            </div>
            <div class="card-body">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Nama</th>
                            <th>D +</th>
                            <th>D -</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($distances as $key => $item)
                            <tr>
                                <td>A{{ $loop->index + 1 }}</td>
                                <td>{{ number_format($item['d_plus'], 4, ',', '.') }}</td>
                                <td>{{ number_format($item['d_minus'], 4, ',', '.') }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <hr>
        <hr>

        <div class="card">
            <div class="card-header">
                <h4>Nilai Preferensi</h4>
            </div>
            <div class="card-body">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Nama</th>
                            <th>Nilai Preferensi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($distances as $key => $item)
                            @php
                                $total = $item['d_plus'] + $item['d_minus'];
                                $nilaiPreferensi = $total != 0 ? $item['d_minus'] / $total : 0;
                            @endphp
                            <tr>
                                <td>A{{ $loop->index + 1 }}</td>
                                <td><strong>{{ number_format($nilaiPreferensi, 4, ',', '.') }}</strong></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <hr>
        @endif
        <hr>
        <div class="card">
            <div class="card-header">
                <h4>Ranking 5 Besar Alternatif</h4>
            @if(!in_array(Auth::user()->role, ['petani']))
                <div class="float-end">
                    {{-- <a href="{{ route('backend.proses.cetak', $preferenceValues) }}" class="btn btn-primary" target="_blank"><i class="fas fa-print"></i> Cetak</a> --}}
                </div>
            </div>
            @endif
            <div class="card-body">
                {{-- <a href="{{ route('backend.proses.cetak') }}" class="btn btn-primary" target="_blank"><i class="fas fa-print"></i> Cetak</a> --}}
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>NO</th>
                            <th>Alternatif</th>
                            <th>Nilai Preferensi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($top35Alternatives as $key => $item)
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td>{{ $item['alternatif'] }}</td>
                                <td>{!! $item['nilai_preferensi'] !!}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <hr>
        <div class="card">
            <div class="card-header">
                <h4>Ranking 5 Besar Alternatif</h4>
            @if(!in_array(Auth::user()->role, ['petani']))
                <div class="float-end">
                    <a href="{{ route('backend.proses.cetak', $preferenceValues) }}" class="btn btn-primary" target="_blank"><i class="fas fa-print"></i> Cetak</a>
                </div>
            </div>
            @endif
            <div class="card-body">
                {{-- <a href="{{ route('backend.proses.cetak') }}" class="btn btn-primary" target="_blank"><i class="fas fa-print"></i> Cetak</a> --}}
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Alternatif</th>
                            <th>Nilai Preferensi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($top5Alternatives as $item)
                            <tr>
                                <td>{{ $item['alternatif'] }}</td>
                                <td>{!! $item['nilai_preferensi'] !!}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        @endsection

        {{-- <hr> --}}
        {{-- <div class="card">
            <div class="card-header">
                <h4>Nilai Preferensi Terbaik</h4>
            </div>
            <div class="card-body">
                <h5>Nama: {{ $bestAlternative['name'] ?? 'Unknown' }}</h5>
                <h5>Nilai Preferensi: {{ number_format($bestAlternative['nilai_preferensi'] ?? 0, 4, ',', '.') }}</h5>
            </div>
        </div> --}}
{{--
    </div>
</div>


