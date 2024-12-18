<aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

        <li class="nav-item">
            <a class="nav-link  {{ Request::is('dashboard') ? '' : 'collapsed' }}" href="/dashboard">
                <i class="bi bi-grid"></i>
                <span>Dashboard</span>
            </a>
        </li>

        @if (auth()->user()->level == 1)
            <li class="nav-item">
                <a class="nav-link  {{ Request::is('dashboard/depot') ? '' : 'collapsed' }}" href="/dashboard/depot">
                    <i class="bi bi-water"></i>
                    <span>Depot Saya</span>
                </a>
            </li>
        @endif

        @if (auth()->user()->level == 0)
            <li class="nav-item">
                <a class="nav-link  {{ Request::is('dashboard/daftar-depot') ? '' : 'collapsed' }}"
                    href="/dashboard/daftar-depot">
                    <i class="bi bi-water"></i>
                    <span>Daftar Depot</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link  {{ Request::is('dashboard/admin') ? '' : 'collapsed' }}" href="/dashboard/admin">
                    <i class="bi bi-person"></i>
                    <span>Admin</span>
                </a>
            </li>
        @endif

    </ul>

</aside>
