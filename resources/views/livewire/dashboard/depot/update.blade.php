<div>
    @if (session()->has('message'))
        <div>
            <script>
                Swal.fire({
                    icon: 'success',
                    text: 'Data berhasil diubah',
                    allowOutsideClick: false
                })
            </script>
        </div>
    @endif

    <form wire:submit.prevent="update({{ $idEdit }})">
        @csrf
        <div wire:ignore.self class="modal fade" id="editModal" data-bs-backdrop="static" data-bs-keyboard="false">
            <div class="modal-dialog modal-lg modal-dialog-scrollable">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5><i class="bi bi-pencil"></i> Update data depot</h5>
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
                                            placeholder="Nama Depot" name="nama" id="nama"
                                            wire:model.defer="nama">
                                        <label for="nama">Nama Depot</label>
                                        @error('nama')
                                            <div class="invalid-feedback d-flex justify-content-star">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <select
                                            class="form-select form-select-md @error('kecamatan')
                                            is-invalid
                                            @enderror"
                                            id="kecamatan" name="kecamatan" wire:model="kecamatan" style="height: 58px;"
                                            wire:change="opsi_kelurahan">
                                            <option value=" ">-- Pilih Kecamatan --</option>
                                            @foreach ($get_kecamatan as $data)
                                                <option value="{{ $data->id }}">{{ $data->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('kecamatan')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <select
                                            class="form-select form-select-md @error('kelurahan')
                                            is-invalid
                                            @enderror"
                                            id="kelurahan" name="kelurahan" wire:model="kelurahan" style="height: 58px;"
                                            wire:change="opsi_kelurahan">
                                            <option value=" ">-- Pilih Kelurahan --</option>
                                            @if ($get_kelurahan)
                                                @if ($get_kelurahan->count() > 0)
                                                    @foreach ($get_kelurahan as $data)
                                                        <option value="{{ $data->id }}">{{ $data->name }}</option>
                                                    @endforeach
                                                @endif
                                            @endif
                                        </select>
                                        @error('kelurahan')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>



                                    <div class="mb-3">
                                        <input type="file" class="hidden d-inline mb-1" id="image"
                                            wire:model="image" style="" style="height: 58px;" multiple
                                            accept="image/png, image/jpg, image/jpeg">
                                        <label for="image"><span type="submit"
                                                class="badge bg-secondary py-2 px-3">Upload
                                                File</span></label>
                                        <span wire:loading wire:target="image" wire:key="image">
                                            <i class="spinner-border" role="status"
                                                style="margin-bottom: -7px; margin-left: 5px;"></i>
                                        </span>
                                        @if ($image)
                                            <span class="text-success d-block" wire:loading.remove wire:target="image">
                                                <i class="bi bi-check-lg"></i> terunggah
                                            </span>
                                        @endif
                                        @error('image.*')
                                            <small class="text-danger d-block">{{ $message }}</small>
                                        @enderror
                                        <div wire:ignore.self>
                                            @if (session()->has('image_required'))
                                                <small class="text-danger">image wajib diisi</small>
                                            @endif
                                        </div>

                                        @foreach ($image as $data)
                                            <i class="bi bi-file-pdf-fill text-danger"></i>
                                            {{ $data->getClientOriginalName() }}
                                            <button type="button" class="badge bg-danger border-0 d-inline-block p-1"
                                                wire:click="remove_item({{ $loop->index }})" style="">
                                                <span wire:loading.remove
                                                    wire:target="remove_item({{ $loop->index }})">
                                                    <i class="bi bi-x-lg text-light fw-bolder"></i>
                                                </span>
                                                <span wire:loading wire:target="remove_item({{ $loop->index }})"
                                                    class="spinner-border spinner-border-sm text-light" role="status"
                                                    aria-hidden="true" style="width: 10px; height: 10px;">
                                                </span>
                                            </button>
                                            <br>
                                        @endforeach
                                    </div>

                                    <div class="form-floating mb-3">
                                        <input type="text"
                                            class="form-control @error('koordinat')
                                                            is-invalid
                                                        @enderror"
                                            placeholder="Koordinat" name="koordinat" id="koordinat"
                                            wire:model.defer="koordinat">
                                        <label for="koordinat">Koordinat</label>
                                        @error('koordinat')
                                            <div class="invalid-feedback d-flex justify-content-star">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>


                                    <div class="mb-3">
                                        <label for="">Keterangan</label>
                                        <div>
                                            @error('keterangan')
                                                <small class="text-danger">
                                                    {{ $message }}
                                                </small>
                                            @enderror
                                        </div>
                                        <div wire:ignore>
                                            <textarea wire:model="keterangan" class="form-control" name="keterangan" id="keterangan"></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer d-flex justify-content-end">
                        <button type="button" id="closeModal" class="btn btn-secondary px-4" data-bs-dismiss="modal"
                            style="width: 140px; height: 3rem;">Batal</button>
                        <button class="btn btn-primary px-4" style="width: 140px; height: 3rem;">
                            <span wire:loading.remove wire:target="update">Simpan</span>
                            <span wire:loading wire:target="update"
                                class="spinner-border spinner-border-sm text-light" role="status" aria-hidden="true"
                                style="width: 12px; height: 12px;">
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
                $('#editModal').modal('hide');
            })
        </script>
    @endif

    <script>
        $(document).ready(function() {
            $('#keterangan').summernote({
                placeholder: 'keterangan',
                tabsize: 2,
                height: 300,
                toolbar: [
                    ['groupName', ['list of button']],
                    ['style', ['bold', 'italic', 'underline', 'clear']],
                    ['font', ['strikethrough', 'superscript', 'subscript']],
                    ['fontname', ['fontname']],
                    ['fontsize', ['fontsize']],
                    ['color', ['color']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['height', ['height']],
                    ['insert', ['picture', 'math']]
                ],
                callbacks: {
                    onChange: function(contents) {
                        @this.set('keterangan', contents);
                    }
                },
            });
        });
    </script>


</div>
