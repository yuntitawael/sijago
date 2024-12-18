<div>

    <title>{{ $title }}</title>


    <div wire:ignore.self class="container">
        <section wire:ignore.self id="hero" class="">

            @if ($showLivewireRegistrasi)
                @livewire('registrasi')
                <script>
                    $(document).ready(function() {
                        $('#registrasiModal').modal('show');
                    });
                </script>
            @endif
            <script>
                $(document).on('click', '#closeModal', function() {
                    Livewire.emit('closeLivewire');
                });
            </script>

            <div wire:ignore.self class="row justify-content-center">
                <div class="col-lg-6 pt-lg-0 order-2 order-lg-1" data-aos="fade-up" wire:ignore.self>
                    @if (session()->has('message'))
                        <script>
                            Swal.fire({
                                position: 'center-center',
                                icon: 'error',
                                title: 'Login gagal !',
                                text: 'Username atau password tidak diketahui',
                                showConfirmButton: false,
                                timer: 1000
                            })
                        </script>
                    @endif
                    <h3 class="text-center mb-4" style="margin-top: -30px;"><i class="bi bi-box-arrow-in-up"></i> Silahkan Login
                    </h3>
                    <form wire:submit.prevent="auth" class="">
                        @csrf
                        <div class="mb-3">
                            <div class="form-floating">
                                <input type="text" wire:model.defer="username"
                                    class="form-control @error('username') is-invalid @enderror" placeholder="Username"
                                    value="{{ old('username') }}" name="username" id="username" autofocus>
                                <label for="username">Username</label>
                                @error('username')
                                    <div class="invalid-feedback d-flex justify-content-star">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="mb-3">
                            <div class="form-floating">
                                <input wire:ignore.self type="password" wire:model.defer="password"
                                    class="form-control @error('password') is-invalid @enderror" placeholder="Password"
                                    value="{{ old('password') }}" name="password" id="password" autofocus>
                                <label for="password">Password</label>
                                @error('password')
                                    <div class="invalid-feedback d-flex justify-content-star">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="icheck-primary d-flex justify-content-star align-items-center"
                            style="margin-top:-10px;">
                            <input type="checkbox" id="lihatPassword" wire:ignore.self>
                            <label wire:ignore.self for="lihatPassword"
                                style="font-weight: normal;margin-top:0px;margin-left: 5px;">
                                <small class="text-dark">Lihat Password</small>
                            </label>
                        </div>

                        <button type="submit" class="w-100 btn border-0 btn-primary mt-3 btn-get-started py-3"
                            name="login">
                            <span wire:loading.remove wire:target="auth">
                                <i class="bi bi-box-arrow-in-up"></i> LOGIN
                            </span>
                            <span wire:loading wire:target="auth" class="spinner-border spinner-border-sm text-light"
                                role="status" aria-hidden="true" style="width: ; height: ;"></span>
                        </button>

                        <div class="icheck-primary d-flex align-items-center justify-content-beetwen"
                            style="margin-top:10px;">
                            <input type="checkbox" id="remember_me" wire:model.defer="remember_me">
                            <label for="remember_me" style="font-weight: normal;margin-top:0px;margin-left: 5px;">
                                <small class="text-dark">Ingat Saya !</small>
                            </label>

                            <div style="margin-top: 13px;margin-left: 50px;">
                                <span type="button" wire:click="registrasi_akun" class="text-primary"
                                    style="font-size: 10pt;font-weight: normal;width: 150px;height: 2.2rem;">
                                    Registrasi Akun
                                    <span wire:loading wire:target="registrasi_akun"
                                        class="spinner-border spinner-border-sm text-primary" role="status"
                                        aria-hidden="true" style="width: 13px; height: 13px;"></span>
                                </span>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </section>
    </div>

    <script>
        $(document).on('click', '#lihatPassword', function() {

            const password = document.querySelector('#password');

            if (password.type == 'password') {
                password.type = 'text'
            } else {
                password.type = 'password';
            }

        })
    </script>

</div>
