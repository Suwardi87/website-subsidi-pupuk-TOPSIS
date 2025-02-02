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
            <a href="{{ route('backend.topsis.index') }}"
                class="btn btn-outline-primary d-inline-flex my-2 align-items-center">
                <i class="fas fa-calculator me-2"></i>
                Proses TOPSIS
            </a>
        </div>
    </div>

    {{-- table --}}
    <div class="card border-0 shadow mb-4">
        <div class="card-body">
            <div class="table-responsive-sm">
                <table class="table table-striped table-bordered table-striped"  width="100%">
                    <thead>
                        <tr>
                            <th width="1%">No</th>
                            <th>Nama</th>
                            <th>Luas Lahan</th>
                            <th>Komoditas</th>
                            <th>Musim Tanam</th>
                            <th>Dosis Pemupukan</th>
                            <th>Verifikasi</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($proses as $item)
                            <tr>
                                <td>{{ ($proses->currentPage() - 1) * $proses->perPage() + $loop->iteration }}</td>
                                <td>{{ $item->user->name }}</td>
                                <td>{{ $item->luas_lahan }}</td>
                                <td>{{ $item->biaya_produksi}}</td>
                                <td>{{ $item->hasil_produksi }}</td>
                                <td>{{ $item->dosis_pemupukan }}</td>
                                <td>
                                    @if ($item->verifikasi == 'tolak')
                                        <span class="badge bg-danger">Ditolak</span>
                                    @else
                                        <span class="badge bg-success">Success</span>
                                    @endif
                                </td>
                                <td>
                                    <div class="btn-group">
                                        <a href="{{ route('backend.proses.show', $item->uuid) }}" class="btn btn-sm btn-info">
                                            <i class="fas fa-eye"></i>
                                        </a>

                                       {{-- @if (auth()->user()->role == 'operator') --}}
                                            <a href="{{ route('backend.proses.edit', $item->uuid) }}"
                                                class="btn btn-sm btn-primary">
                                                <i class="fas fa-edit"></i>
                                            </a>

                                            <button class="btn btn-danger" onclick="deleteData(this)" data-uuid="{{ $item->uuid }}">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        {{-- @endif --}}
                                    </div>
                                </td>
                            </tr>
                        @endforeach

                    </tbody>
                </table>
                <div class="d-flex justify-content-end mt-3">
                    {{ $proses->links() }}
                </div>
            </div>

            {{-- @include('backend.order._modal-download') --}}
            @include('backend.home.section._footer')

        </div>

        @endsection
        @push('js')
        <script src="{{ asset('assets/backend/library/jquery/jquery-3.7.1.min.js') }}"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        {{-- <script src="https://cdn.datatables.net/2.1.8/js/dataTables.js"></script> --}}
        {{-- <script src="https://cdn.datatables.net/2.1.8/js/dataTables.bootstrap5.js"></script> --}}
        <script src={{ asset('assets/backend/js/helper.js') }}></script>
        <script src={{ asset('assets/backend/js/proses.js') }}></script>

        {{-- <script type="text/javascript" src="{{ asset('vendor/jsvalidation/js/jsvalidation.js') }}"></script> --}}

        {{-- {!! JsValidator::formRequest('App\Http\Requests\TagRequest', '#formTag') !!} --}}
        @endpush
