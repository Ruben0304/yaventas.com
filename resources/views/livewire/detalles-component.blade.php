@php

    use App\Models\Whatsapp;use Illuminate\Support\Facades\Auth;
@endphp
@auth

    @php
        $whatsapp = Whatsapp::where('id_user', Auth::user()->id)->first() ?? null;
    @endphp
@else
    @php
        $whatsapp = null;
    @endphp
@endauth
<div>
    <main class="main">
        <div class="page-header breadcrumb-wrap">
            <div class="container">
                <div class="breadcrumb">
                    <a href="{{ route('home') }}" rel="nofollow">Inicio</a>
                    <span></span> Detalles

                </div>
            </div>
        </div>
        <section class="mt-50 mb-50">
            <div class="container">
                <div class="row">
                    <div class="col-lg-9">
                        <div class="product-detail accordion-detail">
                            <div class="row mb-50">
                                <div class="col-md-6 col-sm-12 col-xs-12">
                                    <div class="detail-gallery">
                                        <span><i class="fi-rs-search"></i></span>
                                        <!-- MAIN SLIDES -->
                                        <div style="max-width: 800px; margin: 0 auto; position: relative;">
                                            <div
                                                style="width: 100%; position: relative; overflow: hidden; border-radius: 10px;">
                                                <figure class="border-radius-10"
                                                        style="display: block; margin: 0; width: 100%;">
                                                    <img src="{{ $producto->foto }}" alt="product image"
                                                         style="width: 100%; height: auto; border-radius: 10px;">
                                                </figure>
                                                @if ($producto->foto_2 != null)
                                                    <figure class="border-radius-10"
                                                            style="display: none; margin: 0; width: 100%;">
                                                        <img src="{{ $producto->foto_2 }}" alt="product image"
                                                             style="width: 100%; height: auto; border-radius: 10px;">
                                                    </figure>
                                                @endif
                                                @if ($producto->foto_3 != null)
                                                    <figure class="border-radius-10"
                                                            style="display: none; margin: 0; width: 100%;">
                                                        <img src="{{ $producto->foto_3 }}" alt="product image"
                                                             style="width: 100%; height: auto; border-radius: 10px;">
                                                    </figure>
                                                @endif

                                                <!-- Botones de navegación -->
                                                <button onclick="moveSlide(-1)"
                                                        style="position: absolute; left: 10px; top: 50%; transform: translateY(-50%); background: rgba(255,255,255,0.8); border: none; border-radius: 50%; width: 40px; height: 40px; cursor: pointer; z-index: 2;">
                                                    ←
                                                </button>
                                                <button onclick="moveSlide(1)"
                                                        style="position: absolute; right: 10px; top: 50%; transform: translateY(-50%); background: rgba(255,255,255,0.8); border: none; border-radius: 50%; width: 40px; height: 40px; cursor: pointer; z-index: 2;">
                                                    →
                                                </button>
                                            </div>

                                            <!-- THUMBNAILS -->
                                            <div
                                                style="display: flex; justify-content: center; gap: 10px; margin-top: 20px; padding: 0 15px;">
                                                <div onclick="currentSlide(0)"
                                                     style="width: 100px; height: 100px; cursor: pointer; opacity: 1; border: 2px solid #4a90e2; border-radius: 5px; overflow: hidden;">
                                                    <img src="{{ $producto->foto }}" alt="product image"
                                                         style="width: 100%; height: 100%; object-fit: cover;">
                                                </div>
                                                @if ($producto->foto_2 != null)
                                                    <div onclick="currentSlide(1)"
                                                         style="width: 100px; height: 100px; cursor: pointer; opacity: 0.6; border-radius: 5px; overflow: hidden;">
                                                        <img src="{{ $producto->foto_2 }}" alt="product image"
                                                             style="width: 100%; height: 100%; object-fit: cover;">
                                                    </div>
                                                @endif
                                                @if ($producto->foto_3 != null)
                                                    <div onclick="currentSlide(2)"
                                                         style="width: 100px; height: 100px; cursor: pointer; opacity: 0.6; border-radius: 5px; overflow: hidden;">
                                                        <img src="{{ $producto->foto_3 }}" alt="product image"
                                                             style="width: 100%; height: 100%; object-fit: cover;">
                                                    </div>
                                                @endif
                                            </div>
                                        </div>

                                        <script>
                                            let slideIndex = 0;
                                            const slides = document.querySelectorAll('.border-radius-10');
                                            const thumbnails = document.querySelectorAll('.slider-nav-thumbnails div');

                                            function showSlides(n) {
                                                if (n >= slides.length) slideIndex = 0;
                                                if (n < 0) slideIndex = slides.length - 1;

                                                // Ocultar todas las slides
                                                slides.forEach(slide => slide.style.display = "none");

                                                // Resetear opacidad de miniaturas
                                                const thumbs = document.querySelectorAll('[onclick^="currentSlide"]');
                                                thumbs.forEach(thumb => {
                                                    thumb.style.opacity = "0.6";
                                                    thumb.style.border = "none";
                                                });

                                                // Mostrar slide actual
                                                slides[slideIndex].style.display = "block";
                                                slides[slideIndex].style.animation = "fadeIn 0.5s";

                                                // Activar miniatura actual
                                                thumbs[slideIndex].style.opacity = "1";
                                                thumbs[slideIndex].style.border = "2px solid #4a90e2";
                                            }

                                            function moveSlide(n) {
                                                slideIndex += n;
                                                showSlides(slideIndex);
                                            }

                                            function currentSlide(n) {
                                                slideIndex = n;
                                                showSlides(slideIndex);
                                            }

                                            // Inicializar el slider
                                            showSlides(slideIndex);

                                            // Definir la animación de fade
                                            const style = document.createElement('style');
                                            style.textContent = `
            @keyframes fadeIn {
                from { opacity: 0.8; }
                to { opacity: 1; }
            }
        `;
                                            document.head.appendChild(style);
                                        </script>
                                    </div>
                                    <!-- End Gallery -->
                                    {{--                                    <div class="social-icons single-share">--}}
                                    {{--                                        <ul class="text-grey-5 d-inline-block">--}}
                                    {{--                                            <li><strong class="mr-10">Comprte el producto:</strong></li>--}}
                                    {{--                                            <li class="social-facebook"><a href="#"><img--}}
                                    {{--                                                        src="assets/imgs/theme/icons/icon-facebook.svg"--}}
                                    {{--                                                        alt=""></a></li>--}}
                                    {{--                                            <li class="social-twitter"><a href="#"><img--}}
                                    {{--                                                        src="assets/imgs/theme/icons/icon-twitter.svg"--}}
                                    {{--                                                        alt=""></a></li>--}}
                                    {{--                                            <li class="social-instagram"><a href="#"><img--}}
                                    {{--                                                        src="assets/imgs/theme/icons/icon-instagram.svg"--}}
                                    {{--                                                        alt=""></a></li>--}}
                                    {{--                                            <li class="social-linkedin"><a href="#"><img--}}
                                    {{--                                                        src="assets/imgs/theme/icons/icon-pinterest.svg"--}}
                                    {{--                                                        alt=""></a></li>--}}
                                    {{--                                        </ul>--}}
                                    {{--                                    </div>--}}
                                </div>


                                <div class="md:w-1/2 sm:w-full xs:w-full">
                                    <div class="p-4 bg-white shadow-md rounded-lg">
                                        <h2 class="text-xl font-semibold text-gray-800 mb-6">{{ $producto->nombre }}</h2>

                                        <div class="mb-4">
                                            <div class="pro-details-brand">
                                                <span>Categoria: <a
                                                        href="{{ route('categoria', ['id' => $producto->categoria->id]) }}"
                                                        class="text-blue-500">{{ $producto->categoria->nombre }}</a></span>
                                            </div>
                                        </div>

                                        <div class="clearfix product-price-cover mb-4">
                                            <div class="product-price primary-color float-left"><strong
                                                    style="color: #FF6E11; font-size: 2.0em">
                                                    ${{ $whatsapp ? $producto->preciocup : $producto->preciocup + 0.1 * $producto->preciocup }}</span>
                                                </strong>
                                                <hr class="my-2">
                                                @auth
                                                    @if ($whatsapp != null)
                                                    @else
                                                        <span
                                                            class="product-price primary-color float-left w-full"><strong
                                                                style="color: #FF6E11; font-size: 1.5em">${{ $producto->preciocup }}</strong>
                             ¡Oferta única! Únete a WhatsApp <a href="{{ route('whatsapp') }}" class="text-blue-500 ">aquí</a> 📲</span>
                                                    @endif
                                                @endauth
                                            </div>
                                        </div>

                                        <div class="bt-1 border-color-1 mt-4 mb-4"></div>

                                        <div class="short-desc mb-8"></div>

                                        <div class="attr-detail attr-color mb-4">
                                            <strong class="mr-2">Color</strong>
                                            <ul class="list-filter color-filter flex space-x-2">
                                                @foreach ($productos as $item)
                                                    <li><a href="{{ route('detalles', 'id=' . $item->id . '') }}"
                                                           data-color="{{ $item->color }}">
                                                            <span class="product-color-{{ $item->color }}"
                                                                  style="background-color:{{ $item->color }}; width: 20px; height: 20px; display: inline-block; border-radius: 50%;"></span>
                                                        </a></li>
                                                @endforeach
                                            </ul>
                                        </div>

                                        <div class="bt-1 border-color-1 mt-8 mb-8"></div>

                                        <div class="detail-extralink">
                                            <div class="product-extra-link2">
                                                @auth
                                                    <button type="submit"
                                                            class="bg-blue-500 text-white px-4 py-2 rounded"
                                                            wire:click.prevent="agregar_carrito({{ $producto->id }},1)">
                                                        Agregar al carrito 🛒
                                                    </button>
                                                @else
                                                    <button type="submit"
                                                            class="bg-blue-500 text-white px-4 py-2 rounded"
                                                            wire:click.prevent="login({{ $producto->id }})">
                                                        Agregar al carrito 🛒
                                                    </button>
                                                @endauth
                                                <form action="{{ route('gpt') }}" method="post" class="mt-4">
                                                    @csrf
                                                    <input type="hidden" name="product" value="{{ $producto->nombre }}">
                                                    <input type="hidden" name="descripcion"
                                                           value="{{ $producto->descripcion }}">
                                                    <input type="hidden" name="precio"
                                                           value="{{ $producto->preciocup }}">
                                                    <input type="hidden" name="id" value="{{ $producto->id }}">
                                                    <button type="submit"
                                                            class="bg-yellow-500 text-white px-4 py-2 rounded"
                                                            style="background-color: #BCCA25; border-color:#BCCA25">
                                                        Compartir por whatsapp 💬
                                                    </button>
                                                </form>
                                            </div>
                                        </div>

                                        <ul class="product-meta font-xs text-gray-500 mt-12">
                                            <li>Disponibilidad:<span class="in-stock text-success ml-2">{{ $producto->stock }} en Stock</span>
                                            </li>
                                        </ul>
                                    </div>
                                    <!-- Detail Info -->
                                </div>

                            </div>
                            <div class="tab-style3">
                                <ul class="nav nav-tabs text-uppercase">
                                    <li class="nav-item">
                                        <a class="nav-link active" id="Description-tab" data-bs-toggle="tab"
                                           href="#Description">Descripcion</a>
                                    </li>
                                    {{-- <li class="nav-item">
                                        <a class="nav-link" id="Additional-info-tab" data-bs-toggle="tab" href="#Additional-info">Additional info</a>
                                    </li> --}}
                                    {{-- <li class="nav-item">
                                        <a class="nav-link" id="Reviews-tab" data-bs-toggle="tab" href="#Reviews">Reviews (3)</a>
                                    </li> --}}
                                </ul>
                                <div class="tab-content shop_info_tab entry-main-content">
                                    <div class="tab-pane fade show active" id="Description">
                                        <div class="">
                                            <p>{{ $producto->descripcion }}</p>

                                            {{-- <ul class="product-more-infor mt-30">
                                                <li><span>Type Of Packing</span> Bottle</li>
                                                <li><span>Color</span> Green, Pink, Powder Blue, Purple</li>
                                                <li><span>Quantity Per Case</span> 100ml</li>
                                                <li><span>Ethyl Alcohol</span> 70%</li>
                                                <li><span>Piece In One</span> Carton</li>
                                            </ul> --}}
                                            {{-- <hr class="wp-block-separator is-style-dots">
                                            <p>Laconic overheard dear woodchuck wow this outrageously taut beaver hey hello far meadowlark imitatively egregiously hugged that yikes minimally unanimous pouted flirtatiously as beaver beheld above forward
                                                energetic across this jeepers beneficently cockily less a the raucously that magic upheld far so the this where crud then below after jeez enchanting drunkenly more much wow callously irrespective limpet.</p>
                                            <h4 class="mt-30">Packaging & Delivery</h4>
                                            <hr class="wp-block-separator is-style-wide">
                                            <p>Less lion goodness that euphemistically robin expeditiously bluebird smugly scratched far while thus cackled sheepishly rigid after due one assenting regarding censorious while occasional or this more crane
                                                went more as this less much amid overhung anathematic because much held one exuberantly sheep goodness so where rat wry well concomitantly.
                                            </p>
                                            <p>Scallop or far crud plain remarkably far by thus far iguana lewd precociously and and less rattlesnake contrary caustic wow this near alas and next and pled the yikes articulate about as less cackled dalmatian
                                                in much less well jeering for the thanks blindly sentimental whimpered less across objectively fanciful grimaced wildly some wow and rose jeepers outgrew lugubrious luridly irrationally attractively
                                                dachshund.
                                            </p> --}}
                                        </div>
                                    </div>
                                    {{-- <div class="tab-pane fade" id="Additional-info">
                                        <table class="font-md">
                                            <tbody>
                                                <tr class="stand-up">
                                                    <th>Stand Up</th>
                                                    <td>
                                                        <p>35″L x 24″W x 37-45″H(front to back wheel)</p>
                                                    </td>
                                                </tr>
                                                <tr class="folded-wo-wheels">
                                                    <th>Folded (w/o wheels)</th>
                                                    <td>
                                                        <p>32.5″L x 18.5″W x 16.5″H</p>
                                                    </td>
                                                </tr>
                                                <tr class="folded-w-wheels">
                                                    <th>Folded (w/ wheels)</th>
                                                    <td>
                                                        <p>32.5″L x 24″W x 18.5″H</p>
                                                    </td>
                                                </tr>
                                                <tr class="door-pass-through">
                                                    <th>Door Pass Through</th>
                                                    <td>
                                                        <p>24</p>
                                                    </td>
                                                </tr>
                                                <tr class="frame">
                                                    <th>Frame</th>
                                                    <td>
                                                        <p>Aluminum</p>
                                                    </td>
                                                </tr>
                                                <tr class="weight-wo-wheels">
                                                    <th>Weight (w/o wheels)</th>
                                                    <td>
                                                        <p>20 LBS</p>
                                                    </td>
                                                </tr>
                                                <tr class="weight-capacity">
                                                    <th>Weight Capacity</th>
                                                    <td>
                                                        <p>60 LBS</p>
                                                    </td>
                                                </tr>
                                                <tr class="width">
                                                    <th>Width</th>
                                                    <td>
                                                        <p>24″</p>
                                                    </td>
                                                </tr>
                                                <tr class="handle-height-ground-to-handle">
                                                    <th>Handle height (ground to handle)</th>
                                                    <td>
                                                        <p>37-45″</p>
                                                    </td>
                                                </tr>
                                                <tr class="wheels">
                                                    <th>Wheels</th>
                                                    <td>
                                                        <p>12″ air / wide track slick tread</p>
                                                    </td>
                                                </tr>
                                                <tr class="seat-back-height">
                                                    <th>Seat back height</th>
                                                    <td>
                                                        <p>21.5″</p>
                                                    </td>
                                                </tr>
                                                <tr class="head-room-inside-canopy">
                                                    <th>Head room (inside canopy)</th>
                                                    <td>
                                                        <p>25″</p>
                                                    </td>
                                                </tr>
                                                <tr class="pa_color">
                                                    <th>Color</th>
                                                    <td>
                                                        <p>Black, Blue, Red, White</p>
                                                    </td>
                                                </tr>
                                                <tr class="pa_size">
                                                    <th>Size</th>
                                                    <td>
                                                        <p>M, S</p>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div> --}}
                                    {{-- <div class="tab-pane fade" id="Reviews">
                                        <!--Comments-->
                                        <div class="comments-area">
                                            <div class="row">
                                                <div class="col-lg-8">
                                                    <h4 class="mb-30">Customer questions & answers</h4>
                                                    <div class="comment-list">
                                                        <div class="single-comment justify-content-between d-flex">
                                                            <div class="user justify-content-between d-flex">
                                                                <div class="thumb text-center">
                                                                    <img src="assets/imgs/page/avatar-6.jpg" alt="">
                                                                    <h6><a href="#">Jacky Chan</a></h6>
                                                                    <p class="font-xxs">Since 2012</p>
                                                                </div>
                                                                <div class="desc">
                                                                    <div class="product-rate d-inline-block">
                                                                        <div class="product-rating" style="width:90%">
                                                                        </div>
                                                                    </div>
                                                                    <p>Thank you very fast shipping from Poland only 3days.</p>
                                                                    <div class="d-flex justify-content-between">
                                                                        <div class="d-flex align-items-center">
                                                                            <p class="font-xs mr-30">December 4, 2020 at 3:12 pm </p>
                                                                            <a href="#" class="text-brand btn-reply">Reply <i class="fi-rs-arrow-right"></i> </a>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <!--single-comment -->
                                                        <div class="single-comment justify-content-between d-flex">
                                                            <div class="user justify-content-between d-flex">
                                                                <div class="thumb text-center">
                                                                    <img src="assets/imgs/page/avatar-7.jpg" alt="">
                                                                    <h6><a href="#">Ana Rosie</a></h6>
                                                                    <p class="font-xxs">Since 2008</p>
                                                                </div>
                                                                <div class="desc">
                                                                    <div class="product-rate d-inline-block">
                                                                        <div class="product-rating" style="width:90%">
                                                                        </div>
                                                                    </div>
                                                                    <p>Great low price and works well.</p>
                                                                    <div class="d-flex justify-content-between">
                                                                        <div class="d-flex align-items-center">
                                                                            <p class="font-xs mr-30">December 4, 2020 at 3:12 pm </p>
                                                                            <a href="#" class="text-brand btn-reply">Reply <i class="fi-rs-arrow-right"></i> </a>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <!--single-comment -->
                                                        <div class="single-comment justify-content-between d-flex">
                                                            <div class="user justify-content-between d-flex">
                                                                <div class="thumb text-center">
                                                                    <img src="assets/imgs/page/avatar-8.jpg" alt="">
                                                                    <h6><a href="#">Steven Keny</a></h6>
                                                                    <p class="font-xxs">Since 2010</p>
                                                                </div>
                                                                <div class="desc">
                                                                    <div class="product-rate d-inline-block">
                                                                        <div class="product-rating" style="width:90%">
                                                                        </div>
                                                                    </div>
                                                                    <p>Authentic and Beautiful, Love these way more than ever expected They are Great earphones</p>
                                                                    <div class="d-flex justify-content-between">
                                                                        <div class="d-flex align-items-center">
                                                                            <p class="font-xs mr-30">December 4, 2020 at 3:12 pm </p>
                                                                            <a href="#" class="text-brand btn-reply">Reply <i class="fi-rs-arrow-right"></i> </a>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <!--single-comment -->
                                                    </div>
                                                </div>
                                                <div class="col-lg-4">
                                                    <h4 class="mb-30">Customer reviews</h4>
                                                    <div class="d-flex mb-30">
                                                        <div class="product-rate d-inline-block mr-15">
                                                            <div class="product-rating" style="width:90%">
                                                            </div>
                                                        </div>
                                                        <h6>4.8 out of 5</h6>
                                                    </div>
                                                    <div class="progress">
                                                        <span>5 star</span>
                                                        <div class="progress-bar" role="progressbar" style="width: 50%;" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100">50%</div>
                                                    </div>
                                                    <div class="progress">
                                                        <span>4 star</span>
                                                        <div class="progress-bar" role="progressbar" style="width: 25%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">25%</div>
                                                    </div>
                                                    <div class="progress">
                                                        <span>3 star</span>
                                                        <div class="progress-bar" role="progressbar" style="width: 45%;" aria-valuenow="45" aria-valuemin="0" aria-valuemax="100">45%</div>
                                                    </div>
                                                    <div class="progress">
                                                        <span>2 star</span>
                                                        <div class="progress-bar" role="progressbar" style="width: 65%;" aria-valuenow="65" aria-valuemin="0" aria-valuemax="100">65%</div>
                                                    </div>
                                                    <div class="progress mb-30">
                                                        <span>1 star</span>
                                                        <div class="progress-bar" role="progressbar" style="width: 85%;" aria-valuenow="85" aria-valuemin="0" aria-valuemax="100">85%</div>
                                                    </div>
                                                    <a href="#" class="font-xs text-muted">How are ratings calculated?</a>
                                                </div>
                                            </div>
                                        </div>
                                        <!--comment form-->
                                        <div class="comment-form">
                                            <h4 class="mb-15">Add a review</h4>
                                            <div class="product-rate d-inline-block mb-30">
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-8 col-md-12">
                                                    <form class="form-contact comment_form" action="#" id="commentForm">
                                                        <div class="row">
                                                            <div class="col-12">
                                                                <div class="form-group">
                                                                    <textarea class="form-control w-100" name="comment" id="comment" cols="30" rows="9" placeholder="Write Comment"></textarea>
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-6">
                                                                <div class="form-group">
                                                                    <input class="form-control" name="name" id="name" type="text" placeholder="Name">
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-6">
                                                                <div class="form-group">
                                                                    <input class="form-control" name="email" id="email" type="email" placeholder="Email">
                                                                </div>
                                                            </div>
                                                            <div class="col-12">
                                                                <div class="form-group">
                                                                    <input class="form-control" name="website" id="website" type="text" placeholder="Website">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <button type="submit" class="button button-contactForm">Submit
                                                                Review</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div> --}}
                                </div>
                            </div>
                            {{-- <div class="row mt-60">
                                <div class="col-12">
                                    <h3 class="section-title style-1 mb-30">Productos Relacionados</h3>
                                </div>
                                <div class="col-12">
                                    <div class="row related-products">
                                        <div class="col-lg-3 col-md-4 col-12 col-sm-6">
                                            <div class="product-cart-wrap small hover-up">
                                                <div class="product-img-action-wrap">
                                                    <div class="product-img product-img-zoom">
                                                        <a href="product-details.html" tabindex="0">
                                                            <img class="default-img" src="assets/imgs/shop/product-2-1.jpg" alt="">
                                                            <img class="hover-img" src="assets/imgs/shop/product-2-2.jpg" alt="">
                                                        </a>
                                                    </div>
                                                    <div class="product-action-1">
                                                        <a aria-label="Quick view" class="action-btn small hover-up" data-bs-toggle="modal" data-bs-target="#quickViewModal"><i class="fi-rs-search"></i></a>
                                                        <a aria-label="Add To Wishlist" class="action-btn small hover-up" href="wishlist.php" tabindex="0"><i class="fi-rs-heart"></i></a>
                                                        <a aria-label="Compare" class="action-btn small hover-up" href="compare.php" tabindex="0"><i class="fi-rs-shuffle"></i></a>
                                                    </div>
                                                    <div class="product-badges product-badges-position product-badges-mrg">
                                                        <span class="hot">Hot</span>
                                                    </div>
                                                </div>
                                                <div class="product-content-wrap">
                                                    <h2><a href="product-details.html" tabindex="0">Ulstra Bass Headphone</a></h2>
                                                    <div class="rating-result" title="90%">
                                                        <span>
                                                        </span>
                                                    </div>
                                                    <div class="product-price">
                                                        <span>$238.85 </span>
                                                        <span class="old-price">$245.8</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-3 col-md-4 col-12 col-sm-6">
                                            <div class="product-cart-wrap small hover-up">
                                                <div class="product-img-action-wrap">
                                                    <div class="product-img product-img-zoom">
                                                        <a href="product-details.html" tabindex="0">
                                                            <img class="default-img" src="assets/imgs/shop/product-3-1.jpg" alt="">
                                                            <img class="hover-img" src="assets/imgs/shop/product-4-2.jpg" alt="">
                                                        </a>
                                                    </div>
                                                    <div class="product-action-1">
                                                        <a aria-label="Quick view" class="action-btn small hover-up" data-bs-toggle="modal" data-bs-target="#quickViewModal"><i class="fi-rs-search"></i></a>
                                                        <a aria-label="Add To Wishlist" class="action-btn small hover-up" href="wishlist.php" tabindex="0"><i class="fi-rs-heart"></i></a>
                                                        <a aria-label="Compare" class="action-btn small hover-up" href="compare.php" tabindex="0"><i class="fi-rs-shuffle"></i></a>
                                                    </div>
                                                    <div class="product-badges product-badges-position product-badges-mrg">
                                                        <span class="sale">-12%</span>
                                                    </div>
                                                </div>
                                                <div class="product-content-wrap">
                                                    <h2><a href="product-details.html" tabindex="0">Smart Bluetooth Speaker</a></h2>
                                                    <div class="rating-result" title="90%">
                                                        <span>
                                                        </span>
                                                    </div>
                                                    <div class="product-price">
                                                        <span>$138.85 </span>
                                                        <span class="old-price">$145.8</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-3 col-md-4 col-12 col-sm-6">
                                            <div class="product-cart-wrap small hover-up">
                                                <div class="product-img-action-wrap">
                                                    <div class="product-img product-img-zoom">
                                                        <a href="product-details.html" tabindex="0">
                                                            <img class="default-img" src="assets/imgs/shop/product-4-1.jpg" alt="">
                                                            <img class="hover-img" src="assets/imgs/shop/product-4-2.jpg" alt="">
                                                        </a>
                                                    </div>
                                                    <div class="product-action-1">
                                                        <a aria-label="Quick view" class="action-btn small hover-up" data-bs-toggle="modal" data-bs-target="#quickViewModal"><i class="fi-rs-search"></i></a>
                                                        <a aria-label="Add To Wishlist" class="action-btn small hover-up" href="wishlist.php" tabindex="0"><i class="fi-rs-heart"></i></a>
                                                        <a aria-label="Compare" class="action-btn small hover-up" href="compare.php" tabindex="0"><i class="fi-rs-shuffle"></i></a>
                                                    </div>
                                                    <div class="product-badges product-badges-position product-badges-mrg">
                                                        <span class="new">New</span>
                                                    </div>
                                                </div>
                                                <div class="product-content-wrap">
                                                    <h2><a href="product-details.html" tabindex="0">HomeSpeak 12UEA Goole</a></h2>
                                                    <div class="rating-result" title="90%">
                                                        <span>
                                                        </span>
                                                    </div>
                                                    <div class="product-price">
                                                        <span>$738.85 </span>
                                                        <span class="old-price">$1245.8</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-3 col-md-4 col-12 col-sm-6">
                                            <div class="product-cart-wrap small hover-up mb-0">
                                                <div class="product-img-action-wrap">
                                                    <div class="product-img product-img-zoom">
                                                        <a href="product-details.html" tabindex="0">
                                                            <img class="default-img" src="assets/imgs/shop/product-5-1.jpg" alt="">
                                                            <img class="hover-img" src="assets/imgs/shop/product-3-2.jpg" alt="">
                                                        </a>
                                                    </div>
                                                    <div class="product-action-1">
                                                        <a aria-label="Quick view" class="action-btn small hover-up" data-bs-toggle="modal" data-bs-target="#quickViewModal"><i class="fi-rs-search"></i></a>
                                                        <a aria-label="Add To Wishlist" class="action-btn small hover-up" href="wishlist.php" tabindex="0"><i class="fi-rs-heart"></i></a>
                                                        <a aria-label="Compare" class="action-btn small hover-up" href="compare.php" tabindex="0"><i class="fi-rs-shuffle"></i></a>
                                                    </div>
                                                    <div class="product-badges product-badges-position product-badges-mrg">
                                                        <span class="hot">Hot</span>
                                                    </div>
                                                </div>
                                                <div class="product-content-wrap">
                                                    <h2><a href="product-details.html" tabindex="0">Dadua Camera 4K 2022EF</a></h2>
                                                    <div class="rating-result" title="90%">
                                                        <span>
                                                        </span>
                                                    </div>
                                                    <div class="product-price">
                                                        <span>$89.8 </span>
                                                        <span class="old-price">$98.8</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>                             --}}
                        </div>
                    </div>
                    <div class="col-lg-3 primary-sidebar sticky-sidebar">
                        <div class="row">
                            <div class="col-lg-12 col-mg-6"></div>
                            <div class="col-lg-12 col-mg-6"></div>
                        </div>
                        <div class="widget-category mb-30">
                            <h5 class="section-title style-1 mb-30 wow fadeIn animated">Categorias</h5>
                            <ul class="categories">


                                @foreach ($categorias as $categoria)
                                    <form action="{{ route('categoria') }}" method="GET">

                                        <input type="hidden" name="buscar" value="{{ $categoria->id }}">
                                        <li><a href=""
                                               onclick="event.preventDefault(); this.closest('form').submit()">{{ $categoria->nombre }}</a>
                                        </li>


                                    </form>
                                @endforeach

                            </ul>
                        </div>


                        {{-- <div class="banner-img wow fadeIn mb-45 animated d-lg-block d-none">
                            <img src="assets/imgs/banner/banner-11.jpg" alt="">
                            <div class="banner-text">
                                <span>Women Zone</span>
                                <h4>Save 17% on <br>Office Dress</h4>
                                <a href="{{route('shoping')}}">Shop Now <i class="fi-rs-arrow-right"></i></a>
                            </div>
                        </div> --}}
                    </div>
                </div>
            </div>
        </section>
    </main>
</div>
