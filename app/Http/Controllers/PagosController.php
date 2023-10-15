<?php

namespace App\Http\Controllers;

use App\Models\Carrito;
use App\Models\Orden_detalle;
use App\Models\Ordene;
use App\Models\Producto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class PagosController extends Controller
{

  //telegram 
  public function telegram()
  {
    // Definir el token de acceso y el ID del chat
    $token = "6076481343:AAF5RcA16h2JlRpLKwiVvG3XidaPvaXzKtE";
    $chat_id = "883686571";

    // Definir el texto del mensaje
    $text = "Este es un mensaje de prueba";

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

    // Mostrar el resultado (opcional)
    return redirect(route('home'));
  }



  // Efectivo
  public function efectivo($nombre, $total, $subtotal, $bono, $envio, $direccion, $pais, $provincia, $municipio, $telefono, $comentarios, $cordenadas)
  {

    DB::beginTransaction();

    // crea la orden
    $order = new Ordene();
    $order->id_user = Auth::user()->id;
    $order->total = $total;
    $order->subtotal = $subtotal;
    $order->envio = $envio;
    $order->nombre = $nombre;
    $order->direccion = $direccion;
    $order->pais = $pais;
    $order->provincia = $provincia;
    $order->municipio = $municipio;
    $order->telefono = $telefono;
    $order->bono = $bono;
    // Asignar los valores de los campos opcionales

    $order->comentarios = $comentarios;
    // Guardar la orden con los nuevos valores
    $order->save();



    // obtiene los productos del carrito del usuario
    $cart_products = Carrito::where('id_user', Auth::user()->id)->get();

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

      // elimina el producto del carrito

    }
    $chat_ids = [883686571, 1037612237, 5965028260];
    foreach ($chat_ids as $chat_id) {
      $token = "6076481343:AAF5RcA16h2JlRpLKwiVvG3XidaPvaXzKtE";

      $text = 'id_user = ' . Auth::user()->id . '
      total = ' . $total . '
      subtotal = ' . $subtotal . '
      envio = ' . $envio . '
      nombre = ' . $nombre . '
      direccion = ' . $direccion . '
      pais = ' . $pais . '
      provincia = ' . $provincia . '
      municipio = ' . $municipio . '
      telefono = ' . $telefono . '
      bono = ' . $bono . '
      


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
      curl_setopt($ch, CURLOPT_POSTFIELDS, ['chat_id' => $chat_id, 'text' => $cordenadas]); // Parámetros: chat_id y text
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); // Formato de retorno: JSON
      curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); // Verificación SSL: false

      // Ejecutar la sesión de curl y obtener el resultado
      $result = curl_exec($ch);

      // Cerrar la sesión de curl
      curl_close($ch);
    }
    Carrito::where('id_user', Auth::user()->id)->delete();
    DB::commit();
  }







  public function pagar_con_qvapay(Request $request)
  {
    $curl = curl_init();
    curl_setopt_array($curl, array(
      CURLOPT_URL => 'https://qvapay.com/api/v1/create_invoice',
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => '',
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 0,
      CURLOPT_FOLLOWLOCATION => true,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => 'POST',
      CURLOPT_POSTFIELDS => '{
        "app_id": "' . env('qvapay_id') . '",
        "app_secret": "' . env('qvapay_secret') . '",
        "amount": "' . $request->total . '",
        "description": "Comprar con Qvapay orden",
        "remote_id": "QVA004",
        "signed": 1
      }',
      CURLOPT_HTTPHEADER => array(

        'Content-Type: application/json'
      ),
    ));

    $response = curl_exec($curl);
    $data = json_decode($response, true);


    $signedUrl = $data["signedUrl"];
    //       $transation_uuid=$data["transation_uuid"];

    //       curl_close($curl);
    return redirect($signedUrl);
  }
  public function openai(Request $request)
  {




    $ch = curl_init();

    curl_setopt($ch, CURLOPT_URL, 'https://api.openai.com/v1/chat/completions');
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode(array(
      'model' => 'gpt-3.5-turbo',
      'messages' => array(
        array(
          'role' => 'user',
          'content' => 'Necesito compartir un producto llamado ' . $request->product . '.Redacta un mensaje para whatsapp, breve y preciso pero con algo de humor, se creativa,puede ser tanto para una mujer como para un hombre, usa algun emoji, no uses hashtags,no digas nada en tono de burla acerca de otros productos, y principalmente que embulle a la otra persona de comprar el producto que se le esta compartiendo, que parezca lo mas real posible, nada exagerado, que no exceda los 380 caracteres (contando espacios), no pongas nada amigo/a ni nada parecido solo saluda con un Hey o frases similares agradables y que el link donde se va a encontrar el producto es en : https://yaventas.com/detalles?id=' . $request->id . '. Aqui tienes algunos datos del producto por si los necesitas : ' . $request->descripcion . '. El precio es ' . $request->precio . ' pesos cubanos (cup).  '
        ),
        // 'temperature' => 0.9
      )
    )));

    $headers = array();
    $headers[] = 'Authorization: Bearer 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';
    $headers[] = 'Content-Type: application/json';
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

    $result = curl_exec($ch);
    if (curl_errno($ch)) {
      echo 'Error:' . curl_error($ch);
    }
    curl_close($ch);

    $response = json_decode($result);

    $respuesta = 'whatsapp://send?text=' . $response->choices[0]->message->content . '';

    return redirect()->away($respuesta);
  }

  public function confirmar_qvapay(Request $request)
  {
    $appid = env('qvapay_id');
    $appsecret = env('qvapay_secret');


    $transaction_uuid = $request->transaction_uuid;






    // $curl = curl_init();

    // curl_setopt_array($curl, array(
    //   CURLOPT_URL => 'https://qvapay.com/api/',
    //   CURLOPT_RETURNTRANSFER => true,
    //   CURLOPT_ENCODING => '',
    //   CURLOPT_MAXREDIRS => 10,
    //   CURLOPT_TIMEOUT => 0,
    //   CURLOPT_FOLLOWLOCATION => true,
    //   CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    //   CURLOPT_CUSTOMREQUEST => 'GET',
    //   CURLOPT_POSTFIELDS =>'{
    //     "app_id": "'.env('qvapay_id').'",
    //     "app_secret": "'.env('qvapay_secret').'",
    //     "transaction_uuid": "'.$transaction_uuid.'"
    //   }',
    //   CURLOPT_HTTPHEADER => array(
    //     'Accept: application/json'
    //   ),
    // ));

    // $response = curl_exec($curl);

    // curl_close($curl);

    // $data=json_decode($response,true);
    $curl = curl_init();

    curl_setopt_array($curl, array(
      CURLOPT_URL => 'https://qvapay.com/api/v1/transactions/' . $transaction_uuid . '?app_id=' . $appid . '&app_secret=' . $appsecret . '',
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => '',
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 0,
      CURLOPT_FOLLOWLOCATION => true,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_HTTPHEADER => array(

        'Content-Type: application/json'
      ),
    ));

    $response = curl_exec($curl);

    $data = json_decode($response, true);

    if ($data == null) {
      return 'Error orden no encontrada';
    } else {


      $appidpago = env("qvapay_id_pagos");
      $idapp = $data["app_id"];
      $status = $data["status"];
      $amount = $data["amount"];
      $username = $data["paid_by"]["username"];
      $name = $data["paid_by"]["name"];
      $lastname = $data["paid_by"]["lastname"];
      $appuser = $data["owner"]["username"];
      curl_close($curl);

      $verificar_uuid = Ordene::where('transaction_uuid', $transaction_uuid)->get();
      if ($verificar_uuid->count() > 0) {
        return "Error: Esta orden ya ha sido acreditada";
      } else {
        if ($status == "paid" && $idapp = $appidpago) {
          Ordene::create([


            'id_user' => Auth::user()->id,
            'total' =>  $amount,
            'subtotal' => $amount,
            'transaction_uuid' => $transaction_uuid,
            'usuario_remoto' => $username,
            'metodopago' => 'qvapay'

          ]);
          return redirect(route('home'));
        } else {
          return 'Orden no pagada o incorrecta';
        }

        // return redirect(route('home'));

      }
    }
  }

  public function pagar(Request $request)
  {
    $validatedData = $request->validate([
      'nombre' => 'required',
      'total' => 'required|numeric|min:0',
      'subtotal' => 'required|numeric|min:0',
      'cordenadas' => 'required',
      'envio' => 'required|numeric|min:0',
      'direccion' => 'required',
      'pais' => 'required',
      'provincia' => 'required',
      'municipio' => 'required',
      'telefono' => 'required',
      'metodopago' => 'required',
      // Agregar las reglas de validación para los campos opcionales
      'bono' => 'nullable',
      'comentarios' => 'nullable',
    ], [
      // Mensajes personalizados en español
      'nombre.required' => 'El nombre es obligatorio.',
      'cordenada.required' => 'Cordenadas obligatorias.',
      'total.required' => 'El total es obligatorio.',
      'total.numeric' => 'El total debe ser un número.',
      'total.min' => 'El total debe ser mayor o igual a cero.',
      'direccion.required' => 'La dirección es obligatoria.',
      'pais.required' => 'El país es obligatorio.',
      'provincia.required' => 'La provincia es obligatoria.',
      'municipio.required' => 'El municipio es obligatorio.',
      'telefono.required' => 'El teléfono es obligatorio.',
      'metodopago.required' => 'El método de pago es obligatorio.',
    ]);

    // procesar el formulario
    $nombre = $validatedData['nombre'];
    $total = $validatedData['total'];
    $subtotal = $validatedData['subtotal'];
    $envio = $validatedData['envio'];
    $direccion = $validatedData['direccion'];
    $pais = $validatedData['pais'];
    $provincia = $validatedData['provincia'];
    $municipio = $validatedData['municipio'];
    $telefono = $validatedData['telefono'];
    $metodopago = $validatedData['metodopago'];
    $cordenadas = $validatedData['cordenadas'];
    $bono = $validatedData['bono'];
    // Obtener los valores de los campos opcionales

    $comentarios = $validatedData['comentarios'];

    if ($metodopago == "efectivo") {
      // Pasar las variables como parámetros al método efectivo
      $this->efectivo($nombre, $total, $subtotal, $bono, $envio, $direccion, $pais, $provincia, $municipio, $telefono, $comentarios, $cordenadas);
      return redirect(route('pedidos'))->with('success', '¡Felicidades! Tu compra se ha realizado con éxito. Pronto nos pondremos en contacto contigo. Te agradecemos tu preferencia. 😊');
    } elseif ($request->metodopago == "qvapay") {

      $curl = curl_init();
      curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://qvapay.com/api/v1/create_invoice',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS => '{
      "app_id": "' . env('qvapay_id') . '",
      "app_secret": "' . env('qvapay_secret') . '",
      "amount": "' . $request->total . '",
      "description": "Comprar con Qvapay orden",
      "remote_id": "QVA004",
      "signed": 1
    }',
        CURLOPT_HTTPHEADER => array(

          'Content-Type: application/json'
        ),
      ));

      $response = curl_exec($curl);
      $data = json_decode($response, true);


      $signedUrl = $data["signedUrl"];
      //       $transation_uuid=$data["transation_uuid"];

      //       curl_close($curl);
      return redirect($signedUrl);
    } else {
      return redirect(route('home'));
    }
  }
}
