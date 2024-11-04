<div>
    <main class="main">
        <div class="page-header breadcrumb-wrap">
            <div class="container">
                <div class="breadcrumb">
                    <a href="route{{ 'home' }}" rel="nofollow">Inicio</a>
                    <span></span> Mi cuenta
                </div>
            </div>
        </div>
        <section class="pt-150 pb-150">
            <div class="container">
                <div class="row">
                    <div class="col-lg-10 m-auto">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="dashboard-menu">
                                    <ul class="nav flex-column" role="tablist">
                                        <li class="nav-item">
                                            <a class="nav-link active" id="dashboard-tab" data-bs-toggle="tab"
                                               href="#dashboard" role="tab" aria-controls="dashboard"
                                               aria-selected="false"><i class="fi-rs-settings-sliders mr-10"></i>Panel
                                                de Cuenta</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" id="orders-tab" data-bs-toggle="tab" href="#orders"
                                               role="tab" aria-controls="orders" aria-selected="false"><i
                                                    class="fi-rs-shopping-bag mr-10"></i>Ordenes</a>
                                        </li>

                                        <li class="nav-item">
                                            <a class="nav-link" id="address-tab" data-bs-toggle="tab" href="#address"
                                               role="tab" aria-controls="address" aria-selected="true"><i
                                                    class="fi-rs-marker mr-10"></i>Mi direccion</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" id="account-detail-tab" data-bs-toggle="tab"
                                               href="#account-detail" role="tab" aria-controls="account-detail"
                                               aria-selected="true"><i class="fi-rs-user mr-10"></i>Telefono Whatsapp
                                            </a>
                                        </li>
                                        <form action="{{ route('logout') }}" method="post">
                                            @csrf
                                            <li class="nav-item">
                                                <a class="nav-link"
                                                   onclick="event.preventDefault(); this.closest('form').submit()"><i
                                                        class="fi-rs-sign-out mr-10"></i>Salir</a>
                                            </li>
                                            </li>
                                        </form>

                                    </ul>
                                </div>
                            </div>
                            <div class="col-md-8">
                                <div class="tab-content dashboard-content">
                                    <div class="tab-pane fade active show" id="dashboard" role="tabpanel"
                                         aria-labelledby="dashboard-tab">
                                        <div class="card">
                                            <div class="card-header">
                                                <h5 class="mb-0">Hola {{ Auth::user()->name }} </h5>
                                            </div>
                                            <div class="card-body">
                                                <p>Desde aqui puedes fácilmente chequear &amp; ver tus <a
                                                        href="#">pedidos recientes</a>, administrar tu<a
                                                        href="#">dirección de entrega</a> y <a
                                                        href="#">editar los detalles de tu cuenta.</a></p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="orders" role="tabpanel"
                                         aria-labelledby="orders-tab">
                                        <div class="card">
                                            <div class="card-header">
                                                <h5 class="mb-0">Tus pedidos</h5>
                                            </div>
                                            <div class="card-body">
                                                <section class="pedidos" style="height: 400px; ">
                                                    <iframe src="http://127.0.0.1:8000/tabla" frameborder="0"
                                                            width="100%" height="100%"></iframe>
                                                </section>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="tab-pane fade" id="address" role="tabpanel"
                                         aria-labelledby="address-tab">
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <div class="card mb-3 mb-lg-0">
                                                    <div class="card-header">
                                                        <h5 class="mb-0">Dirección</h5>
                                                    </div>
                                                    <div class="card-body">
                                                        <address>
                                                            {{ $ordenes->direccion ?? 'Ninguna todavia' }}
                                                            <br>{{ $ordenes->municipio ?? '' }}
                                                        </address>
                                                        <p>{{ $ordenes->provincia ?? '' }}</p>
                                                        {{-- <a href="#" class="btn-small">Edit</a> --}}
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="account-detail" role="tabpanel"
                                         aria-labelledby="account-detail-tab">
                                        <div class="card">
                                            <div class="card-header">
                                                <h5>Telefono en el grupo de whatsapp</h5>
                                            </div>
                                            <div class="card-body">
                                                <p>Recibe 10% de descuento en todas las compras si estas en nuestro <a
                                                        href="https://chat.whatsapp.com/BhrgFNATbSyBzShazsRVNL"
                                                        style="color: rgb(9, 155, 41)">grupo de whastapp</a></p>

                                                <div class="row">
                                                    <div class="form-group col-md-6">


                                                        @if ($whatsapp)
                                                            <label>Tu numero <span class="required">*</span></label>
                                                            <input required="" class="form-control square"
                                                                   type="text" value="{{ $whatsapp->telefono }}"
                                                                   disabled>
                                                            {{-- <p class="wow fadeIn animated">
                                                            <!-- Este botón cambia el valor del atributo de estilo directamente dentro del onclick -->
                                                            <a class="btn btn-brand text-white btn-shadow-brand hover-up btn-lg" >Modificar
                                                            </a>
                                                        </p> --}}
                                                        @else
                                                            <label>No has agregado numero todavia <span
                                                                    class="required">*</span></label>
                                                            <p class="wow fadeIn animated">
                                                                <!-- Este botón cambia el valor del atributo de estilo directamente dentro del onclick -->
                                                                <a class="btn btn-brand text-white btn-shadow-brand hover-up btn-lg"
                                                                   href="{{ route('whatsapp') }}">Agregar
                                                                </a>
                                                            </p>
                                                        @endif
                                                    </div>

                                                </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>

</div>
