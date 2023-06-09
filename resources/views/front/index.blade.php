@extends('front.layouts.app')

@section('content')
<!-- Banner Sec  -->
<section class="banner">
    <div class="container">
        <div class="row">
            <div class="col-md-2">
                <div class="slide-image">
                    <img src="{{asset('front/assets/images/banner-inner3.png')}}" alt="">
                </div>
                <div class="slide-image2">
                    <img src="{{asset('front/assets/images/banner-inner4.png')}}" alt="">
                </div>
            </div>
            <div class="col-md-8 z-10">
                <div class="heading-banner">
                    <h1 class="">Photography as </h1>
                    <h1 class="text-center">Art for Home </h1>
                    <h1 class="text-center">& Office</h1>
                </div>
                <div class="banner-btn">
                    <a href="#"><img src="{{asset('front/assets/images/btn.png')}}" alt=""></a>
                </div>
            </div>
            <div class="col-md-2">
                <div class="slide-image3">
                    <img src="{{asset('front/assets/images/banner-inner2.png')}}" alt="">
                </div>
                <div class="slide-image4">
                    <img src="{{asset('front/assets/images/banner-inner1.png')}}" alt="">
                </div>

            </div>
        </div>
    </div>
</section>
<!-- Banner Sec  -->
<section class="social-sec">
    <div class="container">
        <div class="row">
            <div class="row col-md-6">

            </div>
            <div class="row col-md-6">
                <div class="social-icon-box">
                    <span><a href=""><i class="fa-brands fa-facebook-f"></i></a></span>
                    <span><a href=""><i class="fa-brands fa-youtube"></i></a></span>
                    <span><a href=""><i class="fa-brands fa-instagram"></i></a></span>
                    <span><a href=""><i class="fa-brands fa-linkedin-in"></i></a></span>
                    <span><a href=""><i class="fa-brands fa-twitter"></i></a></span>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- About Us sec  -->
<section class="about-section">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <h1 class="stoke-heading">About Me</h1>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <div class="about-info">
                    <h1>About Me</h1>
                    <p>I have enjoyed photography as a means to explore myself.  Seeing the world and observing wildlife provides a mirror to understand my own spirit and values.  Some say a camera inhibits observation, but I believe the opposite is true.  The camera is a tool to enhance an experience and increase understanding.  Standing for hours watching the sun move across the sky fosters patience.  Kneeling for hours observing an animal enter the light during the golden hour makes the heart beat faster and stimulates the brain.  Sitting in the foreground of a mountain or nightscape provides a sense of scale and perspective.</p>
                </div>
                <div class="about-btn">
                    <a href="" class="golbal-btn">Read More</a>
                </div>
            </div>
            <div class="col-md-6">
                <div class="about-img">
                    <img src="{{asset('front/assets/images/about.png')}}" alt="">
                </div>
            </div>
        </div>
    </div>
</section>
<!-- About Us sec  -->
<!-- shop art sec  -->
<section class="shop-art">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <h1 class="stoke-heading text-center">shop art</h1>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="shop-title mb-5">
                    <h1>Floral Art Photography </h1>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <div class="porduct-image">
                    <img src="{{asset('front/assets/images/flora-1.png')}}" alt="">
                    <div class="product-cart">
                        <span><a href=""><i class="fa-solid fa-heart"></i></a></span>
                        <span><a href=""><i class="fa-solid fa-cart-plus"></i></a></span>
                        <span><a href=""><i class="fa-solid fa-magnifying-glass-plus"></i></a></span>
                    </div>
                </div>

            </div>
            <div class="col-md-4">
                <div class="porduct-image">
                    <img src="{{asset('front/assets/images/Layer 12.png')}}" alt="">
                    <div class="product-cart">
                        <span><a href=""><i class="fa-solid fa-heart"></i></a></span>
                        <span><a href=""><i class="fa-solid fa-cart-plus"></i></a></span>
                        <span><a href=""><i class="fa-solid fa-magnifying-glass-plus"></i></a></span>
                    </div>
                </div>

            </div>
            <div class="col-md-4">
                <div class="porduct-image">
                    <img src="{{asset('front/assets/images/flora-3.png')}}" alt="">
                    <div class="product-cart">
                        <span><a href=""><i class="fa-solid fa-heart"></i></a></span>
                        <span><a href=""><i class="fa-solid fa-cart-plus"></i></a></span>
                        <span><a href=""><i class="fa-solid fa-magnifying-glass-plus"></i></a></span>
                    </div>
                </div>

            </div>
        </div>
    </div>
