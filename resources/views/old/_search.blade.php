
    

<div class="hero__search__form">
    <form action="{{route('buscar')}}" method="GET">
        @csrf
        <div class="hero__search__categories">
           Todas las Categorias
            
        </div>
        <input type="text" placeholder="Que necesitas ?" name="buscar">
        <button type="submit" class="site-btn">Buscar</button>
    </form>
</div>


