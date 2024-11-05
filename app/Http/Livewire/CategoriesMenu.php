<?php

namespace App\Http\Livewire;


use App\Models\Categoria;
use Livewire\Component;

class CategoriesMenu extends Component
{
    public $categorias;
    public $showMore = false;
    public $limitCategories = 10; // Número de categorías a mostrar inicialmente

    public function mount()
    {
        $this->loadCategories();
    }

    public function loadCategories()
    {
        $this->categorias = Categoria::all();
    }

    public function selectCategory($categoryId)
    {
        return redirect()->route('categoria', ['buscar' => $categoryId]);
    }

    public function toggleShowMore()
    {
        $this->showMore = !$this->showMore;
    }

    public function getVisibleCategoriesProperty()
    {
        return $this->showMore
            ? $this->categorias
            : $this->categorias->take($this->limitCategories);
    }

    public function render()
    {
        return view('livewire.categories-menu');
    }
}
