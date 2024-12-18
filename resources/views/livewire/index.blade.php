<div>
    <title>{{ $title }}</title>
    <div class="container">

        <section class="bg-light p-2">
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

            <small class="text-secondary">Filter : </small>
            <div class="row mb-3">
                <div class="col-md-10">
                    <div wire:ignore.self>
                        <select class="mb-1 form-select form-select-md d-inline-block" id="kecamatan" name="kecamatan"
                            wire:model="kecamatan" wire:change="opsi_kelurahan">
                            <option value="">-- Kecamatan --</option>
                            @foreach ($get_kecamatan as $data)
                                <option value="{{ $data->id }}">{{ $data->name }}</option>
                            @endforeach
                        </select>
                        @error('kecamatan')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                        <select class="mb-1 form-select form-select-md d-inline-block" id="kelurahan" name="kelurahan"
                            wire:model="kelurahan" wire:change="opsi_kelurahan">
                            <option value="">-- Kelurahan --</option>
                            @if ($get_kelurahan)
                                @if ($get_kelurahan->count() > 0)
                                    @foreach ($get_kelurahan as $data)
                                        <option value="{{ $data->id }}">{{ $data->name }}</option>
                                    @endforeach
                                @endif
                            @endif
                        </select>
                    </div>
                </div>
                <div class="col-md-2">
                    <small>Show :</small>
                    <select class="form-select md w-auto d-inline" wire:model="paginate" id="paginate">
                        <option value="15">10</option>
                        <option value="20">20</option>
                        <option value="25">25</option>
                        <option value="50">50</option>
                        <option value="100">100</option>
                    </select>
                </div>
            </div>

            @if ($depot->count() > 0)
                <div class="row g-2">
                    @foreach ($depot as $data)
                        <div class="col-6 col-lg-3">
                            <div type="button" wire:click="depot_opsi({{ $data->id_depot }})">
                                <div id="main-sub-wisata" style="">
                                    @php
                                        $images = explode('_', $data->image);

                                        include_once 'function.php';

                                        $jarak = 0;

                                        try {
                                            $depot_latlong = explode(',', $data->koordinat);

                                            $jarak = getJarakKoordinat(
                                                $depot_latlong[0],
                                                $depot_latlong[1],
                                                $koordinat_lat,
                                                $koordinat_long,
                                            );
                                        } catch (\Throwable $th) {
                                            //throw $th;
                                        }

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
                                                <span class="address text-secondary d-block">{{ $jarak . ' m' }}</span>
                                            </h5>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                    <div class="d-flex justify-content-star mt-4">{{ $depot->links() }}</div>
                </div>
            @else
                <h6 class="text-center text-secondary">Data tidak ditemukan !</h6>
            @endif
        </section>

    </div>

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

                Livewire.emit('getLatLangForInput', position.coords.latitude, position.coords.longitude);
            }

        })
    </script>
</div>
