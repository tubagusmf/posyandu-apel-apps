<div class="wrapper">
    <!-- Sidebar -->
    <div class="sidebar" data-background-color="dark">
        <div class="sidebar-logo">
            <!-- Logo Header -->
            <div class="logo-header" data-background-color="dark">
                <h3 style="color: white">Bidan</h3>
                <div class="nav-toggle">
                    <button class="btn btn-toggle toggle-sidebar"><i class="gg-menu-right"></i></button>
                    <button class="btn btn-toggle sidenav-toggler"><i class="gg-menu-left"></i></button>
                </div>
                <button class="topbar-toggler more"><i class="gg-more-vertical-alt"></i></button>
            </div>
        </div>
        
        <div class="sidebar-wrapper scrollbar scrollbar-inner">
            <div class="sidebar-content">
                <ul class="nav nav-secondary">
                    <li class="nav-item"><a href="{{ route('dashboard.bidan') }}"><i class="fas fa-home"></i><p>Dashboard</p></a></li>
                    <li class="nav-item">
                        <a data-bs-toggle="collapse" href="#base"><i class="fas fa-layer-group"></i><p>Laporan</p><span class="caret"></span></a>
                        <div class="collapse" id="base">
                            <ul class="nav nav-collapse">
                                <li><a href="{{ route('bidan.laporan-balita') }}"><span class="sub-item">Laporan Bayi & Balita</span></a></li>
                                <li><a href="{{ route('bidan.laporan-ibu-hamil') }}"><span class="sub-item">Laporan Ibu Hamil</span></a></li>
                            </ul>
                        </div>
                    </li>
                    <li class="nav-item"><a href="widgets.html"><i class="fas fa-book"></i><p>Rujukan</p></a></li>
                    <li class="nav-item"><a href="widgets.html"><i class="fas fa-home"></i><p>Profile</p></a></li>
                    <li class="nav-item"><a href="{{ route('logout.bidan') }}"><i class="fas fa-sign-out-alt"></i><p>Logout</p></a></li>
                </ul>
            </div>
        </div>
    </div>