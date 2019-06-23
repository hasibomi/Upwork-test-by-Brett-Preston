<?php

namespace App\Http\Controllers;

use App\Customer;
use App\Product;
use Illuminate\Http\Request;
use Bouncer;

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

    /**
     * Show all the customers.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function customers()
    {
        if (! Bouncer::is(auth()->user())->an('administrator') && ! Bouncer::can('user-manager')) {
            abort(403);
        }

        $customers = Customer::all();

        return view('customers', compact('customers'));
    }

    /**
     * Show all the products.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function products()
    {
        if (! Bouncer::is(auth()->user())->an('administrator') && ! Bouncer::can('shop-manager')) {
            abort(403);
        }

        $products = Product::all();

        return view('products', compact('products'));
    }
}
