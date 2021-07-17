<?php

namespace App\Http\Livewire\Frontend;

use Livewire\Component;
use App\Models\Product;

class Landingpage extends Component
{
    public function render()
    {
        $products = Product::orderBy('created_at', 'DESC')->get();
        return view('livewire.frontend.landingpage', [
            'products' => $products
        ]);
    }
}
