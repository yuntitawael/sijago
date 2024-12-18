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
                @livewire('dashboard.user.create')
                <script>
                    $(document).ready(function() {
                        $('#createModal').modal('show');
                    });
                </script>
            @endif
            @if ($showLivewireDelete)
                @livewire('dashboard.user.delete', ['admin' => $getAdmin])
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

            <div class="row mb-3">
                <div class="col-md-12">
                    <button wire:click="create" class="badge bg-primary border-0 px-3 py-2 mt-1"
                        style="font-size: 10pt;font-weight: normal;width: 150px;height: 2.6rem;">
                        <span wire:loading.remove wire:target="create"><i class="bi bi-plus-lg"></i> Tambah
                            Data</span>
                        <span wire:loading wire:target="create" class="spinner-border spinner-border-sm text-light"
                            role="status" aria-hidden="true" style="width: 13px; height: 13px;"></span>
                    </button>
                </div>
            </div>

            <div class="card pt-3">
                <div class="card-body">
                    @if ($admin->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th style="vertical-align: middle;text-align: center;">#</th>
                                        <th style="vertical-align: middle;text-align: ;">Nama</th>
                                        <th style="vertical-align: middle;text-align: ;">username</th>
                                        <th style="width: 150px;text-align: center; vertical-align: middle;">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($admin as $data)
                                        <tr>
                                            <td style="vertical-align: middle;text-align: center;">
                                                {{ $loop->iteration }}</td>
                                            <td style="vertical-align: middle;text-align: ;">
                                                {{ $data->nama }}
                                            </td>
                                            <td style="vertical-align: middle;text-align: ;">
                                                {{ $data->username }}
                                            </td>
                                            <td style="vertical-align: middle;text-align: center;">
                                                @if (auth()->user()->id == $data->id)
                                                    <button id="noHapus" class="badge bg-danger mb-1 border-0 py-2"
                                                        style="height: 2rem;width: 2rem;"><i
                                                            class="bi bi-trash"></i></button>
                                                @elseif($data->level == 0 || $data->level == 2)
                                                    <button class="badge bg-danger mb-1 border-0 py-2"
                                                        wire:click="delete({{ $data->id }})" ata-bs-toggle="tooltip"
                                                        data-bs-placement="bottom" title="Hapus"
                                                        style="height: 2rem;width: 2rem;">
                                                        <span wire:loading.remove
                                                            wire:target="delete({{ $data->id }})">
                                                            <i class="bi  bi-trash"></i>
                                                        </span>
                                                        <span wire:loading wire:target="delete({{ $data->id }})"
                                                            class="spinner-border spinner-border-sm text-light"
                                                            role="status" aria-hidden="true"
                                                            style="width: 11px; height: 11px;"></span>
                                                    </button>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <hr>
                        <p class="text-center text-secondary mt-5">Data tidak ditemukan !</p>
                    @endif
                </div>
            </div>
        </section>

    </main>

    <script>
        $(document).on('click', '#noHapus', function() {
            Swal.fire({
                icon: 'error',
                'title': 'Sorry !',
                text: 'Tombol hapus tidak berfungsi saat anda sedang login',
                allowOutsideClick: false
            })
        })
    </script>


</div>
