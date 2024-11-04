<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PagosController;
use App\Http\Controllers\TwilioController;
use App\Http\Livewire\Admin\AdminCategoriasComponent;
use App\Http\Livewire\Admin\AdminProductosComponent;
use App\Http\Livewire\Admin\CrearProductoComponent;
use App\Http\Livewire\Admin\EditarCategoriaComponent;
use App\Http\Livewire\Admin\EditarProductosComponent;
use App\Http\Livewire\Admin\ListadoOrdenes;
use App\Http\Livewire\Admin\ListadoUsuarios;
use App\Http\Livewire\Admin\ListadoVendedores;
use App\Http\Livewire\CajaComponent;
use App\Http\Livewire\CarritoComponent;
use App\Http\Livewire\CategoriasComponent;
use App\Http\Livewire\ComprarComponent;
use App\Http\Livewire\DashboardComponent;
use App\Http\Livewire\DetallesComponent;
use App\Http\Livewire\HomeComponent;
use App\Http\Livewire\InfoComponent;
use App\Http\Livewire\MapaComponent;
use App\Http\Livewire\PedidosComponent;
use App\Http\Livewire\PoliticaComponent;
use App\Http\Livewire\SearchComponent;
use App\Http\Livewire\TerminosComponent;
use App\Models\Carrito;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Laravel\Socialite\Facades\Socialite;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('inicio', HomeComponent::class)->name('home');
Route::get('comprar', ComprarComponent::class)->name('shoping');
Route::get('buscar', SearchComponent::class)->name('buscar');
Route::get('categoria', CategoriasComponent::class)->name('categoria');
Route::get('carrito', CarritoComponent::class)->middleware(['auth', 'verified'])->name('carrito');
Route::get('pedidos', PedidosComponent::class)->middleware(['auth', 'verified'])->name('pedidos');
Route::get('detalles', DetallesComponent::class)->name('detalles');
Route::get('politica_privacidad', PoliticaComponent::class)->name('politica');
Route::get('terminos_condiciones', TerminosComponent::class)->name('terminos');
Route::get('info', InfoComponent::class)->name('info');
Route::get('checkout', CajaComponent::class)->middleware(['auth', 'verified'])->name('caja');
Route::get('dashboard', DashboardComponent::class)->middleware(['auth', 'verified'])->name('dashboard');
Route::post('send', [TwilioController::class, 'send'])->name('twilio_send');
Route::post('check', [TwilioController::class, 'check'])->name('twilio_check');
Route::post('calculate-distance', [MapaComponent::class, 'calcular'])->name('calculate-distance');
Route::get('mapa', MapaComponent::class)->name('mapa');

