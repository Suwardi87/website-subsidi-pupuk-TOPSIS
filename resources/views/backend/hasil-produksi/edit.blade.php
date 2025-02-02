@extends('backend.layout.main')

@section('title', 'Edit Hasil Produksi')

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
                            href="{{ route('backend.hasil-produksi.index') }}">Hasil Produksi</a></li>
                    <li class="breadcrumb-item active" aria-current="page"><a
                            href="{{ route('backend.hasil-produksi.create') }}">@yield('title')</a></li>
                </ol>
            </nav>
            <div class="d-flex justify-content-between w-100 flex-wrap">
                <div class="mb-3 mb-lg-0">
                    <h1 class="h4">@yield('title')</h1>
                    <p class="mb-0">Edit Hasil Produksi - Subsidi Pupuk Dinas Pertanian </p>
                </div>
                <div>
                    <a href="{{ route('backend.hasil-produksi.index') }}" class="btn btn-outline-primary"><i
                            class="fas fa-arrow-left me-1"></i> Back</a>
                </div>
            </div>
        </div>

        <form action="#" id="formUpdateHasilProduksi">
            @csrf
            <input type="hidden" id="id" value="{{ $hasilProduksi->uuid }}">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <!-- Input Hasil Produksi -->
                        <div class="mb-4">
                            <label for="hasil_produksi">Hasil Produksi</label>
                            <select name="hasil_produksi" id="hasil_produksi"
                                class="form-select @error('hasil_produksi') is-invalid @enderror"
                                onchange="updateBobot(this.value)">
                                <option value="" {{ old('hasil_produksi', $hasilProduksi->hasil_produksi) == '' ? 'selected' : '' }}>-- select Hasil Produksi --</option>
                                <option value="3000 - 4500 kg" {{ old('hasil_produksi', $hasilProduksi->hasil_produksi) == '3000 - 4500 kg' ? 'selected' : '' }}>3000 - 4500 kg</option>
                                <option value="4501 - 6000 kg" {{ old('hasil_produksi', $hasilProduksi->hasil_produksi) == '4501 - 6000 kg' ? 'selected' : '' }}>4501 - 6000 kg</option>
                                <option value="6001 - 7500 kg" {{ old('hasil_produksi', $hasilProduksi->hasil_produksi) == '6001 - 7500 kg' ? 'selected' : '' }}>6001 - 7500 kg</option>
                                <option value="7501 - 9000 kg" {{ old('hasil_produksi', $hasilProduksi->hasil_produksi) == '7501 - 9000 kg' ? 'selected' : '' }}>7501 - 9000 kg</option>
                                <option value="9001 - 10500 kg" {{ old('hasil_produksi', $hasilProduksi->hasil_produksi) == '9001 - 10500 kg' ? 'selected' : '' }}>9001 - 10500 kg</option>
                            </select>
                            @error('hasil_produksi')
                            <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <!-- Input Interval -->
                        <div class="mb-3">
                            <label for="interval">Interval</label>
                            <select name="interval" id="interval"
                                class="form-select @error('interval') is-invalid @enderror" aria-readonly="readonly">
                                <option value="">-- select interval --</option>
                                <option value="Sangat Kecil" {{ old('interval', $hasilProduksi->interval) == 'Sangat Kecil' ? 'selected' : '' }}>Sangat Kecil</option>
                                <option value="Kecil" {{ old('interval', $hasilProduksi->interval) == 'Kecil' ? 'selected' : '' }}>Kecil</option>
                                <option value="Sedang" {{ old('interval', $hasilProduksi->interval) == 'Sedang' ? 'selected' : '' }}>Sedang</option>
                                <option value="Besar" {{ old('interval', $hasilProduksi->interval) == 'Besar' ? 'selected' : '' }}>Besar</option>
                                <option value="Sangat Besar" {{ old('interval', $hasilProduksi->interval) == 'Sangat Besar' ? 'selected' : '' }}>Sangat Besar</option>
                            </select>
                            @error('interval')
                            <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-6">
                        <!-- Input bobot -->
                        <div class="mb-4">
                            <label for="bobot">bobot</label>
                            <select name="bobot" id="bobot" class="form-select @error('bobot') is-invalid @enderror"
                                aria-readonly="readonly">
                                <option value="">-- select bobot --</option>
                                @for ($i = 1; $i <= 5; $i++)
                                    <option value="{{ $i }}" {{ old('bobot', $hasilProduksi->bobot) == $i ? 'selected' : '' }}>{{ $i }}</option>
                                @endfor
                            </select>
                            @error('bobot')
                            <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <!-- Input Deskripsi -->
                        <div class="mb-4">
                            <label for="deskripsi">Deskripsi</label>
                            <textarea name="deskripsi" class="form-control @error('deskripsi') is-invalid @enderror"
                                rows="4">{{ old('deskripsi', $hasilProduksi->deskripsi) }}</textarea>
                            @error('deskripsi')
                            <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>
                <script>
                    function updateBobot(hasilProduksi) {
                            const bobotSelect = document.getElementById('bobot');
                            const intervalSelect = document.getElementById('interval');

                            if (hasilProduksi === '3000 - 4500 kg') {
                                bobotSelect.value = '1';
                                intervalSelect.value = 'Sangat Kecil';
                            } else if (hasilProduksi === '4501 - 6000 kg') {
                                bobotSelect.value = '2';
                                intervalSelect.value = 'Kecil';
                            } else if (hasilProduksi === '6001 - 7500 kg') {
                                bobotSelect.value = '3';
                                intervalSelect.value = 'Sedang';
                            } else if (hasilProduksi === '7501 - 9000 kg') {
                                bobotSelect.value = '4';
                                intervalSelect.value = 'Besar';
                            } else if (hasilProduksi === '9001 - 10500 kg') {
                                bobotSelect.value = '5';
                                intervalSelect.value = 'Sangat Besar';
                            }
                        }
                </script>
            </div>

            <div class="float-end">
                <a href="{{ route('backend.hasil-produksi.index') }}" class="btn btn-secondary">Back</a>
                <button type="submit" class="btn btn-primary btnSubmit">Submit</button>
            </div>
        </form>

    </div>
@endsection

@push('js')
    <script src="{{ asset('assets/backend/library/jquery/jquery-3.7.1.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src={{ asset('assets/backend/js/helper.js') }}></script>
    <script src={{ asset('assets/backend/js/hasil-produksi.js') }}></script>
@endpush
