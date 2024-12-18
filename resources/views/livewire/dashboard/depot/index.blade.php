<div>
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.3/dist/leaflet.css"
        integrity="sha256-kLaT2GOSpHechhsozzB+flnD+zUyjE2LlfWPgU04xyI=" crossorigin="" />

    <title>{{ $title }}</title>

    <main id="main" class="main">
        <div class="pagetitle">
            <h1>{{ $title_page }}</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">Dashboard</li>
                    <li class="breadcrumb-item">{{ $title_page }}</li>
                </ol>
            </nav>
        </div>

        <section class="section">
            @if ($showLivewireUpdate)
                @livewire('dashboard.depot.update', ['depot' => $getDepot, 'my_koordinat' => $myKoordinat])
                <script>
                    $(document).ready(function() {
                        $('#editModal').modal('show');
                    });
                </script>
            @endif
            <script>
                $(document).on('click', '#closeModal', function() {
                    Livewire.emit('closeLivewire');
                });
            </script>

            @if (!$depot)
                <div class="row mb-3">
                    <div class="col-md-12">
                        <button wire:click="create" class="badge bg-primary border-0 px-3 py-2 mt-1"
                            style="font-size: 10pt;font-weight: normal;width: 150px;height: 2.6rem;">
                            <span wire:loading.remove wire:target="create"><i class="bi bi-plus-lg"></i> Generate
                                Data</span>
                            <span wire:loading wire:target="create" class="spinner-border spinner-border-sm text-light"
                                role="status" aria-hidden="true" style="width: 13px; height: 13px;"></span>
                        </button>
                    </div>
                </div>
            @else
                <div class="row mb-3">
                    <div class="col-md-12">
                        <button wire:click="edit({{ $depot->id_depot }})"
                            class="badge bg-primary border-0 px-3 py-2 mt-1"
                            style="font-size: 10pt;font-weight: normal;width: 150px;height: 2.6rem;">
                            <span wire:loading.remove wire:target="edit({{ $depot->id_depot }})"><i
                                    class="bi bi-pencil"></i> Update
                                Data</span>
                            <span wire:loading wire:target="edit({{ $depot->id_depot }})"
                                class="spinner-border spinner-border-sm text-light" role="status" aria-hidden="true"
                                style="width: 13px; height: 13px;"></span>
                        </button>
                    </div>
                </div>
            @endif

            <div class="card pt-3">
                <div class="card-body">
                    @if ($depot)
                        @if ($depot->is_complete == false)
                            <p class="text-center text-secondary mt-5">Silahkan update data !</p>
                        @else
                            <div class="row">
                                <div class="col-md-7">
                                    <style>
                                        .img-silde {
                                            width: 100%;
                                            height: 360px;
                                            border-radius: 5px;
                                        }

                                        @media only screen and (max-width: 480px) {
                                            .img-silde {
                                                width: 100%;
                                                height: 225px;
                                                border-radius: 5px;
                                            }
                                        }
                                    </style>
                                    @php
                                        $i = 0;
                                        $itemImages = explode('_', $depot->image);
                                    @endphp
                                    <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
                                        <div class="carousel-indicators">
                                            @foreach ($itemImages as $data)
                                                @if ($data != '')
                                                    <button type="button" data-bs-target="#carouselExampleIndicators"
                                                        data-bs-slide-to="{{ $i }}" class="active"
                                                        aria-current="true"
                                                        aria-label="Slide {{ $i + 1 }}"></button>
                                                @endif
                                                @php
                                                    $i++;
                                                @endphp
                                            @endforeach
                                        </div>
                                        <div class="carousel-inner">
                                            @foreach ($itemImages as $data)
                                                @if ($data != '')
                                                    <div
                                                        class="carousel-item @if ($itemImages[0] == $data) active @endif">
                                                        <img class="img-silde" src="{{ asset('storage/' . $data) }}"
                                                            alt="">
                                                    </div>
                                                @endif
                                            @endforeach
                                        </div>
                                        <button class="carousel-control-prev" type="button"
                                            data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
                                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                            <span class="visually-hidden">Previous</span>
                                        </button>
                                        <button class="carousel-control-next" type="button"
                                            data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
                                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                            <span class="visually-hidden">Next</span>
                                        </button>
                                    </div>
                                </div>
                                <div class="col-md-5">
                                    <ol class="list-group mb-2">
                                        <li class="list-group-item d-flex justify-content-between align-items-start">
                                            <div class="me-auto">
                                                <small class="fw-bold">Nama Depot</small>
                                            </div>
                                            <small class="text-secondary">{{ $depot->nama }}</small>
                                        </li>
                                        <li class="list-group-item d-flex justify-content-between align-items-start">
                                            <div class="me-auto">
                                                <small class="fw-bold">Kecamatan</small>
                                            </div>
                                            <small class="text-secondary">{{ $depot->get_kecamatan->name }}</small>
                                        </li>
                                        <li class="list-group-item d-flex justify-content-between align-items-start">
                                            <div class="me-auto">
                                                <small class="fw-bold">Kelurahan</small>
                                            </div>
                                            <small class="text-secondary">{{ $depot->get_kelurahan->name }}</small>
                                        </li>
                                    </ol>
                                    <div wire:ignore style="">
                                        <div id="address-map-container" class="text-light" style="width:100%;">
                                            <div wire:ignore.self id="map2"
                                                style="height: 228px;border-radius: 3px;">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <h6 class="fw-bold mt-3">Keterangan Lainnya</h6>
                                <div>{!! $depot->keterangan !!}</div>
                            </div>
                        @endif
                    @else
                        <p class="text-center text-secondary mt-5">Data tidak ditemukan !</p>
                    @endif
                </div>
            </div>
        </section>

    </main>



    @if ($depot)
        @if ($depot->is_complete)
            @php
                $latlong = explode(',', $depot->koordinat);
            @endphp

            <script src="https://unpkg.com/leaflet@1.9.3/dist/leaflet.js"
                integrity="sha256-WBkoXOwTeyKclOHuWtc+i2uENFpDZ9YPdf5Hf+D7ewM=" crossorigin=""></script>
            <script>
                $(document).ready(function() {
                    var latitude = '{{ $latlong[0] }}';
                    var longitude = '{{ $latlong[1] }}';

                    var map = L.map('map2').setView([latitude, longitude], 17);

                    googleHybrid = L.tileLayer('http://{s}.google.com/vt/lyrs=s,h&x={x}&y={y}&z={z}', {
                        maxZoom: 30,
                        subdomains: ['mt0', 'mt1', 'mt2', 'mt3']
                    }).addTo(map);

                    var marker = L.marker([latitude, longitude]).addTo(map);

                    var popup = L.popup()
                        .setContent("{{ $depot->nama }}");
                    marker.bindPopup(popup).openPopup();

                    // var circle = L.circle([latitude, longitude], {
                    //     color: 'red',
                    //     fillColor: '#f03',
                    //     fillOpacity: 0.3,
                    //     radius: 20
                    // }).addTo(map);

                    // map.scrollWheelZoom.disable();

                    var popup = L.popup();

                    function onMapClick(e) {
                        popup
                            .setLatLng(e.latlng)
                            .setContent("Koordinat  posisi. " + e.latlng)
                            .openOn(map);
                    }

                    map.on('click', onMapClick);
                });
            </script>
        @endif
    @endif

    <script>
        $(document).ready(function() {
            const Http = new XMLHttpRequest();

            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(showPosition);
            } else {
                alert("Maaf ! browser yang digunakan tidak mendukung");
            }

            function showPosition(position) {
                Livewire.emit('getMyKordinat', position.coords.latitude, position.coords.longitude);
            }

        })
    </script>

</div>
