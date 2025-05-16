@extends('fe.layouts.app')

@section('content')
    @include('fe.layouts.header')

    <div class="product_image_area section_padding">
        <div class="container">
            <div class="row s_product_inner justify-content-between">
                <div class="col-lg-7 col-xl-7">
                    <div class="product_slider_img">
                        <div id="vertical">
                            <div data-thumb="{{ asset($data->img) }}">
                                <img src="{{ asset($data->img) }}" />
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-5 col-xl-4">
                    <div class="s_product_text">
                        <br>
                        <br>
                        <br>
                        <h3>{{ $data->name }}</h3>
                        <h2>{{ $data->formatPrice }}</h2>
                        <p>
                            {{ $data->description }}
                        </p>
                        <form action="{{ route('cart.add', ['id' => $data->id]) }}" method="POST">
                            @csrf
                            <div class="card_area d-flex justify-content-between align-items-center">
                                <div class="product_count">
                                    <span class="inumber-decrement"> <i class="ti-minus"></i></span>
                                    <input class="input-number" name="qty" type="text" value="1" min="0"
                                        max="{{ $data->qty }}">
                                    <span class="number-increment"> <i class="ti-plus"></i></span>
                                </div>
                                <button {{ Auth::user() ? '' : 'disabled' }} class="btn_3" type="submit">add to
                                    cart</button>
                            </div>
                            @error('cart')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <section class="product_description_area">
        <div class="container">
            <ul class="nav nav-tabs" id="myTab" role="tablist">
                <li class="nav-item">
                    <a class="nav-link" id="contact-tab" data-toggle="tab" href="#contact" role="tab"
                        aria-controls="contact" aria-selected="false">Comments</a>
                </li>
            </ul>
            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active" id="review" role="tabpanel" aria-labelledby="review-tab">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="row total_rate">
                                <div class="col-6">
                                    <div class="rating_list">
                                        <h3>Based on {{ count($data->ratedata) }} Reviews</h3>
                                        <ul class="list">
                                            @php
                                                $rateIndex = 1;
                                            @endphp
                                            @foreach ($ratings as $key => $rate)
                                                <li>
                                                    <a href="#">

                                                        @for ($i = 0; $i < 5; $i++)
                                                            @if ($i < $key)
                                                                <i class="fa fa-star"></i>
                                                            @else
                                                                <i class="fa fa-star text-secondary"></i>
                                                            @endif
                                                        @endfor

                                                        {{ $rate }} Reviews
                                                    </a>
                                                </li>
                                                @php
                                                    $rateIndex++;
                                                @endphp
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="review_list">
                                @foreach ($data->ratedata as $rate)
                                    <div class="review_item">
                                        <div class="media">
                                            <div class="d-flex">
                                                <img src="img/product/single-product/review-1.png" alt="" />
                                            </div>
                                            <div class="media-body">
                                                <h4>{{ $rate->userdata->name }}</h4>
                                                @for ($i = 0; $i < 5; $i++)
                                                    @if ($i < (int) $rate->rating)
                                                        <i class="fa fa-star"></i>
                                                    @else
                                                        <i class="fa fa-star text-secondary"></i>
                                                    @endif
                                                @endfor
                                            </div>
                                        </div>
                                        <p>
                                            {{ $rate->comment }}
                                        </p>
                                    </div>
                                @endforeach

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    @include('fe.layouts.footer')
@endsection
