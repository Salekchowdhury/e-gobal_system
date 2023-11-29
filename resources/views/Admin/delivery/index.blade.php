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
                    @if (session('message'))
                    <p class="alert alert-danger ">{{ session('message') }}</p>
                @elseif (session('successMessage'))
                    <p class="alert alert-success">{{ session('successMessage') }}</p>
                @endif
                    <h3>{{ trans('labels.delivered') }}</h3>
                </div>
                <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12 mt-3">
                    <div class="card-body">
                        <table id="e-global-table1" class="table table-striped table-responsive-sm table-striped">
                            <thead>
                                <tr>
                                    <th>{{ trans('labels.srno') }}</th>
                                    @if (Auth::user()->type == 1)
                                        <th class="text-center">{{ trans('labels.vendor_name') }}</th>
                                    @endif

                                    <th class="text-center">{{ trans('labels.order_number') }}</th>
                                    <th class="text-center">{{ trans('labels.sales_point') }}</th>
                                    <th class="text-center">{{ trans('labels.no_of_products') }}</th>
                                    <th class="text-center">{{ trans('labels.customer') }}</th>
                                    <th class="text-center">{{ trans('labels.phone') }}</th>
                                    <th class="text-center">{{ trans('labels.order_total') }}</th>
                                    @if (Auth::user()->type == 1)
                                    <th class="text-center">{{ trans('labels.status') }}</th>
                                    @endif
                                    <th class="text-center">{{ trans('labels.date') }}</th>
                                    <th class="text-center">{{ trans('labels.action') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $n=0 @endphp
                                @foreach ($data as $row)
                                    <tr id="del-{{ $row->id }}">
                                        <td class="text-center">{{ ++$n }}</td>
                                        @if (Auth::user()->type == 1)
                                            <td class="text-center">{{ $row['vendors']->name }}</td>
                                        @endif

                                        <td class="text-center">{{ $row->order_number }}</td>
                                        <td class="text-center">
                                            {{ $row->stockiest ? ($row->stockiest->stock_name ? $row->stockiest->stock_name : '') : '' }}
                                        </td>

                                        <td class="text-center">{{ $row->no_products }}</td>
                                        <td class="text-center">{{ $row->full_name }}</td>
                                        <td class="text-center">{{ $row->mobile }}</td>
                                        <td class="text-center">{{ Helper::CurrencyFormatter($row->grand_total) }}</td>
                                        @if (Auth::user()->type == 1)
                                            @if ($row->admin_status == 0)
                                                <td class="text-center text-warning">Pending</td>
                                            @elseif ($row->admin_status == 1)
                                                <td class="text-center text-success">Accepted</td>
                                            @elseif ($row->admin_status == 2)
                                                <td class="text-center text-danger">Cancel</td>
                                            @endif
                                        @endif


                                        <td class="text-center">{{ $row->date }}</td>
                                        <td class="text-center">
                                            <a href="{{ URL::to('admin/orders/order-details/' . $row->order_number) }}"
                                                class="success p-0" data-original-title="{{ trans('labels.view') }}"
                                                title="{{ trans('labels.view') }}">
                                                <span class="badge badge-warning">{{ trans('labels.view') }}</span>
                                            </a>
                                            @if (Auth::user()->type == 1)
                                                @if ($row->admin_status == 0)
                                                    <a href="{{ URL::to('admin/orders/status/update/' . $row->order_number) }}"
                                                        class="success p-0"
                                                        data-original-title="{{ trans('labels.view') }}"
                                                        title="{{ trans('labels.view') }}">
                                                        <span
                                                            class="badge badge-success">{{ trans('labels.Accept') }}</span>
                                                    </a>
                                                @elseif ($row->admin_status == 1)
                                                    <a class="success p-0">
                                                        <span
                                                            class="badge badge-primary">{{ trans('labels.Accepted') }}</span>
                                                    </a>
                                                @endif
                                            @endif

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
