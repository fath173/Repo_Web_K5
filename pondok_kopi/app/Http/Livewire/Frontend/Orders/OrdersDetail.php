<?php

namespace App\Http\Livewire\Frontend\Orders;

use Livewire\Component;
use Illuminate\Support\Facades\DB;
use App\Models\Order;
use App\Models\Testimonial;
use Mockery\Undefined;

class OrdersDetail extends Component
{

    public $id_user, $id_orders, $kesan;

    public function mount($id)
    {
        $this->id_orders = $id;
    }
    public function render()
    {
        $this->id_user = Auth()->id();

        return view('livewire.frontend.orders.orders-detail', [
            'orders' => $this->orders(),
            'testi' => $this->testi(),
            'ordersDetail' => $this->detailOrders($this->id_orders)
        ]);
    }

    public function testi()
    {
        $testi = DB::select('select id_pesanan from testimonials where id_pesanan = ' . $this->id_orders);
        return $testi;
    }

    public function updateTesti()
    {
        $this->validate([
            'kesan' => 'required',
        ]);

        date_default_timezone_set('Asia/Jakarta');
        $waktu = date('Y-m-d H:i:s');

        Testimonial::create([
            'id_user' => $this->id_user,
            'id_pesanan' => $this->id_orders,
            'tgl_testi' => $waktu,
            'kesan' => $this->kesan,
            'status_baca' => 'Yes',

        ]);
        $this->kesan = '';
        $this->emit("swal:modal", [
            'type' => 'success',
            'icon' => 'success',
            'title' => 'Testimoni anda sudah terkirim!',
            'timeout' => 3000,
        ]);
    }

    public function orders()
    {
        $orders = Order::where('id', $this->id_orders)->get();
        return $orders;
    }
    public function detailOrders($id)
    {
        $ordersDetail[] = [DB::table('order_details')
            ->Join(
                'product_variations',
                'order_details.id_variasi',
                '=',
                'product_variations.id',
            )->Join(
                'products',
                'product_variations.id_produk',
                '=',
                'products.id',
            )->where('order_details.id_pesanan', '=', $id)
            ->get()];

        $subtotal = 0;
        foreach ($ordersDetail[0][0] as $detail) {
            $subtotal += $detail->subtotal;
        }
        return [
            'detail' => $ordersDetail,
            'subTotal' => $subtotal
        ];
    }

    public function cancelOrders()
    {
        // dd($this->id_orders);
        Order::where('id', $this->id_orders)
            ->update([
                'status' => 'dibatalkan',
                'alasan' => 'Dibatalkan Pelanggan'
            ]);
    }
    public function confirmOrders()
    {
        Order::where('id', $this->id_orders)
            ->update([
                'status' => 'selesai'
            ]);
    }
}
