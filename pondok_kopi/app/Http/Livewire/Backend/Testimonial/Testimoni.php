<?php

namespace App\Http\Livewire\Backend\Testimonial;

use Livewire\Component;
use App\Http\Livewire\Backend\Redirec;
use App\Models\User;

class Testimoni extends Component
{



    public function render()
    {
        $redi = new Redirec();
        $redi->redirec();

        //ini coding untuk memanggil data daari database
        $dataTestimoni = User::where('level', 'pelanggan')->orderBy('id', 'DESC')->get();

        return view('livewire.backend.testimonial.testimoni', [
            'dataTestimoni' => $dataTestimoni
        ]);
    }
}
