<div>

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
            @if ($showLivewireCreate)
                @livewire('dashboard.daftar-depot.create')
                <script>
                    $(document).ready(function() {
                        $('#createModal').modal('show');
                    });
                </script>
            @endif
            @if ($showLivewireUpdate)
                @livewire('dashboard.daftar-depot.update', ['depot' => $getDepot])
                <script>
                    $(document).ready(function() {
                        $('#editModal').modal('show');
                    });
                </script>
            @endif
            @if ($showLivewireDelete)
                @livewire('dashboard.daftar-depot.delete', ['depot' => $getDepot])
                <script>
                    $(document).ready(function() {
                        $('#deleteModal').modal('show');
                    });
                </script>
            @endif
            <script>
                $(document).on('click', '#closeModal', function() {
                    Livewire.emit('closeLivewire');
                });
            </script>

            <div class="card pt-3">
                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col-md-10">
                            <div wire:ignore.self>
                                <div class="input-group mb-3">
                                    <input wire:model="search" type="text" placeholder="Cari"
                                        class="form-control sm">
                                    <span class="input-group-text" id="basic-addon2"><i class="bi bi-search"></i></span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <span>Show :</span>
                            <select class="form-select md w-auto d-inline" wire:model="paginate">
                                <option value="15">15</option>
                                <option value="20">20</option>
                                <option value="25">25</option>
                                <option value="50">50</option>
                                <option value="100">100</option>
                            </select>
                        </div>
                    </div>
                    @if ($depot->count())
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th style="vertical-align: middle;text-align: center;">#</th>
                                        <th style="vertical-align: middle;text-align: ;">Nama Owner</th>
                                        <th style="vertical-align: middle;text-align: ;">Nama Depot</th>
                                        <th style="vertical-align: middle;text-align: ;">Alamat</th>
                                        <th style="vertical-align: middle;text-align: ;width: 100px;">Koordinat</th>
                                        <th style="vertical-align: middle;text-align: ;width: 100px;">Image</th>
                                        <th style="width: 150px;text-align: center; vertical-align: middle;">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($depot as $data)
                                        <tr>
                                            <td style="vertical-align: middle;text-align: center;">
                                                {{ $loop->iteration }}</td>
                                            <td style="vertical-align: middle;text-align: ;">
                                                {{ $data->owner->nama }}
                                            </td>
                                            <td style="vertical-align: middle;text-align: ;">
                                                {{ $data->nama }}
                                            </td>
                                            <td style="vertical-align: middle;text-align: ;">
                                                @php
                                                    $kelurahan = strtolower($data->get_kelurahan->name);
                                                    $kecamatan = strtolower($data->get_kecamatan->name);
                                                @endphp
                                                {{ ucwords($kelurahan) . ' Kecamatan ' . ucwords($kecamatan) }}
                                            </td>
                                            <td style="vertical-align: middle;text-align: ;">
                                                <a target="blank"
                                                    href="http://maps.google.com/maps?ll={{ $data->koordinat }}">
                                                    <i class="bi bi-pin-map"></i> <small>Maps</small>
                                                </a>
                                            </td>
                                            <td style="vertical-align: middle;text-align: ;">
                                                @php
                                                    $images = explode('_', $data->image);
                                                @endphp

                                                @foreach ($images as $item)
                                                    @if ($item != '')
                                                        <img src="{{ asset('storage/' . $item) }}"
                                                            class="img-fluid mb-1" style="width: 60%;">
                                                    @endif
                                                @endforeach
                                            </td>
                                            <td style="vertical-align: middle;text-align: center;">

                                                <a class="badge bg-primary mb-1 border-0 py-2" target="blank"
                                                    href="https://wa.me/{{ $data->owner->nomor_whatsapp }}">
                                                    <i class="bi bi-whatsapp"></i>
                                                </a>

                                                <button class="badge bg-danger mb-1 border-0 py-2"
                                                    wire:click="delete({{ $data->id_depot }})" ata-bs-toggle="tooltip"
                                                    data-bs-placement="bottom" title="Hapus">
                                                    <span wire:loading.remove
                                                        wire:target="delete({{ $data->id_depot }})">
                                                        <i class="bi  bi-trash"></i>
                                                    </span>
                                                    <span wire:loading wire:target="delete({{ $data->id_depot }})"
                                                        class="spinner-border spinner-border-sm text-light"
                                                        role="status" aria-hidden="true"
                                                        style="width: 11px; height: 11px;"></span>
                                                </button>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="d-flex justify-content-end mt-4">{{ $depot->links() }}</div>
                    @else
                        <hr>
                        <p class="text-center text-secondary mt-5">Data tidak ditemukan !</p>
                    @endif
                </div>
            </div>
        </section>

    </main>

</div>
