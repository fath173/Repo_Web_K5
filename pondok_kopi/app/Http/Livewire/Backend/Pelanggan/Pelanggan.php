<?php

namespace App\Http\Livewire\Backend\Pelanggan;

use Livewire\Component;
use App\Http\Livewire\Backend\Redirec;

class Pelanggan extends Component
{
    public function render()
    {
        $redi = new Redirec();
        $redi->redirec();

        return view('livewire.backend.pelanggan.pelanggan');
    }
}
