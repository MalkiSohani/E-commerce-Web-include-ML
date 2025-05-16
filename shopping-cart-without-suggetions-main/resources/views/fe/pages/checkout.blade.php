@extends('fe.layouts.app')

@section('content')
    @include('fe.layouts.header')
    <section class="breadcrumb breadcrumb_bg">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="breadcrumb_iner">
                        <div class="breadcrumb_iner_item">
                            <h2>Payment</h2>
                            <p>Home <span>-</span>Cart<span>-</span>Checkout</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Credit card form -->
    <section>
        <div class="container mt-5">
            <div class="row">
                <div class="col-md-8 mb-4">
                    <div class="card mb-4">
                        <div class="card-header py-3">
                            <h5 class="mb-0">Biling details</h5>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('cart.checkout.pay') }}">

                                <hr class="my-4" />

                                <h5 class="mb-4">Payment</h5>

                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="flexRadioDefault"
                                        id="checkoutForm3" checked />
                                    <label class="form-check-label" for="checkoutForm3">
                                        Credit card
                                    </label>
                                </div>

                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="flexRadioDefault"
                                        id="checkoutForm4" />
                                    <label class="form-check-label" for="checkoutForm4">
                                        Debit card
                                    </label>
                                </div>
                                <br>
                                <br>
                                <div class="row mb-4">
                                    <div class="col">
                                        <div class="form-outline">
                                            <input type="text" id="formNameOnCard" class="form-control" />
                                            <label class="form-label" for="formNameOnCard">Name on card</label>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="form-outline">
                                            <input type="text" id="formCardNumber" class="form-control" />
                                            <label class="form-label" for="formCardNumber">Credit card number</label>
                                        </div>
                                    </div>
                                </div>

                                <div class="row mb-4">
                                    <div class="col-3">
                                        <div class="form-outline">
                                            <input type="text" id="formExpiration" class="form-control" />
                                            <label class="form-label" for="formExpiration">Expiration</label>
                                        </div>
                                    </div>
                                    <div class="col-3">
                                        <div class="form-outline">
                                            <input type="text" id="formCVV" class="form-control" />
                                            <label class="form-label" for="formCVV">CVV</label>
                                        </div>
                                    </div>
                                </div>

                                <button class="btn btn-success btn-lg btn-block" type="submit">
                                    Continue to checkout
                                </button>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="col-md-4 mb-4">
                    <div class="card mb-4">
                        <div class="card-header py-3">
                            <h5 class="mb-0">Summary</h5>
                        </div>
                        <div class="card-body">
                            <ul class="list-group list-group-flush">
                                <li
                                    class="list-group-item d-flex justify-content-between align-items-center border-0 px-0 pb-0">
                                    Products
                                    <span>{{ $total }}</span>
                                </li>
                                <li
                                    class="list-group-item d-flex justify-content-between align-items-center border-0 px-0 mb-3">
                                    <div>
                                        <strong>Total amount</strong>
                                        <strong>
                                            <p class="mb-0">(including VAT)</p>
                                        </strong>
                                    </div>
                                    <span><strong>{{ $total }}</strong></span>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Credit card form -->

    @include('fe.layouts.footer')
@endsection
