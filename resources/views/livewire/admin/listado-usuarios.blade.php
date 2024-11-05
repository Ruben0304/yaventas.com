<div>
    <main class="main">
        <div class="page-header breadcrumb-wrap">
            <div class="container">
                <div class="breadcrumb">
                    <a href="index.html" rel="nofollow">Home</a>
                    <span>Usuarios</span>
                </div>
            </div>
        </div>
        <section class="mt-50 mb-50">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header d-flex justify-content-between align-items-center">
                                <h3 class="card-title">Listado de Usuarios</h3>
                                <div class="input-group" style="width: 300px;">
                                    <input wire:model.debounce.300ms="search" type="text" class="form-control" placeholder="Buscar por nombre o teléfono...">
                                </div>
                            </div>
                            <div class="card-body">
                                @if (session()->has('message'))
                                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                                        {{ session('message') }}
                                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                    </div>
                                @endif

                                @if (session()->has('error'))
                                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                        {{ session('error') }}
                                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                    </div>
                                @endif

                                <div class="table-responsive">
                                    <table class="table table-hover">
                                        <thead>
                                        <tr>
                                            <th>Nombre</th>
                                            <th>Teléfono</th>
                                            <th>Tipo de Usuario</th>
                                            <th style="width: 50px;" class="text-center"><!-- Columna para ícono --></th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach ($users as $user)
                                            <tr>
                                                <td class="align-middle">{{ $user->name }}</td>
                                                <td class="align-middle">{{ $user->email }}</td>
                                                <td class="align-middle" style="width: 200px">
                                                    <select
                                                        wire:change="updateUserRole({{ $user->id }}, $event.target.value)"
                                                        class="form-select form-select-sm"
                                                        style="border: 1px solid #ddd; border-radius: 4px; padding: 5px 10px;"
                                                    >
                                                        @foreach($roleTypes as $role)
                                                            <option value="{{ $role }}"
                                                                {{ $user->utype === $role ? 'selected' : '' }}>
                                                                {{ $role }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </td>
                                                <td class="align-middle text-center" style="width: 50px;">
                                                    <a href="javascript:void(0)"
                                                       class="{{ $user->id === auth()->id() ? 'disabled' : '' }}"
                                                       wire:click="{{ $user->id === auth()->id() ? '' : 'confirmDelete('.$user->id.')' }}"
                                                       style="{{ $user->id === auth()->id() ? 'opacity: 0.5; pointer-events: none;' : '' }}"
                                                       title="Eliminar usuario">
                                                        <i class="fa-solid fa-trash text-danger"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>

                                    <!-- Modal de confirmación -->
                                    @if($userIdToDelete)
                                        <div class="modal fade show" style="display: block; background-color: rgba(0,0,0,0.5)">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">Confirmar eliminación</h5>
                                                        <button type="button" class="btn-close" wire:click="$set('userIdToDelete', null)"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        ¿Estás seguro de que deseas eliminar este usuario?
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" wire:click="$set('userIdToDelete', null)">Cancelar</button>
                                                        <button type="button" class="btn btn-danger" wire:click="deleteUser">Eliminar</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                </div>

                                <div class="mt-4">
                                    {{ $users->links() }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
</div>
