<?php

namespace App\Http\Livewire\Auth;

use App\Http\Requests\Auth\LoginRequest;
use App\Models\User;
use Livewire\Component;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
class Login extends Component
{
    public $phone;
    public $password;
    public $country_code = '+53';
    public $remember = true;
    public $errorMessage = '';

    // Definir las reglas de validación como una propiedad
    protected $rules = [
        'country_code' => 'required|string|in:+53,+1,+52,+54,+55,+56,+57,+86,+33,+49,+91,+39,+81,+7,+34,+44,+61,+27,+90,+31,+46,+41',
        'phone' => 'required|string|max:15|regex:/^[0-9]+$/',
        'password' => 'required|string|min:8',
    ];

    protected $messages = [
        'phone.required' => 'El número de teléfono es requerido',
        'phone.regex' => 'El número de teléfono solo debe contener dígitos',
        'password.required' => 'La contraseña es requerida',
        'password.min' => 'La contraseña debe tener al menos 8 caracteres',
        'country_code.in' => 'El código de país seleccionado no es válido',
    ];

    public function updated($propertyName)
    {
        // Validar el campo cuando cambia
        $this->validateOnly($propertyName);
        // Limpiar mensaje de error si existe
        $this->errorMessage = '';
    }


    public function render()
    {
        $countries = [
            ['code' => '+53', 'name' => 'Cuba', 'flag' => '🇨🇺'],
            ['code' => '+1', 'name' => 'Estados Unidos', 'flag' => '🇺🇸'],
            ['code' => '+52', 'name' => 'México', 'flag' => '🇲🇽'],
            ['code' => '+54', 'name' => 'Argentina', 'flag' => '🇦🇷'],
            ['code' => '+55', 'name' => 'Brasil', 'flag' => '🇧🇷'],
            ['code' => '+56', 'name' => 'Chile', 'flag' => '🇨🇱'],
            ['code' => '+57', 'name' => 'Colombia', 'flag' => '🇨🇴'],
            ['code' => '+86', 'name' => 'China', 'flag' => '🇨🇳'],
            ['code' => '+33', 'name' => 'Francia', 'flag' => '🇫🇷'],
            ['code' => '+49', 'name' => 'Alemania', 'flag' => '🇩🇪'],
            ['code' => '+91', 'name' => 'India', 'flag' => '🇮🇳'],
            ['code' => '+39', 'name' => 'Italia', 'flag' => '🇮🇹'],
            ['code' => '+81', 'name' => 'Japón', 'flag' => '🇯🇵'],
            ['code' => '+7', 'name' => 'Rusia', 'flag' => '🇷🇺'],
            ['code' => '+34', 'name' => 'España', 'flag' => '🇪🇸'],
            ['code' => '+44', 'name' => 'Reino Unido', 'flag' => '🇬🇧'],
            ['code' => '+61', 'name' => 'Australia', 'flag' => '🇦🇺'],
            ['code' => '+27', 'name' => 'Sudáfrica', 'flag' => '🇿🇦'],
            ['code' => '+90', 'name' => 'Turquía', 'flag' => '🇹🇷'],
            ['code' => '+31', 'name' => 'Países Bajos', 'flag' => '🇳🇱'],
            ['code' => '+46', 'name' => 'Suecia', 'flag' => '🇸🇪'],
            ['code' => '+41', 'name' => 'Suiza', 'flag' => '🇨🇭'],
        ];

        return view('livewire.auth.login', [
            'countries' => $countries
        ]);
    }
}
