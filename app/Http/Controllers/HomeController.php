<?php

namespace App\Http\Controllers;

use App\Customer;
use App\Order;
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

    /**
     * Show all the products.
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function apiProducts(Request $request)
    {
        if ($request->ajax()) {
            if (! Bouncer::is(auth()->user())->an('administrator') && ! Bouncer::can('shop-manager')) {
                return response()->json(['status' => 'error', 'message' => '403 forbidden'], 403);
            }

            if ($request->has('filter_stock') && $request->get('filter_stock') != '') {
                $products = Product::where('in_stock', $request->get('filter_stock'))->get();
            } else {
                $products = Product::all();
            }

            return response()->json(['status' => 'success', 'results' => $products]);
        }

        return response()->json(['status' => 'error', 'message' => 'Ahh, i feel sorry for you!'], 403);
    }

    /**
     * Show all the orders.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function orders()
    {
        if (! Bouncer::is(auth()->user())->an('administrator') && ! Bouncer::can('shop-manager')) {
            abort(403);
        }

        $orders = Order::all();

        return view('orders', compact('orders'));
    }

    /**
     * Show details of the specified order.
     *
     * @param $invoiceNumber
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function orderDetails($invoiceNumber)
    {
        if (! Bouncer::is(auth()->user())->an('administrator') && ! Bouncer::can('shop-manager')) {
            abort(403);
        }

        $order = Order::where('invoice_number', $invoiceNumber)->first();

        if (is_null($order)) {
            abort(404);
        }

        activity()->log(auth()->user()->name . ' processed the order: ' . $order->id);

        return view('order-details', compact('order'));
    }
}
