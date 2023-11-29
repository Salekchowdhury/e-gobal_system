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
                    <h3>{{ trans('labels.transaction_history') }}</h3>
                </div>
                <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12 mt-3">
                    <div class="card-body">
                        <table id="e-global-table1" class="table table-striped">
                            <thead>
                                <tr>
                                    <th scope="col">SL#</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Type</th>
                                    <th scope="col">Amount</th>
                                    <th scope="col">Date</th>
                                </tr>

                            </thead>
                            <tbody>
                                 @php
                                     $s=0;
                                 @endphp
                                @foreach ($single_history_data as $index => $list)
                                    <tr>
                                        <td>{{ ++$s }}</td>
                                        <td>{{$list->user?$list->user->name : ''}}</td>

                                        @if ($list->sector == '1')
                                            <td>Product Sell</td>
                                        @elseif($list->sector == '2')
                                            <td>Stockist</td>
                                        @elseif($list->sector == '3')
                                            <td>1st Generation</td>
                                        @elseif($list->sector == '8')
                                            <td>2nd Generation</td>                                            
                                        @elseif($list->sector == '9')
                                            <td>3rd Generation</td>    
                                        @elseif($list->sector == '4')
                                            <td>Withdraw</td>
                                        @elseif($list->sector == '5')
                                            <td>Ranking</td>
                                        @elseif($list->sector == '7')
                                            <td>Delivery Charge</td>                                            
                                            
                                        @endif
                                          @if (($list->sector == '4')or($list->sector == '7'))

                                          <td class="text-danger">-{{ $list->earnamnt }}</td>
                                          @else
                                          <td class="text-success">+{{ $list->earnamnt }}</td>

                                          @endif
                                        <td>{{ $list->earn_date }}</td>
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

