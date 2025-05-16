<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $todayUsers = User::getData(true)->where('usertype', 3)->whereDate('created_at', Carbon::now())->count();
        $todaySales = Cart::where('status', 1)->whereDate('created_at', Carbon::now())->sum('total');
        $totalSales = Cart::where('status', 1)->sum('total');


        $data = [];

        foreach (Cart::where('status', 1)->where('created_at', '>=', Carbon::now()->subDays(10))->get() as $key => $value) {

            $date = Carbon::parse($value->created_at)->format('Y-m-d');

            if (array_key_exists($date, $data)) {
                $data[$date] = $data[$date] + (float)$value->total;
            } else {
                $data[$date] = (float)$value->total;
            }
        }

        $x = array_keys($data);
        $y = array_values($data);
        return view('home', compact(['todayUsers', 'todaySales', 'totalSales', 'x', 'y']));
    }
}
