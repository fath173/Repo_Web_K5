<?php

namespace App\Http\Livewire\Backend\Products;

use Livewire\Component;
use App\Http\Livewire\Backend\Redirec;
use App\Models\Product as ProductModel;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Livewire\WithFileUploads;

class Product extends Component
{
    use WithFileUploads;
    public $nama_produk, $deskripsi;
    public $photo;

    protected $listeners = ['resetField', 'deleteProduk'];

    public function tambahProduk()
    {
        $this->validate([
            'photo' => 'image|max:1024|required',
            'nama_produk' => 'required:max:15',
            'deskripsi' => 'required',
        ]);


        $namePhoto = md5($this->photo . microtime() . '.' . $this->photo->extension());
        Storage::putFileAs(
            'public/product',
            $this->photo,
            $namePhoto
        );

        ProductModel::create([
            'nama_produk' => $this->nama_produk,
            'gambar' => $namePhoto,
            'deskripsi' => $this->deskripsi
        ]);

        $this->resetField();
        $this->emit("swal:modal", [
            'type'    => 'success',
            'icon'    => 'success',
            'title'   => 'Produk berhasil ditambahkan!',
            'timeout' => 3000,
        ]);
    }

    public function edit($id)
    {
        $produk = ProductModel::find($id);
        $this->nama_produk = $produk->nama_produk;
        $this->deskripsi = $produk->deskripsi;
    }

    public function resetField()
    {
        $this->nama_produk = '';
        $this->photo = '';
        $this->deskripsi = '';
        // Session::flush();
        // session()->forget('deskripsi');
        // Session::forget('nama_produk');
    }

    public function updatedPhoto()
    {
        $this->validate([
            'photo' => 'image|max:1024',
        ]);
    }

    public function updateProduk($id)
    {
        if ($this->photo) {
            $this->validate([
                'photo' => 'image|max:1024|required',
                'nama_produk' => 'required:max:15',
                'deskripsi' => 'required',
            ]);
            $namePhoto = md5($this->photo . microtime() . '.' . $this->photo->extension());
            Storage::putFileAs(
                'public/product',
                $this->photo,
                $namePhoto
            );

            ProductModel::where('id', $id)
                ->update([
                    'nama_produk' => $this->nama_produk,
                    'gambar' => $namePhoto,
                    'deskripsi' => $this->deskripsi,
                ]);
            $this->photo = '';
        } else {
            $this->validate([
                'nama_produk' => 'required:max:15',
                'deskripsi' => 'required',
            ]);
            ProductModel::where('id', $id)
                ->update([
                    'nama_produk' => $this->nama_produk,
                    'deskripsi' => $this->deskripsi,
                ]);
        }
    }

    public function removeProduk($id)
    {
        $this->emit("swal:confirm", [
            'type'        => 'warning',
            'icon'        => 'warning',
            'title'       => 'Anda Yakin?',
            'text'        => "Ingin menghapus produk?",
            'confirmText' => 'Ya, Hapus',
            'method'      => 'deleteProduk',
            'params'      => [$id], // optional, send params to
            'callback'    => '', // optional, fire event if no
        ]);
    }

    public function deleteProduk($id)
    {
        ProductModel::where('id', $id)
            ->delete();
    }

    public function render()
    {
        // Redirect untuk menahan jika bukan admin maka tidak bisa masuk ke dashboard
        $redi = new Redirec();
        $redi->redirec();

        // Memanggil Product dari database dengan model
        $products = ProductModel::orderBy('created_at', 'DESC')->get();

        return view('livewire.backend.products.product', [
            'products' => $products
        ]);
    }
}
