<?php

namespace App\Http\Livewire;

use Livewire\Component;


class GenerarPdf extends Component
{
    public function render()
    {
        return view('livewire.generar-pdf');
    }

    public function generarPDF()
    {
//        $pdf = PDF::loadView('livewire.pdf-template', [
//            'titulo' => 'Mi primer PDF con Livewire',
//            'fecha' => now()->format('d/m/Y'),
//            'contenido' => 'Este es un PDF de prueba'
//        ]);
//
//        return response()->streamDownload(function () use ($pdf) {
//            echo $pdf->output();
//        }, 'prueba.pdf');
    }
}
