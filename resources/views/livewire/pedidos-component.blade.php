<style>
    .alert-success {
        background-color: #29a20b;
        color: white;
        font-size: 20px;
        border-radius: 10px;
        padding: 10px;
    }

    .pdf-download-btn {
        display: inline-block;
        background-color: #ff6e11;
        color: white;
        padding: 10px 20px;
        border-radius: 10px;
        text-decoration: none;
        margin-top: 10px;
        margin-bottom: 20px;
    }

    .pdf-download-btn:hover {
        background-color: #ff6e11;
        color: white;
    }
</style>

<div>
    <main class="main">
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
            @if(session('pdfUrl'))
                <div style="text-align: center;">
                    <a href="{{ session('pdfUrl') }}" class="pdf-download-btn" target="_blank">
                        <i class="fi-rs-download mr-5"></i>Descargar Comprobante de Compra (PDF)
                    </a>
                </div>
            @endif
        @endif


        <div class="page-header breadcrumb-wrap">
            <div class="container">
                <div class="breadcrumb">
                    <a href="{{ route('home') }}" rel="nofollow">Inicio</a>
                    <span></span> <a href="{{ route('shoping') }}">Comprar</a>
                    <span></span> Pedidos
                </div>
            </div>
        </div>

        <livewire:admin.admin-pedidos/>

        <a class="btn " href="{{ route('shoping') }}">
            <i class="fi-rs-shopping-bag mr-10"></i>Volver a la tienda
        </a>
    </main>
</div>
