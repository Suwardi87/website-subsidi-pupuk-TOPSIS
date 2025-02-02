@extends('backend.layout.main')

@section('title', 'Edit Luas Tanah')

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
                <p class="mb-0">Edit Luas Tanah - Subsidi Pupuk Dinas Pertanian </p>
            </div>
            <div>
                <a href="{{ route('backend.luas-tanah.index') }}" class="btn btn-outline-primary"><i
                        class="fas fa-arrow-left me-1"></i> Back</a>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-header">
            <h4 class="card-title">@yield('title')</h4>
        </div>
        <div class="card-body">
            <form action="#" id="formUpdateluasTanah">
                @csrf
                <input type="hidden" id="id" value="{{ $luasTanah->uuid }}">
                <div class="mb-4">
                    <label for="luas_lahan">Luas Tanah</label>
                    <select name="luas_lahan" id="luas_lahan" class="form-select @error('luas_lahan') is-invalid @enderror"
                        onchange="updateSelections(this.value)">
                        <option value="">-- select luas lahan --</option>
                        <option value="1.0 - 1.2" {{ old('luas_lahan', $luasTanah->luas_lahan) == '1.0 - 1.2' ? 'selected' : '' }}>1.0 - 1.2</option>
                        <option value="1.3 - 1.5" {{ old('luas_lahan', $luasTanah->luas_lahan) == '1.3 - 1.5' ? 'selected' : '' }}>1.3 - 1.5</option>
                        <option value="1.6 - 2.0" {{ old('luas_lahan', $luasTanah->luas_lahan) == '1.6 - 2.0' ? 'selected' : '' }}>1.6 - 2.0</option>
                        <option value="2.1 - 2.5" {{ old('luas_lahan', $luasTanah->luas_lahan) == '2.1 - 2.5' ? 'selected' : '' }}>2.1 - 2.5</option>
                        <option value="2.6 - 4.5" {{ old('luas_lahan', $luasTanah->luas_lahan) == '2.6 - 4.5' ? 'selected' : '' }}>2.6 - 4.5</option>
                    </select>
                    @error('luas_lahan')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
                <div class="col-md-6">
                    <!-- Input Interval -->
                    <div class="mb-3">
                        <label for="interval">Interval</label>
                        <select name="interval" id="interval" class="form-select @error('interval') is-invalid @enderror"
                            aria-readonly="readonly">
                            <option value="">-- select interval --</option>
                            <option value="Sangat Kecil" {{ old('interval', $luasTanah->interval) == 'Sangat Kecil' ? 'selected' : '' }}>Sangat Kecil</option>
                            <option value="Kecil" {{ old('interval', $luasTanah->interval) == 'Kecil' ? 'selected' : '' }}>Kecil</option>
                            <option value="Sedang" {{ old('interval', $luasTanah->interval) == 'Sedang' ? 'selected' : '' }}>Sedang</option>
                            <option value="Besar" {{ old('interval', $luasTanah->interval) == 'Besar' ? 'selected' : '' }}>Besar</option>
                            <option value="Sangat Besar" {{ old('interval', $luasTanah->interval) == 'Sangat Besar' ? 'selected' : '' }}>Sangat Besar</option>
                        </select>
                        @error('interval')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="col-md-6">
                    <!-- Input Lokasi Lahan -->
                    <div class="mb-4">
                        <label for="bobot">bobot</label>
                        <select name="bobot" id="bobot" class="form-select @error('bobot') is-invalid @enderror" aria-readonly="readonly">
                            <option value="">-- select lokasi lahan --</option>
                            @for ($i = 1; $i <= 5; $i++)
                                <option value="{{ $i }}" {{ old('bobot', $luasTanah->bobot) == $i ? 'selected' : '' }}>{{ $i }}</option>
                            @endfor
                        </select>
                        @error('bobot')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

            <script>
                function updateSelections(luasLahan) {
                    const bobotSelect = document.getElementById('bobot');
                    const intervalSelect = document.getElementById('interval');

                    if (luasLahan === '1.0 - 1.2') {
                        bobotSelect.value = '1';
                        intervalSelect.value = 'Sangat Kecil';
                    } else if (luasLahan === '1.3 - 1.5') {
                        bobotSelect.value = '2';
                        intervalSelect.value = 'Kecil';
                    } else if (luasLahan === '1.6 - 2.0') {
                        bobotSelect.value = '3';
                        intervalSelect.value = 'Sedang';
                    } else if (luasLahan === '2.1 - 2.5') {
                        bobotSelect.value = '4';
                        intervalSelect.value = 'Besar';
                    } else if (luasLahan === '2.6 - 4.5') {
                        bobotSelect.value = '5';
                        intervalSelect.value = 'Sangat Besar';
                    } else {
                        bobotSelect.value = '';
                        intervalSelect.value = '';
                    }
                }
            </script>

            <div class="float-end">
                <a href="{{ route('backend.luas-tanah.index') }}" class="btn btn-secondary">Back</a>
                <button type="submit" class="btn btn-primary btnSubmit">Submit</button>
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
<script src={{ asset('assets/backend/js/luas-tanah.js') }}></script>
@endpush
