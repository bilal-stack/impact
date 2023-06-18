@extends('front.layouts.app')

@section('content')
    <!-- Inner Page Banner  -->
    <section class="inner-banner">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="inner-page-heading">
                        <h1>FAQS</h1>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Inner Page Banner  -->
    <!-- About Us sec  -->
    <section class="about-section" style="margin-bottom: 0!important;">
        <div class="container-fluid">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <div class="about-info">
                        <h1>Frequently Asked Questions</h1>
                        <p>I have enjoyed photography as a means to explore myself. Seeing the world and observing wildlife provides a mirror to understand my own spirit and values. Some say a camera inhibits observation, but I believe the opposite is true. The camera is a tool to enhance an experience and increase understanding. Standing for hours watching the sun move across the sky fosters patience. Kneeling for hours observing an animal enter the light during the golden hour makes the heart beat faster and stimulates the brain. Sitting in the foreground of a mountain or nightscape provides a sense of scale and perspective.
                        </p>
                        <p>I am a retired lawyer. I spent most of my adult life in courtrooms across the country. I enjoyed the career, but as I gained experience in that world I also hungered for something more creative. I began to experience other worlds by visiting Africa, Antarctica, the Arctic, and North America as well as Europe. I now pursue photography full time, traveling throughout the world to hone my craft. I enjoy sharing my experience through photography and videography, because I find that creates this same joyful energy in others who choose to enjoy my work.</p>
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

@endsection