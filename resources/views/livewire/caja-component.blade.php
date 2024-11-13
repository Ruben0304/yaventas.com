<div>
    <main class="main">
        @if (session()->has('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <div class="page-header breadcrumb-wrap">
            <div class="container">
                <div class="breadcrumb">
                    <a href="{{ route('home') }}" rel="nofollow">Inicio</a>
                    <span></span> <a href="{{ route('shoping') }}">Comprar</a>
                    <span></span> Pagar
                </div>
            </div>
        </div>

        <section class="mt-50 mb-50">
            <div class="container">
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-25">
                            <h4>Dirección de envío 🚚</h4>
                        </div>

                        <form wire:submit.prevent="pagar">
                            <div class="form-group">
                                <input type="text" wire:model.defer="nombre" placeholder="Nombre y apellidos *" required>
                                @error('nombre') <span class="error text-danger">{{ $message }}</span> @enderror
                            </div>
                            <div class="form-group">
                                <input type="text" wire:model.defer="direccion" placeholder="Dirección *" required>
                                @error('direccion') <span class="error text-danger">{{ $message }}</span> @enderror
                            </div>
                            <div class="form-group">
                                <input type="text" wire:model.defer="pais" disabled>
                            </div>
                            <div class="form-group">
                                <input type="text" wire:model.defer="provincia" disabled>
                            </div>
                            <div class="form-group">
                                <div class="custom_select">
                                    <select class="form-control select-active" wire:model="municipio" required>
                                        <option value="">Municipio *</option>
                                        @foreach ($municipios as $mun)
                                            <option value="{{ $mun }}">{{ $mun }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                @error('municipio') <span class="error text-danger">{{ $message }}</span> @enderror
                            </div>
                            <div class="form-group">
                                <input type="text" wire:model.defer="telefono" placeholder="Teléfono (Se le confirmará a este teléfono antes del envío) *" required>
                                @error('telefono') <span class="error text-danger">{{ $message }}</span> @enderror
                            </div>
                            <div class="form-group">
                                <input type="text" wire:model="location" placeholder="Ubicación (coordenadas) *" required>
                                @error('location') <span class="error text-danger">{{ $message }}</span> @enderror
                            </div>
                            <div class="mb-20">
                                <h5>Escribe aquí lo que desees (opcional)</h5>
                            </div>
                            <div class="form-group mb-30">
                                <textarea rows="6" wire:model.defer="comentarios" style="border: 2px solid #FF6E11;color: #2b2a2a" placeholder="¿Tienes alguna duda, petición o alguna otra cosa que quieras decirnos? Escríbenos aquí lo que quieras. Te responderemos lo antes posible. Estamos atentos a tus comentarios. 💬"></textarea>
                            </div>
                            <div class="payment_method">
                                <div class="mb-25">
                                    <h5>Método de Pago</h5>
                                </div>
                                <div class="payment_option">
                                    <div class="custome-radio">
                                        <input class="form-check-input" type="radio" wire:model.defer="metodopago" id="exampleRadios3" value="efectivo">
                                        <label class="form-check-label" for="exampleRadios3">Efectivo</label>

                                        <input class="form-check-input" type="radio" wire:model.defer="metodopago" id="exampleRadios4" value="qvapay">
                                        <label class="form-check-label" for="exampleRadios4">Qvapay</label>
                                    </div>
                                </div>
                                @error('metodopago') <span class="error text-danger">{{ $message }}</span> @enderror
                            </div>
                            <button type="submit" class="btn btn-fill-out btn-block mt-30" style="background-color: #BCCA25">Proceder con la compra 💳</button>
                        </form>
                    </div>
                    <div class="col-md-6">
                        <div class="order_review">
                            <div class="mb-20">
                                <h4>Tu pedido</h4>
                            </div>
                            <div class="table-responsive order_table text-center">
                                <table class="table">
                                    <thead>
                                    <tr>
                                        <th colspan="2">Producto</th>
                                        <th>Total</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach ($carrito as $item)
                                        <tr>
                                            <td class="image product-thumbnail">
                                                <img src="{{ $item->producto->foto }}" alt="{{ $item->producto->nombre }}">
                                            </td>
                                            <td>
                                                <h5>{{ $item->producto->nombre }}</h5>
                                                <span class="product-qty">{{ $item->cantidad }}</span>
                                            </td>
                                            <td>{{ ($whatsapp ? $item->producto->preciocup : $item->producto->preciocup * 1.1) * $item->cantidad }}</td>
                                        </tr>
                                    @endforeach
                                    <tr>
                                        <th>SubTotal</th>
                                        <td class="product-subtotal" colspan="2">${{ $subtotal }}</td>
                                    </tr>
                                    <tr>
                                        <th>Envío</th>
                                        <td colspan="2">
                                            {{ $shippingCost > 0 ? '$' . $shippingCost . ' CUP' : 'Gratis' }}<br>
                                            ( 24h a 48h )
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Total</th>
                                        <td colspan="2" class="product-subtotal">
                                            <span class="font-xl text-brand fw-900">${{ $total }} CUP</span>
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
</div>
