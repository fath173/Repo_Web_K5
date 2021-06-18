<?php

namespace App\Http\Livewire\Backend\Petugas;

use Livewire\Component;
use App\Http\Livewire\Backend\Redirec;

class Petugas extends Component
{
    public function render()
    {
        $redi = new Redirec();
        $redi->redirec();

        return view('livewire.backend.petugas.petugas');
    }
}
