<?php

namespace App\Http\Livewire;

use App\Models\Carrito;
use App\Models\Orden_detalle;
use App\Models\Ordene;
use App\Models\Producto;
use App\Models\Whatsapp;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;

class CajaComponent extends Component
{

    public $nombre;
    public $direccion;
    public $pais = 'Cuba';
    public $provincia = 'La Habana';
    public $municipio;
    public $telefono;
    public $comentarios;
    public $metodopago;
    public $carrito;
    public $subtotal;
    public $shippingCost;
    public $total;
    public $municipios;
    public $whatsapp;
    public $location;

    protected $rules = [
        'nombre' => 'required',
        'direccion' => 'required',
        'municipio' => 'required',
        'telefono' => 'required',
        'metodopago' => 'required',
        'location' => 'required',
    ];

    protected $messages = [
        'nombre.required' => 'El nombre es obligatorio.',
        'direccion.required' => 'La dirección es obligatoria.',
        'municipio.required' => 'El municipio es obligatorio.',
        'telefono.required' => 'El teléfono es obligatorio.',
        'metodopago.required' => 'El método de pago es obligatorio.',
        'location.required' => 'La ubicación es obligatoria.',
    ];

    public function mount(Request $request)
    {
        $this->carrito = auth()->user()->carrito;
        $this->whatsapp = Whatsapp::where('id_user', Auth::id())->first();
        $this->municipios = ['Playa', 'Plaza', 'Centro Habana', 'Habana Vieja', 'Regla', 'Habana del Este', 'Guanabacoa', 'San Miguel del Padrón', 'Diez de Octubre', 'Cerro', 'Marianao', 'La Lisa', 'Boyeros', 'Arroyo Naranjo', 'Cotorro'];
        $this->location = $request->location ?? '';
        $this->calculateTotals();
    }

    public function calculateTotals()
    {
        $this->subtotal = $this->carrito->sum(function ($item) {
            $price = $this->whatsapp ? $item->producto->preciocup : $item->producto->preciocup * 1.1;
            return $price * $item->cantidad;
        });

        $distance = $this->calculateDistance($this->location);
        $this->shippingCost = round($distance * 65, 0);
        $this->total = $this->subtotal + $this->shippingCost;
    }

    public function updatedMunicipio()
    {
        $this->calculateTotals();
    }

    public function pagar()
    {
        $this->validate();

        if ($this->metodopago == 'efectivo') {
            $pdfUrl = $this->createOrder();
            return redirect()->route('pedidos')
                ->with('success', '¡Felicidades! Tu compra se ha realizado con éxito. Pronto nos pondremos en contacto contigo. Te agradecemos tu preferencia. 😊')
                ->with('pdfUrl', $pdfUrl);
        } elseif ($this->metodopago == 'qvapay') {
            $response = $this->createQvapayInvoice();
            if (isset($response['signedUrl'])) {
                return redirect($response['signedUrl']);
            }
        }

        return redirect()->route('home');
    }

