@extends('template')
@section('contenido')

<section class="hero-normal">
       
      
    <div class="container">
        <div class="row">
            <div class="col-lg-3">
                <div class="hero__categories">
                    <div class="hero__categories__all">
                        <i class="fa fa-bars"></i>
                        <span>Categorias</span>
                    </div>
                    <ul>
                        @foreach ($categorias as $categoria)
                            
                        
                        <li><a href="{{$categoria->id}}">{{$categoria->nombre}}</a></li>
                        @endforeach
               </div>
            </div>
            <div class="col-lg-9">
                <div class="hero__search">
                    </ul>
                    @include('_search')
                    <div class="hero__search__phone">
                        <div class="hero__search__phone__icon">
                            <i class="fa fa-phone"></i>
                        </div>
                        <div class="hero__search__phone__text">
                            <h5>+1 7865926593</h5>
                            <span>Atenderemos Enseguida</span>
                        </div>
                    </div>
                </div>
                <div class="hero__item set-bg" data-setbg="" >
                    <iframe src="http://localhost/gustazo/public/tabla" frameborder="0" width="100%" height="100%"></iframe>
                    
                </div>
            </div>
        </div>
    </div>
</section>



@endsection