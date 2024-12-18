<style>
    #main-topbar {
        width: 100%;
        height: 200px;
        padding: 0px;
    }

    #img-topbar {
        width: 100%;
    }

    @media only screen and (max-width:480px) {
        #main-topbar {
            width: 100%;
            height: 80px;
            padding: 0px;
        }

        #img-topbar {
            height: 80px;
        }
    }
</style>

<div class="container">
    <section id="main-topbar" style="">
        <img id="img-topbar" src="/assets/img/topbar_bg.jpg" class="img-fluid" style="width: 100%;">
    </section>
</div>

<div class="container">
    <header id="header" class="d-flex align-items-center">
        <div class="container d-flex justify-content-between">

            <h1 class="logo"> <img src="/assets/img/logo.png" class="me-2" alt=""> <a
                    href="/">{{ env('APP_NAME') }}<span>.</span></a></h1>

            <nav id="navbar" class="navbar">
                <ul>
                    <li><a class="nav-link scrollto {{ Request::is('/') ? 'active' : ' ' }}" href="/">Beranda</a> </li>
                    @if (auth()->user())
                        <li><a class="nav-link scrollto" href="/dashboard">Dashboard</a></li>

                        <li>
                            <form action="/logout" method="post">
                                @csrf
                                <button type="submit" class="dropdown-item link text-danger"><span
                                        style="font-size: 11pt;">Logout</span>
                                </button>
                            </form>
                        </li>
                    @else
                        <li><a class="nav-link scrollto {{ Request::is('login') ? 'active' : ' ' }}"
                                href="/login">login</a></li>
                    @endif
                </ul>
                <i class="bi bi-list mobile-nav-toggle"></i>
            </nav>
        </div>
        <center>
    </header>


    <div style="margin-top: px;background-color: ;height: 30px;box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.2);">
        <div class="container pt-1">
            <div style="display: flex; align-items: center;">
                <marquee direction="up" scrollamount="2" align="center" behavior="alternate" width="">
                    <marquee direction="left">
                        <p>Selamat Datang di Website <b>Sistem Informasi Penjualan Air Galon (SIJAGO)</b>
                            Kota Ambon Maluku</p>
                    </marquee>
                </marquee>
            </div>
        </div>
    </div>
</div>
