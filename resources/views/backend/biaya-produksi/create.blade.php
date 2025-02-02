@extends('backend.layout.main')

@section('title', 'Create Biaya Produksi')

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
                            href="{{ route('backend.biaya-produksi.index') }}">Biaya Produksi</a></li>
                    <li class="breadcrumb-item active" aria-current="page"><a
                            href="{{ route('backend.biaya-produksi.create') }}">@yield('title')</a></li>
                </ol>
            </nav>
            <div class="d-flex justify-content-between w-100 flex-wrap">
                <div class="mb-3 mb-lg-0">
                    <h1 class="h4">@yield('title')</h1>
                    <p class="mb-0">Create Biaya Produksi - Subsidi Pupuk Dinas Pertanian </p>
                </div>
                <div>
                    <a href="{{ route('backend.biaya-produksi.index') }}" class="btn btn-outline-primary"><i
                            class="fas fa-arrow-left me-1"></i> Back</a>
                </div>
            </div>
        </div>

        <form action="{{ route('backend.biaya-produksi.store') }}" method="POST" id="formbiaya-produksi" class="card">
            @csrf
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <!-- Input Nama biaya-produksi -->
                        <div class="mb-4">
                            <label for="biaya_produksi">Biaya Produksi</label>
                            <select name="biaya_produksi" id="biaya_produksi" class="form-select @error('biaya_produksi') is-invalid @enderror"
                                onchange="updateBobot(this.value)">
                                <option value="">-- select biaya produksi --</option>
                                <option value="Rp 0 - Rp9,000,000">Rp 0 - Rp9,000,000</option>
                                <option value="Rp9,000,001 - Rp15,000,000">Rp9,000,001 - Rp15,000,000</option>
                                <option value="Rp15,000,001 - Rp22,000,000">Rp15,000,001 - Rp22,000,000</option>
                                <option value="Rp22,000,001 - Rp30,000,000">Rp22,000,001 - Rp30,000,000</option>
                                <option value="Rp30,000,001 - Rp40,000,000">Rp30,000,001 - Rp40,000,000</option>
                            </select>
                            @error('biaya_produksi')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="interval">Interval</label>
                            <select name="interval" id="interval" class="form-select @error('interval') is-invalid @enderror"
                                aria-readonly="readonly">
                                <option value="">-- select interval --</option>
                                <option value="Sangat Kecil">Sangat Kecil</option>
                                <option value="Kecil">Kecil</option>
                                <option value="Sedang">Sedang</option>
                                <option value="Besar">Besar</option>
                                <option value="Sangat Besar">Sangat Besar</option>
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
                                <option value="">-- select bobot --</option>
                                @for ($i = 1; $i <= 5; $i++)
                                    <option value="{{ $i }}">{{ $i }}</option>
                                @endfor
                            </select>
                            @error('bobot')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                        <!-- Input Deskripsi -->
                        <div class="mb-4">
                            <label for="deskripsi">Deskripsi</label>
                            <textarea name="deskripsi" class="form-control @error('deskripsi') is-invalid @enderror" rows="4">{{ old('deskripsi') }}</textarea>
                            @error('deskripsi')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>
                <script>
                    function updateBobot(biayaProduksi) {
                        const intervalSelect = document.getElementById('interval');
                        const bobotSelect = document.getElementById('bobot');

                        if (!bobotSelect) {
                            console.error("Element dengan id 'bobot' tidak ditemukan.");
                            return;
                        }

                        if (biayaProduksi === 'Rp 0 - Rp9,000,000') {
                            intervalSelect.value = 'Sangat Kecil';
                            bobotSelect.value = '1';
                        } else if (biayaProduksi === 'Rp9,000,001 - Rp15,000,000') {
                            intervalSelect.value = 'Kecil';
                            bobotSelect.value = '2';
                        } else if (biayaProduksi === 'Rp15,000,001 - Rp22,000,000') {
                            intervalSelect.value = 'Sedang';
                            bobotSelect.value = '3';
                        } else if (biayaProduksi === 'Rp22,000,001 - Rp30,000,000') {
                            intervalSelect.value = 'Besar';
                            bobotSelect.value = '4';
                        } else if (biayaProduksi === 'Rp30,000,001 - Rp40,000,000') {
                            intervalSelect.value = 'Sangat Besar';
                            bobotSelect.value = '5';
                        } else {
                            intervalSelect.value = '';
                            bobotSelect.value = '';
                        }
                    }
                </script>

            </div>
            <div class="card-footer d-flex justify-content-end">
                <button type="submit" class="btn btn-primary btnSubmit">Submit</button>
            </div>
        </form>

    </div>
@endsection

@push('js')
    <script src="{{ asset('assets/backend/library/jquery/jquery-3.7.1.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src={{ asset('assets/backend/js/helper.js') }}></script>
    <script src={{ asset('assets/backend/js/biaya-produksi.js') }}></script>
@endpush