    private function createOrder()
    {
        DB::beginTransaction();
        $order = new Ordene([
            'id_user' => Auth::id(),
            'nombre' => $this->nombre,
            'total' => $this->total,
            'subtotal' => $this->subtotal,
            'envio' => $this->shippingCost,
            'direccion' => $this->direccion,
            'pais' => $this->pais,
            'provincia' => $this->provincia,
            'municipio' => $this->municipio,
            'telefono' => $this->telefono,
            'metodopago' => $this->metodopago,
            'comentarios' => $this->comentarios,
        ]);
        $order->save();
        // obtiene los productos del carrito del usuario
        $cart_products = $this->carrito;

        // recorre los productos del carrito y crea un registro en orden_detalles para cada uno
        foreach ($cart_products as $cart_product) {
            $order_detail = new Orden_detalle();
            $order_detail->id_user = Auth::user()->id;
            $order_detail->id_producto = $cart_product->id_producto;
            $order_detail->cantidad = $cart_product->cantidad;
            $order_detail->precio = $cart_product->producto->preciocup;
            $order_detail->total = $cart_product->cantidad * $cart_product->producto->preciocup;
            $order_detail->id_orden = $order->id;
            $order_detail->save();
        }

        // Generar PDF
        $orderDetails = Orden_detalle::with('producto')
            ->where('id_orden', $order->id)
            ->get();

        $pdf = Pdf::loadView('livewire.pdf-template', [
            'order' => $order,
            'orderDetails' => $orderDetails
        ]);

        // Guardar el PDF
        $pdfPath = 'comprobantes/orden-' . $order->id . '.pdf';
        Storage::put('public/' . $pdfPath, $pdf->output());

        $chat_ids = [883686571, 1037612237, 5965028260];
        foreach ($chat_ids as $chat_id) {
            $token = "6076481343:AAF5RcA16h2JlRpLKwiVvG3XidaPvaXzKtE";

            $text = 'id_user = ' . Auth::user()->id . '
      total = ' . $this->total . '
      subtotal = ' . $this->subtotal . '
      envio = ' . $this->shippingCost . '
      nombre = ' . $this->nombre . '
      direccion = ' . $this->direccion . '
      pais = ' . $this->pais . '
      provincia = ' . $this->provincia . '
      municipio = ' . $this->municipio . '
      telefono = ' . $this->telefono . '

      Productos:
      ';
            foreach ($cart_products as $cart_product) {
                $text .= 'link = https://yaventas.com/detalles?id=' . $cart_product->id_producto . '
        nombre = ' . Producto::find($cart_product->id_producto)->nombre . '
        cantidad = ' . $cart_product->cantidad . '
        precio = ' . $cart_product->producto->preciocup . '
        total = ' . $cart_product->cantidad * $cart_product->producto->preciocup . '

        ';
            }


            // Iniciar una sesión de curl con la URL de la API de Telegram
            $ch = curl_init('https://api.telegram.org/bot' . $token . '/sendMessage');

            // Establecer las opciones de curl
            curl_setopt($ch, CURLOPT_POST, 1); // Tipo de petición: POST
            curl_setopt($ch, CURLOPT_POSTFIELDS, ['chat_id' => $chat_id, 'text' => $text]); // Parámetros: chat_id y text
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); // Formato de retorno: JSON
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); // Verificación SSL: false

            // Ejecutar la sesión de curl y obtener el resultado
            $result = curl_exec($ch);

            // Cerrar la sesión de curl
            curl_close($ch);
            $ch = curl_init('https://api.telegram.org/bot' . $token . '/sendMessage');

            // Establecer las opciones de curl
            curl_setopt($ch, CURLOPT_POST, 1); // Tipo de petición: POST
            curl_setopt($ch, CURLOPT_POSTFIELDS, ['chat_id' => $chat_id, 'text' => $this->location]); // Parámetros: chat_id y text
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); // Formato de retorno: JSON
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); // Verificación SSL: false

            // Ejecutar la sesión de curl y obtener el resultado
            $result = curl_exec($ch);

            // Cerrar la sesión de curl
            curl_close($ch);
        }
        Carrito::where('id_user', Auth::user()->id)->delete();
        DB::commit();

        return Storage::url($pdfPath);
    }


    public function calculateDistance($location)
    {
        $mapboxToken = env('MAPBOX_TOKEN');
        $fixedLocation = '-82.46179838936656,23.090916961379236'; // Havana, Cuba

        try {
            $response = Http::get("https://api.mapbox.com/directions/v5/mapbox/driving/{$fixedLocation};{$location}?access_token={$mapboxToken}");

            $responseBody = json_decode($response->body(), true);

            if ($response->failed() || empty($responseBody['routes'])) {
                throw new \Exception('Fallo al calcular distancia');
            }

            $distanceInMeters = $responseBody['routes'][0]['distance'];
            $distanceInKilometers = $distanceInMeters / 1000;

            return $distanceInKilometers;
        } catch (\Exception $e) {
            $this->addError('location', 'No se pudo calcular la distancia. Por favor, intente de nuevo.');
            return 0;
        }
    }


    public function render()
    {
        return view('livewire.caja-component');
    }
}
