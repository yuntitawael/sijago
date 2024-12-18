<header id="header" class="header fixed-top d-flex align-items-center">

    <div class="d-flex align-items-center justify-content-between">
        <i class="bi bi-list toggle-sidebar-btn" id="list-menu-open" style="font-size: 16pt;margin-right: 10px;"></i>
        <a href="" class="logo d-flex align-items-center">
            <img src="/assets/img/logo.png" alt="">
            <span class="" style="font-size: 16pt;">
                {{ env('APP_NAME') }}
            </span>
        </a>

        <script>
            $(document).ready(function() {
                var windowsize = $(window).width();
                if (windowsize > 480) {
                    document.getElementById("list-menu-open").classList.remove('bi-list');
                    document.getElementById("list-menu-open").classList.add('bi-x-lg');
                    $('#list-menu-open').attr("id", "list-menu-close");

                } else {
                    document.getElementById("list-menu-close").classList.add('bi-list');
                    document.getElementById("list-menu-close").classList.remove('bi-x-lg');
                    $('#list-menu-close').attr("id", "list-menu-open");
                }
            });

            $(document).on('click', '#list-menu-open', function() {
                document.getElementById("list-menu-open").classList.remove('bi-list');
                document.getElementById("list-menu-open").classList.add('bi-x-lg');
                $(this).attr("id", "list-menu-close");
            });

            $(document).on('click', '#list-menu-close', function() {
                document.getElementById("list-menu-close").classList.add('bi-list');
                document.getElementById("list-menu-close").classList.remove('bi-x-lg');
                $(this).attr("id", "list-menu-open");
            })
        </script>
    </div>


    <nav class="header-nav ms-auto">
        <ul class="d-flex align-items-center">
            <li class="nav-item dropdown pe-3">

                <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
                    <img src="/assets/img/avatar.png" alt="Profile" class="rounded-circle">
                    <span class="d-none d-md-block dropdown-toggle ps-2">
                        {{ auth()->user()->nama }}
                    </span>
                </a>

                <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
                    <li class="dropdown-header">
                        <h6>{{ auth()->user()->nama }}</h6>
                        @if (auth()->user()->level == 0)
                            <span>Admin</span>
                        @else
                            <span>Owner</span>
                        @endif
                    </li>
                    <li>
                        <hr class="dropdown-divider">
                    </li>

                    <li>
                        <a class="dropdown-item d-flex align-items-center" href="/dashboard/profil">
                            <i class="bi bi-person"></i>
                            <span>Profil Saya</span>
                        </a>
                    </li>
                    <li>
                        <hr class="dropdown-divider">
                    </li>
                    <li>
                        <hr class="dropdown-divider">
                    </li>
                    <li>
                        <hr class="dropdown-divider">
                    </li>

                    <li>
                        <form action="/logout" method="post">
                            @csrf
                            <button type="submit" class="dropdown-item d-flex align-items-center">
                                <i class="bi bi-box-arrow-right" style=""></i> <span style="">Logout</span>
                            </button>
                        </form>
                    </li>

                </ul><!-- End Profile Dropdown Items -->
            </li><!-- End Profile Nav -->

        </ul>
    </nav><!-- End Icons Navigation -->

</header>
