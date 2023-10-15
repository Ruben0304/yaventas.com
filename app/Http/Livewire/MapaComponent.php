<?php

namespace App\Http\Livewire;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Livewire\Component;

class MapaComponent extends Component
{
    public function calcular(Request $request)
    {

        $clientLocation = $request->input('location');
        $fixedLocation = '23.09134271600482, -82.46368666373967'; // Reemplaza con tu ubicación fija

        // Define el token de acceso de Mapbox
        $access_token = 'sk.eyJ1IjoicnViZW4wMzA0IiwiYSI6ImNsa2xwcTJpbzA2YWQzam54NjhsZ3RjYjMifQ.-R7U7-DuoK2_R77bQJKS3A'; // Reemplaza con tu token de acceso de Mapbox

        // Construye la URL de la API de Mapbox
        $url = "https://api.mapbox.com/directions/v5/mapbox/driving/{$fixedLocation};{$clientLocation}?access_token={$access_token}";

        // Realiza la solicitud a la API de Mapbox
        $response = Http::get($url);

        // Verifica si la respuesta es válida
        if ($response->failed()) {
            // Asegúrate de manejar este error adecuadamente en tu aplicación
            return response()->json(['error' => 'Failed to calculate distance.'], 500);
        }

        // Decodifica la respuesta JSON
        $data = $response->json();

        // Extrae la distancia del resultado (la API de Mapbox proporciona la distancia en metros, así que se convierte a kilómetros)
        $distance = $data['routes'][0]['distance'] / 1000;

        return response()->json([
            'distance' => $distance
        ]);
    }

    public function render()
    {
        return view('livewire.mapa-component');
    }
}
