<!-- resources/views/livewire/pedidos.blade.php -->
<div class="max-w-7xl mx-auto sm:px-6 lg:px-8 py-12">
    <div class="bg-white shadow-md rounded-lg">
        <div class="px-6 py-4">
            <div class="flex justify-between items-center">
                <div>
                    <h6 class="text-lg font-semibold">Pedidos</h6>
                    <p class="text-sm text-gray-600">
                        <i class="fa fa-check text-blue-500" aria-hidden="true"></i>
                        <span class="font-bold ml-1">{{ $completados }} COMPLETADA</span>
                    </p>
                </div>
                <div>
                    <div class="relative">
                        <button class="focus:outline-none">
                            <i class="fa fa-ellipsis-v text-gray-600"></i>
                        </button>
                        <!-- Dropdown content here -->
                    </div>
                </div>
            </div>
        </div>
        <div class="px-6 py-4 overflow-x-auto">
            <table class="min-w-full bg-white">
                <thead>
                <tr>
                    <th class="text-left py-2 text-xs font-bold text-gray-600 uppercase">Productos</th>
                    <th class="text-center py-2 text-xs font-bold text-gray-600 uppercase">Total</th>
                    <th class="text-center py-2 text-xs font-bold text-gray-600 uppercase">Estado</th>
                </tr>
                </thead>
                <tbody class="text-gray-700">
                @foreach ($ordenes as $orden)
                    <tr>
                        <td class="px-6 py-4">
                            <div class="flex items-center space-x-4">
                                @php
                                    $detalles = $orden_detalles->where('id_orden', $orden->id);
                                @endphp
                                @foreach ($detalles as $detalle)
                                    <a href="{{ route('detalles', 'id=' . $detalle->producto->id) }}" class="flex-shrink-0 h-8 w-8 rounded-full" title="{{ $detalle->producto->nombre }}">
                                        <img class="h-full w-full object-cover" src="{{ $detalle->producto->foto }}" alt="{{ $detalle->producto->nombre }}">
                                    </a>
                                @endforeach
                            </div>
                        </td>
                        <td class="px-6 py-4 text-center">
                            <span class="text-sm font-bold">${{ $orden->total }}</span>
                        </td>
                        <td class="px-6 py-4 text-center">
                            <div class="flex flex-col items-center">
                                <span class="text-sm font-bold">{{ $orden->estado }}</span>
                                <div class="w-full bg-gray-200 rounded-full h-2.5 mt-2">
                                    @php
                                        $progress = 0;
                                        $color = 'bg-gray-500';
                                        switch ($orden->estado) {
                                            case 'PENDIENTE':
                                                $progress = 25;
                                                $color = 'bg-yellow-500';
                                                break;
                                            case 'PROCESANDO':
                                                $progress = 50;
                                                $color = 'bg-blue-500';
                                                break;
                                            case 'CANCELADA':
                                                $progress = 0;
                                                $color = 'bg-red-500';
                                                break;
                                            case 'COMPLETADA':
                                                $progress = 100;
                                                $color = 'bg-green-500';
                                                break;
                                        }
                                    @endphp
                                    <div class="{{ $color }} h-2.5 rounded-full" style="width: {{ $progress }}%"></div>
                                </div>
                            </div>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            <div class="mt-4">
                {{ $ordenes->links() }}
            </div>
        </div>
    </div>
</div>
