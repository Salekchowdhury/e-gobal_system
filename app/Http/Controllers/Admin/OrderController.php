<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Notification;
use App\Models\Transaction;
use App\Models\User;
use App\Models\Business_Setting;
use App\Models\ProductCommissionDistribution;
use App\Models\Settings;
use App\Models\FundDistribution;
use App\Models\DistributeFundAmount;
use App\Models\SalesCommission;
use App\Models\VendorProduct;
use App\Models\Products;
use App\Models\ProductWiseIncome;
use App\Models\OrderProductComment;
use App\Models\IncomeHistory;
use App\Models\Stockiest;
use App\Models\Ratting;
use App\Models\RetuenProductWiseIncome;
use App\Models\CurrentStock;
use Auth;
use Helper;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth::user()->type == 1) {
            $data = Order::with(['vendors', 'stockiest'])
                ->select('id', 'order_number', 'vendor_id', 'order_notes', 'full_name', 'email', 'mobile', 'landmark', 'stockiest_id', 'stock_name', 'admin_status', 'street_address', 'pincode', 'status', \DB::raw('SUM(order_total) AS grand_total'), \DB::raw('DATE_FORMAT(created_at, "%d %M %Y") as date'), \DB::raw('count(order_number) AS no_products'))
                ->where('status', '!=', 4)
                ->where('status', '!=', 8)
                ->groupBy('order_number')
                ->orderBy('id', 'DESC')
                ->get();
        }
        if (Auth::user()->type == 3) {
            $data = Order::with(['vendors', 'stockiest'])
                ->select('id', 'order_number', 'vendor_id', 'order_notes', 'full_name', 'email', 'mobile', 'landmark', 'stockiest_id', 'stock_name', 'admin_status', 'street_address', 'pincode', 'status', \DB::raw('SUM(order_total) AS grand_total'), \DB::raw('DATE_FORMAT(created_at, "%d %M %Y") as date'), \DB::raw('count(order_number) AS no_products'))
                ->where('vendor_id', Auth::user()->id)
                ->where('status', '!=', 4)
                ->where('status', '!=', 8)
                ->groupBy('order_number')
                ->orderBy('id', 'DESC')
                ->get();
            // dd(Auth::user()->id);
        }
        // dd($data);
        return view('Admin.orders.index', compact('data'));
    }

    public function searchOrderByDate(Request $request)
    {
        //  dd($request->all());

        $from = $request->from_date;
        $to = $request->to_date;

        if (!$from) {
            return $this->index();
        }

        if (Auth::user()->type == 1) {
            $data = Order::with(['vendors', 'stockiest'])
                ->select('id', 'order_number', 'vendor_id', 'order_notes', 'full_name', 'email', 'mobile', 'landmark', 'stockiest_id', 'stock_name', 'admin_status', 'street_address', 'pincode', 'status', \DB::raw('SUM(order_total) AS grand_total'), \DB::raw('DATE_FORMAT(created_at, "%d %M %Y") as date'), \DB::raw('count(order_number) AS no_products'))
                ->whereBetween('created_at', [$request->from_date . ' 00:00:00', $request->to_date . ' 23:59:59'])
                ->groupBy('order_number')
                ->orderBy('id', 'DESC')
                ->get();
        }
        if (Auth::user()->type == 3) {
            $data = Order::with(['vendors', 'stockiest'])
                ->select('id', 'order_number', 'vendor_id', 'order_notes', 'full_name', 'email', 'mobile', 'landmark', 'stockiest_id', 'stock_name', 'admin_status', 'street_address', 'pincode', 'status', \DB::raw('SUM(order_total) AS grand_total'), \DB::raw('DATE_FORMAT(created_at, "%d %M %Y") as date'), \DB::raw('count(order_number) AS no_products'))
                ->where('vendor_id', Auth::user()->id)
                ->whereBetween('created_at', [$request->from_date . ' 00:00:00', $request->to_date . ' 23:59:59'])
                ->groupBy('order_number')
                ->orderBy('id', 'DESC')
                ->get();
            // dd(Auth::user()->id);
        }
        // dd($data);
        return view('Admin.orders.index', compact('data'));
    }

    public function trackorder(Request $request, $id)
    {
        // dd($id);
        if (Auth::user()->type == 3) {
            $user_id = @Auth::user()->id;

                $data['order_info'] = Order::with('orderComment')
                    ->select('id', 'product_id', 'order_number', 'vendor_id', 'product_name', 'vendor_comment', 'slug', 'price', 'qty', 'status', 'created_at', 'confirmed_at', 'shipped_at', 'delivered_at', 'attribute', \DB::raw('(case when variation is null then "" else variation end) as variation'), \DB::raw("CONCAT('" . url('/storage/app/public/images/products/') . "/', image) AS image_url"))
                    ->where('id', $id)
                    ->where('vendor_id', $user_id)
                    ->first();

                $data['checkratting'] = $checkratting = Ratting::select('ratting')
                    ->where('product_id', @$order_info->product_id)
                    ->where('vendor_id', @$order_info->vendor_id)
                    ->where('user_id', $user_id)
                    ->count();

                if ($checkratting > 0) {
                    $data['ratting'] = 1;
                } else {
                    $data['ratting'] = 0;
                }
                // dd($data,$user_id);
                return view('Admin.order_track.track-order', $data);
            }

            if (Auth::user()->type == 1) {
                $user_id = @Auth::user()->id;

                    $order_info = Order::with('orderComment')
                        ->select('id', 'product_id', 'order_number', 'vendor_id', 'product_name', 'vendor_comment', 'slug', 'price', 'qty', 'status', 'created_at', 'confirmed_at', 'shipped_at', 'delivered_at', 'attribute', \DB::raw('(case when variation is null then "" else variation end) as variation'), \DB::raw("CONCAT('" . url('/storage/app/public/images/products/') . "/', image) AS image_url"))
                        ->where('id', $id)
                        ->first();

                    return view('Admin.order_track.track-order', compact('order_info'));
                }
            }

            public function search(Request $request)
            {
                if (Auth::user()->type == 1) {
                    $data = Order::with(['vendors'])
                        ->select('order_number', 'vendor_id', 'order_notes', 'full_name', 'email', 'mobile', 'landmark', 'street_address', 'pincode', 'status', \DB::raw('SUM(order_total) AS grand_total'), \DB::raw('DATE_FORMAT(created_at, "%d %M %Y") as date'), \DB::raw('count(order_number) AS no_products'))
                        ->groupBy('order_number')
                        ->where('order_number', 'LIKE', '%' . $request->search . '%')
                        ->orWhere('full_name', 'LIKE', '%' . $request->search . '%')
                        ->orderBy('id', 'DESC')
                        ->paginate(10);
                }

                if (Auth::user()->type == 3) {
                    $data = Order::with(['vendors'])
                        ->select('order_number', 'vendor_id', 'order_notes', 'full_name', 'email', 'mobile', 'landmark', 'street_address', 'pincode', 'status', \DB::raw('SUM(order_total) AS grand_total'), \DB::raw('DATE_FORMAT(created_at, "%d %M %Y") as date'), \DB::raw('count(order_number) AS no_products'))
                        ->where('vendor_id', Auth::user()->id)
                        ->where('order_number', 'LIKE', '%' . $request->search . '%')
                        ->orWhere('full_name', 'LIKE', '%' . $request->search . '%')
                        ->groupBy('order_number')
                        ->orderBy('id', 'DESC')
                        ->paginate(10);
                }
                return view('Admin.orders.index', compact('data'));
            }

            public function orderdetails($id)
            {
                $order_info = Order::with(['vendors', 'stockiest'])
                    ->select('id', 'stockiest_id', 'vendor_id', 'user_id', 'admin_status', 'order_number', 'order_notes', 'payment_type', 'payment_id', 'full_name', 'email', 'mobile', 'landmark', 'stock_name', 'stockiest_id', 'street_address', 'pincode', 'status', \DB::raw('DATE_FORMAT(created_at, "%d-%m-%Y") as date'), \DB::raw('SUM(price*qty) AS subtotal'), \DB::raw('SUM(tax) AS tax'), \DB::raw('SUM(shipping_cost) AS shipping_cost'), \DB::raw('SUM(order_total) AS grand_total'))
                    ->where('order_number', $id)
                    ->groupBy('order_number')
                    ->orderByDesc('id')
                    ->first();

                $order_data = Order::select('id', 'stockiest_id', 'vendor_id', 'user_id', 'product_id', 'product_name', 'price', 'qty', 'tax', 'status', 'discount_amount', 'stock_name', 'return_number', 'admin_product_price', 'admin_status', 'order_total', 'product_type', \DB::raw('(case when variation is null then "" else variation end) as variation'), \DB::raw("CONCAT('" . url('/storage/app/public/images/products/') . "/', image) AS image_url"), 'shipping_cost')
                    ->where('order_number', $id)
                    ->orderBy('id', 'DESC')
                    ->get();
                //  dd('kk');
                return view('Admin.orders.order-details', compact('order_info', 'order_data'));
            }

            public function showStockiest()
            {
                $data = Stockiest::get();
                return response()->json([
                    'data' => $data,
                ]);
            }
            public function delete()
            {
                $data = Order::where('vendor_id', Auth::user()->id)->get();
                return view('Admin.orders.index', compact('data'));
            }

            public function editProductPrice(Request $request)
            {
                // dd($request->all());
                $data = Order::where('id', $request->id)->first();
                $status = $data->update([
                    'price' => $request->update_price,
                    'qty' => $request->update_qty,
                    'order_total' => $request->update_price * $request->update_qty,
                    'stockiest_id' => $request->stockiest_id,
                ]);
                return $status;
            }
            public function deliveredProduct()
            {
                if (Auth::user()->type == 1) {
                    $data['data'] = Order::with(['vendors', 'stockiest'])
                        ->select('id', 'order_number', 'vendor_id', 'order_notes', 'full_name', 'email', 'mobile', 'landmark', 'stockiest_id', 'stock_name', 'admin_status', 'street_address', 'pincode', 'status', \DB::raw('SUM(order_total) AS grand_total'), \DB::raw('DATE_FORMAT(created_at, "%d %M %Y") as date'), \DB::raw('count(order_number) AS no_products'))
                        ->where('status', 4)
                        ->groupBy('order_number')
                        ->orderBy('id', 'DESC')
                        ->get();
                } elseif (Auth::user()->type == 3) {
                    $data['data'] = Order::with(['vendors', 'stockiest'])
                        ->select('id', 'order_number', 'vendor_id', 'order_notes', 'full_name', 'email', 'mobile', 'landmark', 'stockiest_id', 'stock_name', 'admin_status', 'street_address', 'pincode', 'status', \DB::raw('SUM(order_total) AS grand_total'), \DB::raw('DATE_FORMAT(created_at, "%d %M %Y") as date'), \DB::raw('count(order_number) AS no_products'))
                        ->where('vendor_id', Auth::user()->id)
                        ->where('status', 4)
                        ->groupBy('order_number')
                        ->orderBy('id', 'DESC')
                        ->get();
                }
                // dd($data);
                return view('Admin.delivery.index', $data);
            }

            public function orderReturn(Request $request)
            {
                //   dd($request->all());
                $vendorId = '';
                $orderNumber = '';
                $settings = Settings::select('delivery_charge')->first();
                $delivery_charge = $settings->delivery_charge;
                $currentDate = date('Y-m-d');
                $currentDate = date('Y-m-d');
                $orders = Order::where('order_number', $request->order_number)
                    ->where('admin_status', 0)
                    ->get();

                foreach ($orders as $key => $order) {
                    $check_comment = OrderProductComment::where('order_id', $order->id)
                        ->where('status', $request->status)
                        ->first();
                    // dd($check_comment);
                    if (!empty($check_comment)) {
                        OrderProductComment::where('order_id', $order->id)
                            ->where('status', $request->status)
                            ->update([
                                'comment' => $request->comment,
                                'status' => $request->status,
                                'generate_date' => $currentDate,
                            ]);
                    } else {
                        OrderProductComment::create([
                            'order_id' => $order->id,
                            'comment' => $request->comment,
                            'status' => $request->status,
                            'generate_date' => $currentDate,
                        ]);
                    }
                    $order_data = Order::select('vendor_id')
                        ->where('id', $order->id)
                        ->first();
                    $data = ['status' => $request->status, 'returned_at' => date('Y-m-d h:i:s')];
                    Order::where('id', $order->id)->update($data);

                    $vendorId = $order->vendor_id;
                    $orderNumber = $order->order_number;
                }

                RetuenProductWiseIncome::create([
                    'vendor_id' => $vendorId,
                    'order_number' => $orderNumber,
                    'delivery_charge' => $delivery_charge,
                    'generated_date' => $currentDate,
                ]);

                $user_data = User::where('id', $order_data->vendor_id)
                    ->where('type', '3')
                    ->first();
                $currentAmount = $user_data->wallet;
                $updatePrice = $currentAmount - $delivery_charge;
                $user_data->update(['wallet' => $updatePrice]);
            }
            public function changeStatus(Request $request)
            {
                // dd($request->all());
                $currentDate = date('Y-m-d');

                $this->validate($request, [
                    'id' => 'required',
                    'status' => 'required',
                ]);

                $check_comment = OrderProductComment::where('order_id', $request->id)
                    ->where('status', $request->status)
                    ->first();
                // dd($check_comment);
                if (!empty($check_comment)) {
                    OrderProductComment::where('order_id', $request->id)
                        ->where('status', $request->status)
                        ->update([
                            'comment' => $request->comment,
                            'status' => $request->status,
                            'generate_date' => $currentDate,
                        ]);
                } else {
                    OrderProductComment::create([
                        'order_id' => $request->id,
                        'comment' => $request->comment,
                        'status' => $request->status,
                        'generate_date' => $currentDate,
                    ]);
                }

                $status = Order::select('order_total', 'product_name', 'payment_id', 'user_id', 'vendor_id', 'payment_type', 'order_number')
                    ->where('id', $request->id)
                    ->first();

                if ($request->status == 1) {
                    // dd($request->status);
                    $data = ['status' => $request->status, 'cancelled_at' => date('Y-m-d h:i:s')];
                    // $data=array('status'=>$request->status,'cancelled_at'=>date('Y-m-d h:i:s'),'shipped_at'=>NULL,'delivered_at'=>NULL);
                    Order::where('id', $request->id)->update($data);

                    $message = 'Order ' . $order_number . ' has been placed';
                }

                if ($request->status == 2) {
                    $data = ['status' => $request->status, 'confirmed_at' => date('Y-m-d h:i:s')];
                    Order::where('id', $request->id)->update($data);

                    $message = '' . $status->product_name . ' has been confirmed';
                }

                if ($request->status == 3) {
                    $data = ['status' => $request->status, 'shipped_at' => date('Y-m-d h:i:s')];
                    Order::where('id', $request->id)->update($data);

                    $message = '' . $status->product_name . ' has been shipped';
                }
                if ($request->status == 11) {
                    //11 = order assign to rider
                    $data = ['status' => $request->status, 'assigned_at' => date('Y-m-d h:i:s')];
                    Order::where('id', $request->id)->update($data);

                    $message = '' . $status->product_name . ' has been assigned to rider';
                }
                if ($request->status == 8) {
                    //8 = order returned
                    // $orderData =  Order::find($request->id);
                    //  $stock_data = CurrentStock::where('product_id', $request->product_id)
                    //     ->where('stock_id', $request->stockiest_id)
                    //     ->first();

                    //     $stock_data->update([
                    //         'current_stock'=> ($stock_data->current_stock) + ($orderData->qty)
                    //     ]);

                    $order_data = Order::select('vendor_id')
                        ->where('id', $request->id)
                        ->first();

                    $settings = Settings::select('delivery_charge')->first();

                    $user_data = User::where('id', $order_data->vendor_id)
                        ->where('type', '3')
                        ->first();
                    $currentAmount = $user_data->wallet;
                    $updatePrice = $currentAmount - $settings->delivery_charge;
                    $user_data->update(['wallet' => $updatePrice]);

                    $data = ['status' => $request->status, 'returned_at' => date('Y-m-d h:i:s')];
                    Order::where('id', $request->id)->update($data);

                    $order_data = Order::where('id', $request->id)->first();
                    $settings = Settings::select('delivery_charge')->first();
                    // dd($settings);

                    $delivery_charge = $settings->delivery_charge;
                    //  dd($order_data);
                    $currentDate = date('Y-m-d');
                    $message = '' . $status->product_name . ' has been returned';
                    RetuenProductWiseIncome::create([
                        'product_id' => $order_data->product_id,
                        'vendor_id' => $order_data->vendor_id,
                        'order_id' => $order_data->id,
                        'order_number' => $order_data->order_number,
                        'qty' => $order_data->qty,
                        'delivery_charge' => $delivery_charge,
                        'generated_date' => $currentDate,
                    ]);
                }

                if ($request->status == 4) {
                    //  dd($request->all());
                     $orderData =  Order::find($request->id);
                     $stock_data = CurrentStock::where('product_id', $request->product_id)
                        ->where('stock_id', $request->stockiest_id)
                        ->first();
                        // dd($stock_data->current_stock);
                        if($stock_data && $stock_data->current_stock>= $request->product_qty){

                         if ($request->product_type == 'stockiest_product') {

                        $stockiest = Stockiest::where('id', $request->stockiest_id)
                            ->with('user')
                            ->first();

                        $checkVendor = VendorProduct::where('product_id', $request->product_id)
                            ->where('vendor_id', $stockiest->user_id)
                            ->first();
                        if (!$checkVendor) {
                            $product = Products::find($request->product_id);
                            $msg = $product->product_name . ' is not ' . $stockiest->user->name . ' product';
                            //  $message = 'message',$product->product_name." is not ". $stockiest->user->name. " product";
                            return response()->json([
                                'msg' => $msg,
                                'status' => 2000,
                            ]);
                            // return redirect()->back()
                            // ->with('message',$product->product_name." is not ". $stockiest->user->name. " product");
                        } else {
                            $data = ['status' => $request->status, 'delivered_at' => date('Y-m-d h:i:s')];
                            Order::where('id', $request->id)->update($data);

                            $message = '' . $status->product_name . ' has been delivered';

                            if ($status->payment_type == 1) {
                                $getvendordata = User::select('wallet')
                                    ->where('id', $status->vendor_id)
                                    ->first();
                                if ($getvendordata->wallet > 0) {
                                    $vendorwallet = $getvendordata->wallet + $status->order_total;
                                } elseif ($getvendordata->wallet < 0) {
                                    $vendorwallet = $getvendordata->wallet + $status->order_total;
                                } else {
                                    $vendorwallet = 0;
                                }
                                //$UpdateWalletDetails = User::where('id', $status->vendor_id)->update(['wallet' => $vendorwallet]);
                            }
                        }
                    } else {
                        $data = ['status' => $request->status, 'delivered_at' => date('Y-m-d h:i:s')];
                        Order::where('id', $request->id)->update($data);

                        $message = '' . $status->product_name . ' has been delivered';

                        if ($status->payment_type == 1) {
                            $getvendordata = User::select('wallet')
                                ->where('id', $status->vendor_id)
                                ->first();
                            if ($getvendordata->wallet > 0) {
                                $vendorwallet = $getvendordata->wallet + $status->order_total;
                            } elseif ($getvendordata->wallet < 0) {
                                $vendorwallet = $getvendordata->wallet + $status->order_total;
                            } else {
                                $vendorwallet = 0;
                            }
                            //$UpdateWalletDetails = User::where('id', $status->vendor_id)->update(['wallet' => $vendorwallet]);
                        }
                    }

                           $stock_data->update([
                            'current_stock'=> ($stock_data->current_stock) - ($orderData->qty)
                        ]);

                        }else{
                            $product = Products::find($request->product_id);
                              $msg = $product->product_name . ' Out of Stock';

                            return response()->json([
                                'msg' => $msg,
                                'status' => 2000,
                            ]);

                        }




                }

                if ($request->status == 5) {
                    if ($status->payment_type != '1') {
                        $walletdata = User::select('wallet')
                            ->where('id', $status->user_id)
                            ->first();

                        if ($walletdata->wallet >= 0) {
                            $walletamount = $walletdata->wallet + $status->order_total;
                        } elseif ($walletdata->wallet <= 0) {
                            $walletamount = $walletdata->wallet + $status->order_total;
                        } else {
                            $walletamount = 0;
                        }

                        //$UpdateWalletDetails = User::where('id', $status->user_id)->update(['wallet' => $walletamount]);

                        $Wallet = new Transaction();
                        $Wallet->user_id = $status->user_id;
                        $Wallet->order_id = $request->id;
                        $Wallet->order_number = $status->order_number;
                        $Wallet->wallet = $status->order_total;
                        $Wallet->payment_id = $status->payment_id;
                        $Wallet->transaction_type = '1';
                        $Wallet->save();

                        $getvendordata = User::select('wallet')
                            ->where('id', $status->vendor_id)
                            ->first();

                        if ($getvendordata->wallet >= 0) {
                            $vendorwallet = $getvendordata->wallet - $status->order_total;
                        } elseif ($getvendordata->wallet <= 0) {
                            $vendorwallet = $getvendordata->wallet - $status->order_total;
                        } else {
                            $vendorwallet = 0;
                        }

                        //$vendorwallet = User::where('id', $status->vendor_id)->update(['wallet' => $vendorwallet]);
                    }
                    //    dd($request->status);
                    $data = ['status' => $request->status, 'cancelled_at' => date('Y-m-d h:i:s'), 'shipped_at' => null];
                    Order::where('id', $request->id)->update($data);
                    $message = '' . $status->product_name . ' has been cancelled by vendor';
                }

                if ($data) {
                    $notification = ['user_id' => $status->user_id, 'order_id' => $request->id, 'order_number' => $status->order_number, 'order_status' => $request->status, 'message' => $message, 'is_read' => '1', 'type' => 'order'];
                    $store = Notification::create($notification);

                    return 1000;
                } else {
                    return 2000;
                }
            }
            public function orderStatusUpdate($id)
            {
                $distr_array = ['1st Generation' => 'no', '2nd Generation' => 'no', '3rd Generation' => 'no', '1st Star' => 'monthly', '2nd Star' => 'monthly', '3rd Star' => 'monthly', 'Incentive' => 'no', 'Poor' => 'no', 'Health Fund' => 'no', 'Stockiest' => 'no', 'Pension Fund' => 'no', 'Religion Fund' => 'no'];

                $orderData = Order::where('order_number', $id)
                    ->with(['user', 'product', 'vendors'])
                    ->where('status', 4) //----status = 4 mean its product delivered ---
                    ->where('admin_status', 0) //----admin_status = 0 mean order not-accepted---
                    ->get();

                $check_is = true;
                $check_stock = true;
                foreach ($orderData as $key => $pro) {
                    $stockiest = Stockiest::where('id', $pro->stockiest_id)
                        ->with('user')
                        ->first();
                    // dd($stockiest->user_id);

                    $checkStock = CurrentStock::where('product_id', $pro->product_id)
                        ->where('stock_id', $pro->stockiest_id)
                        ->first();

                    $checkVendor = VendorProduct::where('product_id', $pro->product_id)
                        ->where('vendor_id', $stockiest->user_id)
                        ->first();
                    if (!$checkVendor) {
                        $product = Products::find($pro->product_id);
                        $check_is = false;
                        return redirect()
                            ->back()
                            ->with('message', $product->product_name . ' is not ' . $stockiest->user->name . ' product');
                    }

                    if ($checkStock) {
                        if($checkStock->current_stock < $pro->qty){
                        $check_stock = false;
                        $product = Products::find($pro->product_id);
                        return redirect()
                            ->back()
                            ->with('message', $product->product_name . ' is out of stock');
                        }

                    }
                }
                // dd($check_is,$check_stock);
                if (count($orderData) > 0 && $check_is == true && $check_stock == true) {
                    $currentDate = date('Y-m-d');
                    $vendor_profit = 0;
                    $admin_profit = 0;
                    $levels = Business_Setting::all();

                    $settings = Settings::select('sales_center_commission', 'delivery_charge', 'distribute_amount')->first();
                    // dd($settings);
                    $sales_center_commission = $settings->sales_center_commission;
                    $delivery_charge = $settings->delivery_charge;
                    $distribute_amount = $settings->distribute_amount;

                    $approved_by = Auth::user()->id;

                    $fundDatas = FundDistribution::get();
                    // dd($orderData[0]);
                    $first_generation = $fundDatas[0];
                    $second_generation = $fundDatas[1];
                    $third_generation = $fundDatas[2];
                    $stockiest_commission = $fundDatas[9];
                    $vandorId = $orderData[0]->vendor_id;
                    $vandorName = $orderData[0]->vendors->name;

                    foreach ($orderData as $data) {
                        $stockiest_id = $data->stockiest_id;
                        $order_date = $data->created_at;

                        $product_id = $data->product_id;
                        $order_id = $data->id;
                        $order_number = $data->order_number;
                        $user_id = $data->vendors->id;
                        $order_product_price=$data->price;

                        $user_refferal_vendor = $data->vendors->refferal_vendor;

                        $vendor_id = $data->vendor_id;
                        $point = $data->product->point;
                        $qty = $data->qty;
                        $store_user_id = [];
                        $store_product_id = [];

                        $vandor_product = VendorProduct::where('product_id', $product_id)
                            ->where('vendor_id', $vendor_id)
                            ->first();
                        $stockiest_data = Stockiest::where('id', $stockiest_id)
                            ->with('user')
                            ->first();
                        $vendorData = User::where('id', $user_id)->first();
                        $stockiestComission = $stockiest_commission->amount * $qty;

                        // if ($vendorData->vendor_status == 1) {

                        //   minus product qty from current_stock


                        foreach ($levels as $index => $level) {
                            $level_name = $level->level;
                            $amount = (float) $level->amount;

                            $check_referer = User::where('referral_code', $user_refferal_vendor)->first();

                            if ($check_referer) {
                                $user_refferal_vendor = $check_referer->refferal_vendor;
                                if ($index + 1 == 1) {
                                    if ($check_referer->vendor_status == 1) {
                                        $distr_array['1st Generation'] = 'yes';
                                    }
                                    $generation_amount = $first_generation->amount * $qty;
                                } elseif ($index + 1 == 2) {
                                    if ($check_referer->vendor_status == 1) {
                                        $distr_array['2nd Generation'] = 'yes';
                                    }
                                    $generation_amount = $second_generation->amount * $qty;
                                } elseif ($index + 1 == 3) {
                                    if ($check_referer->vendor_status == 1) {
                                        $distr_array['3rd Generation'] = 'yes';
                                    }
                                    $generation_amount = $third_generation->amount * $qty;
                                }

                                //  -------------Affiliate Commission---------
                                if ($check_referer->vendor_status == 1) {
                                    ProductCommissionDistribution::create([
                                        'level' => $level_name,
                                        'vendor_id' => $vendor_id,
                                        'product_id' => $product_id,
                                        'point' => $point,
                                        'amount' => (float) $generation_amount,
                                        'generated_date' => $currentDate,
                                        'approved_id' => $approved_by,
                                        'order_id' => $order_id,
                                        'user_id' => $check_referer->id,
                                    ]);
                                }

                                if ($check_referer->vendor_status == 1) {
                                    $user = User::find($check_referer->id);
                                    $currentAmount = $user->wallet;
                                    $updatePrice = $currentAmount + (float) $generation_amount;
                                    $user->update(['wallet' => $updatePrice]);
                                }
                            }
                        }
                        //}

                        $profit = $order_product_price - $vandor_product->admin_product_price;
                        $total_profit = $profit * $qty;

                        $product_income = ProductWiseIncome::create([
                            'product_id' => $product_id,
                            'vendor_product_id' => $vandor_product->id,
                            'vendor_id' => $vendor_id,
                            'order_id' => $order_id,
                            'order_number' => $order_number,
                            'qty' => $qty,
                            // 'invoice_id' => $point,
                            'product_price' => $order_product_price,
                            'admin_product_price' => $vandor_product->admin_product_price,
                            'delivery_charge' => $delivery_charge,
                            'vendor_profit' => $total_profit,
                            'admin_profit' => $vandor_product->admin_product_price * $qty - $distribute_amount * $qty,
                            'distribute_amount' => $distribute_amount * $qty,
                            'generated_date' => $currentDate,
                        ]);

                        if ($product_income) {
                            $vendor_profit = $vendor_profit + $total_profit;
                            $admin_profit = $admin_profit + $vandor_product->admin_product_price * $qty - $distribute_amount * $qty;
                        }

                        //    ----Found Distribution Amount------

                        foreach ($fundDatas as $ind => $fund) {
                            if ($stockiest_data->user->stockiest_status == 0) {
                                if ($fund->title == 'Stockiest') {
                                    $distr_array['Stockiest'] = 'no';
                                    DistributeFundAmount::create([
                                        'fund_distribution_id' => $fund->id,
                                        'fund_title' => $fund->title,
                                        'order_id' => $data->id,
                                        'order_number' => $data->order_number,
                                        'vendor_id' => $vandorId,
                                        'distribution_status' => $distr_array[$fund->title],
                                        'vendor_name' => $vandorName,
                                        'amount' => (float) ($fund->amount * $data->qty),
                                    ]);
                                } else {
                                    DistributeFundAmount::create([
                                        'fund_distribution_id' => $fund->id,
                                        'fund_title' => $fund->title,
                                        'order_id' => $data->id,
                                        'order_number' => $data->order_number,
                                        'vendor_id' => $vandorId,
                                        'distribution_status' => $distr_array[$fund->title],
                                        'vendor_name' => $vandorName,
                                        'amount' => (float) ($fund->amount * $data->qty),
                                    ]);
                                }
                            } elseif ($stockiest_data->user->stockiest_status == 1) {
                                //    dd('kkk');
                                $distr_array['Stockiest'] = 'yes';
                                DistributeFundAmount::create([
                                    'fund_distribution_id' => $fund->id,
                                    'fund_title' => $fund->title,
                                    'order_id' => $data->id,
                                    'order_number' => $data->order_number,
                                    'vendor_id' => $vandorId,
                                    'distribution_status' => $distr_array[$fund->title],
                                    'vendor_name' => $vandorName,
                                    'amount' => (float) ($fund->amount * $data->qty),
                                ]);

                                //---------Stockiest commission-------------
                                if ($ind == 0) {
                                    SalesCommission::create([
                                        'stockiest_id' => $stockiest_id,
                                        // 'product_id'=> $store_product_id[$s],
                                        'product_id' => $product_id,
                                        'user_id' => $stockiest_data->user_id,
                                        'point' => $point,
                                        'amount' => (float) $stockiestComission,
                                        'order_date' => $order_date,
                                        'approved_date' => $currentDate,
                                        'generated_date' => $currentDate,
                                    ]);

                                    //    ------add amount in stockiest wallet----
                                    $user = User::find($stockiest_data->user_id);
                                    // dd($user);
                                    if ($user) {
                                        $distr_array['Stockiest'] = 'yes';
                                        $amount = $user->wallet;
                                        // dd($amount);
                                        $updatePrice = $amount + $stockiestComission;

                                        $user->update(['wallet' => $updatePrice]);
                                    } else {
                                        $user_admin = User::where('id', 1)
                                            ->where('type', '1')
                                            ->first();
                                        $adminCurrentAmount = $user_admin->wallet;
                                        $updatePrice = $adminCurrentAmount + $distribute_amount * $qty - $stockiestComission;
                                        $user_admin->update(['wallet' => $updatePrice]);
                                    }
                                }
                            }
                        }

                    }



                    $user = User::find($vendor_id);
                    $amount = $user->wallet;
                    $updatePrice = $amount + $vendor_profit - $delivery_charge;
                    \DB::table('users')
                        ->where('id', $vendor_id)
                        ->update(['wallet' => $updatePrice]);

                    //update admin wallet
                    $undistribute_amount = DistributeFundAmount::where('order_number', $id)
                        ->where('distribution_status', 'no')
                        ->where('calculation_sataus', 'no')
                        ->select(\DB::raw('SUM(amount) as amount'))
                        ->first();
                    $all_undistribute_amount = DistributeFundAmount::where('order_number', $id)
                        // ->where('distribution_status', 'no')
                        ->where('calculation_sataus', 'no')
                        ->get();
                    foreach ($all_undistribute_amount as $undis_row) {
                        // dd($undis_row);
                        DistributeFundAmount::where('id', $undis_row->id)->update(['calculation_sataus' => 'yes']);
                    }

                    $user = User::where('id', 1)
                        ->where('type', '1')
                        ->first();
                    // $delivery_charge
                    $currentAmount = $user->wallet;
                    $updatePrice = $currentAmount + $admin_profit + $undistribute_amount->amount;

                    \DB::table('users')
                        ->where('id', 1)
                        ->where('type', '1')
                        ->update(['wallet' => $updatePrice]);
                    $all_order_data = Order::where('order_number', $id)
                        ->where('status', 4)
                        ->get();
                    foreach ($all_order_data as $order_row) {
                        Order::where('id', $order_row->id)->update(['admin_status' => '1', 'status_update' => $currentDate, 'confirmed_at' => date('Y-m-d h:i:s')]);
                    }

                    // Order::where('order_number', $id)->update(['admin_status' => '1', 'status_update' => $currentDate, 'confirmed_at' => date('Y-m-d h:i:s')]);

                    if (Auth::user()->type == 1) {
                        $data = Order::with(['vendors'])
                            ->select('id', 'order_number', 'vendor_id', 'order_notes', 'full_name', 'email', 'mobile', 'landmark', 'admin_status', 'street_address', 'pincode', 'status', \DB::raw('SUM(order_total) AS grand_total'), \DB::raw('DATE_FORMAT(created_at, "%d %M %Y") as date'), \DB::raw('count(order_number) AS no_products'))
                            ->groupBy('order_number')
                            ->orderBy('id', 'DESC')
                            ->paginate(10);
                    }
                    if (Auth::user()->type == 3) {
                        $data = Order::with(['vendors'])
                            ->select('id', 'order_number', 'vendor_id', 'order_notes', 'full_name', 'email', 'mobile', 'landmark', 'admin_status', 'street_address', 'pincode', 'status', \DB::raw('SUM(order_total) AS grand_total'), \DB::raw('DATE_FORMAT(created_at, "%d %M %Y") as date'), \DB::raw('count(order_number) AS no_products'))
                            ->where('vendor_id', Auth::user()->id)
                            ->groupBy('order_number')
                            ->orderBy('id', 'DESC')
                            ->paginate(10);
                    }

                    // return view('Admin.orders.index', compact('data'));
                    return redirect()
                        ->back()
                        ->with('message', 'Accepted Succssfully');
                } else {
                    return redirect()
                        ->back()
                        ->with('message', 'Your product is not delivered');
                }
            }

            public function orderStatusCancel(int $id)
            {
                $currentDate = date('Y-m-d');

                \DB::table('orders')
                    ->where('id', $id)
                    ->update(['admin_status' => '2', 'status_update' => $currentDate]);

                return $this->index();
            }

            public function updateWallet($id, $amount)
            {
                $user = User::find($id);

                $currentAmount = $user->wallet;
                $updatePrice = $currentAmount + $amount;

                $data = \DB::table('users')
                    ->where('id', $id)
                    ->update(['wallet' => $updatePrice]);
                return $data;
            }

            public function showAllCancelOrder()
            {
                // $data['datas'] =  Order::where('status','5')->orWhere('status','6')->with(['vendors', 'stockiest'])->get();
                if (Auth::user()->type == 1) {
                    $data['datas'] = Order::with(['vendors', 'stockiest'])
                        ->select('id', 'order_number', 'vendor_id', 'qty', 'order_notes', 'full_name', 'email', 'mobile', 'landmark', 'stockiest_id', 'stock_name', 'admin_status', 'street_address', 'pincode', 'status', \DB::raw('SUM(order_total) AS grand_total'), \DB::raw('DATE_FORMAT(created_at, "%d %M %Y") as date'), \DB::raw('count(order_number) AS no_products'))
                        ->where('status', '5')
                        ->orWhere('status', '6')
                        ->groupBy('order_number')
                        ->orderBy('id', 'DESC')
                        ->get();
                }

                if (Auth::user()->type == 3) {
                    $data['datas'] = Order::with(['vendors', 'stockiest'])
                        ->select('id', 'order_number', 'vendor_id', 'qty', 'order_notes', 'full_name', 'email', 'mobile', 'landmark', 'stockiest_id', 'stock_name', 'admin_status', 'street_address', 'pincode', 'status', \DB::raw('SUM(order_total) AS grand_total'), \DB::raw('DATE_FORMAT(created_at, "%d %M %Y") as date'), \DB::raw('count(order_number) AS no_products'))
                        ->where('vendor_id', Auth::user()->id)
                        ->where('status', '5')
                        ->orWhere('status', '6')
                        ->groupBy('order_number')
                        ->orderBy('id', 'DESC')
                        ->get();
                }

                return view('Admin.cancel_order.index', $data);
            }
        }
