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
                        <h3>{{ trans('labels.affiliate_commission') }}</h3>
                        <form method="post" action="{{ route('admin.commission.search') }}">
                            @csrf
                            <div class="row py-2">
                                <div class="col-md-12">
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
                                        <div class="col-md-3">
                                            <label class="">Product</label>
                                            <select class="form-control select2" name="product_id">
                                                <option value="">Select Product</option>
                                                @foreach ($products as $product)
                                                <option value="{{$product->id}}">{{$product->product_name}}</option>
                                                @endforeach
                                            </select>

                                        </div>
                                         <div class="col-md-3">
                                            <label class="">User</label>
                                            <select class="form-control select2" name="user_id">
                                                <option value="">Select Stockiest</option>
                                                @foreach ($users as $user)
                                                <option value="{{$user->id}}">{{$user->name}}</option>
                                                @endforeach
                                            </select>

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
                                <th scope="col">user</th>
                                <th scope="col">lavel</th>
                                <th scope="col">point</th>
                                <th scope="col">Generated Date</th>
                                <th scope="col" class="">Amount</th>
                              </tr>
                            </thead>
                            <tbody>
                                <?php
                                    $s=1;
                                    $total_amount = 0;
                                ?>
                                @foreach ($productCommission as $list)
                                <?php
                                $total_amount = $total_amount + $list->amount;
                                ?>
                                   <tr>
                                    <td>{{$s++}}</td>
                                    <td class="w-25">{{$list->product->product_name}}</td>
                                    <td>{{$list->user->name}}</td>
                                    <td>{{$list->level}}</td>
                                    <td>{{$list->point}}</td>
                                    <td>{{$list->generated_date}}</td>
                                    <td class="">{{$list->amount}}</td>

                                  </tr>

                                @endforeach
                                <tr>
                                    <td colspan="6" class="text-right">Total =</td>
                                    <td colspan="7" class="">{{$total_amount}}</td>
                                  </tr>
                            </tbody>
                          </table>
                          <div class="float-right"
                              {{$productCommission->links()}};

                          </div>
                    </div>
            </div>
        </div>

    </div>
@endsection
@section('scripttop')

@endsection

