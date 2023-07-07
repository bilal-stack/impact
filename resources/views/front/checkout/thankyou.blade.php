@extends('front.layouts.app')
@section('content')
    <!-- Inner Page Banner  -->
    <section class="inner-banner">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="inner-page-heading">
                        <h1>Thankyou</h1>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Inner Page Banner  -->
    <!-- cart section  -->
    <section class="cart-main my-5">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    Your Order has been Placed,
                    Order Number is : {{$order->order_number}}
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
