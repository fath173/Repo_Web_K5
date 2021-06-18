<?php

namespace App\Http\Livewire\Backend\Testimonial;

use Livewire\Component;
use App\Http\Livewire\Backend\Redirec;

class Testimoni extends Component
{
    public function render()
    {
        $redi = new Redirec();
        $redi->redirec();

        return view('livewire.backend.testimonial.testimoni');
    }
}
