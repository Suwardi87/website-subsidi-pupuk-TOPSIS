@extends('backend.layout.main')

@section('title', 'Create Data Petani')

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
                            href="{{ route('backend.dosis-pupuk.index') }}">Data Petani</a></li>
                    <li class="breadcrumb-item active" aria-current="page"><a
                            href="{{ route('backend.dosis-pupuk.create') }}">@yield('title')</a></li>
                </ol>
            </nav>
            <div class="d-flex justify-content-between w-100 flex-wrap">
                <div class="mb-3 mb-lg-0">
                    <h1 class="h4">@yield('title')</h1>
                    <p class="mb-0">Create Data Petani - Subsidi Pupuk Dinas Pertanian </p>
                </div>
                <div>
                    <a href="{{ route('backend.dosis-pupuk.index') }}" class="btn btn-outline-primary"><i
                            class="fas fa-arrow-left me-1"></i> Back</a>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-header">
                <h5 class="card-title">@yield('title')</h5>
            </div>
            <div class="card-body">
                <form action="#" id="formProses" class="row g-3">
                    @csrf
                    <!-- Input Luas Tanah -->
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="user_id">Nama Petani</label>
                            <select name="user_id" id="user_id" class="form-select @error('user_id') is-invalid @enderror">
                                <option value="">-- select Users --</option>
                                @foreach ($users as $user)
                                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                                @endforeach
                            </select>

                            @error('category_id')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-4">
                            <label for="luas_lahan">Luas Lahan</label>
                            <input name="luas_lahan"  type="number" step="0.1" class="form-control @error('luas_lahan') is-invalid @enderror" rows="4">{{ old('luas_lahan') }}
                            @error('luas_lahan')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="biaya_produksi">Biaya Produksi</label>
                            <input name="biaya_produksi" id="biaya_produksi" type="number" class="form-control @error('biaya_produksi') is-invalid @enderror">
                            @error('biaya_produksi')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="hasil_produksi">Hasil Produksi</label>
                            <input name="hasil_produksi" id="hasil_produksi" type="number" class="form-control @error('hasil_produksi') is-invalid @enderror">
                            @error('hasil_produksi')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="mb-4">
                            <label for="dosis_pemupukan">Dosis Pemupukan</label>
                            <input name="dosis_pemupukan" type="number" class="form-control @error('dosis_pemupukan') is-invalid @enderror" rows="4">{{ old('dosis_pemupukan') }}
                            @error('dosis_pemupukan')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="mb-4">
                            <label for="verifikasi">Verifikasi</label>
                            <select name="verifikasi" id="verifikasi" class="form-select @error('verifikasi') is-invalid @enderror">
                                <option value="">-- Pilih --</option>
                                <option value="setuju">Setuju</option>
                                <option value="tolak">Tolak</option>
                            </select>

                            @error('verifikasi')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <!-- Submit Button -->
                    <div class="col-12">
                        <button type="submit" class="btn btn-primary btnSubmit w-100">Submit</button>
                    </div>
                </form>
            </div>
        </div>

    </div>
@endsection

@push('js')
    <script src="{{ asset('assets/backend/library/jquery/jquery-3.7.1.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src={{ asset('assets/backend/js/helper.js') }}></script>
    <script src={{ asset('assets/backend/js/proses.js') }}></script>
@endpush
