<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Events\UserLog;
use Illuminate\Support\Facades\Storage;
use App\Models\Order;
use App\Notifications\PurchaseConfirmedNotification;

class ProductController extends Controller
{
    public function index()
    {
        $shoes = Product::where('category', 'Shoes')->get();
        $apparel = Product::where('category', 'Apparel')->get();

        return view('products.index', compact('shoes', 'apparel'));
    }

    public function create()
    {
        return view('products.create');
    }

    public function store(Request $request)
{
    $request->validate([
        'name' => 'required',
        'description' => 'required',
        'price' => 'required|numeric',
        'category' => 'required|in:shoes,apparel',
        'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Validate image file
    ]);

    $imagePath = $request->file('image')->store('product_images', 'public'); // Store the uploaded image

    $product = new Product([
        'name' => $request->input('name'),
        'description' => $request->input('description'),
        'price' => $request->input('price'),
        'category' => $request->input('category'),
        'image_path' => $imagePath, // Save the image path to the database
    ]);

    $product->save();

    $log_entry = Auth::user()->name . " added a " . ucfirst($product->category) . " product: " . $product->name;
    event(new UserLog($log_entry));

    return redirect()->route('products.index')->with('success', 'Product created successfully');
}

    public function show(Product $product)
    {
        return view('products.show', compact('product'));
    }

    public function edit(Product $product)
    {
        return view('products.edit', compact('product'));
    }

    public function update(Request $request, Product $product)
{
    $request->validate([
        'name' => 'required',
        'description' => 'required',
        'price' => 'required|numeric',
        'category' => 'required|in:shoes,apparel',
        'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048', // Validate image file (optional)
    ]);

    if ($request->hasFile('image')) {
        if ($product->image_path && Storage::disk('public')->exists($product->image_path)) {
            Storage::disk('public')->delete($product->image_path);
        }
        $imagePath = $request->file('image')->store('product_images', 'public');
        $product->image_path = $imagePath;
    }

    $product->name = $request->input('name');
    $product->description = $request->input('description');
    $product->price = $request->input('price');
    $product->category = $request->input('category');
    $product->save();

    $log_entry = Auth::user()->name . " updated a " . ucfirst($product->category) . " product: " . $product->name;
    event(new UserLog($log_entry));

    return redirect()->route('products.index')->with('success', 'Product updated successfully');
}


    public function destroy(Product $product)
    {
        $log_entry = Auth::user()->name . " deleted a " . ucfirst($product->category) . " product: " . $product->name;
        event(new UserLog($log_entry));

        $product->delete();

        return redirect()->route('products.index')->with('success', 'Product deleted successfully');
    }


    public function buy(Request $request, Product $product)
{
    // Create a new order and associate it with the product
    $order = new Order([
        'product_id' => $product->id,
        'quantity' => 1, // You can adjust the quantity as needed
        'total_price' => $product->price, // Calculate the total price based on quantity if needed
    ]);

    // Implement any additional logic here, such as processing payments

    $order->save();

    // Pass the $product and $order variables to the confirmation view
    return view('products.confirmation', compact('product', 'order'));
}

public function confirmPurchase(Product $product)
{
    // Create an order and populate its details
    $order = new Order();
    $order->product_id = $product->id;
    $order->quantity = 1; // You can set the quantity based on your requirements
    $order->total_price = $product->price; // You can calculate the total price based on quantity and product price
    $order->save();

    $user = auth()->user(); // Assuming you have authentication set up
    $user->notify(new PurchaseConfirmedNotification($order->id));

    // Redirect to the index page with a success message
    return redirect()->route('products.index')->with('success', 'Purchase confirmed successfully');
}



}
