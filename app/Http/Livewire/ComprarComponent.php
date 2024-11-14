<?php

namespace App\Http\Livewire;

use App\Models\Categoria;
use App\Models\Oferta;
use App\Models\Producto;
use Livewire\Component;
use Livewire\WithPagination;

class ComprarComponent extends Component
{
    use WithPagination;

    protected $paginationTheme = 'tailwind';
    public $minimo = 1;
    public $maximo = 1000000;
    public $orderBy = "Default";

    public function filtrar_precio($min, $max, $moneda)
    {

        $productos = Producto::where('precio' . $moneda . '', '>=', $min)->where('precio' . $moneda . '', '<=', $max);

    }

    public function cambiar_orden($order)
    {
        $this->orderBy = $order;
    }

    public function render()
    {

        if ($this->orderBy == 'Precio: Menor a Mayor') {
            $productos = Producto::whereBetween('preciocup', [$this->minimo, $this->maximo])->orderBy('preciocup', 'ASC')->paginate(12);

        } else if ($this->orderBy == 'Precio: Mayor a Menor') {
            $productos = Producto::whereBetween('preciocup', [$this->minimo, $this->maximo])->orderBy('preciocup', 'DESC')->paginate(12);

        } else if ($this->orderBy == 'Ultimos productos') {
            $productos = Producto::whereBetween('preciocup', [$this->minimo, $this->maximo])->orderBy('created_at', 'DESC')->paginate(12);

        } else {
            $productos = Producto::whereBetween('preciocup', [$this->minimo, $this->maximo])->paginate(12);

        }
        $categorias = Categoria::all();


        // $productosnuevos=Producto::orderBy('created_at', 'DESC')->paginate(3);
        // $productos=Producto::paginate(12);
        $oferta = Oferta::where('fecha_final', '>=', date('Y-m-d'))->get();


        return view('livewire.comprar-component', [

                'productos' => $productos,
                'categorias' => $categorias,
                'oferta' => $oferta
            ]
        );


    }


}
