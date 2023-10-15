<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Carrito;
use App\Models\Ordene;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

class CajaComponent extends Component
{


    public function calculateDistance($location)
    {
        // El token de acceso de Mapbox debe estar almacenado en una variable de entorno
        $mapboxToken = "sk.eyJ1IjoicnViZW4wMzA0IiwiYSI6ImNsa2xwcTJpbzA2YWQzam54NjhsZ3RjYjMifQ.-R7U7-DuoK2_R77bQJKS3A";

        $fixedLocation = '-82.46179838936656,23.090916961379236'; // Havana, Cuba

        $response = Http::get("https://api.mapbox.com/directions/v5/mapbox/driving/{$fixedLocation};{$location}?access_token={$mapboxToken}");

        $responseBody = json_decode($response->body(), true);

        if ($response->failed() || empty($responseBody['routes'])) {
            throw new \Exception('Fallo al calcular distancia');
        }

        $distanceInMeters = $responseBody['routes'][0]['distance'];
        $distanceInKilometers = $distanceInMeters / 1000;

        return $distanceInKilometers;
    }

    public function render(Request $request)
    {
        
        // dd($request->location);
        $municipios = [
            'Arroyo Naranjo',
            'Boyeros',
            'Centro Habana',
            'Cerro',
            'Cotorro',
            'Diez de Octubre',
            'Guanabacoa',
            'Habana del Este',
            'Habana Vieja',
            'La Lisa',
            'Marianao',
            'Playa',
            'Plaza de la Revolución',
            'Regla',
            'San Miguel del Padrón'
        ];
        $carrito = Carrito::all();
        $ordenes = Ordene::where('id_user', Auth::user()->id)->orderBy('created_at', 'DESC')->first();
        $shippingCost = 0;


        $distance = $this->calculateDistance($request->location);
        $shippingCost = $distance * 65; 


        return view('livewire.caja-component', [
            'carrito' => $carrito,
            'ordenes' => $ordenes,
            'municipios' => $municipios,
            'shippingCost' => round($shippingCost,0),
            'cordenadas' => $request->location,
        ]);
    }
}