</section>
<!-- shop art sec  -->
<!-- wlid life  -->
<section class="wild-life">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="shop-title mb-5">
                    <h1>Wild Life </h1>
                </div>
            </div>
            <div class="col-md-2">
                <div class="wild-inner">
                    <img src="{{asset('front/assets/images/wild-1.png')}}" alt="">
                    <p>Big Cats</p>
                </div>
            </div>
            <div class="col-md-2">
                <div class="wild-inner">
                    <img src="{{asset('front/assets/images/wild-2.png')}}" alt="">
                    <p>Feathered Wings</p>
                </div>
            </div>
            <div class="col-md-2">
                <div class="wild-inner">
                    <img src="{{asset('front/assets/images/Layer 16.png')}}" alt="">
                    <p>Bears of North  <br>
                        America </p>
                </div>
            </div>
            <div class="col-md-2">
                <div class="wild-inner">
                    <img src="{{asset('front/assets/images/wild-4.png')}}" alt="">
                    <p>Elephants </p>
                </div>
            </div>
            <div class="col-md-2">
                <div class="wild-inner">
                    <img src="{{asset('front/assets/images/wild-5.png')}}" alt="">
                    <p>Zebras </p>
                </div>
            </div>
            <div class="col-md-2">
                <div class="wild-inner">
                    <img src="{{asset('front/assets/images/wild-6.png')}}" alt="">
                    <p>Giraffe </p>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- wlid life  -->
<!-- shop art2 sec -->
<section class="shop-art">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="shop-title">
                    <h1>Big Cats</h1>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-3">
                <div class="porduct-image">
                    <img src="{{asset('front/assets/images/big-cat1.png')}}" alt="">
                    <div class="product-cart">
                        <span><a href=""><i class="fa-solid fa-heart"></i></a></span>
                        <span><a href=""><i class="fa-solid fa-cart-plus"></i></a></span>
                        <span><a href=""><i class="fa-solid fa-magnifying-glass-plus"></i></a></span>
                    </div>
                </div>

            </div>
            <div class="col-md-3">
                <div class="porduct-image">
                    <img src="{{asset('front/assets/images/big-cat2.png')}}" alt="">
                    <div class="product-cart">
                        <span><a href=""><i class="fa-solid fa-heart"></i></a></span>
                        <span><a href=""><i class="fa-solid fa-cart-plus"></i></a></span>
                        <span><a href=""><i class="fa-solid fa-magnifying-glass-plus"></i></a></span>
                    </div>
                </div>

            </div>
            <div class="col-md-3">
                <div class="porduct-image">
                    <img src="{{asset('front/assets/images/big-cat3.png')}}" alt="">
                    <div class="product-cart">
                        <span><a href=""><i class="fa-solid fa-heart"></i></a></span>
                        <span><a href=""><i class="fa-solid fa-cart-plus"></i></a></span>
                        <span><a href=""><i class="fa-solid fa-magnifying-glass-plus"></i></a></span>
                    </div>
                </div>

            </div>
            <div class="col-md-3">
                <div class="porduct-image">
                    <img src="{{asset('front/assets/images/big-cat4.png')}}" alt="">
                    <div class="product-cart">
                        <span><a href=""><i class="fa-solid fa-heart"></i></a></span>
                        <span><a href=""><i class="fa-solid fa-cart-plus"></i></a></span>
                        <span><a href=""><i class="fa-solid fa-magnifying-glass-plus"></i></a></span>
                    </div>
                </div>

            </div>
            <div class="col-md-12">
                <!-- <div class="about-btn d-block mx-auto">
                    <a href="" class="golbal-btn">Read More</a>
                </div> -->
            </div>
        </div>
    </div>
