<div>
    @if (session()->has('message'))
        <div>
            <script>
                Swal.fire({
                    icon: 'success',
                    text: 'Registrasi berhasil',
                    allowOutsideClick: false
                }).then(() => {
                    window.location.href = '/login';
                })
            </script>
        </div>
    @endif

    <form wire:submit.prevent="store">
        @csrf
        <div wire:ignore.self class="modal fade" id="registrasiModal" data-bs-backdrop="static" data-bs-keyboard="false">
            <div class="modal-dialog modal-dialog-scrollable">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5> <i class="bi bi-plus-lg"></i> Registrasi Owner</h5>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-floating mb-3">
                                        <input type="text"
                                            class="form-control @error('nama')
                                                            is-invalid
                                                        @enderror"
                                            placeholder="Nama" name="nama" id="nama" wire:model.defer="nama">
                                        <label for="nama">Nama</label>
                                        @error('nama')
                                            <div class="invalid-feedback d-flex justify-content-star">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <select
                                            class="form-select form-select-md @error('jenis_kelamin')
                                            is-invalid
                                            @enderror"
                                            id="jenis_kelamin" name="jenis_kelamin" wire:model="jenis_kelamin"
                                            style="height: 58px;">
                                            <option value=" ">-- Jenis Kelamin --</option>
                                            <option value="Laki-Laki">Laki-Laki</option>
                                            <option value="Perempuan">Perempuan</option>
                                        </select>
                                        @error('jenis_kelamin')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="form-floating mb-3">
                                        <input type="text"
                                            class="form-control @error('nomor_whatsapp')
                                                            is-invalid
                                                        @enderror"
                                            placeholder="Nomor Whatsapp" name="nomor_whatsapp" id="nomor_whatsapp"
                                            wire:model.defer="nomor_whatsapp">
                                        <label for="nomor_whatsapp">Nomor Whatsapp</label>
                                        @error('nomor_whatsapp')
                                            <div class="invalid-feedback d-flex justify-content-star">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                        @if (session()->has('no_whatsapp_invalid'))
                                            <small class="text-danger">maaf awalan nomor whatsapp harus menggunakan
                                                (628) bukan (08)</small>
                                        @endif
                                    </div>
                                    <div class="form-floating mb-3">
                                        <input type="text"
                                            class="form-control @error('password')
                                                            is-invalid
                                                        @enderror"
                                            placeholder="Password" name="password" id="password"
                                            wire:model.defer="password">
                                        <label for="password">Password</label>
                                        @error('password')
                                            <div class="invalid-feedback d-flex justify-content-star">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                        @if (session()->has('batas_password'))
                                            <small class="text-danger">password minimal 8 karakter</small>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer d-flex justify-content-end">
                            <button type="button" id="closeModal" class="btn btn-secondary px-4"
                                data-bs-dismiss="modal" style="width: 140px; height: 3rem;">Batal</button>
                            <button class="btn btn-primary px-4" style="width: 140px; height: 3rem;">
                                <span wire:loading.remove wire:target="store">Simpan</span>
                                <span wire:loading wire:target="store"
                                    class="spinner-border spinner-border-sm text-light" role="status"
                                    aria-hidden="true" style="width: 12px; height: 12px;">
                                </span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
    </form>

    @if ($closeModal)
        <script>
            $(document).ready(function() {
                $('#registrasiModal').modal('hide');
            })
        </script>
    @endif


</div>
