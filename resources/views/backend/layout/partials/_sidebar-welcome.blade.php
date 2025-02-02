{{-- sidebar --}}
<div id="sidebar" class="active">
    <div class="sidebar-wrapper active">
        <div class="sidebar-header">
            <div class="d-flex justify-content-between">
                <div class="logo">
                    <a href="{{ route('dashboard') }}"><img src="{{ asset('assets/backend') }}/images/logo/logo.png"
                            class="img-fluid" width=75 height=150 alt="Logo" srcset=""></a>
                </div>
                <div class="toggler">
                    <a href="#" class="sidebar-hide d-xl-none d-block"><i class="bi bi-x bi-middle"></i></a>
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

                @auth
                    <li class="sidebar-item has-sub">
                        <a href="#" class='sidebar-link'>
                            <i class="bi bi-folder-fill"></i>
                            <span>Master Data</span>
                        </a>
                        <ul class="submenu">
                            <li class="submenu-item">
                                <a href="{{ route('backend.luas-tanah.index') }}">
                                    <i class="bi bi-clipboard-data-fill"></i>
                                    <span>luas Tanah</span>
                                </a>
                            </li>
                            <li class="submenu-item">
                                <a href="{{ route('backend.komoditas.index') }}">
                                    <i class="bi bi-clipboard-data-fill"></i>
                                    <span>Komoditas</span>
                                </a>
                            </li>
                            <li class="submenu-item">
                                <a href="{{ route('backend.musim-tanam.index') }}">
                                    <i class="bi bi-clipboard-data-fill"></i>
                                    <span>Musim Tanam</span>
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

                    <li class="sidebar-item">
                        <a href="{{ route('backend.proses.index') }}" class='sidebar-link'>
                            <i class="bi bi-grid-fill"></i>
                            <span>Proses TOPSIS</span>
                        </a>
                    </li>

                    <li class="sidebar-item">
                        <a href="{{ route('admin.index') }}" class='sidebar-link'>
                            <i class="bi bi-grid-fill"></i>
                            <span>Cetak</span>
                        </a>
                    </li>
                @endauth


                <li class="sidebar-item  ">
                    <a href="table-datatable.html" class='sidebar-link'>
                        <i class="bi bi-file-earmark-spreadsheet-fill"></i>
                        <span>Logout</span>
                    </a>
                </li>

            </ul>
        </div>
        <button class="sidebar-toggler btn x"><i data-feather="x"></i></button>
    </div>
</div>
