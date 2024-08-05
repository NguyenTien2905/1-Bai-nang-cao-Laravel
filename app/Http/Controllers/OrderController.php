<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreOrderRequest;
use App\Http\Requests\UpdateOrderRequest;
use App\Models\Customer;
use App\Models\Order;
use App\Models\Product;
use App\Models\Supplier;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $orders = Order::with(['customer', 'details'])->latest('id')->paginate(1);

        return response()->json($orders);
        // return view('orders.index', compact('orders'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('orders.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreOrderRequest $request)
    {
        $images = [];

        try {
            DB::transaction(function () use ($request, &$images) {
                $customer = Customer::create($request->customer);
                $supplier = Supplier::create($request->supplier);

                $orderDetails = [];
                $totalAmuont = 0;

                foreach ($request->products as $key => $product) {

                    $product['supplier_id'] = $supplier->id;

                    if ($request->hasFile("products.$key.image")) {
                        $images[] =  $product['image'] = Storage::put('products', $request->file("products.$key.image"));
                    }

                    $tmp = Product::query()->create($product);

                    $orderDetails[$tmp->id] = [
                        'qty' => $request->order_details[$key]['qty'],
                        'price' => $tmp->price,
                    ];

                    $totalAmuont +=  $request->order_details[$key]['qty'] * $tmp->price;
                }

                $order = Order::query()->create([
                    'customer_id' => $customer->id,
                    'total' => $totalAmuont,
                ]);

                $order->details()->attach($orderDetails);
            }, 3);

            return response()->json($order, 201);
            // return redirect()->route('orders.index')->with('success', 'Thêm thành công');
        } catch (Exception $exception) {

            foreach ($images as $image) {
                if (Storage::exists($image)) {
                    Storage::delete($image);
                }
            }

            return back()->with('error', $exception->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Order $order)
    {
        $order->load(['customer', 'details']);

        // return view('orders.show', compact('order'));

        return response()->json($order);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Order $order)
    {
        $order->load(['customer', 'details']);
        

        return view('orders.edit', compact('order'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateOrderRequest $request, Order $order)
    {

        try {
            DB::transaction(function () use ($request, $order) {
                $order->details()->sync($request->order_details);

                $orderDetails = array_map(function ($item) {
                    return $item['price'] * $item['qty'];
                }, $request->order_details);

                $total = array_sum($orderDetails);

                $order->update([
                    'total' => $total,
                ]);
            }, 3);

            return response()->json($order);
            // return back()->with('success', 'Sửa thành công');
        } catch (Exception $exception) {

            return back()->with('error', $exception->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Order $order)
    {
        try {
            DB::transaction(function () use ($order) {
                $order->details()->sync([]);
                $order->delete();
            }, 3);

            return response()->json(['message' => 'Xóa thành công']);
            // return back()->with('success', 'Xóa thành công');
        } catch (Exception $exception) {
            return response()->json(['message' => 'Xóa thành công']);
        //     return back()->with('error', $exception->getMessage());
        }
    }
}
