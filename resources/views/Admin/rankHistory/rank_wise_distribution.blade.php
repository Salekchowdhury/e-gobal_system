@extends('layouts.admin')
@section('title')
    {{ Helper::webinfo()->site_title }} | {{ trans('labels.rank_wise_distribute_fund') }}
@endsection
@section('css')
@endsection
@section('content')
    <div class="content-wrapper">
        <div class="container">
            <div class="card">
                <div class="show-success-error"></div>
                    <div class="card-header">
                        <h3>{{ trans('labels.rank_wise_distribute_fund') }}</h3>
                    </div>

                    <div class="container">
                    <div class="card-body py-5">
                            <form class="form" method="post" action="{{ route('admin.rank.wise.distribute.fund') }}">
                                @csrf
                                <div class="row">
                                    <div class="col-md-5">
                                        <label>From Date:</label>
                                        <input class="form-control" type="date" required value="" name="from_date"/>
                                    </div>
                                    <div class="col-md-5">
                                        <label>To Date:</label>
                                        <input class="form-control" type="date" required value="" name="to_date"/>
                                    </div>
                                    <div class="col-md-2 mt-4">
                                        <button class="btn btn-success" type="submit"> Save</button>

                                    </div>
                                  </div>

                            </form>
                            <table id="e-global-table1" class="table table-striped">
                                <thead>
                                  <tr>
                                    <th scope="col">SL#</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Rank</th>
                                    <th scope="col">Amount</th>
                                    <th scope="col">Date</th>

                                  </tr>
                                </thead>
                                <tbody>
                                    @foreach ($datas as $key=> $data)
                                    <tr>
                                        <td>{{++$key}}</td>
                                        <td>{{$data->user->name}}</td>
                                        <td>{{$data->rank}}</td>
                                        <td>{{$data->amount}}</td>
                                        <td>{{$data->generate_date}}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                              </table>
                            </div>
                        </div>
            </div>
        </div>

    </div>
@endsection
@section('scripttop')
@endsection

