<?php

namespace App\Http\Livewire\Frontend;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Redirectt extends Component
{

    public function redirectt()
    {
        if (Auth::user()->level == 'admin') {
            return redirect()->to('/');
        }
    }
}