//Admin routes
Route::middleware(['auth', 'authadmin', 'verified'])->group(function () {
    Route::get('/admin/productos', AdminProductosComponent::class)->name('admin.productos');
    Route::get('/admin/categorias', AdminCategoriasComponent::class)->name('admin.categorias');
    Route::get('/admin/editar_categorias', EditarCategoriaComponent::class)->name('admin.editar.categoria');
    Route::get('/admin/editar_productos', EditarProductosComponent::class)->name('admin.editar.productos');
    Route::get('/admin/crear_productos', CrearProductoComponent::class)->name('admin.crear.productos');
    Route::get('/admin/lista-usuarios', ListadoUsuarios::class)->name('admin.listado.usuarios');
    Route::get('/admin/lista-ordenes', ListadoOrdenes::class)->name('admin.listado.ordenes');
    Route::get('/admin/lista-vendedores', ListadoVendedores::class)->name('admin.listado.vendedores');

    Route::controller(AdminController::class)->group(function () {
        Route::get('/admin', 'dashboard')->name('admin');
        Route::get('/agregar_producto', 'agregar_producto')->name('agregar_producto');
        Route::get('/actualizar_producto', 'actualizar_producto')->name('actualizar_producto');
        Route::get('/eliminar_producto', 'eliminar_producto')->name('eliminar_producto');
        Route::delete('/eliminando_producto', 'eliminando_producto')->name('eliminando_producto');
        Route::post('/creando', 'crear_producto')->name('crear_producto');
        Route::put('/actualizando_producto', 'actualizando_producto')->name('actualizando_producto');
        Route::post('/actualizar_producto', 'buscar_producto_id')->name('buscar_producto_id');
        Route::put('/admin/actualizar_categoria', 'actualizar_categoria')->name('actualizar_categoria');

    });
});
//home routes
Route::controller(HomeController::class)->group(function () {


    Route::get('/CUP', 'cup')->name('cup');
    Route::get('/USD', 'usd')->name('usd');
    Route::get('/reservar', 'reservar')->name('reservar');

    Route::get('contacto', 'contacto')->name('contacto');


    Route::post('addcart', 'agregar_carrito')->middleware(['auth', 'verified'])->name('agregar_carrito');
    Route::post('removecart', 'quitar_carrito')->middleware(['auth', 'verified'])->name('quitar_carrito');
    Route::post('sumar_carrito', 'sumar_carrito')->middleware(['auth', 'verified'])->name('sumar_carrito');
    Route::post('limpiar_carrito', 'limpiar_carrito')->middleware(['auth', 'verified'])->name('limpiar_carrito');
    Route::post('restar_carrito', 'restar_carrito')->middleware(['auth', 'verified'])->name('restar_carrito');

    Route::post('paying', 'ir_a_pagar')->middleware(['auth', 'verified'])->name('ir_a_pagar');


    Route::put('/cambiar_color', 'cambiar_color')->name('cambiar_color');
    Route::get('/tabla', 'tabla')->name('tabla');
    Route::get('/tabla_productos', 'tabla_productos')->name('tabla_productos');
    Route::get('/ordenes', 'ordenes')->name('ordenes');
});

//admin routes

Route::controller(PagosController::class)->group(function () {
    Route::post('/pagar', 'pagar')->middleware(['auth', 'verified'])->name('pagar');
    Route::post('/gpt', 'openai')->name('gpt');
    Route::get('/telegram', 'telegram')->name('telegram');
    Route::post('/pay', 'pagar_con_qvapay')->middleware(['auth', 'verified'])->name('pagar_con_qvapay');
    Route::get('qvapay_callback_ok', 'confirmar_qvapay')->middleware(['auth', 'verified'])->name('confirmar_qvapay');

});


Route::get('/add', function (Request $request) {
    return view('webservices.verificar_usuario', [
        'usuario' => $request->uid,
        'producto' => $request->pid,
        'cantidad' => $request->cant,
        'home' => HomeController::class
    ]);
})->name('redireccioniniciossdds');


//Redireccion a inicio
Route::get('/', function () {
    return redirect('/inicio');
})->name('redireccioninicio');

// Route::get('/dashboard', function () {
//     return redirect('/inicio');
// })->middleware(['auth', 'verified'])->name('dashboard');
require __DIR__ . '/auth.php';


Route::get('/vender', function () {
    return view('auth.crear_vendedor', [
        'carrito' => Carrito::all(),
    ]);
})->middleware(['auth', 'verified'])->name('crear_vendedor');

Route::post('/registrar_vendedor', function () {
    return view('auth.crear_vendedor', [
        'carrito' => Carrito::all(),
    ]);
})->middleware(['auth', 'verified'])->name('registrar_vendedor');
// Route::post('register', [RegisteredUserController::class, 'store']);


//Iniciar con google
Route::get('login-google', function () {
    return Socialite::driver('google')->redirect();
})->name('glogin');


Route::get('google-callback-url', function () {
    $user = Socialite::driver('google')->user();

    $existingUser = User::where('email', $user->getEmail())->first();

    if ($existingUser) {

        Auth::login($existingUser);
    } else {

        $newUser = new User;
        $newUser->name = $user->getName();
        $newUser->email = $user->getEmail();
        $newUser->verificado = 1;
        $newUser->save();

        // Iniciar sesión con la nueva cuenta
        Auth::login($newUser);
    }
    return redirect(route('home'));


})->name('gcallback');
//Fin GOOGLE


// Route::get('/login_facebook', function () {
//     return Socialite::driver('facebook')->redirect();
// });
// Route::get('/facebook_callback', function () {
//     $user = Socialite::driver('facebook')->user();
//     dd($user);
// });



