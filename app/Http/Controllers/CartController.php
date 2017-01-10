<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Cart;
use App\Item;
use App\Order;
use Session;
use Mail;


class CartController extends Controller
{
    // KORPA

    public function addToCart(Request $request, $id)
    {
    	$item = Item::find($id);
        $oldCart = Session::has('cart') ? Session::get('cart') : null;
        $cart = new Cart($oldCart);
        $cart->add($item, $item->id);

        $request->session()->put('cart', $cart);

        return response()->json($cart);
    }

    public function getReduceByOne($id)
    {
        $oldCart = Session::has('cart') ? Session::get('cart') : null;
        $cart = new Cart($oldCart);
        $cart->reduceByOne($id);

        Session::put('cart', $cart);

        return response()->json($cart);

    }

    public function getRemoveItem($id)
    {
        $oldCart = Session::has('cart') ? Session::get('cart') : null;
        $cart = new Cart($oldCart);
        $cart->removeItem($id);

        if(count($cart->items) > 0)
        {
            Session::put('cart', $cart);
        }
        else
        {
            Session::forget('cart');
        }

        return response()->json($cart);
    }    

    public function showCart()
    {
        if (!Session::has('cart')) {

            return view('shop.shopping-cart');
        }
        $oldCart = Session::get('cart');
        $cart = new Cart($oldCart);

        // return view('shop.shopping-cart', ['items' => $cart->items, 'totalPrice' => $cart->totalPrice]);
        return response()->json($cart);
    }

    public function getCheckout(Request $request)
    {
        if (!Session::has('cart'))
        {
            return view('shop.shopping-cart');
        }
        $oldCart = Session::get('cart');
        $cart = new Cart($oldCart);
        
        $total = $cart->totalPrice;

        // return view('shop.checkout', compact('total'));                
        return response()->json($total);
    }

    public function postCheckout(Request $request, Item $item)
    {
        if (!Session::has('cart'))
        {
            return view('shop.shopping-cart');
        }
        $oldCart = Session::get('cart');
        $cart = new Cart($oldCart);        
        $total = $cart->totalPrice;

        $order = new Order();
        $order->cart = serialize($cart);
        $order->total = $total;
        $order->save();

        $data = [$request->input()];
        $order->cart = unserialize($order->cart);

        Mail::send('emails.order', ['request' => $request,'order' => $order, 'cart' => $cart], function ($m) use ($request, $order, $cart) { 
            $m->from('mrzi.me.87@gmail.com', 'Hexor');

            $m->to('mrzi.me.87@gmail.com', 'Dzoni')->subject('Narudzbina Predmeta');
        });

        Session::forget('cart');

        return redirect()->route('index')->with('success', 'Narudzba uspesno izvrsena! Uskoro cemo vas kontaktirati.');
    }
}
