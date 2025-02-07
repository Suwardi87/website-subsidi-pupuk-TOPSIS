{{-- sidebar --}}
<div id="sidebar" class="active">
    <div class="sidebar-wrapper active">
        <div class="sidebar-header">
            <div class="d-flex justify-content-center align-items-center">
                <div class="logo" >
                    <a href="{{ route('dashboard') }}"><img src="{{ asset('assets/backend') }}/images/logo/logo.png" style="width:75px;height:110px;"class="img-fluid" alt="Logo"
                            srcset=""></a>
                </div>
            </div>
        </div>
        <div class="sidebar-menu">
            <ul class="menu">
                <li class="sidebar-title">Menu</li>

                <li class="sidebar-item ">
                    <a href="{{ route('admin.index') }}" class='sidebar-link'>
                        <i class="bi bi-grid-fill"></i>
                        <span>Dashboard</span>
                    </a>
                </li>

                @if(!in_array(Auth::user()->role, ['petani','petugasDinas']))
                    <li class="sidebar-item has-sub">
                        <a href="#" class='sidebar-link'>
                            <i class="bi bi-folder-fill"></i>
                            <span>Master Data</span>
                        </a>
                        <ul class="submenu">
                            <li class="submenu-item">
                                <a href="{{ route('backend.luas-tanah.index') }}">
                                    <i class="bi bi-clipboard-data-fill"></i>
                                    <span>luas Lahan</span>
                                </a>
                            </li>
                            <li class="submenu-item">
                                <a href="{{ route('backend.biaya-produksi.index') }}">
                                    <i class="bi bi-clipboard-data-fill"></i>
                                    <span>Biaya Produksi</span>
                                </a>
                            </li>
                            <li class="submenu-item">
                                <a href="{{ route('backend.hasil-produksi.index') }}">
                                    <i class="bi bi-clipboard-data-fill"></i>
                                    <span>Hasil Panen</span>
                                </a>
                            </li>
                            <li class="submenu-item">
                                <a href="{{ route('backend.dosis-pupuk.index') }}">
                                    <i class="bi bi-clipboard-data-fill"></i>
                                    <span>Dosis Pupuk</span>
                                </a>
                            </li>
                        </ul>
                    </li>
                @endif

                @if(!in_array(Auth::user()->role, ['petani']))
                <li class="sidebar-item ">
                    <a href="{{ route('backend.proses.index') }}" class='sidebar-link'>
                        <i class="bi bi-grid-fill"></i>
                        <span>Proses TOPSIS</span>
                    </a>
                </li>
                @endif

                <li class="sidebar-item ">
                    <a href="{{ route('backend.topsis.index') }}" class='sidebar-link'>
                        <i class="bi bi-grid-fill"></i>
                        <span>Hasil</span>
                    </a>
                </li>


                <li class="sidebar-item  ">
                    <a href="{{ route('logout') }}" class='sidebar-link' onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <i class="bi bi-file-earmark-spreadsheet-fill"></i>
                        <span>Logout</span>
                    </a>
                    <form action="{{ route('logout') }}" method="POST" style="display: none;" id="logout-form">
                        @csrf
                    </form>
                </li>

            </ul>
        </div>
        <button class="sidebar-toggler btn x"><i data-feather="x"></i></button>
    </div>
</div>