</section>
<!-- shop art2 sec -->
<!-- shop art sec  -->
<section class="shop-art">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="shop-title mb-5">
                    <h1>Equine</h1>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <div class="porduct-image">
                    <img src="{{asset('front/assets/images/equine-1.png')}}" alt="">
                    <div class="product-cart">
                        <span><a href=""><i class="fa-solid fa-heart"></i></a></span>
                        <span><a href=""><i class="fa-solid fa-cart-plus"></i></a></span>
                        <span><a href=""><i class="fa-solid fa-magnifying-glass-plus"></i></a></span>
                    </div>
                </div>

            </div>
            <div class="col-md-4">
                <div class="porduct-image">
                    <img src="{{asset('front/assets/images/equine-2.png')}}" alt="">
                    <div class="product-cart">
                        <span><a href=""><i class="fa-solid fa-heart"></i></a></span>
                        <span><a href=""><i class="fa-solid fa-cart-plus"></i></a></span>
                        <span><a href=""><i class="fa-solid fa-magnifying-glass-plus"></i></a></span>
                    </div>
                </div>

            </div>
            <div class="col-md-4">
                <div class="porduct-image">
                    <img src="{{asset('front/assets/images/equine-3.png')}}" alt="">
                    <div class="product-cart">
                        <span><a href=""><i class="fa-solid fa-heart"></i></a></span>
                        <span><a href=""><i class="fa-solid fa-cart-plus"></i></a></span>
                        <span><a href=""><i class="fa-solid fa-magnifying-glass-plus"></i></a></span>
                    </div>
                </div>

            </div>
        </div>
    </div>
</section>
<!-- shop art sec  -->
<!-- contact sec  -->
<section class="contact-form">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <div class="conect-form">
                    <div class="about-info">
                        <h1>Get In Touch</h1>
                    </div>
                    <form action="" class="from-group">
                        <div class="row">
                            <div class="col-md-12">
                                <input type="email" id="email"  placeholder="Email" class="form-control">
                            </div>
                            <div class="col-md-12">
                                <input type="text" id="name"  placeholder="Name" class="form-control">
                            </div>
                            <div class="col-md-12">
                                <textarea name="" id="" cols="30" rows="4" placeholder="Message" class="form-control"></textarea>
                            </div>
                            <div class="col-md-12">
                                <input type="submit" id="submit" value="submit"  class="form-control">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- contact sec  -->
<!-- Award sec  -->
<section class="award-sec">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1 class="stoke-heading text-center">trusted</h1>
            </div>
        </div>
    </div>
    <div class="container inner">
        <div class="row">
            <div class="col-md-6">
                <div class="row border">
                    <div class="col-md-4">
                        <div class="award-img">
                            <img src="{{asset('front/assets/images/award-1.png')}}" alt="">
                        </div>
                    </div>
                    <div class="col-md-8">
                        <div class="award-para">
                            <h6>TRUSTED ART SELLER</h6>
                            <p>The presence of this badge signifies that this business has officially registered with the Art Storefronts Organization and has an established track record of selling art.                                </p>
                            <a href="">Read More</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="award-img1">
                    <img src="{{asset('front/assets/images/award-2.png')}}" alt="" class="text-center">
                </div>
            </div>
            <div class="col-md-3">
                <div class="award-img1  ">
                    <img src="{{asset('front/assets/images/award-3.png')}}" alt="">
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Award sec  -->
@endsection
