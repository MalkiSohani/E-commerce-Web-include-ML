@extends('fe.layouts.app')

@section('content')
    @include('fe.layouts.header')

    <section class="banner_part">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-12">
                    <div class="banner_slider owl-carousel">
                        @foreach ($latestProducts as $latestProduct)
                            <div class="single_banner_slider">
                                <div class="row">
                                    <div class="col-lg-5 col-md-8">
                                        <div class="banner_text">
                                            <div class="banner_text_iner">
                                                <h1>{{ $latestProduct->name }}</h1>
                                                <p>{{ $latestProduct->description }}</p>
                                                <a href="{{ route('product.view', $latestProduct->id) }}" class="btn_2">shop now</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="banner_img d-none d-lg-block">
                                        <img style="width:370px;" src="{{ asset($latestProduct->img) }}" alt="">
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <div class="slider-counter"></div>
                </div>
            </div>
        </div>
    </section>
    <section class="product_list best_seller">
        <div class="container">
            <div class="row align-items-center justify-content-between">
                @foreach ($products as $item)
                    <div class="col-md-3">
                        <a href="{{ route('product.view', $item->id) }}">
                            <div class="single_product_item">
                                <img src="{{ asset($item->img) }}" alt="">
                                <div class="single_product_text">
                                    <h4>{{ $item->name }}</h4>
                                    <h3>{{ $item->formatPrice }}</h3>
                                </div>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    @include('fe.layouts.footer')
@endsection
