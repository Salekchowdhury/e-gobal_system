@extends('layouts.admin')
@section('title')
    {{ Helper::webinfo()->site_title }} | {{ trans('labels.products') }}
@endsection
@section('css')
@endsection
@section('content')
    <div class="content-wrapper">
        <div class="container">
            <div class="card">
                <div class="show-success-error"></div>
                    <div class="card-header">
                        <h3>{{ trans('labels.stockiest_commission') }}</h3>
                        <form method="post" action="{{ route('admin.search.user.commission') }}">
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
                        </form>
                    </div>

                    <div class="card-body">
                        <table id="e-global-table1" class="table table-striped">
                            <thead>
                              <tr>
                                <th scope="col">SL#</th>
                                <th scope="col">Product Name</th>
                                <th scope="col">Stockiest Name</th>
                                <th scope="col">Order Date</th>
                                <th scope="col">Approved Date</th>
                                <th scope="col">Point</th>
                                <th scope="col">Amount</th>
                              </tr>
                            </thead>
                            <tbody>
                                <?php
                                    $s=1;
                                    $total_amount = 0;
                                ?>
                                @foreach ($salesCommissions as $list)
                                <?php
                                $total_amount = $total_amount + $list->amount;
                                ?>

                                   <tr>
                                    <td>{{$s++}}</td>
                                    <td class="w-25">{{$list->product->product_name}}</td>
                                    <td>{{$list->stockiest->stock_name}}</td>
                                    <td>{{$list->order_date}}</td>
                                    <td>{{$list->approved_date}}</td>
                                    <td>{{$list->point}}</td>
                                    <td>{{$list->amount}}</td>

                                  </tr>
                                @endforeach
                                <tr>
                                    <td colspan="6" class="text-right">Total = </td>
                                    <td colspan="7" class="">{{$total_amount}}</td>
                                  </tr>
                            </tbody>
                          </table>

                    </div>
            </div>
        </div>

    </div>
@endsection
@section('scripttop')
@endsection

