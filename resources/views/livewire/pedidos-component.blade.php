<style> .alert-success { background-color: #29a20b; color: white; font-size: 20px; border-radius: 10px; padding: 10px; } </style>

<div>
    <main class="main">
        @if (session('success'))
            <div class="alert alert-success"> {{ session('success') }} </div>
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

        <section class="pedidos" style="height: 700px; padding:20px; margin-left:30px; margin-right:30px">
            <iframe src="http://127.0.0.1:8000/tabla" frameborder="0" width="100%" height="100%"></iframe>

        </section>
        <a class="btn " href="{{ route('shoping') }}"><i
            class="fi-rs-shopping-bag mr-10"></i>Volver a la tienda</a>
    </main>

</div>
