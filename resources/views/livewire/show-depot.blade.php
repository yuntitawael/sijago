<div>

    <title>{{ $title }}</title>

    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.3/dist/leaflet.css"
        integrity="sha256-kLaT2GOSpHechhsozzB+flnD+zUyjE2LlfWPgU04xyI=" crossorigin="" />

    <title>{{ $title }}</title>

    <main id="main">
        <div class="container">
            <section id="breadcrumbs" class="breadcrumbs bg-light p-3">
                <ol>
                    {!! $subtitle !!}
                </ol>
                <h4>{{ $title_page }}</h4>
            </section>

            <style>
                #img-header {
                    width: 100%;
                    height: 220px;
                }

                @media only screen and (max-width: 480px) {
                    #img-header {
                        width: 100%;
                        height: 100%;
                    }
                }

                #img-master {
                    width: 100%;
                    height: 170px;
                }

                .address {
                    font-size: 10pt;
                    font-weight: normal;
                }

                #kecamatan {
                    width: 150px;
                    font-size: 10pt;
                }

                #kelurahan {
                    width: 150px;
                    font-size: 10pt;
                }

                #paginate {
                    font-size: 10pt;
                }

                .card-title {
                    font-size: 11pt;
                }

                #spiner {
                    position: absolute;
                    margin-top: 70px;
                    ;
                }

                @media only screen and (max-width: 480px) {
                    #img-master {
                        width: 100%;
                        height: 100px;
                    }

                    .card-title {
                        font-size: 9pt;
                    }

                    .address {
                        font-size: 8pt;
                    }

                    #kecamatan {
                        width: 150px;
                        font-size: 8pt;
                    }

                    #kelurahan {
                        width: 150px;
                        font-size: 8pt;
                    }

                    #paginate {
                        font-size: 8pt;
                    }

                    #spiner {
                        position: absolute;
                        margin-top: 35px;
                        ;
                    }
                }

                #main-sub-wisata {
                    width: 100%;
                    /* height: 100px; */
                }

                @media only screen and (max-width: 480px) {
                    #main-sub-wisata {
                        width: 100%;
                        /* height: 70px; */
                    }
                }
            </style>

            <div class="bg-light p-3">
                <div class="row gy-4">

                    <div class="col-lg-8">
                        <div class="portfolio-details-slider swiper">
                            <div class="swiper-wrapper align-items-center">
                                <style>
                                    .img-silde {
                                        width: 100%;
                                        height: 450px;
                                    }

                                    @media only screen and (max-width: 480px) {
                                        .img-silde {
                                            width: 100%;
                                            height: 225px;
                                        }
                                    }
                                </style>
                                @php
                                    $images = explode('_', $depot->image);
                                @endphp
                                @foreach ($images as $data)
                                    @if ($data != '')
                                        <div class="swiper-slide">
                                            <img class="img-silde" src="{{ asset('storage/' . $data) }}" alt=""
                                                style="border-radius: 5px;">
                                        </div>
                                    @endif
                                @endforeach
                            </div>
                            <div class="swiper-pagination"></div>
                        </div>
                    </div>

                    <div class="col-lg-4">
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
                            <li class="list-group-item d-flex justify-content-between align-items-start">
                                <div class="me-auto">
                                    <small class="fw-bold">Jarak</small>
                                </div>
                                <small class="text-secondary">{{ $jarak }} m</small>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-start">
                                <div class="me-auto">
                                    <small class="fw-bold">Hubungi</small>
                                </div>
                                <small class="text-secondary">
                                    <a class="badge bg-primary mb-1 border-0 py-2" target="blank"
                                        href="https://wa.me/{{ $depot->owner->nomor_whatsapp }}">
                                        <i class="bi bi-whatsapp"></i>
                                    </a>
                                </small>
                            </li>
                        </ol>
                        <div wire:ignore style="">
                            <div id="address-map-container" class="text-light" style="width:100%;">
                                <div wire:ignore.self id="map2" style="height: 228px;border-radius: 3px;">
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

                <div class="row">
                    <h6 class="fw-bold mt-3">Keterangan Lainnya</h6>
                    <div>{!! $depot->keterangan !!}</div>
                </div>

                <hr>

                <h6 class="fw-bold mt-5">Depot Air Terkait</h6>
                @php
                    $tags = \App\Models\Depot::where('id_depot', '!=', $depot->id_depot)
                        ->where('id_kelurahan', $depot->id_kelurahan)
                        ->get();
                @endphp
                @if ($tags->count() > 0)
                    <div class="row g-2 mb-5">
                        @foreach ($tags as $data)
                            <div class="col-6 col-lg-3">
                                <div type="button" wire:click="depot_opsi({{ $data->id_depot }})">
                                    <div id="main-sub-wisata" style="">
                                        @php
                                            $images = explode('_', $data->image);
                                        @endphp
                                        <div class="card">
                                            <div class="d-flex justify-content-center">
                                                <div wire:loading wire:target="depot_opsi({{ $data->id_depot }})"
                                                    class="spinner-border text-light" role="status" id="spiner">
                                                    <span class="visually-hidden">Loading...</span>
                                                </div>
                                            </div>
                                            <img id="img-master" src="{{ asset('storage/' . $images[0]) }}"
                                                class="card-img-top img-fluid" alt="image">
                                            <div class="card-body">
                                                @php
                                                    $kelurahan = strtolower($data->get_kelurahan->name);
                                                    $kecamatan = strtolower($data->get_kecamatan->name);
                                                @endphp
                                                <h5 class="card-title text-center">{{ $data->nama }}
                                                    <span class="address text-secondary d-block">
                                                        <i class="bi bi-geo text-primary"></i>
                                                        {{ ucwords($kelurahan) . ' Kecamatan ' . ucwords($kecamatan) }}
                                                    </span>
                                                </h5>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="mb-5">
                        <small class="text-secondary">Data tidak ditemukan !</small>
                    </div>
                @endif
            </div>
        </div>

    </main>

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

    <script>
        $(document).ready(function() {
            const Http = new XMLHttpRequest();

            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(showPosition);
            } else {
                alert("Maaf ! browser yang digunakan tidak mendukung");
            }

            function showPosition(position) {
                var latitude = position.coords.latitude;
                var longitude = position.coords.longitude;
                var depot_lat = "{{ $latlong[0] }}";
                var depot_long = "{{ $latlong[1] }}";

                Livewire.emit('getLatLangForInput', position.coords.latitude, position.coords.longitude);
            }

        })
    </script>

</div>
