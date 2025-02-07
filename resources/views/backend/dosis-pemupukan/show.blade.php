@extends('backend.layout.main')

@section('title', 'Dosis Pemupukan')

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
            <p class="my-2">@yield('title') - Subsidi Pupuk Dinas Pertanian </p>
        </div>
    </div>
    <div class="py-4">
        <nav aria-label="breadcrumb" class="d-none d-md-inline-block">
            <ol class="breadcrumb breadcrumb-dark breadcrumb-transparent">
                <li class="">
                    <a href="#">
                        <svg class="icon icon-xxs" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                            xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6">
                            </path>
                        </svg>
                    </a>
                </li>
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page"><a
                        href="{{ route('backend.dosis-pupuk.index') }}">Dosis Pemupukan</a></li>
                <li class="breadcrumb-item active" aria-current="page"><a
                        href="{{ route('backend.dosis-pupuk.show', $dosisPemupukan->id) }}">@yield('title')</a></li>
            </ol>
        </nav>
    </div>

    <div class="card border-0 shadow mb-4">
        <div class="card-body">
            <div class="table-responsive-sm mt-4">
                <table class="table table-striped table-bordered" id="yajra" width="100%">
                    <tr>
                        <th>Dosis Pemupukan</th>
                        <td>{{ $dosisPemupukan->dosis_pemupukan }}</td>
                    </tr>
                    <tr>
                        <th>Interval</th>
                        <td>{{ $dosisPemupukan->interval }}</td>
                    </tr>
                    <tr>
                        <th>Bobot</th>
                        <td>{{ $dosisPemupukan->bobot }}</td>
                    </tr>
                    <tr>
                        <th>Deskripsi</th>
                        <td>{{ $dosisPemupukan->deskripsi }}</td>
                    </tr>
                </table>

                <div class="d-flex justify-content-end mt-3">
                    <a href="{{ route('backend.dosis-pupuk.index') }}" class="btn btn-secondary"><i
                            class="fas fa-arrow-left"></i> Back</a>
                    <a href="{{ route('backend.dosis-pupuk.edit', $dosisPemupukan->uuid) }}" class="btn btn-primary"><i
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

