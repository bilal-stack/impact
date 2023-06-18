@extends('front.layouts.app')

@section('content')
    <!-- Inner Page Banner  -->
    <section class="inner-banner">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="inner-page-heading">
                        <h1>Contact us</h1>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Inner Page Banner  -->


    <!-- contact sec  -->
    <section class="contact-form">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-7">
                    <div class="conect-form">
                        <div class="about-info">
                            <h1>Get In Touch</h1>
                        </div>
                        <form action="" class="from-group">
                            <div class="row">
                                <div class="col-md-12">
                                    <input type="text" id="name"  placeholder="Name" class="form-control">
                                </div>
                                <div class="col-md-12">
                                    <input type="email" id="email"  placeholder="Email" class="form-control">
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
@endsection