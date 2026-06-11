<header id="header" class="header sticky-top">


</div>
</div>

<div class="branding d-flex align-items-center">

<div class="container position-relative d-flex align-items-center justify-content-between">

<a href="/" class="logo d-flex align-items-center">
<img src="{{ asset('assets/img/logo.png') }}" alt="">
<h1 class="sitename"> DP3A</h1>
</a>

<nav id="navmenu" class="navmenu">
<ul>
    <li><a href="{{ route('branda') }}">Home</a></li>

    <!-- Dropdown Profile -->
    <li class="dropdown">
        <a href="#"><span>Profile</span> <i class="bi bi-chevron-down toggle-dropdown"></i></a>
        <ul>
            <li><a href="{{ route('public.struktur.index') }}">Struktur Organisasi</a></li>
            <li><a href="{{ route('public.visimisi') }}">Visi & Misi</a></li>
            <li><a href="{{ route('public.berita.index') }}">Berita</a></li>
        </ul>
    </li>

    <li><a href="{{ route('program.index') }}">Program & Kegiatan</a></li>
    <li><a href="{{ route('public.pengumuman') }}">Pengumuman</a></li>
    <li><a href="{{ route('public.layanan.index') }}">Layanan</a></li>
   <li><a href="{{ route('public.kontak') }}">Kontak</a></li>
     @auth
        @if(auth()->user()->role == 'user')
            <li><a href="{{ route('laporan.create') }}">Laporan</a></li>
        @endif

        @if(auth()->user()->role == 'admin')
            <li><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
        @endif

        <li>
            <form action="{{ route('user.logout') }}" method="POST" style="display:inline;">
                @csrf
                <button type="submit" style="background:none;border:none;">Logout</button>
            </form>
        </li>
    @else
    @endauth
</ul>
<i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
</nav>

</div>
</div>

</header>