<div>
    <button wire:click="generarPDF"
           style="height: 400px;width: 500px;background-color: #0a58ca">
        Generar PDF
    </button>
</div>
@if(session('pdfUrl'))
    <div class="mt-4">
        <a href="{{ session('pdfUrl') }}" class="btn btn-primary" target="_blank">
            Descargar Comprobante de Compra (PDF)
        </a>
    </div>
@endif
