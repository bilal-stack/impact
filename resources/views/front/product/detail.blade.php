@extends('front.layouts.app')

@section('template_title')
    Product {{$product->title}}
@endsection

@section('template_linked_css')
@endsection

@section('template_fastload_css')
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
            <div class="row">
                <div class="col-md-6">
                    <div class="product-img" >
                        <div class="zoom-area">
                            <div class="large"></div>
                            <img src="{{$product->getFirstMediaUrl('product-images')}}" alt=""  class="small img-fluid">
                        </div>
                    </div>
                    <div class="click-link">
                        <p>
                            <a href="">Click to enlarge</a>
                        </p>
                    </div>
                    <div class="row icon-menu">
                        <div class="col">
                            <a href="#"><img src="{{asset('front/assets/images/icon-movie.png')}}" alt=""><br>
                                <p> Live Preview AR</p></a>
                        </div>
                        <div class="col">
                            <a href="#"><img src="{{asset('front/assets/images/icon-image.png')}}" alt=""><br>
                                <p>Wall Preview</p> </a>
                        </div>
                        <div class="col">
                            <a href="#"><img src="{{asset('front/assets/images/icon-3d.png')}}" alt=""><br>
                                <p>360 view Tool</p></a>
                        </div>
                        <div class="col">
                            <a href="#"><img src="{{asset('front/assets/images/icon-heart.png')}}" alt=""><br>
                                <p>Save To Favorites</p></a>
                        </div>
                        <div class="col">
                            <a href="#"><img src="{{asset('front/assets/images/icon-email.png')}}" alt=""><br>
                                <p>Email a Friend</p></a>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 px-4">
                    <div class="product-info">
                        <h1>{{$product->title}}</h1>
                        <h2 class="prize bold"> <b> 120$ </b></h2>
                    </div>
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
                                        <div class="row">
                                            @foreach($variations as $var)
                                                <div class="col-md-3">
                                                    <div class="border-img variation_div" onclick="updateSelectedVariation(this)">
                                                        <img src="{{asset('storage/'.$var->option_image)}}" alt="" onclick="triggerVariationEvent(this, '{{$product->id}}', '{{ $var->id}}')">
                                                        <span class="tick"></span>
                                                        <h6 class=""><small>{{$var->title}}</small></h6>
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
                                        <div class="row">
                                            @foreach($sizes as $size)
                                                <div class="col-md-3 mb-2 size">
                                                    <a href="#">
                                                        <div class="border-sizes size_div" onclick="updateSelectedSize(this)">
                                                            <label>{{$size->title}}</label>
                                                        </div>
                                                    </a>
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
                                        <div class="row">
                                            @foreach($styles as $style)
                                            <div class="col-md-3 style_div">
                                                <div class="border-img" onclick="updateSelectedStyle(this)">
                                                    <img src="{{asset('storage/variation-style-option-images/'.$style->option_image)}}" alt="" onclick="toggleTick(this)">
                                                    <span class="tick"></span>
                                                    <h6><small>{{$style->title}}</small></h6>
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
    <script src="{{asset('js/front/product/product.js')}}"></script>
@endsection