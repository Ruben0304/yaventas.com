<div>
    <main class="main">
        <div class="page-header breadcrumb-wrap">
            <div class="container">
                <div class="breadcrumb">
                    <a href="index.html" rel="nofollow">Home</a>
                    <span>Órdenes</span>
                </div>
            </div>
        </div>
        <section class="mt-50 mb-50">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header d-flex justify-content-between align-items-center">
                                <h3 class="card-title">Listado de Órdenes</h3>
                                <div class="input-group" style="width: 300px;">
                                    <input wire:model.debounce.300ms="search" type="text" class="form-control"
                                           placeholder="Buscar por nombre, teléfono o ID de transacción...">
                                </div>
                            </div>
                            <div class="card-body">
                                @if (session()->has('message'))
                                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                                        {{ session('message') }}
                                        <button type="button" class="btn-close" data-bs-dismiss="alert"
                                                aria-label="Close"></button>
                                    </div>
                                @endif

                                @if (session()->has('error'))
                                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                        {{ session('error') }}
                                        <button type="button" class="btn-close" data-bs-dismiss="alert"
                                                aria-label="Close"></button>
                                    </div>
                                @endif

                                <div class="table-responsive">
                                    <table class="table table-hover">
                                        <thead>
                                        <tr>
                                            <th>ID Transacción</th>
                                            <th>Cliente</th>
                                            <th>Teléfono</th>
                                            <th>Dirección</th>
                                            <th>Total</th>
                                            <th>Método de Pago</th>
                                            <th>Estado</th>
                                            <th>Detalles</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach ($orders as $order)
                                            <tr>
                                                <td class="align-middle">{{ $order->transaction_uuid }}</td>
                                                <td class="align-middle">{{ $order->nombre }}</td>
                                                <td class="align-middle">{{ $order->telefono }}</td>
                                                <td class="align-middle">
                                                    {{ $order->direccion }},
                                                    {{ $order->municipio }},
                                                    {{ $order->provincia }}
                                                </td>
                                                <td class="align-middle font-weight-bold">
                                                    ${{ number_format($order->total, 2) }}
                                                </td>
                                                <td class="align-middle">{{ $order->metodopago }}</td>
                                                <td class="align-middle" style="width: 200px">
                                                    <select
                                                        wire:change="updateOrderStatus({{ $order->id }}, $event.target.value)"
                                                        class="form-select form-select-sm"
                                                        style="border: 1px solid #ddd; border-radius: 4px; padding: 5px 10px;"
                                                    >
                                                        @foreach($statusTypes as $status)
                                                            <option value="{{ $status }}"
                                                                {{ $order->estado === $status ? 'selected' : '' }}>
                                                                {{ $status }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </td>
                                                <td class="align-middle">
                                                    <button type="button"
                                                            class="btn btn-sm btn-info"
                                                            data-bs-toggle="modal"
                                                            data-bs-target="#orderModal{{ $order->id }}">
                                                        Ver Detalles
                                                    </button>

                                                    <!-- Modal de Detalles -->
                                                    <div class="modal fade" id="orderModal{{ $order->id }}"
                                                         tabindex="-1" aria-hidden="true">
                                                        <div class="modal-dialog modal-lg">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title">Detalles de la Orden
                                                                        #{{ $order->id }}</h5>
                                                                    <button type="button" class="btn-close"
                                                                            data-bs-dismiss="modal"
                                                                            aria-label="Close"></button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <div class="row mb-3">
                                                                        <div class="col-md-6">
                                                                            <h6>Información del Cliente</h6>
                                                                            <p>Nombre: {{ $order->nombre }}</p>
                                                                            <p>Teléfono: {{ $order->telefono }}</p>
                                                                            <p>Dirección: {{ $order->direccion }}</p>
                                                                            <p>Municipio: {{ $order->municipio }}</p>
                                                                            <p>Provincia: {{ $order->provincia }}</p>
                                                                            <p>País: {{ $order->pais }}</p>
                                                                        </div>
                                                                        <div class="col-md-6">
                                                                            <h6>Información de la Orden</h6>
                                                                            <p>Subtotal:
                                                                                ${{ number_format($order->subtotal, 2) }}</p>
                                                                            <p>Envío:
                                                                                ${{ number_format($order->envio, 2) }}</p>
                                                                            <p>Bono aplicado:
                                                                                ${{ number_format($order->bono, 2) }}</p>
                                                                            <p>Total Final:
                                                                                ${{ number_format($order->total, 2) }}</p>
                                                                            <p>Método de
                                                                                pago: {{ $order->metodopago }}</p>
                                                                        </div>
                                                                    </div>
                                                                    @if($order->comentarios)
                                                                        <div class="row mb-3">
                                                                            <div class="col-12">
                                                                                <h6>Comentarios</h6>
                                                                                <p>{{ $order->comentarios }}</p>
                                                                            </div>
                                                                        </div>
                                                                    @endif
                                                                    @if($order->ordersDetails->count() > 0)
                                                                        <div class="row">
                                                                            <div class="col-12">
                                                                                <h6>Productos</h6>
                                                                                <table class="table table-sm">
                                                                                    <thead>
                                                                                    <tr>
                                                                                        <th>Imagen</th>
                                                                                        <th>Producto</th>
                                                                                        <th>Cantidad</th>
                                                                                        <th>Precio</th>
                                                                                        <th>Subtotal</th>
                                                                                    </tr>
                                                                                    </thead>
                                                                                    <tbody>
                                                                                    @foreach($order->ordersDetails as $detail)
                                                                                        <tr>
                                                                                            <td style="width: 80px;">
                                                                                                <img
                                                                                                    src="{{ asset($detail->producto->foto) }}"
                                                                                                    alt="{{ $detail->producto->nombre }}"
                                                                                                    class="img-thumbnail"
                                                                                                    style="width: 60px; height: 60px; object-fit: cover;">
                                                                                            </td>
                                                                                            <td>
                                                                                                <a href="{{ route('detalles', ['id' => $detail->producto->id]) }}"
                                                                                                   class="text-primary text-decoration-none">
                                                                                                    {{ $detail->producto->nombre }}
                                                                                                </a>
                                                                                            </td>
                                                                                            <td>{{ $detail->cantidad }}</td>
                                                                                            <td>
                                                                                                ${{ number_format($detail->precio, 2) }}</td>
                                                                                            <td>
                                                                                                ${{ number_format($detail->precio * $detail->cantidad, 2) }}</td>
                                                                                        </tr>
                                                                                    @endforeach
                                                                                    </tbody>
                                                                                </table>
                                                                            </div>
                                                                        </div>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>

                                <div class="mt-4">
                                    {{ $orders->links() }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
</div>
