<div class="main-panel">
  <div class="main-header">
    <div class="main-header-logo">
      <!-- Logo Header -->
      <div class="logo-header" data-background-color="dark">
        <a href="#" class="logo">
          <img
            src="{{ asset('template-admin') }}/assets/img/kaiadmin/logo_light.svg"
            alt="navbar brand"
            class="navbar-brand"
            height="20"
          />
        </a>
        <div class="nav-toggle">
          <button class="btn btn-toggle toggle-sidebar">
            <i class="gg-menu-right"></i>
          </button>
          <button class="btn btn-toggle sidenav-toggler">
            <i class="gg-menu-left"></i>
          </button>
        </div>
        <button class="topbar-toggler more">
          <i class="gg-more-vertical-alt"></i>
        </button>
      </div>
      <!-- End Logo Header -->
    </div>
    <!-- Navbar Header -->
    <nav
      class="navbar navbar-header navbar-header-transparent navbar-expand-lg border-bottom"
    >
      <div class="container-fluid">

        <ul class="navbar-nav topbar-nav ms-md-auto align-items-center">
          

          <li class="nav-item topbar-user dropdown hidden-caret">
            <a
              class="dropdown-toggle profile-pic"
              data-bs-toggle="dropdown"
              href="#"
              aria-expanded="false"
            >
              <div class="avatar-sm">
                <img
                  src="{{ asset('template-admin') }}/assets/img/profile.jpg"
                  alt="..."
                  class="avatar-img rounded-circle"
                />
              </div>
              @php
                $user = isset($kader) ? Auth::guard('kader')->user() : (isset($bidan) ? Auth::guard('bidan')->user() : null);
              @endphp
              @if($user)
              <span class="profile-username">
                <span class="op-7">Hi,</span>
                <span class="fw-bold">{{ $user->nama_kader ?? $user->nama_bidan }}</span>
              </span>
              @endif
            </a>
            <ul class="dropdown-menu dropdown-user animated fadeIn">
              <div class="dropdown-user-scroll scrollbar-outer">
                <li>
                  <div class="user-box">
                    <div class="avatar-lg">
                      <img
                        src="{{ asset('template-admin') }}/assets/img/profile.jpg"
                        alt="image profile"
                        class="avatar-img rounded"
                      />
                    </div>
                    <div class="u-text">
                      <h4>{{ $user->nama_kader ?? $user->nama_bidan }}</h4>
                      <a
                        href="profile.html"
                        class="btn btn-xs btn-secondary btn-sm"
                        >View Profile</a
                      >
                    </div>
                  </div>
                </li>
                @if(isset($kader))
                <li>
                  <div class="dropdown-divider"></div>
                  <a class="dropdown-item" href="{{ route('logout.kader') }}">Logout</a>
                </li>
                @elseif(isset($bidan))
                <li>
                  <div class="dropdown-divider"></div>
                  <a class="dropdown-item" href="{{ isset($kader) ? route('logout.kader') : route('logout.bidan') }}">Logout</a>
                </li>
                @endif
              </div>
            </ul>
          </li>
        </ul>
      </div>
    </nav>
    <!-- End Navbar -->
  </div>