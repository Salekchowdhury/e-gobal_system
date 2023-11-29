@extends('layouts.admin')
@section('title')
    {{ Helper::webinfo()->site_title }} | {{ trans('labels.cancel_order') }}
@endsection
@section('css')
@endsection
@section('content')
    <div class="content-wrapper">
        <div class="container">
            <div class="card">
                <div class="show-success-error"></div>
                    <div class="card-header">
                        <h3>{{ trans('labels.cancel_order') }}</h3>
                        {{-- <form method="post" action="{{ route('admin.search.user.commission') }}">
                            @csrf
                            <div class="row py-2">
                                <div class="col-md-10">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <label class="">From Date</label>
                                            <input type="date" name="from_date" class="form-control" value=""
                                                placeholder="From Date...">
                                        </div>
                                        <div class="col-md-3">
                                            <label class="">To Date</label>
                                            <input type="date" name="to_date" class="form-control" value=""
                                                placeholder="To Date...">
                                        </div>
                                        <div class="col-md-3 mt-4">
                                            <button type="submit" class="btn btn-success">Search</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form> --}}
                    </div>

                    <div class="card-body">
                        <table id="e-global-table1" class="table table-striped">
                            <tr>
                                <th>{{trans('labels.srno')}}</th>
                                @if(Auth::user()->type == 1)
                                <th class="text-center">{{ trans('labels.vendor_name') }}</th>
                                @endif

                                <th class="text-center">{{ trans('labels.order_number') }}</th>
                                <th class="text-center">{{ trans('labels.sales_point') }}</th>
                                <th class="text-center">{{ trans('labels.no_of_products') }}</th>
                                <th class="text-center">{{ trans('labels.customer') }}</th>
                                <th class="text-center">{{ trans('labels.phone') }}</th>
                                <th class="text-center">{{ trans('labels.date') }}</th>
                                <th class="text-center">Qty</th>
                                <th class="text-center">Amount</th>
                                <th class="text-center">{{ trans('labels.action') }}</th>
                            </tr>
                            <tbody>
                                <?php

                                    $total_amount = 0;
                                ?>
                                @foreach ($datas as $in=> $row)
                                <?php
                                $total_amount = $total_amount + $row->grand_total;
                                ?>

                                   <tr>
                                    <tr id="">
                                        <td class="text-center">{{++$in}}</td>
                                        @if(Auth::user()->type == 1)
                                        <td class="text-center">{{$row['vendors']->name}}</td>
                                        @endif

                                        <td class="text-center">{{$row->order_number}}</td>
                                        <td class="text-center">{{$row->stockiest ? $row->stockiest->stock_name ? $row->stockiest->stock_name : "" : ""}}</td>

                                        <td class="text-center">{{$row->no_products}}</td>
                                        <td class="text-center">{{$row->full_name}}</td>
                                        <td class="text-center">{{$row->mobile}}</td>

                                        <td class="text-center">{{$row->date}}</td>
                                        <td class="text-center">{{$row->qty}}</td>
                                        <td class="text-center">{{$row->grand_total}}</td>
                                        <td class="text-center">
                                            <a href="{{URL::to('admin/orders/order-details/'.$row->order_number)}}" class="success p-0" data-original-title="{{ trans('labels.view') }}" title="{{ trans('labels.view') }}">
                                                <span class="badge badge-warning">{{trans('labels.view')}}</span>
                                            </a>
                                          
                                        </td>
                                    </tr>

                                  </tr>
                                @endforeach
                                @if(Auth::user()->type == 1)
                                <tr>
                                    <td colspan="9" class="text-right">Total = </td>
                                    <td colspan="10" class="">{{$total_amount}}</td>
                                  </tr>
                                  @elseif (Auth::user()->type == 3)
                                  <tr>
                                    <td colspan="8" class="text-right">Total = </td>
                                    <td colspan="9" class="">{{$total_amount}}</td>
                                  </tr>
                                @endif

                            </tbody>
                          </table>

                    </div>
            </div>
        </div>

    </div>
@endsection
@section('scripttop')
@endsection

