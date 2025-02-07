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
                <p class="mb-0">Edit Dosis Pemupukan - Subsidi Pupuk Dinas Pertanian </p>
            </div>
            <div>
                <a href="{{ route('backend.dosis-pupuk.index') }}" class="btn btn-outline-primary"><i
                        class="fas fa-arrow-left me-1"></i> Back</a>
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
                            href="{{ route('backend.dosis-pupuk.create') }}">@yield('title')</a></li>
                </ol>
            </nav>

        </div>
        <div class="card border-0 shadow mb-4">
    <div class="card-body">
        <form action="#" id="formUpdateDosisPempupukan">
            @csrf
            <input type="hidden" id="id" value="{{ $dosisPemupukan->uuid }}">

            <div class="row">
                <div class="col-md-6">
                    <div class="mb-4">
                        <label for="dosis_pemupukan">Dosis Pemupukan</label>
                        <select name="dosis_pemupukan" id="dosis_pemupukan" class="form-select @error('dosis_pemupukan') is-invalid @enderror"
                            onchange="updateSelections(this.value)">
                            <option value="">-- select luas lahan --</option>
                            <option value="0 - 500" {{ old('dosis_pemupukan', $dosisPemupukan->dosis_pemupukan) == '0 - 500' ? 'selected' : '' }}>0 - 500</option>
                            <option value="501 - 1000" {{ old('dosis_pemupukan', $dosisPemupukan->dosis_pemupukan) == '501 - 1000' ? 'selected' : '' }}>501 - 1000</option>
                            <option value="1001- 1350" {{ old('dosis_pemupukan', $dosisPemupukan->dosis_pemupukan) == '1001- 1350' ? 'selected' : '' }}>1001- 1350</option>
                            <option value="1351 - 1500" {{ old('dosis_pemupukan', $dosisPemupukan->dosis_pemupukan) == '1351 - 1500' ? 'selected' : '' }}>1351 - 1500</option>
                            <option value="1501 - 2000" {{ old('dosis_pemupukan', $dosisPemupukan->dosis_pemupukan) == '1501 - 2000' ? 'selected' : '' }}>1501 - 2000</option>
                        </select>
                        @error('dosis_pemupukan')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="interval">Interval</label>
                        <select name="interval" id="interval"
                            class="form-select @error('interval') is-invalid @enderror" aria-readonly="readonly">
                            <option value="">-- select interval --</option>
                            <option value="Sangat Kecil" {{ old('interval', $dosisPemupukan->interval) == 'Sangat Kecil' ? 'selected' : '' }}>Sangat Kecil</option>
                            <option value="Kecil" {{ old('interval', $dosisPemupukan->interval) == 'Kecil' ? 'selected' : '' }}>Kecil</option>
                            <option value="Sedang" {{ old('interval', $dosisPemupukan->interval) == 'Sedang' ? 'selected' : '' }}>Sedang</option>
                            <option value="Besar" {{ old('interval', $dosisPemupukan->interval) == 'Besar' ? 'selected' : '' }}>Besar</option>
                            <option value="Sangat Besar" {{ old('interval', $dosisPemupukan->interval) == 'Sangat Besar' ? 'selected' : '' }}>Sangat Besar</option>
                        </select>
                        @error('interval')
                        <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="mb-4">
                        <label for="bobot">bobot</label>
                        <select name="bobot" id="bobot" class="form-select @error('bobot') is-invalid @enderror"
                            aria-readonly="readonly">
                            <option value="">-- select bobot --</option>
                            @for ($i = 1; $i <= 5; $i++)
                                <option value="{{ $i }}" {{ old('bobot', $dosisPemupukan->bobot) == $i ? 'selected' : '' }}>{{ $i }}</option>
                            @endfor
                        </select>
                        @error('bobot')
                        <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="mb-4">
                        <label for="deskripsi">Deskripsi</label>
                        <textarea name="deskripsi" class="form-control @error('deskripsi') is-invalid @enderror"
                            rows="4">{{ old('deskripsi', $dosisPemupukan->deskripsi) }}</textarea>
                        @error('deskripsi')
                        <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="float-end">
                <a href="{{ route('backend.dosis-pupuk.index') }}" class="btn btn-secondary">Back</a>
                <button type="submit" class="btn btn-primary btnSubmit">Submit</button>
            </div>
        </form>

        <script>
            function updateSelections(luasLahan) {
                const bobotSelect = document.getElementById('bobot');
                const intervalSelect = document.getElementById('interval');

                if (luasLahan === '0 - 500') {
                    bobotSelect.value = '1';
                    intervalSelect.value = 'Sangat Kecil';
                } else if (luasLahan === '501 - 1000') {
                    bobotSelect.value = '2';
                    intervalSelect.value = 'Kecil';
                } else if (luasLahan === '1001- 1350') {
                    bobotSelect.value = '3';
                    intervalSelect.value = 'Sedang';
                } else if (luasLahan === '1351 - 1500') {
                    bobotSelect.value = '4';
                    intervalSelect.value = 'Besar';
                } else if (luasLahan === '1501 - 2000') {
                    bobotSelect.value = '5';
                    intervalSelect.value = 'Sangat Besar';
                } else {
                    bobotSelect.value = '';
                    intervalSelect.value = '';
                }
            }
        </script>
    </div>
</div>
@endsection

@push('js')
    <script src="{{ asset('assets/backend/library/jquery/jquery-3.7.1.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src={{ asset('assets/backend/js/helper.js') }}></script>
    <script src={{ asset('assets/backend/js/dosis-pemupukan.js') }}></script>
@endpush
