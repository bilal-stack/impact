@extends('front.layouts.app')

@section('content')
    <!-- Inner Page Banner  -->
    <section class="inner-banner">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="inner-page-heading">
                        <h1>{{$category->title}}</h1>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Inner Page Banner  -->
    <!-- category flora art sec  -->
    <section class="flora-art">
        <div class="container">
            <div class="row my-5">
                @foreach($products as $product)
                <div class="col-md-3">
                    <div class="catigory-flora-inner">
                        <img src="{{$product->getFirstMediaUrl('product-images')}}" alt="">
                        <div class="prduct-price-list">
                            <h3>{{$product->title}}</h3>
                            <div class="review-icon">
                                <span><i class="fa-regular fa-star"></i></span>
                                <span><i class="fa-regular fa-star"></i></span>
                                <span><i class="fa-regular fa-star"></i></span>
                                <span><i class="fa-regular fa-star"></i></span>
                                <span><i class="fa-regular fa-star"></i></span>
                            </div>
                            <p></p>
                            <a href="#" class="golbal-btn">Details</a>
                        </div>
                    </div>
                </div>
                    @endforeach
            </div>
        </div>
    </section>
    <!-- category flora art sec  -->
@endsection
