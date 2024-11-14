<?php

namespace App\Http\Livewire\Admin;

use App\Models\Vendedore;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;

class ListadoVendedores extends Component
{
    use WithPagination, WithFileUploads;

    public $search = '';
    public $selectedVendor = null;
    public $showModal = false;
    public $showProductsModal = false;

    // Form fields
    public $vendorId;
    public $nombre;
    public $direccion;
    public $telefono;
    public $descripcion;
    public $foto;
    public $tempFoto;
    public $isEditing = false;

    protected $rules = [
        'nombre' => 'required|min:3',
        'direccion' => 'required',
        'telefono' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:8',
        'descripcion' => 'required|min:10',
        'foto' => 'nullable|image|max:1024',
    ];

    public function mount()
    {
        $this->resetForm();
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function create()
    {
        $this->resetForm();
        $this->isEditing = false;
        $this->showModal = true;
    }

    public function edit($id)
    {
        $this->isEditing = true;
        $this->vendorId = $id;
        $vendedor = Vendedore::findOrFail($id);

        $this->nombre = $vendedor->nombre;
        $this->direccion = $vendedor->direccion;
        $this->telefono = $vendedor->telefono;
        $this->descripcion = $vendedor->descripcion;
        $this->tempFoto = $vendedor->foto;

        $this->showModal = true;
    }

    public function save()
    {
        $this->validate();

        $data = [
            'nombre' => $this->nombre,
            'direccion' => $this->direccion,
            'telefono' => $this->telefono,
            'descripcion' => $this->descripcion,
            'id_user' => auth()->id(),
        ];

        if ($this->foto) {
            $fotoPath = $this->foto->store('vendors', 'public');
            $data['foto'] = 'storage/' . $fotoPath;

            if ($this->isEditing && $this->tempFoto) {
                Storage::disk('public')->delete(str_replace('storage/', '', $this->tempFoto));
            }
        }

        if ($this->isEditing) {
            $vendedor = Vendedore::find($this->vendorId);
            $vendedor->update($data);
        } else {
            Vendedore::create($data);
        }

        $this->showModal = false;
        $this->resetForm();
    }

    public function delete($id)
    {
        $vendedor = Vendedore::find($id);
        if ($vendedor->foto) {
            Storage::disk('public')->delete(str_replace('storage/', '', $vendedor->foto));
        }
        $vendedor->delete();
    }

    public function showVendorProducts($vendorId)
    {
        $this->selectedVendor = Vendedore::with(['productos' => function($query) {
            $query->orderBy('created_at', 'desc');
        }])->find($vendorId);
        $this->showProductsModal = true;
    }

    public function closeVendorModal()
    {
        $this->selectedVendor = null;
        $this->showProductsModal = false;
    }

    private function resetForm()
    {
        $this->vendorId = null;
        $this->nombre = '';
        $this->direccion = '';
        $this->telefono = '';
        $this->descripcion = '';
        $this->foto = null;
        $this->tempFoto = null;
        $this->resetErrorBag();
        $this->resetValidation();
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
