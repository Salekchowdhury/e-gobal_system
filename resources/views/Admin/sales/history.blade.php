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
                        <h3>{{ trans('labels.sales_history') }}</h3>
                        <form method="post" action="{{ route('admin.sales.history.search') }}">
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
                                        <div class="col-md-3">
                                            <label class="">Stockiest</label>
                                            <select class="form-control" name="user_id">
                                                <option value="">Select Stockiest</option>
                                                @foreach ($users as $user)
                                                <option value="{{$user->user_id}}">{{$user->stock_name}}</option>
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
                                <th scope="col">Customer Name</th>
                                <th scope="col">Sales Date</th>
                                <th scope="col">Tax</th>
                                <th scope="col">Vat</th>
                                <th scope="col">Discount</th>
                                <th scope="col">Load/Unload</th>
                                <th scope="col">Sub Total</th>
                                <th scope="col">Amount</th>
                                <th scope="col">Action</th>
                              </tr>
                            </thead>
                            <tbody>
                                <?php
                                    $s=1;
                                ?>
                                @foreach ($salesHistory as $list)
                                   <tr>
                                    <td>{{$s++}}</td>

                                    @if (!empty($list->user->name))
                                    <td>{{$list->user->name}}</td>
                                    @else
                                    <td></td>
                                    @endif
                                    
                                    <td>{{$list->created_at}}</td>
                                    <td>{{$list->tax}}</td>
                                    <td>{{$list->vat}}</td>
                                    <td>{{$list->discount}}</td>
                                    <td>{{$list->load_unload}}</td>
                                    <td>{{$list->sub_total}}</td>
                                    <td>{{$list->amount}}</td>
                                    <td>
                                        <a href="{{url('/admin/pdf/generate/'.$list->id)}}" class="btn btn-success btn-sm ">View PDF</a>
                                        <a href="{{url('/admin/pdf/view/report/'.$list->id)}}" class="btn btn-secondary btn-sm ">View</a>
                                        <a href="{{url('/admin/pdf/download/'.$list->id)}}" class="btn btn-primary btn-sm ">Dowload</a>
                                    </td>


                                  </tr>

                                @endforeach

                            </tbody>
                          </table>

                    </div>
            </div>
        </div>

    </div>
@endsection
@section('scripttop')
@endsection

