@extends('backend.layout.main')

@section('title', 'Create Luas Tanah')

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
                            href="{{ route('backend.luas-tanah.index') }}">Luas Tanah</a></li>
                    <li class="breadcrumb-item active" aria-current="page"><a
                            href="{{ route('backend.luas-tanah.create') }}">@yield('title')</a></li>
                </ol>
            </nav>
            <div class="d-flex justify-content-between w-100 flex-wrap">
                <div class="mb-3 mb-lg-0">
                    <h1 class="h4">@yield('title')</h1>
                    <p class="mb-0">Create Luas Tanah - Subsidi Pupuk Dinas Pertanian </p>
                </div>
                <div>
                    <a href="{{ route('backend.luas-tanah.index') }}" class="btn btn-outline-primary"><i
                            class="fas fa-arrow-left me-1"></i> Back</a>
                </div>
            </div>
        </div>

        <form action="#" id="formLuasTanah">
            @csrf
            <!-- Input Luas Tanah -->
            <div class="mb-4">
                <label for="luas_lahan">Luas Tanah</label>
                <input type="number" name="luas_lahan" class="form-control @error('luas_lahan') is-invalid @enderror"
                    value="{{ old('luas_lahan', 0) }}">
                @error('luas_lahan')
                    <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>

            <div class="row">
                <div class="col-md-6">
                    <!-- Input Interval -->
                    <div class="mb-3">
                        <label for="interval">Interval</label>
                        <input name="interval" type="text" class="form-control @error('interval') is-invalid @enderror"
                            value="{{ old('interval') }}">
                        @error('interval')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="col-md-6">
                    <!-- Input Lokasi Lahan -->
                    <div class="mb-4">
                        <label for="lokasi_lahan">Lokasi Lahan</label>
                        <select name="lokasi_lahan" class="form-select @error('lokasi_lahan') is-invalid @enderror">
                            <option value="">-- select lokasi lahan --</option>
                            <option value="lokasi1" {{ old('lokasi_lahan') == 'lokasi1' ? 'selected' : '' }}>Lokasi 1
                            </option>
                            <option value="lokasi2" {{ old('lokasi_lahan') == 'lokasi2' ? 'selected' : '' }}>Lokasi 2
                            </option>
                            <option value="lokasi3" {{ old('lokasi_lahan') == 'lokasi3' ? 'selected' : '' }}>Lokasi 3
                            </option>
                        </select>
                        @error('lokasi_lahan')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
            </div>

            <!-- Submit Button -->
            <div class="float-end">
                <button type="submit" class="btn btn-primary btnSubmit">Submit</button>
            </div>
        </form>

    </div>
@endsection

@push('js')
    <script src="{{ asset('assets/backend/library/jquery/jquery-3.7.1.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src={{ asset('assets/backend/js/helper.js') }}></script>
    <script src={{ asset('assets/backend/js/luas-tanah.js') }}></script>
@endpush
