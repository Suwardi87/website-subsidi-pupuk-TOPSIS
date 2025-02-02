@extends('backend.layout.main')

@section('title', 'Data Petani')

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
            <a href="{{ route('backend.proses.create') }}"
                class="btn btn-outline-primary d-inline-flex my-2 align-items-center">
                <i class="fas fa-plus me-2"></i>
                Create @yield('title')
            </a>
        </div>
    </div>

    <div class="card border-0 shadow mb-4">
        <div class="card-body">
            <div class="table-responsive-sm mt-4">
                <table class="table table-striped table-bordered" id="yajra" width="100%">
                    <tr>
                        <th>Nama Petani</th>
                        <td>{{ $proses->user->name }}</td>
                    </tr>
                    <tr>
                        <th>Luas Lahan</th>
                        <td>{{ $proses->luas_lahan }}</td>
                    </tr>
                    <tr>
                        <th>Komoditas</th>
                        <td>{{ $proses->komoditas->nama }}</td>
                    </tr>
                    <tr>
                        <th>Musim Tanam</th>
                        <td>{{ $proses->musimTanam->nama }}</td>
                    </tr>
                    <tr>
                        <th>Dosis Pemupukan</th>
                        <td>{{ $proses->dosis_pemupukan }}</td>
                    </tr>
                </table>

                <div class="d-flex justify-content-end mt-3">
                    <a href="{{ route('backend.proses.index') }}" class="btn btn-secondary"><i
                            class="fas fa-arrow-left"></i> Back</a>
                    <a href="{{ route('backend.proses.edit', $proses->uuid) }}" class="btn btn-primary"><i
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
    <script src={{ asset('assets/backend/js/dosis-pemupukan.js') }}></script>
@endpush

