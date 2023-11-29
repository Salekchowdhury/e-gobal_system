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
                    <h3>{{ trans('labels.my_stock') }}</h3>
                </div>

                <div class="card-body">
                    <table id="e-global-table1" class="table table-striped">
                        <thead>
                            <tr>
                                <th scope="col">Product Name</th>
                                <th scope="col">Quntity</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($stock_list as $list)
                                @if ($list->currentStock)
                                    @foreach ($list->currentStock as $data)
                                        <tr>
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

