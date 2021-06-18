<?php

namespace App\Http\Livewire\Backend\Report;

use Livewire\Component;
use App\Http\Livewire\Backend\Redirec;

class ReportOrders extends Component
{
    public function render()
    {
        $redi = new Redirec();
        $redi->redirec();

        return view('livewire.backend.report.report-orders');
    }
}
