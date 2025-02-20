<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PlantProduct;
use App\Models\CartItem;

class ShoppingCartController extends Controller
{
    public function index()
    {
        $cartItems = auth()->check()
            ? CartItem::where('user_id', auth()->id())->with('product')->get()
            : session()->get('cart', []);

        return view('cart.index', compact('cartItems'));
    }


    public function addToCart($id)
    {
        $product = PlantProduct::findOrFail($id);

        if (auth()->check()) {
            // Authenticated user: store in MySQL
            $cartItem = CartItem::firstOrCreate(
                ['user_id' => auth()->id(), 'plant_product_id' => $id],
                ['quantity' => 1]
            );

            if (!$cartItem->wasRecentlyCreated) {
                $cartItem->increment('quantity');
            }
        } else {
            // Guest user: store in session
            $cart = session()->get('cart', []);

            if (isset($cart[$id])) {
                $cart[$id]['quantity']++;
            } else {
                $cart[$id] = [
                    'name' => $product->name,
                    'price' => $product->price,
                    'quantity' => 1,
                ];
            }

            session()->put('cart', $cart);
        }

        return redirect()->route('public.products.index')->with('success', 'Product added to cart!');
    }


    public function removeFromCart($id)
    {
        if (auth()->check()) {
            CartItem::where('user_id', auth()->id())->where('plant_product_id', $id)->delete();
        } else {
            $cart = session()->get('cart', []);
            unset($cart[$id]);
            session()->put('cart', $cart);
        }

        return redirect()->route('cart.index')->with('success', 'Product removed from cart.');
    }

    public function clearCart()
    {
        if (auth()->check()) {
            CartItem::where('user_id', auth()->id())->delete();
        } else {
            session()->forget('cart');
        }

        return redirect()->route('cart.index')->with('success', 'Cart cleared.');
    }

}
