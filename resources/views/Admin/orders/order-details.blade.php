@extends('layouts.admin')
@section('title')
    {{ Helper::webinfo()->site_title }} | {{ trans('labels.orders') }}
@endsection
@section('css')
@endsection
@section('content')
    <div class="content-wrapper">
        @if (Session::has('success'))
            <div class="alert alert-success">
                {{ Session::get('success') }}
                @php
                    Session::forget('success');
                @endphp
            </div>
        @endif

        @if (Session::has('danger'))
            <div class="alert alert-danger">
                {{ Session::get('danger') }}
                @php
                    Session::forget('danger');
                @endphp
            </div>
        @endif

        <div class="row">
            <div class="col-md-12">
                <h4>{{ trans('labels.invoice') }}</h4>
            </div>
        </div>
        <section class="invoice-template">
            <div class="card">
                @if (Session::has('message'))
                    {{-- {{dd(Session::get('message'))}} --}}
                    <div class="alert alert-danger">
                        {{ Session::get('message') }}
                        @php
                            Session::forget('message');
                        @endphp
                    </div>
                @endif
                {{-- {{dd($order_data)}} --}}
                <div class="card-body p-3">
                    <div id="invoice-template" class="card-block">
                        <!-- Invoice Company Details -->
                        <div id="invoice-company-details" class="row">
                            <div class="col-6 text-left">
                                <img src="{{ $order_info['vendors']->image_url }}" alt="company logo" class="mb-2"
                                    width="70">
                                <ul class="px-0 list-unstyled">
                                    <li>{{ $order_info['vendors']->store_address }}</li>
                                </ul>
                            </div>
                            <div class="col-6 text-right">
                                <h2>{{ trans('labels.invoice') }}</h2>

                                {{-- {{dd($order_info)}} --}}

                                {{-- <p class="pb-3"># {{$order_info->stockiest->stock_name}}</p> --}}
                                {{-- <p class="pb-3"># {{$order_info ?  $order_info->stockiest ?  $order_info->stockiest->stock_name : "" : ""}}</p> --}}
                            </div>
                        </div>
                        <!--/ Invoice Company Details -->
                        <!-- Invoice Customer Details -->
                        <div id="invoice-customer-details" class="row pt-2">
                            <div class="col-sm-12 text-left">
                                <p class="text-muted">{{ trans('labels.bill_to') }}</p>
                            </div>
                            <div class="col-9 text-left">
                                <ul class="px-0 list-unstyled">
                                    <li class="text-bold-800">{{ $order_info->full_name }}</li>
                                    <li class="text-bold-800">{{ $order_info->email }}</li>
                                    <li class="text-bold-800">{{ $order_info->mobile }}</li>
                                    <li>{{ $order_info->street_address }},</li>
                                    <li>{{ $order_info->landmark }},</li>
                                    <li>{{ $order_info->pincode }}.</li>
                                </ul>
                            </div>
                            <div class="col-3 text-left">
                                <p><span class="text-muted">{{ trans('labels.invoice_date') }} :</span>
                                    {{ $order_info->date }}</p>
                                <p><span class="text-muted">{{ trans('labels.sales_point') }} :</span>
                                    {{ $order_info ? ($order_info->stockiest ? $order_info->stockiest->stock_name : '') : '' }}
                                </p>
                            </div>
                        </div>
                        <!--/ Invoice Customer Details -->
                        <!-- Invoice Items Details -->
                        <div id="invoice-items-details" class="pt-2">
                            <div class="row">
                                <div class="table-responsive col-sm-12">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th>{{ trans('labels.image') }}</th>
                                                <th>{{ trans('labels.name') }}</th>
                                                <th>{{ trans('labels.vendor_price') }}</th>
                                                <th>{{ trans('labels.admin_price') }}</th>
                                                <th>{{ trans('labels.qty') }}</th>
                                                <th>{{ trans('labels.tax') }}</th>
                                                <th>{{ trans('labels.shipping_charge') }}</th>
                                                <th>{{ trans('labels.status') }}</th>
                                                <th>{{ trans('labels.order_total') }}</th>
                                                <th>{{ trans('labels.action') }}</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($order_data as $row)
                                                @if ($row->discount_amount == '')
                                                    @php $grand_total = $row->subtotal+$row->tax+$row->shipping_cost; @endphp
                                                @else
                                                    @php $grand_total = $row->subtotal+$row->tax+$row->shipping_cost-$row->discount_amount; @endphp
                                                @endif
                                                <tr>
                                                    <td><img class="media-object round-media height-50"
                                                            src="{{ $row->image_url }}" alt="Generic placeholder image" />
                                                    </td>
                                                    <td>{{ $row->product_name }} @if ($row->variation != '')
                                                            ({{ $row->variation }})
                                                        @endif
                                                    </td>
                                                    <td>{{ Helper::CurrencyFormatter($row->price) }}</td>
                                                    <td>{{ Helper::CurrencyFormatter($row->admin_product_price) }}</td>
                                                    <td>{{ $row->qty }}</td>
                                                    <td>{{ Helper::CurrencyFormatter($row->tax) }}</td>
                                                    <td>{{ Helper::CurrencyFormatter($row->shipping_cost) }}</td>
                                                    {{-- @if (Auth::user()->type == 1)
                                                <td>
                                                    @if ($row->status == 1)
                                                        {{ trans('labels.order_placed') }}
                                                    @endif
                                                    @if ($row->status == 2)
                                                        {{ trans('labels.confirmed') }}
                                                    @endif
                                                    @if ($row->status == 3)
                                                        {{ trans('labels.order_shipped') }}
                                                    @endif
                                                    @if ($row->status == 4)
                                                        {{ trans('labels.delivered') }}
                                                    @endif
                                                    @if ($row->status == 5)
                                                        {{ trans('labels.cancelled_by_vendor') }}
                                                    @endif
                                                    @if ($row->status == 6)
                                                        {{ trans('labels.cancelled_by_user') }}
                                                    @endif
                                                    @if ($row->status == 7)
                                                        {{ trans('labels.return_request_raised') }}
                                                    @endif
                                                    @if ($row->status == 8)
                                                        {{ trans('labels.return_in_progress') }}
                                                    @endif
                                                    @if ($row->status == 9)
                                                        {{ trans('labels.return_complete') }}
                                                    @endif
                                                    @if ($row->status == 20)
                                                        {{ trans('labels.return_rejected') }}
                                                    @endif
                                                </td>
                                                @endif --}}
                                                    @if (Auth::user()->type == 3 || Auth::user()->type == 1)
                                                        <td id="tdstatus{{ $row->id }}">
                                                            <div class="btn-group">
                                                                @if ($row->status != 4)
                                                                    @if ($row->status != 5 && $row->status != 7 && $row->status != 8 && $row->status != 9 && $row->status != 10)
                                                                        <a class="btn dropdown-toggle"
                                                                            data-toggle="dropdown" href="#">
                                                                            @if ($row->status == 1)
                                                                                {{ trans('labels.order_placed') }}
                                                                            @endif

                                                                            @if ($row->status == 2)
                                                                                {{ trans('labels.confirmed') }}
                                                                            @endif
                                                                            @if ($row->status == 3)
                                                                                {{ trans('labels.order_shipped') }}
                                                                            @endif
                                                                            @if ($row->status == 11)
                                                                                {{ trans('labels.assigned_to_rider') }}
                                                                            @endif
                                                                            @if ($row->status == 4)
                                                                                {{ trans('labels.delivered') }}
                                                                            @endif
                                                                            <span class="caret"></span>
                                                                        </a>
                                                                    @endif
                                                                    <ul class="dropdown-menu"
                                                                        style="overflow-y: scroll; height: 115px;">
                                                                        @if ($row->status == 1)
                                                                            <button
                                                                                class="dropdown-item changeStatus active"
                                                                                data-id="{{ $row->id }}"
                                                                                data-status="1">{{ trans('labels.order_placed') }}</button>
                                                                            <button class="dropdown-item changeStatus"
                                                                                data-id="{{ $row->id }}"
                                                                                data-status="2">{{ trans('labels.confirmed') }}</button>

                                                                            @if (Auth::user()->type == 1)
                                                                                <button class="dropdown-item changeStatus"
                                                                                    data-id="{{ $row->id }}"
                                                                                    data-status="3">{{ trans('labels.order_shipped') }}</button>
                                                                                <button class="dropdown-item changeStatus"
                                                                                    data-id="{{ $row->id }}"
                                                                                    data-status="11">{{ trans('labels.assigned_to_rider') }}
                                                                                </button>
                                                                                <button class="dropdown-item changeStatus"
                                                                                    data-id="{{ $row->id }}"
                                                                                    data-product-id="{{ $row->product_id }}"
                                                                                    data-stockiest-id="{{ $row->stockiest_id }}"
                                                                                    data-product-type="{{ $row->product_type }}"
                                                                                    data-status="8">{{ trans('labels.return') }}
                                                                                </button>
                                                                                <button class="dropdown-item changeStatus"
                                                                                    data-id="{{ $row->id }}"
                                                                                    data-product-id="{{ $row->product_id }}"
                                                                                    data-stockiest-id="{{ $row->stockiest_id }}"
                                                                                    data-product-type="{{ $row->product_type }}"
                                                                                    data-product-qty="{{ $row->qty }}"
                                                                                    data-status="4">{{ trans('labels.delivered') }}</button>
                                                                            @endif
                                                                            <button class="dropdown-item changeStatus"
                                                                                data-id="{{ $row->id }}"
                                                                                data-status="5">{{ trans('labels.cancelled') }}</button>
                                                                        @endif
                                                                        @if ($row->status == 2)
                                                                            <button class="dropdown-item changeStatus"
                                                                                data-id="{{ $row->id }}"
                                                                                data-status="1">{{ trans('labels.order_placed') }}</button>
                                                                            <button
                                                                                class="dropdown-item changeStatus active"
                                                                                data-id="{{ $row->id }}"
                                                                                data-status="2">{{ trans('labels.confirmed') }}</button>

                                                                            @if (Auth::user()->type == 1)
                                                                                <button class="dropdown-item changeStatus"
                                                                                    data-id="{{ $row->id }}"
                                                                                    data-status="3">{{ trans('labels.order_shipped') }}</button>
                                                                                <button class="dropdown-item changeStatus"
                                                                                    data-id="{{ $row->id }}"
                                                                                    data-status="11">{{ trans('labels.assigned_to_rider') }}
                                                                                </button>
                                                                                <button class="dropdown-item changeStatus"
                                                                                    data-id="{{ $row->id }}"
                                                                                    data-product-id="{{ $row->product_id }}"
                                                                                    data-stockiest-id="{{ $row->stockiest_id }}"
                                                                                    data-product-type="{{ $row->product_type }}"
                                                                                    data-status="8">{{ trans('labels.return') }}
                                                                                </button>
                                                                                <button class="dropdown-item changeStatus"
                                                                                    data-id="{{ $row->id }}"
                                                                                    data-product-id="{{ $row->product_id }}"
                                                                                    data-stockiest-id="{{ $row->stockiest_id }}"
                                                                                    data-product-type="{{ $row->product_type }}"
                                                                                    data-product-qty="{{ $row->qty }}"
                                                                                    data-status="4">{{ trans('labels.delivered') }}</button>
                                                                            @endif
                                                                            <button class="dropdown-item changeStatus"
                                                                                data-id="{{ $row->id }}"
                                                                                data-status="5">{{ trans('labels.cancelled') }}</button>
                                                                        @endif
                                                                        @if ($row->status == 3)
                                                                            <button class="dropdown-item changeStatus"
                                                                                data-id="{{ $row->id }}"
                                                                                data-status="1">{{ trans('labels.order_placed') }}</button>
                                                                            <button class="dropdown-item changeStatus"
                                                                                data-id="{{ $row->id }}"
                                                                                data-status="2">{{ trans('labels.confirmed') }}</button>

                                                                            @if (Auth::user()->type == 1)
                                                                                <button
                                                                                    class="dropdown-item changeStatus active"
                                                                                    data-id="{{ $row->id }}"
                                                                                    data-status="3">{{ trans('labels.order_shipped') }}
                                                                                </button>
                                                                                <button class="dropdown-item changeStatus"
                                                                                    data-id="{{ $row->id }}"
                                                                                    data-status="11">{{ trans('labels.assigned_to_rider') }}
                                                                                </button>
                                                                                <button class="dropdown-item changeStatus"
                                                                                    data-id="{{ $row->id }}"
                                                                                    data-product-id="{{ $row->product_id }}"
                                                                                    data-stockiest-id="{{ $row->stockiest_id }}"
                                                                                    data-product-type="{{ $row->product_type }}"
                                                                                    data-status="8">{{ trans('labels.return') }}
                                                                                </button>
                                                                                <button class="dropdown-item changeStatus"
                                                                                    data-id="{{ $row->id }}"
                                                                                    data-product-id="{{ $row->product_id }}"
                                                                                    data-stockiest-id="{{ $row->stockiest_id }}"
                                                                                    data-product-type="{{ $row->product_type }}"
                                                                                    data-product-qty="{{ $row->qty }}"
                                                                                    data-status="4">{{ trans('labels.delivered') }}</button>
                                                                            @endif

                                                                            <button class="dropdown-item changeStatus"
                                                                                data-id="{{ $row->id }}"
                                                                                data-status="5">{{ trans('labels.cancelled') }}</button>
                                                                        @endif
                                                                        @if ($row->status == 11)
                                                                            {{-- 11 = order assign to rider --}}
                                                                            <button class="dropdown-item changeStatus"
                                                                                data-id="{{ $row->id }}"
                                                                                data-status="1">{{ trans('labels.order_placed') }}</button>
                                                                            <button class="dropdown-item changeStatus"
                                                                                data-id="{{ $row->id }}"
                                                                                data-status="2">{{ trans('labels.confirmed') }}</button>

                                                                            @if (Auth::user()->type == 1)
                                                                                <button class="dropdown-item changeStatus"
                                                                                    data-id="{{ $row->id }}"
                                                                                    data-status="3">{{ trans('labels.order_shipped') }}
                                                                                </button>
                                                                                <button
                                                                                    class="dropdown-item changeStatus active"
                                                                                    data-id="{{ $row->id }}"
                                                                                    data-status="11">{{ trans('labels.assigned_to_rider') }}
                                                                                </button>
                                                                                <button class="dropdown-item changeStatus"
                                                                                    data-id="{{ $row->id }}"
                                                                                    data-product-id="{{ $row->product_id }}"
                                                                                    data-stockiest-id="{{ $row->stockiest_id }}"
                                                                                    data-product-type="{{ $row->product_type }}"
                                                                                    data-status="8">{{ trans('labels.return') }}
                                                                                </button>
                                                                                <button class="dropdown-item changeStatus"
                                                                                    data-id="{{ $row->id }}"
                                                                                    data-product-id="{{ $row->product_id }}"
                                                                                    data-stockiest-id="{{ $row->stockiest_id }}"
                                                                                    data-product-type="{{ $row->product_type }}"
                                                                                    data-product-qty="{{ $row->qty }}"
                                                                                    data-status="4">{{ trans('labels.delivered') }}</button>
                                                                            @endif
                                                                            <button class="dropdown-item changeStatus"
                                                                                data-id="{{ $row->id }}"
                                                                                data-status="5">{{ trans('labels.cancelled') }}</button>
                                                                        @endif
                                                                        @if ($row->status == 8)
                                                                            {{-- 11 = order assign to rider --}}
                                                                            <button class="dropdown-item changeStatus"
                                                                                data-id="{{ $row->id }}"
                                                                                data-status="1">{{ trans('labels.order_placed') }}</button>
                                                                            <button class="dropdown-item changeStatus"
                                                                                data-id="{{ $row->id }}"
                                                                                data-status="2">{{ trans('labels.confirmed') }}</button>

                                                                            @if (Auth::user()->type == 1)
                                                                                <button class="dropdown-item changeStatus"
                                                                                    data-id="{{ $row->id }}"
                                                                                    data-status="3">{{ trans('labels.order_shipped') }}
                                                                                </button>
                                                                                <button class="dropdown-item changeStatus"
                                                                                    data-id="{{ $row->id }}"
                                                                                    data-status="11">{{ trans('labels.assigned_to_rider') }}
                                                                                </button>
                                                                                <button
                                                                                    class="dropdown-item changeStatus active"
                                                                                    data-id="{{ $row->id }}"
                                                                                    data-product-id="{{ $row->product_id }}"
                                                                                    data-stockiest-id="{{ $row->stockiest_id }}"
                                                                                    data-product-type="{{ $row->product_type }}"
                                                                                    data-status="8">{{ trans('labels.return') }}
                                                                                </button>
                                                                                <button class="dropdown-item changeStatus"
                                                                                    data-id="{{ $row->id }}"
                                                                                    data-product-id="{{ $row->product_id }}"
                                                                                    data-stockiest-id="{{ $row->stockiest_id }}"
                                                                                    data-product-type="{{ $row->product_type }}"
                                                                                    data-product-qty="{{ $row->qty }}"
                                                                                    data-status="4">{{ trans('labels.delivered') }}</button>
                                                                            @endif
                                                                            <button class="dropdown-item changeStatus"
                                                                                data-id="{{ $row->id }}"
                                                                                data-status="5">{{ trans('labels.cancelled') }}</button>
                                                                        @endif

                                                                        @if ($row->status == 4)
                                                                            <button class="dropdown-item changeStatus"
                                                                                data-id="{{ $row->id }}"
                                                                                data-status="1">{{ trans('labels.order_placed') }}</button>
                                                                            <button class="dropdown-item changeStatus"
                                                                                data-id="{{ $row->id }}"
                                                                                data-status="2">{{ trans('labels.confirmed') }}</button>

                                                                            @if (Auth::user()->type == 1)
                                                                                <button class="dropdown-item changeStatus"
                                                                                    data-id="{{ $row->id }}"
                                                                                    data-status="3">{{ trans('labels.order_shipped') }}
                                                                                </button>
                                                                                <button class="dropdown-item changeStatus"
                                                                                    data-id="{{ $row->id }}"
                                                                                    data-status="11">{{ trans('labels.assigned_to_rider') }}
                                                                                </button>
                                                                                <button class="dropdown-item changeStatus"
                                                                                    data-id="{{ $row->id }}"
                                                                                    data-product-id="{{ $row->product_id }}"
                                                                                    data-stockiest-id="{{ $row->stockiest_id }}"
                                                                                    data-product-type="{{ $row->product_type }}"
                                                                                    data-status="8">{{ trans('labels.return') }}
                                                                                </button>
                                                                                <button
                                                                                    class="dropdown-item changeStatus active"
                                                                                    data-id="{{ $row->id }}"
                                                                                    data-product-id="{{ $row->product_id }}"
                                                                                    data-stockiest-id="{{ $row->stockiest_id }}"
                                                                                    data-product-type="{{ $row->product_type }}"
                                                                                    data-product-qty="{{ $row->qty }}"
                                                                                    data-status="4">{{ trans('labels.delivered') }}
                                                                                </button>
                                                                            @endif
                                                                            <button class="dropdown-item changeStatus"
                                                                                data-id="{{ $row->id }}"
                                                                                data-status="5">{{ trans('labels.cancelled') }}</button>
                                                                        @endif
                                                                    </ul>
                                                                    @if ($row->status == 5)
                                                                        <a href="{{ URL::to('/admin/returnorders/order-details/' . @$row->return_number) }}"
                                                                            class="btn btn-flat btn-danger">{{ trans('labels.cancelled') }}</a>
                                                                    @endif
                                                                    @if ($row->status == 7)
                                                                        <a href="{{ URL::to('/admin/returnorders/order-details/' . @$row->return_number) }}"
                                                                            class="btn btn-flat btn-danger">{{ trans('labels.return') }}</a>
                                                                    @endif
                                                                    @if ($row->status == 8)
                                                                        <a href="{{ URL::to('/admin/returnorders/order-details/' . @$row->return_number) }}"
                                                                            class="btn btn-flat text-danger">{{ trans('labels.return_in_progress') }}</a>
                                                                    @endif
                                                                    @if ($row->status == 9)
                                                                        <a href="{{ URL::to('/admin/returnorders/order-details/' . @$row->return_number) }}"
                                                                            class="btn btn-flat btn-danger">{{ trans('labels.return_complete') }}</a>
                                                                    @endif
                                                                    @if ($row->status == 10)
                                                                        <a href="{{ URL::to('/admin/returnorders/order-details/' . @$row->return_number) }}"
                                                                            class="btn btn-flat btn-danger">{{ trans('labels.return_rejected') }}</a>
                                                                    @endif
                                                                @else
                                                                    <button
                                                                        class="btn btn-flat btn-success">{{ trans('labels.delivered') }}</button>
                                                                @endif
                                                            </div>
                                                        </td>
                                                    @endif
                                                    <td>{{ Helper::CurrencyFormatter($row->qty * $row->price) }}</td>
                                                    <td>

                                                        @if ($row->status == 4)
                                                            <button class="btn btn-success changePrice" disabled
                                                                data-price="{{ $row->price }}"
                                                                data-id="{{ $row->id }}"> <i class="fa fa-eye"></i>
                                                                Edit</button>
                                                        @else
                                                            <button class="btn btn-success changePrice"
                                                                data-price="{{ $row->price }}"
                                                                data-vendor-id="{{ $row->vendor_id }}"
                                                                data-stockiest-id ="{{ $row->stockiest_id }}"
                                                                data-admin-price="{{ $row->admin_product_price }}"
                                                                data-qty="{{ $row->qty }}"
                                                                data-id="{{ $row->id }}"> <i class="fa fa-eye"></i>
                                                                Edit </button>
                                                        @endif
                                                        <a href="{{ URL::to('admin/orders/track-order/' . $row->id) }}"
                                                            class="btn btn-warning"> Track </a>

                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 col-sm-12 text-left">
                                    <p class="lead">{{ trans('labels.payment_methods') }} </p>
                                    <div class="row">
                                        <div class="col-12">
                                            <table class="table table-borderless table-sm">
                                                <tbody>
                                                    <!-- payment_type = COD : 1, Wallet : 2, RazorPay : 3, Stripe : 4, Flutterwave : 5 , Paystack : 6-->
                                                    <td>
                                                        @if ($order_info->payment_type == 1)
                                                            {{ trans('labels.cod') }}
                                                        @endif

                                                        @if ($order_info->payment_type == 2)
                                                            {{ trans('labels.wallet') }}
                                                        @endif

                                                        @if ($order_info->payment_type == 3)
                                                            {{ trans('labels.RazorPay') }}
                                                        @endif

                                                        @if ($order_info->payment_type == 4)
                                                            {{ trans('labels.Stripe') }}
                                                        @endif

                                                        @if ($order_info->payment_type == 5)
                                                            {{ trans('labels.Flutterwave') }}
                                                        @endif

                                                        @if ($order_info->payment_type == 6)
                                                            {{ trans('labels.Paystack') }}
                                                        @endif
                                                    </td>
                                                    <td class="text-right">{{ $order_info->payment_id }}</td>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-12">
                                    <p class="lead">{{ trans('labels.Total_due') }}</p>
                                    <div class="table-responsive">
                                        <table class="table">
                                            <tbody>
                                                <tr>
                                                    <td>{{ trans('labels.sub_total') }}</td>
                                                    <td class="text-right">
                                                        {{ Helper::CurrencyFormatter($order_info->subtotal) }}</td>
                                                </tr>
                                                <tr>
                                                    <td>{{ trans('labels.tax') }}</td>
                                                    <td class="text-right">
                                                        {{ Helper::CurrencyFormatter($order_info->tax) }}</td>
                                                </tr>
                                                <tr>
                                                    <td>{{ trans('labels.Shipping_charges') }}</td>
                                                    <td class="text-right">
                                                        {{ Helper::CurrencyFormatter($order_info->shipping_cost) }}</td>
                                                </tr>
                                                <tr>
                                                    <td class="text-bold-800">{{ trans('labels.total') }}</td>
                                                    <td class="text-bold-800 text-right">
                                                        {{ Helper::CurrencyFormatter($order_info->subtotal + $order_info->tax + $order_info->shipping_cost) }}
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="modal" id="addCommentModal" tabindex="-1" role="dialog">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content mt-5">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Add Comment</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <textarea required class="form-control" id="comment" name="comment" rows="3" cols="5"></textarea>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-primary" onclick="save()">Save</button>
                                        <button type="button" class="btn btn-secondary"
                                            data-dismiss="modal">Close</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="modal" id="editPriceModal" tabindex="-1" role="dialog">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content mt-5">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Edit </h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="mb-1">
                                            <label>Stockiest</label>
                                            <select id="stockiest-option" class="form-control" name="stockiest_id">

                                            </select>

                                        </div>
                                        <div>
                                            <label>Price</label>
                                            <input type="number" required class="form-control"
                                                oninput="ChangeVendorPrice(this)" id="update_price" name="update_price"
                                                value=""></input>
                                            <span id="admin-price" class="text-danger show-alert d-none">Sorry you can not
                                                add less than <span id="admin-product-price"> </span> Taka</span>
                                        </div>

                                        <div class="mt-1">
                                            <label>Quantity</label>
                                            <input type="number" required class="form-control" min="1"
                                                id="update_qty" name="update_qty" value=""></input>
                                        </div>

                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-primary"
                                            onclick="updatePrice()">Save</button>
                                        <button type="button" class="btn btn-secondary"
                                            data-dismiss="modal">Close</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Invoice Footer -->
                        <!--/ Invoice Footer -->
                    </div>
                </div>
            </div>
        </section>
    </div>


@endsection
@section('scripttop')
@endsection
@section('script')
    <script type="text/javascript">
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        let product_id = '';
        let product_type = '';
        let stockiest_id = '';
        let product_qty = '';
        let comment = '';
        let status = '';
        let id = '';
        let price = '';
        let admin_price = '';
        let qty = '';
        let vendor_price = '';
        //Change Status
        $('body').on('click', '.changeStatus', function() {
            // console.log('lllll');
            $('#addCommentModal').modal('show');
            $('.modal-backdrop').remove()
            status = $(this).attr('data-status');
            id = $(this).attr('data-id');
            product_id = $(this).attr('data-product-id');
            product_type = $(this).attr('data-product-type');
            stockiest_id = $(this).attr('data-stockiest-id');
            product_qty = $(this).attr('data-product-qty');

        });

        $('body').on('click', '.changePrice', function() {
            let option = '<option value="">Select Stockiest</option>';
            id = $(this).attr('data-id');
            let user_id = $(this).attr('data-vendor-id');
            let stockiest_id = $(this).attr('data-stockiest-id');
            $.ajax({
                url: '{{ route('admin.show.stockiest') }}',
                type: "GET",

                success: function(data) {
                    // console.log('jjj',data.data)

                    $.each(data.data, function(key, el) {
                        if (el.id == stockiest_id) {
                            option +=
                                `<option value="${el.id}" selected>${el.stock_name}</option>`
                        } else {
                            option += `<option value="${el.id}">${el.stock_name}</option>`
                        }

                    })
                    // console.log('llll',option)
                    // $(option).insertAfter('#stockiest-option');
                    $("#stockiest-option").html(option);
                },
                error: function(data) {
                    $('#preloader').hide();
                    console.log("AJAX error in request: " + JSON.stringify(data, null,
                        2));
                }


            });

            $('#editPriceModal').modal('show');
            $('.modal-backdrop').remove()
            status = $(this).attr('data-status');

            qty = $(this).attr('data-qty');
            price = $(this).attr('data-price');
            vendor_price = $(this).attr('data-price');
            admin_price = Number($(this).attr('data-admin-price'));
            $('#update_price').val(price);
            $('#update_qty').val(qty);


        });


        function ChangeVendorPrice(e) {

            vendor_price = Number(e.value);

            if (admin_price > vendor_price) {
                $('#admin-product-price').html(admin_price);
                $('#admin-price').removeClass('d-none');


            } else if (admin_price < vendor_price) {
                $('#admin-price').addClass('d-none');
            }

        }

        function save() {
            // alert('ooo');
            comment = $('#comment').val();
            // console.log('check co',comment,status,id)
            // return;
            Swal.fire({
                title: '{{ trans('labels.are_you_sure') }}',
                text: "{{ trans('labels.change_status') }}",
                type: 'success',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: '{{ trans('labels.yes') }}',
                cancelButtonText: '{{ trans('labels.no') }}'
            }).then((t) => {
                if (t.value == true) {
                    $('#preloader').show();
                    $.ajax({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        url: '{{ route('admin.orders.changeStatus') }}',
                        type: "POST",
                        data: {
                            'id': id,
                            'status': status,
                            'comment': comment,
                            'stockiest_id': stockiest_id,
                            'product_type': product_type,
                            'product_id': product_id,
                            'product_qty': product_qty,
                        },
                        success: function(data) {

                            // console.log(data);



                            if (data.status == 2000) {
                                Swal.fire({
                                    type: 'error',
                                    title: data.msg,
                                    showConfirmButton: true,
                                    timer: 10500
                                });
                                $('#preloader').hide();
                                // location.reload();
                            } else {
                                $('#preloader').hide();
                                location.reload();
                            }


                        },
                        error: function(data) {
                            $('#preloader').hide();
                            console.log("AJAX error in request: " + JSON.stringify(data, null,
                                2));
                        }
                    });
                } else {
                    Swal.fire({
                        type: 'error',
                        title: '{{ trans('labels.cancelled') }}',
                        showConfirmButton: false,
                        timer: 1500
                    });
                }
            });
        }

        function updatePrice() {
            // alert('ooo');
            let stockiest_id = $('#stockiest-option').val();
            let update_price = $('#update_price').val();
            let update_qty = $('#update_qty').val();
            // console.log('stockiest_id',stockiest_id)
            // return;
            Swal.fire({
                title: '{{ trans('labels.are_you_sure') }}',
                text: "{{ trans('labels.change_status') }}",
                type: 'success',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: '{{ trans('labels.yes') }}',
                cancelButtonText: '{{ trans('labels.no') }}'
            }).then((t) => {
                if (t.value == true && admin_price < vendor_price) {
                    $('#preloader').show();
                    $.ajax({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        url: '{{ route('admin.orders.editProductPrice') }}',
                        type: "get",
                        data: {
                            'id': id,
                            'update_price': update_price,
                            'update_qty': update_qty,
                            'stockiest_id': stockiest_id,
                        },
                        success: function(data) {
                            $('#preloader').hide();
                            location.reload();
                        },
                        error: function(data) {
                            $('#preloader').hide();
                            console.log("AJAX error in request: " + JSON.stringify(data, null,
                                2));
                        }
                    });
                } else {
                    Swal.fire({
                        type: 'error',
                        title: '{{ trans('labels.cancelled') }}',
                        showConfirmButton: false,
                        timer: 1500
                    });
                }
            });
        }
    </script>
@endsection
