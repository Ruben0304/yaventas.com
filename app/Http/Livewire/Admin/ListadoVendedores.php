<?php

namespace App\Http\Livewire\Admin;

use App\Models\Vendedore;
use Livewire\Component;
use Livewire\WithPagination;

class ListadoVendedores extends Component
{
    use WithPagination;

    public $search = '';
    public $selectedVendor = null;

    protected $listeners = ['closeModal' => 'closeVendorModal'];

    public function showVendorProducts($vendorId)
    {
        $this->selectedVendor = Vendedore::with(['productos' => function($query) {
            $query->orderBy('created_at', 'desc');
        }])->find($vendorId);
    }

    public function closeVendorModal()
    {
        $this->selectedVendor = null;
    }

    public function render()
    {
        $vendedores = Vendedore::where(function($query) {
            $query->where('nombre', 'like', '%' . $this->search . '%')
                ->orWhere('telefono', 'like', '%' . $this->search . '%')
                ->orWhere('direccion', 'like', '%' . $this->search . '%');
        })
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('livewire.admin.listado-vendedores', [
            'vendedores' => $vendedores
        ]);
    }
}
