@extends('front.layouts.app')

@section('template_title')
    Product {{$product->title}}
@endsection

@section('css')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fancyapps/ui@5.0/dist/fancybox/fancybox.css"/>
   <style>
       .accordion-body {
           padding-bottom: 22px;
       }

       .page-navigation {
           padding-top: 16px;
           text-align: center;
       }

       .page-navigation a {
           color: grey;
           padding: 3px 7px;
           text-decoration: none;
           border: 1px solid #ddd; /* Gray */
       }

       .page-navigation a[data-selected] {
           background-color: #7f032f;
           color: white;
       }

       .page-navigation a:hover:not(.active) {
           background-color: #ddd;
       }

   </style>
@endsection

@section('content')

    <!-- Inner Page Banner  -->
    <section class="inner-banner">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="inner-page-heading">
                        <h1>{{$product->title}}</h1>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Inner Page Banner  -->
    <!-- product detail sec -->

    <section class="product-sec my-5">
        <div class="container">
            @if($errors->any())
                @foreach ($errors->all() as $error)
                    <p class="shopping-info-txt text-danger"><i class="fas fa-info-circle"></i>
                        {{ $error }}
                        @endforeach
                    </p>
                    @endif

                    @if(session('success'))
                        <div class="alert alert-success">{{session('success')}}</div>
                    @endif

                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

            <section id="loading">
                <div id="loading-content"></div>
            </section>
            <div class="row">
                <div class="col-md-6">
                    <div class="product-img">
                        <div class="zoom-area">
                            <div class="large"></div>
                            <img id="product-image" src="{{$product->getFirstMediaUrl('product-images')}}" alt="product-image" data-caption="Single image" class="small img-fluid">
                        </div>
                    </div>
                    <div class="click-link">
                        <small>
                            <a id="click-enlarge" data-fancybox href="{{$product->getFirstMediaUrl('product-images')}}">Click to enlarge</a>
                        </small>
                    </div>
                    <div class="row icon-menu">
                        <div class="col">
                            <a href="#">
                                <img src="{{asset('front/assets/images/icon-movie.png')}}" alt=""><br>
                                <p> Live Preview AR</p>
                            </a>
                        </div>
                        <div class="col">
                            <a href="#">
                                <img src="{{asset('front/assets/images/icon-image.png')}}" alt=""><br>
                                <p>Wall Preview</p>
                            </a>
                        </div>
                        <div class="col">
                            <a href="#">
                                <img src="{{asset('front/assets/images/icon-3d.png')}}" alt=""><br>
                                <p>360 view Tool</p>
                            </a>
                        </div>
                        <div class="col">
                            <a href="{{route('favorite.add', $product->slug)}}">
                                <img src="{{asset('front/assets/images/icon-heart.png')}}" alt=""><br>
                                <p>Save To Favorites</p>
                            </a>
                        </div>
                        <div class="col">
                            <a href="#">
                                <img src="{{asset('front/assets/images/icon-email.png')}}" alt=""><br>
                                <p>Email a Friend</p>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 px-4">
                    <div class="product-info">
                        <h3>{{$product->title}}</h3>
                        <h2 class="prize bold">
                            <b id="product-price"> ${{$price}} </b>
                        </h2>
                    </div>
                    <form action="{{route('cart.store')}}" method="post">
                        @csrf
                        <input type="hidden" name="product" value="{{$product->slug}}">
                        <input type="hidden" name="variation" value="" id="variation_input">
                        <input type="hidden" name="size" value="" id="size_input">
                        <input type="hidden" name="style" value="" id="style_input">
                        <input type="hidden" name="price" value="{{$price}}" id="price_input">
                    <div class="row">
                        <div class="col-md-12 mb-3">
                            <span>Add a message</span>
                            <textarea name="message" class="form-control" style="width: 85%"></textarea>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-2">
                            <input required type="number" class="form-control" name="qty" value="1"/>
                        </div>
                        <div class="col-md-4">
                            <button type="submit" class="btn btn-dark" style="width: 100%">Add to cart</button>
                        </div>
                        <div class="col-md-4">
                            <button type="submit" class="btn btn-dark" >Instant Checkout</button>
                        </div>
                    </div>
                    </form>
                    <div class="product-border">
                        <div class="accordion" id="accordionExample">
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="headingOne">
                                    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                        #1 Medium:&nbsp;&nbsp; <span id="selected-variation-title"></span>
                                    </button>
                                </h2>
                                <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                                    <div class="accordion-body">
                                        <div class="row m-pagination" id="variations-row">
                                            @foreach($variations as $var)
                                                <div class="col-md-3">
                                                    <div class="border-img variation_div" onclick="updateSelectedVariation(this)">
                                                        <img class="variation-image" src="{{asset('storage/'.$var->option_image)}}" alt="" onclick="triggerVariationEvent(this, '{{$product->slug}}', '{{ $var->id}}')">
                                                        <span class="tick"></span>
                                                        <h6 onclick="triggerVariationEvent(this, '{{$product->slug}}', '{{ $var->id}}')" class="">
                                                            <small>{{$var->title}}</small>
                                                        </h6>
                                                        <label class="variation-info d-none">{{$var->id}}</label>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="headingTwo">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                        #2 Size:&nbsp;&nbsp; <span id="selected-size-title"></span>
                                    </button>
                                </h2>
                                <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                                    <div class="accordion-body">
                                        <div class="row" id="sizes-row">
                                            @foreach($sizes as $size)
                                                <div class="col-md-3 mb-2 size">
                                                    <div class="border-sizes size_div" onclick="triggerSizeEvent(this, '{{$product->slug}}', {{$size->id}})">
                                                        <label data-info="{{$size->id}}">{{$size->title}}</label>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                        <small style="font-size: .675em;">* sizes are in width x height format, in inches</small>
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="headingThree">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                        #3 Style:&nbsp;&nbsp; <span id="selected-style-title"></span>
                                    </button>
                                </h2>
                                <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#accordionExample">
                                    <div class="accordion-body">
                                        <div class="row" id="styles-row">
                                            @foreach($styles as $style)
                                                <div class="col-md-3 style_div">
                                                    <div class="border-img" onclick="triggerStyleEvent(this, '{{$product->slug}}', {{$style->id}})">
                                                        <img src="{{asset('storage/variation-style-option-images/'.$style->option_image)}}" alt="" onclick="toggleTickStyle(this)">
                                                        <span class="style-tick"></span>
                                                        <h6><small>{{$style->title}}</small></h6>
                                                        <label class="variation-style-info d-none">{{$style->id}}</label>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- product detail sec -->
@endsection

@section('footer_scripts')
    <script src="{{asset('js/pagination/jquery-paginate.min.js')}}" type="text/javascript"></script>
    <script>
        var baseUrl = '{!! url("/") !!}/';
        var selectedVariation = '';
        var selectedSize = '';
        var selectedStyle = '';
        var styleImagePath = '{!! asset('storage/variation-style-option-images/') !!}';

        $('#variations-row').paginate({
            childrenSelector:'div',
            limit: 24,
            previous:false,
            next:false,
            first:false,
            last:false,
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/@fancyapps/ui@5.0/dist/fancybox/fancybox.umd.js"></script>
    <script>
        Fancybox.bind("[data-fancybox]", {
            // Your custom options
        });
    </script>
    <script src="{{asset('js/front/product/other.js')}}"></script>
    <script src="{{asset('js/front/product/product.js')}}"></script>
@endsection