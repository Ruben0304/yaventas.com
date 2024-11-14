<div class="w-full sm:w-1/2 md:w-1/3 lg:w-1/4 p-4">
    <div class="bg-white rounded-lg shadow-md overflow-hidden transition-all duration-300 hover:shadow-xl group">
        <div class="relative pb-[100%]">
            <a href="{{ route('detalles', 'id=' . $producto->id . '') }}"
               class="block absolute inset-0 overflow-hidden">
                <img class="w-full h-full object-cover transition-opacity duration-300 transform group-hover:scale-105"
                     src="{{ $producto->foto }}" alt="{{ $producto->nombre }}">
                <img
                    class="w-full h-full object-cover absolute inset-0 opacity-0 transition-opacity duration-300 group-hover:opacity-100 transform group-hover:scale-105"
                    src="{{ $producto->foto_2 }}" alt="{{ $producto->nombre }}">
            </a>
            <div class="absolute top-2 left-2 bg-red-500 text-white text-xs font-bold px-2 py-1 rounded">
                {{$producto->vendedor->nombre}}
            </div>
        </div>
        <div class="p-4">
            <a href="{{ route('shoping') }}"
               class="text-sm text-gray-500 hover:text-gray-700">{{ $producto->categoria->nombre }}</a>
            <h2 class="mt-2 text-lg font-semibold h-14 overflow-hidden">
                <a href="{{ route('detalles', 'id=' . $producto->id . '') }}"
                   class="text-gray-900 hover:text-gray-700 block overflow-hidden whitespace-nowrap text-overflow-ellipsis">{{ $producto->nombre }}</a>
            </h2>
            <div class="mt-2 flex items-center">
                <div class="flex items-center">
                    @for ($i = 1; $i <= 5; $i++)
                        <svg class="w-4 h-4 {{ $i <= $producto->valoracion ? 'text-yellow-400' : 'text-gray-300' }}"
                             fill="currentColor" viewBox="0 0 20 20">
                            <path
                                d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                        </svg>
                    @endfor
                </div>
                <span class="ml-2 text-sm text-gray-500">{{ $producto->valoracion }}/5</span>
            </div>
            <div class="mt-4 flex justify-between items-center">
                <div class="flex flex-col">
                    <span
                        class="text-lg font-bold text-gray-900">${{ $whatsapp ? $producto->preciocup : number_format($producto->preciocup + 0.1 * $producto->preciocup, 2) }}</span>
                    @if ($whatsapp != null)
                        <span
                            class="text-sm text-gray-500 line-through">${{ number_format($producto->preciocup + 0.1 * $producto->preciocup, 2) }}</span>
                    @endif
                </div>

                    <!-- Cambia la clase del botón de agregar al carrito -->
                    <button wire:click="agregarAlCarrito()" style="background-color: #FF6E11"
                            class="text-white w-10 h-10 rounded-full flex items-center justify-center transition-transform duration-300 transform hover:scale-110 hover:bg-blue-600">
                        <i class="fi-rs-shopping-bag-add"></i> <span class="sr-only">Agregar al carrito</span>
                    </button>
            </div>
        </div>
    </div>
</div>
