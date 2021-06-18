@if ($orders->status == 'verifikasi' || $orders->status == 'belum bayar')
    <div class="container">
        <div class="row">
            <div class="col-6">
                <h4>Form Pembayaran</h4>
                <div class="card">
                    <div class="card-body">
                        <div class="alert alert-info" role="alert">
                            Silahkan melakukan pembayaran <b>Rp {{ $orders->total }}</b> ke <br>
                            <b>BANK MANDIRI 137-889900-753 AN. Fathor Rahman</b>
                        </div>
                        <form>
                            <div class="form-group">
                                <label>Upload Bukti Pembayaran</label>
                                <div class="custom-file">
                                    <input type="file" wire:model="image" id="customFile" accept="image/*"
                                        class="custom-file-input" style="cursor: pointer">
                                    <label for="customFile" class="custom-file-label">Pilih Gambar</label>
                                    @error('image')<small class="text-danger">{{ $message }}</small>@enderror
                                </div>
                            </div>
                        </form>
                        <b class="text-danger">Max 2Mb</b>
                    </div>
                    <div class="card-footer">
                        <button type="submit" wire:click.prevent="updateBayar()" class="genric-btn danger"
                            data-dismiss="modal">Save Payment</button>
                    </div>
                </div>
            </div>
            <div class="col-6">
                <h4>Bukti Pembayaran</h4>
                <div class="card">
                    <div class="card-body">
                        @if (!empty($image))
                            <label class="mt-2">Upload Preview</label>
                            <img class="mt-2" src="{{ $image->temporaryUrl() }}" style="width: 100%" alt="Preview">
                        @else
                            <label class="mt-2">Upload Preview</label>
                            <img class="mt-2" src="{{ asset('storage/payment/' . $orders->bukti_bayar) }}"
                                style="width: 100%" alt="Preview">
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@else
    <h1>empty</h1>
@endif
