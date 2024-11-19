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

{{--                                        <li class="nav-item">--}}
{{--                                            <a class="nav-link" id="address-tab" data-bs-toggle="tab" href="#address"--}}
{{--                                               role="tab" aria-controls="address" aria-selected="true"><i--}}
{{--                                                    class="fi-rs-marker mr-10"></i>Mi direccion</a>--}}
{{--                                        </li>--}}
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
                                                <div class="flex justify-end mt-4">
                                                    <button
                                                        wire:click="confirmDelete"
                                                        class="inline-flex items-center px-4 py-2 bg-red-600 hover:bg-red-700 text-white rounded-md"
                                                        type="button">
                                                        <i class="fas fa-trash-alt mr-2"></i>
                                                        Eliminar cuenta
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                        @if($showingDeleteModal)
                                            <div class="fixed inset-0 z-50 overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
                                                <div class="flex items-center justify-center min-h-screen px-4">
                                                    <!-- Overlay de fondo -->
                                                    <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true"></div>

                                                    <!-- Contenido del modal -->
                                                    <div class="relative bg-white rounded-lg overflow-hidden shadow-xl transform transition-all w-full max-w-lg">
                                                        <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                                                            <div class="sm:flex sm:items-start">
                                                                <!-- Ícono de advertencia -->
                                                                <div class="mx-auto flex-shrink-0 flex items-center justify-center h-12 w-12 rounded-full bg-red-100 sm:mx-0 sm:h-10 sm:w-10">
                                                                    <svg class="h-6 w-6 text-red-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                                                                    </svg>
                                                                </div>

                                                                <!-- Texto del modal -->
                                                                <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                                                                    <h3 class="text-lg leading-6 font-medium text-gray-900" id="modal-title">
                                                                        Confirmar eliminación
                                                                    </h3>
                                                                    <div class="mt-2">
                                                                        <p class="text-sm text-gray-500">
                                                                            ¿Estás seguro que deseas eliminar tu cuenta? Esta acción no se puede deshacer y se eliminarán todos tus datos.
                                                                        </p>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <!-- Botones del modal -->
                                                        <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse gap-3">
                                                            <button
                                                                wire:click="deleteAccount"
                                                                type="button"
                                                                class="w-full sm:w-32 justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-red-600 text-base font-medium text-white hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 sm:text-sm">
                                                                Confirmar
                                                            </button>
                                                            <button
                                                                wire:click="cancelDelete"
                                                                type="button"
                                                                class="w-full sm:w-32 justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500 sm:text-sm">
                                                                Cancelar
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endif
                                    </div>
                                    <div class="tab-pane fade" id="orders" role="tabpanel"
                                         aria-labelledby="orders-tab">
                                        <div class="card">
                                            <div class="card-header">
                                                <h5 class="mb-0">Tus pedidos</h5>
                                            </div>
                                            <div class="card-body">

                                                   <livewire:admin.admin-pedidos/>

                                            </div>
                                        </div>
                                    </div>

{{--                                    <div class="tab-pane fade" id="address" role="tabpanel"--}}
{{--                                         aria-labelledby="address-tab">--}}
{{--                                        <div class="row">--}}
{{--                                            <div class="col-lg-6">--}}
{{--                                                <div class="card mb-3 mb-lg-0">--}}
{{--                                                    <div class="card-header">--}}
{{--                                                        <h5 class="mb-0">Dirección</h5>--}}
{{--                                                    </div>--}}
{{--                                                    <div class="card-body">--}}
{{--                                                        <address>--}}
{{--                                                            {{ $ordenes->direccion ?? 'Ninguna todavia' }}--}}
{{--                                                            <br>{{ $ordenes->municipio ?? '' }}--}}
{{--                                                        </address>--}}
{{--                                                        <p>{{ $ordenes->provincia ?? '' }}</p>--}}
{{--                                                        --}}{{-- <a href="#" class="btn-small">Edit</a> --}}
{{--                                                    </div>--}}
{{--                                                </div>--}}
{{--                                            </div>--}}

{{--                                        </div>--}}
{{--                                    </div>--}}
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
