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

        @if ($showUpdateNama)
            @livewire('dashboard.profil.update-nama')
            <script>
                $(document).ready(function() {
                    $('#updateNamaModal').modal('show');
                });
            </script>
        @endif
        @if ($showUpdateUsername)
            @livewire('dashboard.profil.update-username')
            <script>
                $(document).ready(function() {
                    $('#updateUsernameModal').modal('show');
                });
            </script>
        @endif
        @if ($showUpdatePassword)
            @livewire('dashboard.profil.update-password')
            <script>
                $(document).ready(function() {
                    $('#updatePasswordModal').modal('show');
                });
            </script>
        @endif
        <script>
            $(document).on('click', '#closeModal', function() {
                Livewire.emit('closeLivewire');
            });
        </script>

        <section class="section" style="padding-top: 20px;">

            <div class="row">
                <div class="col-md-12">

                    @if (auth()->user()->pegawai)
                        <form wire:submit.prevent="update">
                            @csrf
                            <div class="fw-bold mb-2">Update Foto Profil</div>
                            <div class="mb-3">
                                <input type="file" class="hidden d-inline mb-1" id="image" wire:model="image"
                                    style="" onchange="imgPreview()" style="height: 58px;">
                                <span wire:loading wire:target="image" wire:key="image">
                                    <i class="spinner-border" role="status"
                                        style="margin-bottom: -7px; margin-left: 5px;"></i>
                                </span>
                                <label for="image"><span type="submit" class="badge bg-secondary py-2 px-3"
                                        style="width: 100px; height: 2rem;font-size: 10pt;">Pilih
                                        Image</span></label>

                                <button class="btn btn-primary" style="width: 100px; height: 2rem;font-size: 10pt;">
                                    <span wire:loading.remove wire:target="update">Simpan</span>
                                    <span wire:loading wire:target="update"
                                        class="spinner-border spinner-border-sm text-light" role="status"
                                        aria-hidden="true" style="width: 12px; height: 12px;">
                                    </span>
                                </button>
                                @error('image')
                                    <small class="text-danger d-block">{{ $message }}</small>
                                @enderror
                                <div wire:ignore>
                                    <img class="img-preview img-fluid d-block mt-2" style="width: 100px;"
                                        height="100">
                                </div>
                            </div>
                        </form>
                    @endif
                    <ol class="list-group">

                        <li class="list-group-item d-flex justify-content-between align-items-start">
                            <div class="ms-2 me-auto">
                                <div class="fw-bold">Nama</div>
                                {{ auth()->user()->nama }}
                            </div>
                            @if (auth()->user()->level == 0)
                                <button class="badge bg-primary border-0" wire:click="updateNama"
                                    style="font-size: 10pt; font-weight: normal;height: 35px; width: 6rem;">
                                    <span wire:loading.remove wire:target="updateNama"><i class="bi bi-pencil"></i>
                                        Ubah</span>
                                    <span wire:loading wire:target="updateNama"
                                        class="spinner-border spinner-border-sm text-light" role="status"
                                        aria-hidden="true"></span>
                                </button>
                            @else
                                <button class="badge bg-secondary border-0"
                                    style="font-size: 10pt; font-weight: normal;height: 35px; width: 6rem;" disabled>
                                    <i class="bi bi-pencil"></i> Ubah
                                </button>
                            @endif
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-start">
                            <div class="ms-2 me-auto">
                                <div class="fw-bold">Username</div>
                                {{ auth()->user()->username }}
                            </div>
                            @if (auth()->user()->level == 0)
                                <button class="badge bg-primary border-0" wire:click="updateUsername"
                                    style="font-size: 10pt; font-weight: normal;height: 35px; width: 6rem;">
                                    <span wire:loading.remove wire:target="updateUsername"><i class="bi bi-pencil"></i>
                                        Ubah</span>
                                    <span wire:loading wire:target="updateUsername"
                                        class="spinner-border spinner-border-sm text-light" role="status"
                                        aria-hidden="true"></span>
                                </button>
                            @else
                                <button class="badge bg-secondary border-0"
                                    style="font-size: 10pt; font-weight: normal;height: 35px; width: 6rem;" disabled>
                                    <i class="bi bi-pencil"></i> Ubah
                                </button>
                            @endif
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-start">
                            <div class="ms-2 me-auto">
                                <div class="fw-bold">Password</div>
                                {{ '********' }}
                            </div>
                            <button class="badge bg-primary border-0" wire:click="updatePassword"
                                style="font-size: 10pt; font-weight: normal;height: 35px; width: 6rem;">
                                <span wire:loading.remove wire:target="updatePassword"><i class="bi bi-pencil"></i>
                                    Ubah</span>
                                <span wire:loading wire:target="updatePassword"
                                    class="spinner-border spinner-border-sm text-light" role="status"
                                    aria-hidden="true"></span>
                            </button>
                        </li>
                    </ol>
                </div>
            </div>


        </section>

    </main>

</div>
