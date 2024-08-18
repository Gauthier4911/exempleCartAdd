<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Products;
use Stripe\Stripe;
use Stripe\Checkout\Session;


class CartContronllers extends Controller
{
    public function index()
    {
        $cart = session()->get('cart', []);
        $subtotal = 0;

        foreach ($cart as $item) {
            $subtotal += $item['product']->price * $item['quantity'];
        }

        $total = $subtotal;  // Ajuster si des taxes ou des remises sont appliquées

        return view('cart.index', compact('cart', 'subtotal', 'total'));
    }

    public function add(Request $request)
    {
        $product_id = $request->input('product_id');
        $product = Products::find($product_id);
        $cart = session()->get('cart', []);

        if (isset($cart[$product_id])) {
            $cart[$product_id]['quantity']++;
        } else {
            $cart[$product_id] = [
                "product" => $product,
                "quantity" => 1
            ];
        }

        session()->put('cart', $cart);
        return redirect()->route('app.home');
    }

    public function update(Request $request)
    {
        $product_id = $request->query('product_id');
        $change = $request->query('change');
        $cart = session()->get('cart', []);

        if (isset($cart[$product_id])) {
            $cart[$product_id]['quantity'] += $change;

            if ($cart[$product_id]['quantity'] < 1) {
                unset($cart[$product_id]);
            }
        }

        session()->put('cart', $cart);
        return redirect()->route('cart.index');
    }



    public function remove(Request $request)
    {
        $product_id = $request->query('product_id');
        $cart = session()->get('cart', []);

        if (isset($cart[$product_id])) {
            unset($cart[$product_id]);
        }

        session()->put('cart', $cart);
        return redirect()->route('cart.index');
    }

    public function checkout(Request $request)
    {
        $cart = session()->get('cart', []);
        $line_items = [];

        foreach ($cart as $item) {
            $line_items[] = [
                'price_data' => [
                    'currency' => 'usd',
                    'product_data' => [
                        'name' => $item['product']->title,
                    ],
                    'unit_amount' => $item['product']->price * 100,
                ],
                'quantity' => $item['quantity'],
            ];
        }

        Stripe::setApiKey(env('STRIPE_SECRET'));

        $session = Session::create([
            'payment_method_types' => ['card'],
            'line_items' => [$line_items],
            'mode' => 'payment',
            'success_url' => route('app.home'),
            'cancel_url' => route('cart.index'),
        ]);

        return redirect($session->url);
    }


}
