<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ShopController extends Controller
{
    /**
     * Display all products in the shop.
     */
    public function index()
    {
        $products = Product::latest()->get();

        return view('shop.index', compact('products'));
    }

    /**
     * Show a single product.
     */
    public function show(Product $product)
    {
        return view('shop.show', compact('product'));
    }

    /**
     * Add product to cart (stored in session).
     */
    public function addToCart(Request $request, Product $product)
    {
        $cart = session()->get('cart', []);

        if (isset($cart[$product->id])) {
            $cart[$product->id]['quantity']++;
        } else {
            $cart[$product->id] = [
                "name" => $product->name,
                "quantity" => 1,
                "price" => $product->price,
                "image" => $product->image ?? null,
            ];
        }

        session()->put('cart', $cart);

        return redirect()->back()->with('success', "{$product->name} added to cart!");
    }

    /**
     * View cart contents.
     */
    public function viewCart()
    {
        $cart = session()->get('cart', []);
        return view('shop.cart', compact('cart'));
    }

    /**
     * Remove item from cart.
     */
    public function removeFromCart($id)
    {
        $cart = session()->get('cart', []);

        if (isset($cart[$id])) {
            unset($cart[$id]);
            session()->put('cart', $cart);
        }

        return redirect()->back()->with('success', 'Item removed from cart.');
    }

    /**
     * Checkout page (placeholder for payment integration).
     */
    public function checkout()
    {
        $cart = session()->get('cart', []);
        return view('shop.checkout', compact('cart'));
    }
}
