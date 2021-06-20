<?php

namespace App\Http\Livewire\Backend\Petugas;

use Livewire\Component;
use App\Http\Livewire\Backend\Redirec;
use App\Models\User;

class Petugas extends Component
{



    public function render()
    {
        $redi = new Redirec();
        $redi->redirec();

        //ini coding untuk memanggil data daari database
        $dataPetugas = User::where('level', 'admin')->orderBy('id', 'DESC')->get();

        return view('livewire.backend.petugas.petugas', [
            'dataPetugas' => $dataPetugas
        ]);
    }
}
