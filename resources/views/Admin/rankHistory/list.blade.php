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
                        <h3>{{ trans('labels.rank_history') }}</h3>
                    </div>

                    <div class="card-body">
                        <table id="e-global-table1" class="table table-striped">
                            <thead>
                              <tr>
                                <th scope="col">SL#</th>
                                <th scope="col">User Name</th>
                                <th scope="col">Incentive Title</th>
                                <th scope="col">Achieve Date</th>

                              </tr>
                            </thead>
                            <tbody>
                                @foreach ($datas as $key=> $data)
                                <tr>
                                    <td>{{++$key}}</td>
                                    <td>{{$data->name}}</td>
                                    <td>{{$data->title}}</td>
                                    <td>{{$data->achieve_date}}</td>
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

