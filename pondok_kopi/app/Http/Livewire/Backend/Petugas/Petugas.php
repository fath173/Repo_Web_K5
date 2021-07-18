<?php

namespace App\Http\Livewire\Backend\Petugas;

use Livewire\Component;
use App\Http\Livewire\Backend\Redirec;
use App\Models\User;
use Livewire\WithFileUploads;

class Petugas extends Component
{
    use WithFileUploads;
    public $name, $phone_number, $email, $password, $password_confirmation,
        $gender, $address;

    public function tambahPetugas()
    {
        $this->validate([
            'name' => 'required',
            'phone_number' => 'required',
            'email' => 'required|email',
            'password' => 'required|confirmed',
            'level' => 'required',
            'gender' => 'required',
            'address' => 'required',
        ]);

        User::create([
            'name' => $this->name,
            'phone_number' => $this->phone_number,
            'email' => $this->email,
            'password' => $this->password,
            'level' => 'pegawai',
            'gender' => $this->gender,
            'address' => $this->address,
        ]);

        $this->resetField();
        $this->emit("swal:modal", [
            'type'    => 'success',
            'icon'    => 'success',
            'title'   => 'Petugas berhasil ditambahkan!',
            'timeout' => 3000,
        ]);
    }

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
