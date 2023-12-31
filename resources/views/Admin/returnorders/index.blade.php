@extends('layouts.admin')
@section('title')
    {{Helper::webinfo()->site_title}} | {{ trans('labels.returnorders') }}
@endsection
@section('css')

@endsection
@section('content')
    <div class="content-wrapper">
        @if(Session::has('success'))
        <div class="alert alert-success">
            {{ Session::get('success') }}
            @php
                Session::forget('success');
            @endphp
        </div>
        @endif

        @if(Session::has('danger'))
        <div class="alert alert-danger">
            {{ Session::get('danger') }}
            @php
                Session::forget('danger');
            @endphp
        </div>
        @endif
        <section id="configuration">
            <div class="row">
                <div class="col-12">
                    @if(Session::has('success'))
                    <div class="alert alert-success">
                        {{ Session::get('success') }}
                        @php
                            Session::forget('success');
                        @endphp
                    </div>
                    @endif
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">{{ trans('labels.returnorders') }}</h4>
                        </div>

                        <div class="card-body collapse show">
                            <div class="card-block card-dashboard" id="table-display">
                                @include('Admin.returnorders.ordersstable')
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </section>
    </div>
@endsection
