@extends('fe.layouts.app')

@section('content')
    @include('fe.layouts.header')
    <section class="breadcrumb breadcrumb_bg">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="breadcrumb_iner">
                        <div class="breadcrumb_iner_item">
                            <h2>Cart</h2>
                            <p>Home <span>-</span>Cart</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="cart_area padding_top">
        <div class="container">
            <div class="cart_inner">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">Product</th>
                                <th scope="col">Price</th>
                                <th scope="col">Quantity</th>
                                <th scope="col">Total</th>
                                <th scope="col">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($cartData as $record)
                                <tr>
                                    <td>
                                        <div class="media">
                                            <div class="d-flex">
                                                <img style="width:50px;" src="{{ asset($record->img) }}" alt="" />
                                            </div>
                                            <div class="media-body">
                                                <p>{{ $record->name }}</p>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <h5>{{ $record->formatPrice }}</h5>
                                    </td>
                                    <td>
                                        <h5>{{ $record->qty }}</h5>
                                    </td>
                                    <td>
                                        <h5>{{ format_currency($record->price) }}</h5>
                                    </td>
                                    <td>
                                        <a href="{{ route('cart.remove', $record->cartid) }}">
                                            <i class="fa fa-times text-danger" aria-hidden="true"></i>
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5">No Cart Products Found</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                    <div class="checkout_btn_inner float-right">
                        <a class="btn_1" href="{{ route('welcome') }}">Continue Shopping</a>
                        <a class="btn_1 checkout_btn_1" href="{{ route('cart.checkout') }}">Proceed to checkout</a>
                    </div>
                </div>
            </div>
    </section>

    @include('fe.layouts.footer')
@endsection
