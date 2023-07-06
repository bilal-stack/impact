@extends('front.layouts.app')
@section('content')
    <!-- Inner Page Banner  -->
    <section class="inner-banner">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="inner-page-heading">
                        <h1>Cart</h1>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Inner Page Banner  -->
    <!-- cart section  -->
    <section class="cart-main my-5">
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
            <div class="row">
                <div class="col-md-12">
                    <div class="cart-table">
                        <table id="example" class="table table-striped dt-responsive nowrap" style="width:100%">
                            <thead>
                            <tr>
                                <th></th>
                                <th></th>
                                <th>Product</th>
                                <th>Price</th>
                                <th>Quantity</th>
                            </thead>
                            <tbody>
                            @foreach($cartItems as $key => $item)
                            <tr class="cart-table-row">
                                <td>
                                    <form id="remove-form" style="display: contents" action="{{ route('cart.remove') }}" method="POST">
                                        {{ csrf_field() }}
                                        <input type="hidden" value="{{ $item->id }}" name="id">
                                        <p><a style="cursor: pointer" onclick="event.preventDefault();
                                                         document.getElementById('remove-form').submit();">
                                                <i class="fa-solid fa-xmark"></i>
                                            </a>
                                        </p>
                                    </form>
                                </td>
                                <td width="50%">
                                    <img src="{{$item->attributes->image}}" alt="{{$item->name}}" width="10%"></td>
                                <td>
                                    <a target="_blank" href="{{route('shop.category.product.show', [$item->attributes->category, $item->attributes->product_slug])}}">
                                        {{$item->name}}
                                    </a>
                                    <br>
                                    {{$item->attributes->variation_title}}
                                    <br>
                                    Size in Inches: {{$item->attributes->variation_size}}
                                </td>
                                <td>${{$item->price}}</td>
                                <td>
                                    {{$item->quantity}}
                                </td>
                            </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="col-md-6">
                    <form action="" class="coupon-form">
                        <div class="row">
                            <div class="col-md-6">
                                <input type="text" id="coupon" placeholder="Coupon Coupon">
                            </div>
                            <div class="col-md-6">
                                <input type="button" id="submite" value="Apply Coupon">
                            </div>
                        </div>
                    </form>
                </div>
                <div class="col-md-6">
                    <div class="update-btn">
                        <a href="#" class="golbal-btn">Update Cart</a>
                        <a href="{{route('cart.clear')}}" class="golbal-btn">Clear Cart</a>
                    </div>
                </div>
                <div class="col-md-6"></div>
                <div class="col-md-6">
                    <div class="Cart-totals">
                        <h1>Cart totals</h1>
                        <div class="row last-cart">
                            <div class="col-md-4">
                                <p> Subtotal</p>
                            </div>
                            <div class="col-md-4">
                                ${{ Cart::getSubTotal() }}
                            </div>
                            <div class="col-md-4"></div>
                        </div>
                        <div class="row last-cart">
                            <div class="col-md-4">
                                <p> Total</p>
                            </div>
                            <div class="col-md-4">
                                ${{ Cart::getTotal() }}
                            </div>
                            <div class="col-md-4"></div>
                        </div>
                    </div>
                    <div class="last-cart-btn">
                        <a href="#" class="golbal-btn">Checkout</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- cart section  -->
@endsection
@section('footer_scripts')
    <script>
        $(document).ready(function() {
            $('.minus').click(function () {
                var $input = $(this).parent().find('.qty');
                var count = parseInt($input.val()) - 1;
                count = count < 1 ? 1 : count;
                $input.val(count);
                $input.change();
                return false;
            });
            $('.plus').click(function () {
                var $input = $(this).parent().find('.qty');
                $input.val(parseInt($input.val()) + 1);
                $input.change();
                return false;
            });
        });
    </script>
@endsection
