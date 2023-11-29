@extends('layouts.admin')
@section('title')
    {{Helper::webinfo()->site_title}} | {{trans('labels.subscribers')}}
@endsection
@section('css')

@endsection
@section('content')
    <div class="content-wrapper">
        <section id="striped-light">
            <div class="row">
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">{{trans('labels.subscribers')}}</h4>
                        </div>

                        <div class="card-body">
                            <div class="card-block">
                                <table id="e-global-table1" class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>{{trans('labels.email')}}</th>
                                            <th>{{trans('labels.created_at')}}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php $n=0 @endphp
                                        @foreach($data as $row)
                                        <tr>
                                            <td>{{$row->email}}</td>
                                            <td>{{$row->created_at}}</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                               
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
