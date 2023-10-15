<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    public function validar(){
        $aleatorio = 100000;
        $id_aleatorio = 10000000;
        
        echo "Nombres y apellidos: \n";
        $dato['nombres_apellidos'] = readline();
        
        echo "Numero de telefono: \n";
        $dato['telefono'] = readline();
        
        $id_aleatorio += rand(0, 900000000);
        $aleatorio += rand(0, 900000);
        
        echo "Introduzca el siguiente numero: $aleatorio\n";
        $usuarionum = readline();
        
        while($aleatorio != $usuarionum){
            $dato['verificacion'] = false;
            $aleatorio = 100000;
            $aleatorio += rand(0, 900000);
            echo "Error: introduzca el siguiente codigo: $aleatorio\n";
            $usuarionum = readline();
        }
        
        $dato['verificacion'] = true;
        echo "Registrado\n";

    }
}
