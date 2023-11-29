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
                    <h3>{{ trans('labels.stockiest_stock') }}</h3>
                    <form method="post" action="{{ route('admin.sales.stock.search') }}">
                        @csrf
                        <div class="row py-2">
                            <div class="col-md-10">
                                <div class="row">
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
                                <th scope="col">Stocked Name</th>
                                <th scope="col">Product Name</th>
                                <th scope="col">Quntity</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($stock_list as $list)
                                @if ($list->currentStock)
                                    @foreach ($list->currentStock as $data)
                                        <tr>

                                            <td>{{ $list->stock_name }}</td>
                                            <td>{{ $data->product->product_name }}</td>
                                            <td>{{ $data->current_stock }}</td>
                                        </tr>
                                    @endforeach
                                @endif
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

