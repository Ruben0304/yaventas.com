<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Whatsapp;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WhatsappController extends Controller
{
    public function mostrar(){
        return view('auth.whatsapp');
    }

    // Método para guardar el número de whatsapp y el id del usuario
    public function store(Request $request)
    {
        // Validar los datos del formulario
        $request->validate([
            'country_code' => 'required|string',
            'whatsapp_number' => 'required|numeric',
        ], [
            // Mensajes personalizados en español
            'country_code.required' => 'El código de país es obligatorio.',
            'country_code.string' => 'El código de país debe ser una cadena de texto.',
            'whatsapp_number.required' => 'El número de whatsapp es obligatorio.',
            'whatsapp_number.numeric' => 'El número de whatsapp debe ser un número.',
        ]);
        
        $full_number = $request->country_code.$request->whatsapp_number;
        
        $request->validate([
            'full_number' => 'regex:/^\+?[0-9]{10,15}$/|unique:whatsapp,telefono',
        ], [
            // Mensajes personalizados en español
            'full_number.regex' => 'El número completo debe tener el formato +xxxxxxxxxx.',
            'full_number.unique' => 'El número completo ya está registrado, puede continuar con la compra.',
        ]);
        
       // Verificar si full number ya existe
if (Whatsapp::where('telefono', $full_number)->exists()) {
    // Redirigir a inicio
    return redirect('/')->with('success', 'El número de whatsapp ya está registrado, puede continuar con la compra. En caso de no aparecer el descuento proceda con la compra y se realizara el descuento al final. ');
  } else {
    // Crear una nueva instancia de Whatsapp
    $whatsapp = new Whatsapp();
    
    // Asignar los valores a las columnas
    $whatsapp->telefono = $full_number;
    $whatsapp->id_user = Auth::user()->id;
    
    // Guardar el registro en la base de datos
    $whatsapp->save();
  }
        
        // Redirigir a la ruta deseada con un mensaje de éxito
        return redirect('https://chat.whatsapp.com/BhrgFNATbSyBzShazsRVNL');
 }

}