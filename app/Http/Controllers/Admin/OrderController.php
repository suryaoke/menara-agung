<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderDetails;
use App\Models\Product;
use App\Models\Store;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    public function FinalInvoice(Request $request)
    {
        $data = array();
        $data['customer'] = $request->customer;
        $data['tanggal_order'] = $request->tanggal_order;
        $data['order_status'] = $request->order_status;
        $data['sub_total'] = $request->sub_total;
        $data['total_product'] = $request->total_product;
        $data['vat'] = $request->vat;


        $data['invoice_no'] = 'TRS' . mt_rand(10000000, 99999999);
        $data['total'] = $request->total;
        $data['payment_status'] = $request->payment_status;
        $data['pay'] = $request->pay;
        $data['due'] = $request->vat;

        $order_id = Order::insertGetId($data);
        $contents = Cart::content();

        $pdata = array();
        foreach ($contents as $content) {
            $pdata['order_id'] = $order_id;
            $pdata['product_id'] = $content->id;
            $pdata['quantity'] = $content->qty;
            $pdata['unitcost'] = $content->price;
            $pdata['total'] = $content->total;

            $insert = OrderDetails::insert($pdata);
        }
        Cart::destroy();

        notyf()->success("Order Successfully!");

        return to_route('admin.order.details', $order_id);
    }


    public function PendingOrder(): View
    {
        $orders = Order::where('order_status', 'pending')->paginate(10);
        return view('admin.order.pending_order', compact('orders'));
    }

    public function OrderDetails($order_id)
    {
        $orders = Order::where('id', $order_id)->first();
        $orderItems = OrderDetails::with('product')->where('order_id', $order_id)->orderBy('id', 'DESC')->get();
        $store = Store::first();
        return view('admin.order.order_details', compact('store', 'orders', 'orderItems'));
    }


    public function OrderStatusUpdate(Request $request)
    {

        $order_id = $request->id;

        $product = OrderDetails::where('order_id', $order_id)->get();
        foreach ($product as $item) {
            Product::where('id', $item->product_id)
                ->update(['product_store' => DB::raw('product_store-' . $item->quantity)]);
        }


        $order =  Order::findOrFail($order_id);

        $order->order_status = 'completed';

        $order->save();


        notyf()->success("Order Done Successfully!");

        return to_route('admin.pending.order');
    }



    public function CompleteOrder(): View
    {
        $orders = Order::where('order_status', 'completed')->paginate(10);
        return view('admin.order.complete_order', compact('orders'));
    }
}
