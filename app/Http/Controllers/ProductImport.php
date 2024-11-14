<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductImport extends Controller
{
    public function importProducts($jsonPath = null)
    {
        try {
            // Validar la URL del JSON
            // Ruta al archivo JSON en descargas (ajusta según tu sistema operativo)
            $jsonPath = $jsonPath ?? "C:/Users/herna/Downloads/fashionp/fashion.json";

            // Verificar si el archivo existe
            if (!file_exists($jsonPath)) {
                return response()->json([
                    'success' => false,
                    'message' => 'El archivo JSON no existe en la ruta especificada'
                ], 404);
            }

            // Leer el contenido del archivo
            $jsonContent = file_get_contents($jsonPath);
            $products = json_decode($jsonContent, true);

            if (!is_array($products)) {
                $products = [$products]; // Si es un solo producto, convertirlo en array
            }

            $importedCount = 0;
            $errors = [];

            foreach ($products as $productData) {
                try {
                    $producto = new Producto();

                    // Mapear los campos del JSON a la estructura de la tabla
                    $producto->nombre = $productData['product_name'] ?? null;

                    // Procesar el precio
                    $precio = str_replace(',', '', $productData['sales_price'] ?? '0');
                    $producto->preciocup = (float)$precio;
                    $producto->preciousd = $precio; // Guardamos el precio original como texto
                    $producto->monedas = 'USD'; // Por defecto USD ya que viene de Amazon

                    // Stock por defecto 1 si no se especifica
                    $producto->stock = 1;

                    // Campos por defecto
                    $producto->recojible = 'no';
                    $producto->direccion = null;
                    $producto->id_categoria = rand(26,32); // Categoría por defecto
                    $producto->valoracion = $productData['rating'] ?? 0.00;

                    // Procesar las imágenes
                    $imageUrls = explode('|', $productData['large'] ?? '');

                    if (!empty($imageUrls[0])) {
                        $producto->foto = $imageUrls[0]; // Primera imagen como principal
                    } else {
                        $producto->foto = 'https://canalsalud.imq.es/hubfs/imq-blog/alimentos-saludables.jpg';
                    }

                    // Imágenes adicionales
                    $producto->foto_2 = $imageUrls[1] ?? null;
                    $producto->foto_3 = $imageUrls[2] ?? null;

                    // Otros campos
                    $producto->color = null; // No viene en el JSON
                    $producto->descripcion = $this->generateDescription($productData);

                    // ID del vendedor (deberías tener uno por defecto o pasarlo como parámetro)
                    $producto->id_vendedor = 1; // Cambiar según necesidades

                    $producto->save();
                    $importedCount++;

                } catch (\Exception $e) {
                    $errors[] = [
                        'product_name' => $productData['product_name'] ?? 'Unknown',
                        'error' => $e->getMessage()
                    ];
                }
            }

            return [
                'success' => true,
                'imported_count' => $importedCount,
                'errors' => $errors
            ];

        } catch (\Exception $e) {
            return [
                'success' => false,
                'message' => 'Error processing JSON file: ' . $e->getMessage()
            ];
        }
    }

    /**
     * Genera una descripción del producto basada en los datos disponibles
     */
    private function generateDescription($productData): string
    {
        $description = [];

        // Añadir nombre del producto
        $description[] = $productData['product_name'] ?? '';

        // Añadir marca si está disponible
        if (!empty($productData['brand'])) {
            $description[] = "Marca: " . $productData['brand'];
        }

        // Añadir detalles del producto si están disponibles
        if (!empty($productData['product_details__k_v_pairs'])) {
            foreach ($productData['product_details__k_v_pairs'] as $key => $value) {
                $key = str_replace('_', ' ', $key);
                $description[] = "$key: $value";
            }
        }

        return implode("\n", array_filter($description));
    }
}
