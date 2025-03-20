<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Store;
use Exception;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class PosController extends Controller
{
    public function index(): View
    {
        $products = Product::paginate(10);
        return view('admin.pos.pos_page', compact('products'));
    }

    public function AddCart(Request $request)
    {
        Cart::add([
            'id' => $request->id,
            'name' => $request->name,
            'qty' => $request->qty,
            'price' => $request->price,
            'weight' => 550,
            'options' => ['size' => 'large'],
        ]);

        notyf()->success("Product Added Successfully!");

        return to_route('admin.pos');
    }

    public function AllItem(): View
    {
        $product_item = Cart::content();
        return view('admin.pos.text_item', compact('product_item'));
    }


    public function UpdateCart(Request $request, $rowId)
    {
        $qty = $request->qty;
        $update = Cart::update($rowId, $qty);

        notyf()->success("Product Updated Successfully!");

        return to_route('admin.pos');
    }

    public function DeleteCart($rowId)
    {
        try {

            Cart::remove($rowId);


            notyf()->success('Deleted Cart Successfully!');
            return response(['message' => 'Deleted Successfully!'], 200);
        } catch (Exception $e) {
            logger("cart Language Error >> " . $e);
            return response(['message' => 'Something went wrong!'], 500);
        }
    }

    public function AddInvoice(Request $request)
    {
        $request->validate([
            'customer' => 'required',
        ]);
        $contents = Cart::content();
        $customer = $request->customer;
        $store = Store::first();


        return view('admin.invoice.product_invoice', compact('store', 'contents', 'customer'));
    }
}
