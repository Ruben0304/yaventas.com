<?php

namespace App\Http\Livewire;

use App\Models\Categoria;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class MobileNavigation extends Component
{
    public $searchQuery = '';
    public $categories = null;
    public $isMenuOpen = false;
    public $isCategoryDropdownOpen = false;

    protected $listeners = ['refreshCategories' => '$refresh'];

    public function mount()
    {
        $this->categories = Categoria::orderBy('nombre')->get();
    }

    public function search()
    {
        $this->validate([
            'searchQuery' => 'required|min:2'
        ]);

        return redirect()->route('buscar', ['buscar' => $this->searchQuery]);
    }

    public function filterByCategory($categoryId)
    {
        return redirect()->route('categoria', ['buscar' => $categoryId]);
    }

    public function toggleMenu()
    {
        $this->isMenuOpen = !$this->isMenuOpen;
    }

    public function toggleCategoryDropdown()
    {
        $this->isCategoryDropdownOpen = !$this->isCategoryDropdownOpen;
    }

    public function render()
    {
        return view('livewire.mobile-navigation', [
            'user' => Auth::user(),
            'isAdmin' => Auth::check() && Auth::user()->utype === 'ADMIN',
        ]);
    }
}
