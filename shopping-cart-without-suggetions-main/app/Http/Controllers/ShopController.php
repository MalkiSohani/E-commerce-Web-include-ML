<?php

namespace App\Http\Controllers;

use App\Models\Shop;
use App\Models\User;
use App\Traits\ResponseTrait;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class ShopController extends Controller
{
    use ResponseTrait;

    public function index()
    {
        $shops = Shop::getData()->paginate(10);
        return view('pages.shops', compact(['shops']));
    }

    public function enroll(Request $request)
    {
        $request->validate([
            'name' => 'required|string|min:2',
            'address' => 'required|string',
            'lng' => 'required|numeric',
            'ltd' => 'required|numeric',
            'description' => 'nullable|string',
            'owner' => 'required_unless:isnew,2|string|exists:users,email',
            'isnew' => 'required|numeric',
            'record' => 'nullable|numeric',
        ]);

        $user = User::where('usertype', 2)->where('email', $request->owner)->first();
        if ($request->isnew == 1 && !$user) {
            throw ValidationException::withMessages(['owner' => 'Invalid Account']);
        }

        $data = [
            'name' => $request->name,
            'address' => $request->address,
            'lng' => $request->lng,
            'ltd' => $request->ltd,
            'description' => $request->description,
            'status' => $request->status ?? 1
        ];

        if ($request->has('tel')) {
            $data['tel'] = $request->tel;
        }

        if ($request->isnew == 1) {
            $data['owner'] = $user->id;
            Shop::create($data);
        } else {
            Shop::where('id', $request->record)->update($data);
        }

        return redirect()->back()->with(['code' => 1, 'color' => 'success', 'msg' => 'Successfully ' . (($request->isnew == 1) ? 'Registered' : 'Updated')]);
    }

    public function deleteOne(Request $request)
    {
        $request->validate([
            'id' => 'required|exists:shops,id'
        ]);

        Shop::where('id', $request->id)->update(['status' => 3]);
        return redirect()->back()->with(['code' => 1, 'color' => 'danger', 'msg' => 'Successfully Removed']);
    }

    public function getOne(Request $request)
    {
        $request->validate([
            'id' => 'required|exists:shops,id'
        ]);
        $data = Shop::where('id', $request->id)->first();
        $data['owner'] = User::where('status', 1)->where('usertype', 2)->where('id', $data->owner)->first()->email ?? 'zz';
        return $data;
    }

    //API

    public function get()
    {
        return $this->successResponse(code: 200, data: Shop::getData(true)->get());
    }
}
