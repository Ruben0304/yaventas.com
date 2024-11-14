<?php

namespace App\Http\Livewire\Admin;

use App\Models\Carrito;
use App\Models\Producto;
use Livewire\Component;
use Livewire\WithPagination;

use App\Models\Categoria;
use App\Models\Vendedore;
use Livewire\WithFileUploads;

class AdminProductosComponent extends Component
{
    use WithPagination;
    use WithFileUploads;

    public $modo = 'lista'; // lista, crear, editar
    public $nombre, $preciocup, $color, $stock, $id_categoria, $id_vendedor, $descripcion;
    public $foto, $foto2, $foto3;
    public $producto_id;
    public $duraciono, $preciocupo, $preciousdo, $motivo;


    // Agregar esta propiedad
    public $producto;

    // Modificar el método editar
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
    protected $rules = [
        'nombre' => 'required',
        'preciocup' => 'required|numeric',
        'color' => 'required',
        'stock' => 'required|numeric',
        'id_categoria' => 'required',
        'id_vendedor' => 'required',
        'foto' => 'required|image|max:1024', // solo requerido en creación
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
        $this->foto = null;
        $this->foto2 = null;
        $this->foto3 = null;
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

        $producto = new Producto();
        $producto->nombre = $this->nombre;
        $producto->preciocup = $this->preciocup;
        $producto->color = $this->color;
        $producto->stock = $this->stock;
        $producto->id_categoria = $this->id_categoria;
        $producto->id_vendedor = $this->id_vendedor;
        $producto->descripcion = $this->descripcion;

        // Manejo de imágenes
        $producto->foto = $this->foto->store('productos', 'public');
        if ($this->foto2) {
            $producto->foto_2 = $this->foto2->store('productos', 'public');
        }
        if ($this->foto3) {
            $producto->foto_3 = $this->foto3->store('productos', 'public');
        }

        $producto->save();

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
            'foto' => 'nullable|image|max:1024',
            'descripcion' => 'required'
        ]);

        $producto = Producto::find($this->producto_id);
        $producto->nombre = $this->nombre;
        $producto->preciocup = $this->preciocup;
        $producto->color = $this->color;
        $producto->stock = $this->stock;
        $producto->id_categoria = $this->id_categoria;
        $producto->id_vendedor = $this->id_vendedor;
        $producto->descripcion = $this->descripcion;

        if ($this->foto) {
            $producto->foto = $this->foto->store('productos', 'public');
        }
        if ($this->foto2) {
            $producto->foto_2 = $this->foto2->store('productos', 'public');
        }
        if ($this->foto3) {
            $producto->foto_3 = $this->foto3->store('productos', 'public');
        }

        // Manejo de ofertas
        if ($this->duraciono) {
            $producto->duraciono = $this->duraciono;
            $producto->preciocupo = $this->preciocupo;
            $producto->preciousdo = $this->preciousdo;
            $producto->motivo = $this->motivo;
        }

        $producto->save();

        $this->modo = 'lista';
        $this->resetInputs();
        session()->flash('message', 'Producto actualizado correctamente.');
    }

    public function eliminar_producto($id)
    {
        $producto = Producto::find($id);
        if ($producto) {
            // Eliminar registros relacionados en el carrito
            Carrito::where('id_producto', $id)->delete();
            // Eliminar el producto
            $producto->delete();
            session()->flash('message', 'Producto eliminado correctamente.');
        }
    }
}

