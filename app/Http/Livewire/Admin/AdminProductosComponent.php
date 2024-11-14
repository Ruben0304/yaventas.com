<?php

namespace App\Http\Livewire\Admin;

use App\Models\Carrito;
use App\Models\Producto;
use App\Models\Oferta;
use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Categoria;
use App\Models\Vendedore;
use Livewire\WithFileUploads;
use Illuminate\Support\Str;

class AdminProductosComponent extends Component
{
    use WithPagination;
    use WithFileUploads;

    public $modo = 'lista';
    public $nombre, $preciocup, $color, $stock, $id_categoria, $id_vendedor, $descripcion;
    public $foto, $foto2, $foto3;
    public $producto_id;
    public $duraciono, $preciocupo, $preciousdo, $motivo;
    public $producto;

    protected $rules = [
        'nombre' => 'required',
        'preciocup' => 'required|numeric',
        'color' => 'required',
        'stock' => 'required|numeric',
        'id_categoria' => 'required',
        'id_vendedor' => 'required',
        'foto' => 'required|max:1024',
    ];

    public function mount()
    {
        $this->resetInputs();
    }

    public function resetInputs()
    {
        $this->nombre = '';
        $this->preciocup = '';
        $this->color = '';
        $this->stock = 0;
        $this->id_categoria = '';
        $this->id_vendedor = '';
        $this->descripcion = '';
        $this->foto = '';
        $this->foto2 = '';
        $this->foto3 = '';
        $this->duraciono = null;
        $this->preciocupo = null;
        $this->preciousdo = null;
        $this->motivo = '';
    }

    public function render()
    {
        $productos = Producto::orderBy('created_at', 'desc')->paginate(10);
        $categorias = Categoria::all();
        $vendedores = Vendedore::all();

        return view('livewire.admin.admin-productos-component', [
            'productos' => $productos,
            'categorias' => $categorias,
            'vendedores' => $vendedores,
        ]);
    }

    public function cambiarModo($modo)
    {
        $this->modo = $modo;
        if ($modo === 'lista') {
            $this->resetInputs();
        }
    }

    public function crear()
    {
        $this->validate();


            Producto::create([
                'nombre' => $this->nombre,
                'preciocup' => $this->preciocup,
                'color' => $this->color,
                'stock' => $this->stock,
                'id_vendedor' => $this->id_vendedor,
                'id_categoria' => $this->id_categoria,
                'foto' => $this->foto,
                'foto_2' => $this->foto2,
                'foto_3' => $this->foto3,
                'descripcion' => $this->descripcion,
            ]);

            $this->modo = 'lista';
            $this->resetInputs();
            session()->flash('message', 'Producto creado correctamente.');
    }

    public function actualizar()
    {
        $this->validate([
            'nombre' => 'required',
            'preciocup' => 'required|numeric',
            'color' => 'required',
            'stock' => 'required|numeric',
            'id_categoria' => 'required',
            'id_vendedor' => 'required',
            'foto' => 'required|max:1024',
            'descripcion' => 'required'
        ]);

        $producto = Producto::find($this->producto_id);


            $producto->foto = $this->foto2;

        if ($this->foto2) {
            $producto->foto_2 = $this->foto2;
        }
        if ($this->foto3) {
            $producto->foto_3 = $this->foto2;
        }

        $producto->nombre = $this->nombre;
        $producto->preciocup = $this->preciocup;
        $producto->id_vendedor = $this->id_vendedor;
        $producto->id_categoria = $this->id_categoria;
        $producto->stock = $this->stock;
        $producto->descripcion = $this->descripcion;
        $producto->color = $this->color;
        $producto->save();

        if ($this->duraciono && ($this->preciocupo || $this->preciousdo)) {
            Oferta::create([
                'id_producto' => $this->producto_id,
                'preciocup' => $this->preciocupo,
                'fecha_final' => $this->duraciono,
                'motivo' => $this->motivo,
                'fecha_inicial' => date('Y-m-d'),
            ]);
        }

        $this->modo = 'lista';
        $this->resetInputs();
        session()->flash('message', 'Producto actualizado correctamente.');
    }

    public function eliminar_producto($id)
    {
        $producto = Producto::find($id);
        $error = null;

        if ($producto->id_vendedor != auth()->id() && $producto->id_vendedor != 1) {
            $error = "No pertenece a vendedor";
        } else {
            Carrito::where('id_producto', $id)->delete();
            $producto->delete();
        }

        if ($error) {
            session()->flash('error', $error);
        } else {
            session()->flash('message', 'Producto eliminado correctamente.');
        }
    }


    public function editar($id)
    {
        $this->producto = Producto::findOrFail($id);
        $this->producto_id = $this->producto->id;
        $this->nombre = $this->producto->nombre;
        $this->preciocup = $this->producto->preciocup;
        $this->color = $this->producto->color;
        $this->stock = $this->producto->stock;
        $this->id_categoria = $this->producto->id_categoria;
        $this->id_vendedor = $this->producto->id_vendedor;
        $this->descripcion = $this->producto->descripcion;

        $this->modo = 'editar';
    }
}
