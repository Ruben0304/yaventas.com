<?php

namespace App\Http\Livewire\Admin;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class ListadoUsuarios extends Component
{
    use WithPagination;

    public $search = '';
    protected $roleTypes = ["ADMIN","USER"];

    protected $listeners = ['userUpdated' => '$refresh'];

    public function updateUserRole($userId, $userRole)
    {
        $user = User::find($userId);

        if (!$user) {
            session()->flash('error', 'Usuario no encontrado');
            return;
        }

        $user->update([
            'utype' => $userRole
        ]);

        session()->flash('message', 'Rol actualizado correctamente');
    }

    public function render()
    {
        $users = User::where('name', 'like', '%' . $this->search . '%')
            ->orWhere('email', 'like', '%' . $this->search . '%')
            ->paginate(10);

        return view('livewire.admin.listado-usuarios', [
            'users' => $users,
            'roleTypes' => $this->roleTypes
        ]);
    }
}
