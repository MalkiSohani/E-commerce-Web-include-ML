<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\CartProduct;
use App\Models\Product;
use App\Models\Ratings;
use App\Traits\ResponseTrait;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Validation\ValidationException;

class CartController extends Controller
{
    use ResponseTrait;

    public function addToCart(Request $request, $id)
    {

        if (Auth::user() == null) {
            throw ValidationException::withMessages(['cart' => 'Please login before add to cart']);
        }

        $qty = $request->qty;
        $product = Product::getData(true)->where('id', $id)->first();
        if ($product && $product->qty >= $qty) {

            $data = Cart::where('user', Auth::user()->id)->where('status', 1)->with('cartproducts')->latest()->first();
            if (!$data) {
                $data = Cart::create([
                    'user' => Auth::user()->id,
                    'total' => 0,
                    'status' => 1
                ]);
            }

            $isNew = true;

            if ($data->cartproducts) {
                foreach ($data->cartproducts as $key => $value) {
                    if ($value->cart == $data->id && $value->product == $product->id) {
                        $isNew = false;
                        if (($product->qty - $value->qty) < $qty) {
                            return 0;
                        }
                        CartProduct::where('id', $value->id)->update([
                            'qty' => $value->qty + $qty,
                            'total' =>  $product->price * ($value->qty + $qty),
                        ]);
                        break;
                    }
                }
            }

            if ($isNew) {
                CartProduct::create([
                    'cart' => $data->id,
                    'product' => $product->id,
                    'qty' => $qty,
                    'total' =>  $product->price * $qty,
                ]);
            }
        } else {
            throw ValidationException::withMessages(['cart' => 'Maximum quantity added']);
        }

        return back();
    }

    public function view(Request $request)
    {
        $cartData = [];
        $total = 0;
        $data = Cart::where('status', 1)->where('user', Auth::user()->id)->with('cartproducts')->latest()->first();
        if ($data && $data->cartproducts && count($data->cartproducts)) {
            $total = 0.0;
            foreach ($data->cartproducts as $key => $value) {
                $product = $value->productdata;
                $product->cartid = $value->id;
                $product->qty = $value->qty;
                $product->price = $value->total;

                $total += $value->total;

                $cartData[] = $product;
            }

            $total = format_currency($total);
        }

        return view('fe.pages.cart', compact(['cartData', 'total']));
    }

    public function checkout(Request $request)
    {
        $cartData = [];
        $total = 0;
        $data = Cart::where('status', 1)->where('user', Auth::user()->id)->with('cartproducts')->latest()->first();
        if ($data && $data->cartproducts && count($data->cartproducts)) {
            $total = 0.0;
            foreach ($data->cartproducts as $key => $value) {
                $product = $value->productdata;
                $product->cartid = $value->id;
                $product->qty = $value->qty;
                $product->price = $value->total;

                $total += $value->total;

                $cartData[] = $product;
            }

            $total = format_currency($total);
        }

        return view('fe.pages.checkout', compact(['cartData', 'total']));
    }

    public function removeFromCart(Request $request)
    {
        CartProduct::where('id', $request->id)->delete();
        return back();
    }

    public function paymentDone(Request $request)
    {
        $data = Cart::where('status', 1)->where('user', Auth::user()->id)->with('cartproducts')->latest()->first();
        if ($data && $data->cartproducts) {
            $total = 0.0;
            foreach ($data->cartproducts as $key => $value) {
                $total += $value->total;
                Product::where('id', $value->product)->decrement('qty', $value->qty);
            }
            Cart::where('id', $data->id)->update(['total' => $total]);
            $data->update(['status' => 2]);
        }
        return redirect()->route('welcome');
    }

    public function orders(Request $request)
    {
        $data = Cart::where('status', 2)->where('user', Auth::user()->id)->orderByDesc('id')->get();
        return view('fe.pages.orders')->with('data', $data);
    }

    public function orderView(Request $request, $id)
    {
        $cartData = [];
        $total = 0;
        $data = Cart::where('id', $id)->where('user', Auth::user()->id)->with('cartproducts')->latest()->first();
        if ($data && $data->cartproducts && count($data->cartproducts)) {
            $total = 0.0;
            foreach ($data->cartproducts as $key => $value) {
                $product = $value->productdata;
                $product->cartid = $value->id;
                $product->qty = $value->qty;
                $product->price = $value->total;

                $total += $value->total;

                $cartData[] = $product;
            }

            $total = format_currency($total);
        }

        return view('fe.pages.orderview', compact(['cartData', 'total']));
    }

    public function comment(Request $request)
    {
        $rate = 0;

        $rate = Http::get('https://testserver.aries.lk/test', [ //prediction link
            'comment' => $request->comment,
        ])->body();

        Ratings::create([
            'user' => Auth::user()->id,
            'product' => $request->product,
            'comment' => $request->comment,
            'rating' => $rate
        ]);
    }
}
