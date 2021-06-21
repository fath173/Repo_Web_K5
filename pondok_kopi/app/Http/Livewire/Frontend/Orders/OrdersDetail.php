<?php

namespace App\Http\Livewire\Frontend\Orders;

use Livewire\Component;
use Illuminate\Support\Facades\DB;
use App\Models\Order;
use App\Models\Testimonial;

class OrdersDetail extends Component
{

    public $id_orders;

    public function mount($id)
    {
        $this->id_orders = $id;
    }
    public function render()
    {
        // dd($this->testi());
        return view('livewire.frontend.orders.orders-detail', [
            'orders' => $this->orders(),
            'testi' => $this->testi(),
            'ordersDetail' => $this->detailOrders($this->id_orders)
        ]);
    }

    public function testi()
    {
        $testi = Testimonial::where('id_pesan', $this->id_orders);
        return $testi;
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
