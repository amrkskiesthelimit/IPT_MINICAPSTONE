<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Notifications\PurchaseConfirmedNotification;
use App\Models\Product;
use App\Models\Cart;
use App\Models\Order;
use Illuminate\Support\Facades\DB;

class CartController extends Controller
{

public function addToCart(Request $request, Product $product)
{
    // Check if the product is already in the cart
    $existingCartItem = Cart::where('product_id', $product->id)->first();

    if ($existingCartItem) {
        // If the product is in the cart, increment the quantity
        $existingCartItem->increment('quantity');
    } else {
        // If not, create a new cart item
        Cart::create([
            'product_id' => $product->id,
            'quantity' => 1,
        ]);
    }

    return redirect()->route('cart.show')->with('success', 'Product added to cart successfully');
}

public function showCart()
{
    $shoesCartItems = Cart::whereHas('product', function ($query) {
        $query->where('category', 'Shoes');
    })->with('product')->get();

    $apparelCartItems = Cart::whereHas('product', function ($query) {
        $query->where('category', 'Apparel');
    })->with('product')->get();

    return view('cart.show', compact('shoesCartItems', 'apparelCartItems'));
}

public function buyAll($category)
    {
        $cartItems = Cart::whereHas('product', function ($query) use ($category) {
            $query->where('category', $category);
        })->get();

        try {
            DB::beginTransaction();

            foreach ($cartItems as $cartItem) {
                $product = $cartItem->product;
                $order = new Order([
                    'product_id' => $product->id,
                    'quantity' => 1, // You may need to adjust this based on your cart structure
                    'total_price' => $product->price,
                ]);
                $order->save();

                // Notify the user of the successful purchase
                $user = auth()->user(); // Assuming you have authentication set up
                $user->notify(new PurchaseConfirmedNotification($order->id));
                $cartItem->delete();
            }

            DB::commit();

            return redirect()->route('cart.show')->with('success', 'All items in the cart have been purchased successfully.');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->route('cart.show')->with('error', 'Error occurred while processing the purchase.');
        }
    }

    public function remove($id)
{
    try {
        $cartItem = Cart::findOrFail($id);
        $cartItem->delete();

        return redirect()->back()->with('success', 'Item removed from the cart successfully.');
    } catch (\Exception $e) {
        return redirect()->back()->with('error', 'Error occurred while removing the item from the cart.');
    }
}
}
