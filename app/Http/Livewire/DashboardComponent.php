<?php

namespace App\Http\Livewire;

use App\Models\Ordene;
use App\Models\User;
use App\Models\Whatsapp;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class DashboardComponent extends Component
{

    public $showingDeleteModal = false;

    public function confirmDelete()
    {
        $this->showingDeleteModal = true;
    }

    public function cancelDelete()
    {
        $this->showingDeleteModal = false;
    }
    public function deleteAccount()
    {
        // Obtener usuario actual
        $user = Auth::user();


        // Eliminar registros relacionados
        Whatsapp::where('id_user', $user->id)->delete();
        Ordene::where('id_user', $user->id)->delete();

        // Eliminar el usuario
        User::where('id', $user->id)->delete();

        // Cerrar sesión
        Auth::logout();

        // Redirigir al login
        return redirect()->route('login');
    }
    public function render()
    {
        $whatsapp = Whatsapp::where('id_user', Auth::user()->id)->first() ?? false;
        $ordenes = Ordene::where('id_user', Auth::user()->id)->orderBy('created_at','desc')->first();
        return view('livewire.dashboard-component',['ordenes' => $ordenes,'whatsapp' => $whatsapp]);
    }
}
