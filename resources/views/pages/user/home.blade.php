@extends('front.layouts.app')

@section('template_title')
    {{ Auth::user()->name }}'s' Homepage
@endsection

@section('css')
    <link href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
    <link href="https://cdn.datatables.net/responsive/2.4.1/css/responsive.dataTables.min.css">
@endsection

@section('content')

    <!-- Inner Page Banner  -->
    <section class="inner-banner-dashboard">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="inner-page-heading">
                        <h1>{{ Auth::user()->name }}'s' Dashboard</h1>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Inner Page Banner  -->

    <!-- Start Dashboard section  -->
    <div class="container container-dashboard">
        <div class="sidebar">
            <h3>Welcome</h3>
            <ul>
                <li><a href="#">Orders</a></li>
                <li><a href="#">Order Details</a></li>
                <li><a href="{{ url('/profile/'.Auth::user()->name) }}">User Profile</a></li>
            </ul>
        </div>
        <div class="content">
            <div class="row">
                <div class="widget col-md-4 m-1">
                    <h4>Number of Orders</h4>
                    <p id="orderCount">0</p>
                </div>
                <div class="widget col-md-4 m-1">
                    <h4>Total Price</h4>
                    <p id="totalPrice">$0</p>
                </div>
            </div>
            <hr>
            <div class="row">
                <h4>Recent Orders</h4>
                <table id="orderDetailsTable" class="table table-striped">
                    <thead>
                    <tr>
                        <th>Order ID</th>
                        <th>Product</th>
                        <th>Quantity</th>
                        <th>Price</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td>1</td>
                        <td>Product A</td>
                        <td>2</td>
                        <td>$50</td>
                    </tr>
                    <tr>
                        <td>1</td>
                        <td>Product B</td>
                        <td>3</td>
                        <td>$20</td>
                    </tr>
                    <tr>
                        <td>2</td>
                        <td>Product C</td>
                        <td>1</td>
                        <td>$150</td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!-- End Dashboard section  -->



@endsection

@section('footer_scripts')
    <script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.25/js/dataTables.bootstrap.min.js"></script>

    <script>
        $(document).ready(function() {
            $('#orderDetailsTable').DataTable();
        });
    </script>
@endsection
