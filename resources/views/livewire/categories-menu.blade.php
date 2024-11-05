<div class="main-categori-wrap d-none d-lg-block">
    <a class="categori-button-active" href="#">
        <span class="fi-rs-apps"></span> Categorias
    </a>
    <div class="categori-dropdown-wrap categori-dropdown-active-large">
        <ul>
            @foreach ($this->visibleCategories as $categoria)
                <li>
                    <a href="#"
                       wire:click.prevent="selectCategory({{ $categoria->id }})"
                       class="category-item">
                        <i class="surfsidemedia-font-desktop"></i>
                        {{ $categoria->nombre }}
                    </a>
                </li>
            @endforeach
        </ul>
        @if ($categorias->count() > $limitCategories)
            <div class="more_categories" wire:click="toggleShowMore">
                {{ $showMore ? 'Mostrar menos...' : 'Mostrar mas...' }}
            </div>
        @endif
    </div>
</div>
