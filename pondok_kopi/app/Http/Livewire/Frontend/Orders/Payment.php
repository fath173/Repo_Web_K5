<?php

namespace App\Http\Livewire\Frontend\Orders;

use Livewire\Component;

use App\Models\Order;
use Illuminate\Support\Facades\Storage;
use Livewire\WithFileUploads;

class Payment extends Component
{

    use WithFileUploads;
    public $id_orders, $image;
    public function mount($id)
    {
        $this->id_orders = $id;
    }

    public function previewImage()
    {
        $this->validate([
            'image' => 'image|max:2048|required'
        ]);
    }

    public function updateBayar()
    {
        $this->validate([
            'image' => 'image|max:2048|required'
        ]);
        $nameImage = md5($this->image . microtime() . '.' . $this->image->extension());
        Storage::putFileAs(
            'public/payment',
            $this->image,
            $nameImage
        );
        Order::where('id', $this->id_orders)
            ->update([
                'bukti_bayar' => $nameImage,
                'status' => 'verifikasi',
            ]);

        $this->emit("swal:modal", [
            'type' => 'success',
            'icon' => 'success',
            'title' => 'Upload payment have been finished!',
            'timeout' => 3000,
        ]);
        $this->image = '';
    }

    public function render()
    {
        $orders = Order::find($this->id_orders);
        return view('livewire.frontend.orders.payment', [
            'orders' => $orders
        ]);
    }
}
