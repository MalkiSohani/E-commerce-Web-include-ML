@extends('fe.layouts.app')

@section('content')
    @include('fe.layouts.header')
    <section class="breadcrumb breadcrumb_bg">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="breadcrumb_iner">
                        <div class="breadcrumb_iner_item">
                            <h2>Orders</h2>
                            <p>Home <span>-</span>Orders</p>
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
                                <th scope="col">Order Reference</th>
                                <th scope="col">Placed At</th>
                                <th scope="col">Total</th>
                                <th scope="col">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($data as $record)
                                <tr>
                                    <td>
                                        #{{ str_pad($record->id, 5, '0', STR_PAD_LEFT) }}
                                    </td>
                                    <td>
                                        <h5>{{ $record->created_at }}</h5>
                                    </td>
                                    <td>
                                        <h5>{{ format_currency($record->total) }}</h5>
                                    </td>
                                    <td>
                                        <a href="{{ route('order.view', $record->id) }}">
                                            <i class="fa fa-eye text-primary" aria-hidden="true"></i>
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
                </div>
            </div>
    </section>

    @include('fe.layouts.footer')
@endsection
