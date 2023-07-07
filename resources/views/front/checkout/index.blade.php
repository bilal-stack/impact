@extends('front.layouts.app')
@section('content')
    <!-- Inner Page Banner  -->
    <section class="inner-banner">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="inner-page-heading">
                        <h1>CheckOut</h1>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Inner Page Banner  -->
    <!-- Checkout section  -->
    <section class="checkout-main my-5">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <h2>Billing Information</h2>
                    <form action="{{route('order.store')}}" class="billing-form" method="post">
                        @csrf
                        <div class="mb-3">
                            <label for="firstName" class="form-label">First Name</label>
                            <input value="{{old('first_name')}}" type="text" class="form-control {{ $errors->has('first_name') ? ' is-invalid' : '' }}" id="firstName" name="first_name" placeholder="Enter your first name" required>
                            @if ($errors->has('first_name'))
                                <span class="invalid-feedback">
                                    <strong>{{ $errors->first('first_name') }}</strong>
                                </span>
                            @endif
                        </div>

                        <div class="mb-3">
                            <label for="lastName" class="form-label">Last Name</label>
                            <input value="{{old('last_name')}}" type="text" class="form-control {{ $errors->has('last_name') ? ' is-invalid' : '' }}" id="lastName" name="last_name" placeholder="Enter your last name" required>
                            @if ($errors->has('last_name'))
                                <span class="invalid-feedback">
                                    <strong>{{ $errors->first('last_name') }}</strong>
                                </span>
                            @endif
                        </div>

                        <div class="mb-3">
                            <label for="">Country / Region </label>
                            <select class="form-select {{ $errors->has('country') ? ' is-invalid' : '' }}" id="country" required name="country">
                                <option value="">Select your country or region</option>
                                <option value="USA">United States</option>
                                <option value="Canada">Canada</option>
                                <option value="UK">United Kingdom</option>
                                <option value="Australia">Australia</option>
                                <option value="Germany">Germany</option>
                                <option value="France">France</option>
                                <option value="Japan">Japan</option>
                                <!-- Add more country options here -->
                            </select>

                            @if ($errors->has('country'))
                                <span class="invalid-feedback">
                                    <strong>{{ $errors->first('last_name') }}</strong>
                                </span>
                            @endif
                        </div>

                        <div class="mb-3">
                            <label for="streetAddress" class="form-label">Street Address</label>
                            <input value="{{old('address')}}" name="address" type="text" class="form-control {{ $errors->has('address') ? ' is-invalid' : '' }}" id="streetAddress" placeholder="Enter your street address" required>
                            @if ($errors->has('address'))
                                <span class="invalid-feedback">
                                    <strong>{{ $errors->first('address') }}</strong>
                                </span>
                            @endif
                        </div>

                        <div class="mb-3">
                            <label for="city" class="form-label">Town / City</label>
                            <input value="{{old('city')}}" name="city" type="text" class="form-control {{ $errors->has('city') ? ' is-invalid' : '' }}" id="city" placeholder="Enter your town or city" required>
                            @if ($errors->has('city'))
                                <span class="invalid-feedback">
                                    <strong>{{ $errors->first('city') }}</strong>
                                </span>
                            @endif
                        </div>

                        <div class="mb-3">
                            <label for="state" class="form-label">State</label>
                            <input value="{{old('state')}}" name="state" type="text" class="form-control {{ $errors->has('state') ? ' is-invalid' : '' }}" id="state" placeholder="Enter your state" required>
                            @if ($errors->has('state'))
                                <span class="invalid-feedback">
                                    <strong>{{ $errors->first('state') }}</strong>
                                </span>
                            @endif
                        </div>

                        <div class="mb-3">
                            <label for="zipCode" class="form-label">ZIP Code</label>
                            <input value="{{old('zip')}}" name="zip" type="text" class="form-control {{ $errors->has('zip') ? ' is-invalid' : '' }}" id="zipCode" placeholder="Enter your ZIP code" required>
                            @if ($errors->has('zip'))
                                <span class="invalid-feedback">
                                    <strong>{{ $errors->first('zip') }}</strong>
                                </span>
                            @endif
                        </div>

                        <div class="mb-3">
                            <label for="phone" class="form-label">Phone</label>
                            <input value="{{old('phone')}}" name="phone" type="text" class="form-control {{ $errors->has('phone') ? ' is-invalid' : '' }}" id="phone" placeholder="Enter your phone number" required>
                            @if ($errors->has('phone'))
                                <span class="invalid-feedback">
                                    <strong>{{ $errors->first('phone') }}</strong>
                                </span>
                            @endif
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label">Email Address</label>
                            <input value="{{old('email')}}" name="email" type="email" class="form-control {{ $errors->has('email') ? ' is-invalid' : '' }}" id="email" placeholder="Enter your email address" required>
                            @if ($errors->has('email'))
                                <span class="invalid-feedback">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                            @endif
                        </div>

                        <div class="mb-3">
                            <label for="orderNotes" class="form-label">Order Notes</label>
                            <textarea name="notes" class="form-control" id="orderNotes" placeholder="Enter any additional notes">{{old('notes')}}</textarea>
                            @if ($errors->has('notes'))
                                <span class="invalid-feedback">
                                    <strong>{{ $errors->first('notes') }}</strong>
                                </span>
                            @endif
                        </div>

                        <button type="submit" class="btn btn-primary">Place Order</button>
                    </form>
                </div>
                <div class="col-lg-6">
                    <h2>Product Details</h2>
                    <table class="table product-detail-list">
                        <thead>
                        <tr>
                            <th>Product</th>
                            <th>Price</th>
                            <th>Quantity</th>
                            <th>Total</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($cartItems as $item)
                            <tr>
                                <td>{{$item->name}}</td>
                                <td>${{$item->price}}</td>
                                <td>{{$item->quantity}}</td>
                                <td>{{$item->price * $item->quantity}}</td>
                            </tr>
                        @endforeach
                        </tbody>
                        <tfoot>
                        <tr>
                            <td colspan="3" class="text-end">Subtotal:</td>
                            <td>${{ Cart::getSubTotal() }}</td>
                        </tr>
                        <tr>
                            <td colspan="3" class="text-end">Discount:</td>
                            <td>$0</td>
                        </tr>
                        <tr>
                            <td colspan="3" class="text-end">Total:</td>
                            <td>${{ Cart::getTotal() }}</td>
                        </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </section>
    <!-- checkout section  -->
@endsection
@section('footer_scripts')
@endsection
