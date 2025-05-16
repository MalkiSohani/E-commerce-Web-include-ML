<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Shop;
use App\Traits\ResponseTrait;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
    use ResponseTrait;

    public function index()
    {
        $shops = Shop::getData(true)->get();
        $products = Product::getData()->with('ratings')->paginate(10);
        return view('pages.products', compact(['products', 'shops']));
    }

    public function productView($id)
    {
        $ratings = [1 => 0, 2 => 0, 3 => 0, 4 => 0, 5 => 0];
        $data = Product::where('id', $id)->with('ratedata')->first();

        foreach ($data->ratedata as $key => $value) {
            $ratings[((int)$value->rating)]++;
        }

        return view('fe.pages.product', compact(['data', 'ratings']));
    }

    public function enroll(Request $request)
    {
        $request->validate([
            'shop' => 'required|exists:shops,id',
            'name' => 'required|string|min:2',
            'rfid' => 'required|string',
            'qty' => 'required|numeric',
            'price' => 'required|numeric',
            'description' => 'required|string',
            'isnew' => 'required|numeric',
            'record' => 'nullable|numeric',
        ]);

        $data = [
            'shop' => $request->shop,
            'name' => $request->name,
            'rfid' => $request->rfid,
            'qty' => $request->qty,
            'price' => $request->price,
            'description' => $request->description,
            'status' => $request->status ?? 1,
            'is_fridge_item' => $request->is_fridge_item ?? 2,
        ];

        if ($request->has('image')) {
            $data['img'] = $this->uploadImage($request->file('image'), Carbon::now()->format('YmdHs'), $request->image);
        }

        if ($request->isnew == 1) {
            Product::create($data);
        } else {
            Product::where('id', $request->record)->update($data);
        }

        return redirect()->back()->with(['code' => 1, 'color' => 'success', 'msg' => 'Successfully ' . (($request->isnew == 1) ? 'Registered' : 'Updated')]);
    }

    public function uploadImage($valid, $name, $file)
    {
        $ext = strtolower($file->getClientOriginalExtension());
        $name = $name . '.' . $ext;
        $upload_path = 'assets/img/products';
        $image_url = $upload_path . $name;
        $file->move($upload_path, $name);
        return $name;
    }


    public function deleteOne(Request $request)
    {
        $request->validate([
            'id' => 'required|exists:products,id'
        ]);

        Product::where('id', $request->id)->update(['status' => 3]);
        return redirect()->back()->with(['code' => 1, 'color' => 'danger', 'msg' => 'Successfully Removed']);
    }

    public function getOne(Request $request)
    {
        $request->validate([
            'id' => 'required|exists:products,id'
        ]);
        $data = Product::where('id', $request->id)->first();
        return $data;
    }

    //API

    public function get(Request $request)
    {
        $query = Product::getData(true);
        if ($request->has('shop')) {
            $query->where('shop', $request->shop);
        }
        return $this->successResponse(code: 200, data: $query->get());
    }
}
