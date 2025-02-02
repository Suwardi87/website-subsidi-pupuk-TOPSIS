@extends('backend.layout.main')

@section('title', 'Hasil Produksi')

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

        <div class="d-flex justify-content-between w-100 flex-wrap">
            <div class="mb-3 mb-lg-0">
                <h1 class="h4">@yield('title')</h1>
                <p class="my-3">@yield('title') - Subsidi Pupuk Dinas Pertanian </p>
            </div>
        </div>
        <div class="card border-0 shadow mb-4">
            <div class="card-body">
                <div class="table-responsive-sm mt-4">
                    <table class="table table-striped table-bordered" id="yajra" width="100%">
                        <tr>
                            <th>Hasil Produksi</th>
                            <td>{{ $hasilProduksi->hasil_produksi }}</td>
                        </tr>
                        <tr>
                            <th>Interval</th>
                            <td>{{ $hasilProduksi->interval }}</td>
                        </tr>
                        <tr>
                            <th>Slug</th>
                            <td>{{ $hasilProduksi->slug }}</td>
                        </tr>
                        <tr>
                            <th>Deskripsi</th>
                            <td>{{ $hasilProduksi->deskripsi }}</td>
                        </tr>
                    </table>

                    <div class="d-flex justify-content-end mt-3">
                        <a href="{{ route('backend.hasil-produksi.index') }}" class="btn btn-secondary"><i
                                class="fas fa-arrow-left"></i> Back</a>
                        <a href="{{ route('backend.hasil-produksi.edit', $hasilProduksi->uuid) }}" class="btn btn-primary"><i
                                class="fas fa-edit"></i> Edit</a>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection

@push('js')
    <script src="{{ asset('assets/backend/library/jquery/jquery-3.7.1.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src={{ asset('assets/backend/js/helper.js') }}></script>
    <script src={{ asset('assets/backend/js/article.js') }}></script>
@endpush
