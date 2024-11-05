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
    public $userIdToDelete = null;

    protected $listeners = ['userUpdated' => '$refresh'];

    public function deleteUser()
    {
        $user = User::find($this->userIdToDelete);

        if (!$user) {
            session()->flash('error', 'Usuario no encontrado');
            return;
        }

        // Evitar que se elimine a sí mismo
        if ($user->id === auth()->id()) {
            session()->flash('error', 'No puedes eliminar tu propio usuario');
            return;
        }

        $user->delete();
        $this->userIdToDelete = null;

        session()->flash('message', 'Usuario eliminado correctamente');
    }

    public function confirmDelete($userId)
    {
        $this->userIdToDelete = $userId;
    }

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
