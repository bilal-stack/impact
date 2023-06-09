@extends('front.layouts.app')
@section('template_title')
    Shop
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
                        <h1>Shop Art</h1>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Inner Page Banner  -->
    <!-- category sec  -->
    <section class="flora-art">
        <div class="container">
            <div class="row">
                @foreach($categories as $category)
                <div class="col-4 mt-4 mb-4">
                    <div class="catigory-flora-inner">
                        <a href="{{route('shop.category.product', $category->slug)}}">
                            <img width="50%" src="{{$category->getFirstMediaUrl('category-images')}}"/>
                        </a>
                        <div class="prduct-price-list">
                            <h3><a class="text-decoration-none text-black-50" href="{{route('shop.category.product', $category->slug)}}">{{$category->title}}</a></h3>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>
    <!-- category sec  -->
@endsection
