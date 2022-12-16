<ul class="navbar-nav sidebar sidebar-light accordion" id="accordionSidebar">
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="">
        <div class="sidebar-brand-icon">
            <img src="{{ asset((setting('logo')) ? '/storage/'.setting('logo') : 'dist/img/logo/logo2.png') }}">
        </div>
        <div class="sidebar-brand-text mx-3">
            <i href="{{route('admin.dashboard')}}">
                Sofi Grosir
            </i>

        </div>
    </a>
    <hr class="sidebar-divider my-0">

    <x-nav-link
        text="Dashboard"
        icon="tachometer-alt"
        url="{{ route('admin.dashboard') }}"
        active="{{ request()->routeIs('admin.dashboard') ? ' active' : '' }}"
    />

    <hr class="sidebar-divider mb-0">

    <x-nav-link
        text="Kategori Barang"
        icon="users"
        url="{{ route('admin.katbarang') }}"
        active="{{ request()->routeIs('admin.katbarang') ? ' active' : '' }}"
    />

    <x-nav-link
        text="Data Barang"
        icon="users"
        url="{{ route('admin.barang') }}"
        active="{{ request()->routeIs('admin.barang') ? ' active' : '' }}"
    />

    <hr class="sidebar-divider mb-0">

    <x-nav-link
        text="Pembukuan"
        icon="users"
        url="{{ route('admin.pembukuan') }}"
        active="{{ request()->routeIs('admin.pembukuan') ? ' active' : '' }}"
    />

    <x-nav-link
        text="Laporan Bulanan"
        icon="users"
        url="{{ route('admin.laporan') }}"
        active="{{ request()->routeIs('admin.laporan') ? ' active' : '' }}"
    />

    <hr class="sidebar-divider mb-0">

    @can('member-list')
    <x-nav-link
        text="Member"
        icon="users"
        url="{{ route('admin.member') }}"
        active="{{ request()->routeIs('admin.member') ? ' active' : '' }}"
    />
    @endcan

    @can('role-list')
    <x-nav-link
        text="Roles"
        icon="th-list"
        url="{{ route('admin.roles') }}"
        active="{{ request()->routeIs('admin.roles') ? ' active' : '' }}"
    />
    @endcan

    <hr class="sidebar-divider mb-0">

    @can('setting-list')
    <x-nav-link
        text="Settings"
        icon="cogs"
        url="{{ route('admin.settings') }}"
        active="{{ request()->routeIs('admin.settings') ? ' active' : '' }}"
    />
    @endcan
</ul>
