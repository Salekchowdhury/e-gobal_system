@extends('layouts.admin')
@section('title')
    {{ Helper::webinfo()->site_title }} | {{ trans('labels.product_wise_income') }}
@endsection
@section('css')
@endsection
@section('content')
    <div class="content-wrapper">
        <div class="container">
            <div class="card">
                <div class="show-success-error"></div>
                    <div class="card-header">
                        <h3>{{ trans('labels.product_wise_income') }}</h3>
                        
                    </div>

                    <div class="card-body">
                        <table id="e-global-table" class="table table-striped">
                            <thead>
                              <tr>
                                <th scope="col">SL#</th>
                                <th scope="col">Product</th>
                                <th scope="col">Vendor Name</th>
                                <th scope="col">Product Price</th>
                                <th scope="col">Admin Assign Price</th>
                                <th scope="col">Qty</th>
                                @if (Auth::user()->type == 1)
                                <th scope="col">Admin Profit</th>
                                @endif
                                <th scope="col">Vendor Profit without(D.C)</th>
                                <th scope="col">Delivery Charge</th>
                                <th scope="col">Date</th>

                              </tr>
                            </thead>
                            <tbody>
                                <?php
                                 $total_vendor_profit = 0;
                                 $total_admin_profit = 0;
                                 $total_product_price = 0;
                                 $total_admin_product_price = 0;
                                 $total_delivery_charge = 0;
                                ?>
                                @foreach ($datas as $key=> $data)
                                <?php
                                $total_vendor_profit = $total_vendor_profit + $data->vendor_profit;
                                $total_admin_profit = $total_admin_profit + $data->admin_profit;
                                $total_delivery_charge = $total_delivery_charge + $data->delivery_charge;
                                $total_product_price =  $total_product_price + $data->product->product_price;
                                $total_admin_product_price = $total_admin_product_price + $data->product->admin_product_price;
                               ?>
                                <tr>
                                    <td>{{++$key}}</td>
                                    <td>{{$data->product->product_name}}</td>
                                    <td>{{$data->vendor?$data->vendor->name : ''}}</td>
                                    <td>{{$data->product->product_price}}</td>
                                    <td>{{$data->product->admin_product_price}}</td>
                                    <td>{{$data->qty}}</td>
                                    @if (Auth::user()->type == 1)
                                    <td>{{$data->admin_profit}}</td>
                                    @endif
                                    <td>{{$data->vendor_profit}}</td>
                                    <td>{{$data->delivery_charge}}</td>
                                    <td>{{$data->generated_date}}</td>
                                </tr>
                                @endforeach

                                <tr>
                                    <td class="font-weight-bold" colspan="">Total</td>
                                    <td colspan=""></td>
                                    <td colspan=""></td>
                                    <td class="font-weight-bold" colspan="">{{$total_product_price}}</td>
                                    <td class="font-weight-bold" colspan="">{{$total_admin_product_price}}</td>
                                    <td colspan=""></td>
                                    @if (Auth::user()->type == 1)
                                    <td class="font-weight-bold" colspan="">{{$total_admin_profit}}</td>
                                    @endif
                                    <td class="font-weight-bold" colspan="">{{$total_vendor_profit}}</td>
                                    <td class="font-weight-bold" colspan="">{{$total_delivery_charge}}</td>
                                    {{-- <td colspan="6"></td> --}}

                                </tr>
                            </tbody>
                          </table>

                    </div>
            </div>
        </div>

    </div>
@endsection
@section('script')


@endsection
@section('scripttop')
<script>
    $(function() {
        $("#e-global-table").DataTable({
            // "lengthMenu":[ 3,4 ],
            "searching": true,
        });
        $("#example2").DataTable({

            "searching": true,
        });


    });

</script>
@endsection

