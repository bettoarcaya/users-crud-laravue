<?php

namespace App\Http\Controllers;

use App\Models\CarDealership;
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
        return view('home');
    }

    public function getCarShips(){
      $car_dealerships = CarDealership::all();
      $data = compact('car_dealerships');

      return response()->json($data, 200);

    }
}
