@extends('layouts.admin')
@section('title')
    {{ Helper::webinfo()->site_title }} | {{ trans('labels.referral') }}
@endsection
@section('css')
@endsection
@section('content')
    <div class="content-wrapper">
        <div class="container">
            <div class="card px-2">
                <div class="show-success-error"></div>
                <div class="card-header pl-0">
                    <h3>{{ trans('labels.referral')." List of ".($vendor->name) }}</h3>
                </div>

                <div class="card-body table-responsive">
                    <table id="example1" class="table table-striped table-bordered default-ordering">
                        <thead>
                            <tr>
                                <th scope="col">SL#</th>
                                <th scope="col">Level</th>
                                <th scope="col">Total Member</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>{{ 1 }}</td>
                                <td>One</td>
                                <td>{{ count($firstGen) }}</td>
                            </tr>

                            <tr>
                                <td>{{ 2 }}</td>
                                <td>Two</td>
                                <td>{{ count($secondGen)}}</td>
                            </tr>
                             <tr>
                                <td>{{ 3 }}</td>
                                <td>Three</td>
                                <td>{{ count($thirdGen)}}</td>
                            </tr>

                        </tbody>
                    </table>

                </div>
                
                
                
            <!-- Modal -->
            <div class="card-body table-responsive">
                <table class="table table-striped table-bordered default-ordering">
                    <thead> 
                        <tr>
                            <th colspan="5">Generation One: Total {{ count($firstGen) }}</th>
                        </tr>
                        <tr>
                            <th scope="col">SL#</th>
                            <th scope="col">Name</th>
                            <th scope="col">email</th>
                            <th scope="col">phone</th>
                            <th scope="col">Date</th>
                        </tr>
                    </thead>
                    <tbody id="user-referral">
                        @foreach($firstGen as $key=>$value)
                        
                            <tr>
                                <td width="30px">{{ $key+1 }}</td>
                                <td>{{ $value->name }}</td>
                                <td>{{ $value->email }}</td>
                                <td>{{ $value->mobile }}</td>
                                <td>{{ $value->created_at->format("Y-m-d") }}</td>
                            </tr>
                        @endforeach

                    </tbody>
                </table>

            </div>
          
            <!-- Modal -->
            <div class="card-body table-responsive">
                <table class="table table-striped table-bordered default-ordering">
                    <thead> 
                        <tr>
                            <th colspan="5">Generation Two: Total {{ count($secondGen) }}</th>
                        </tr>
                        <tr>
                            <th scope="col">SL#</th>
                            <th scope="col">Name</th>
                            <th scope="col">email</th>
                            <th scope="col">phone</th>
                            <th scope="col">Date</th>
                        </tr>
                    </thead>
                    <tbody id="user-referral">
                        @foreach($secondGen as $key=>$value)
                        
                            <tr>
                                <td width="30px">{{ $key+1 }}</td>
                                <td>{{ $value->name }}</td>
                                <td>{{ $value->email }}</td>
                                <td>{{ $value->mobile }}</td>
                                <td>{{ $value->created_at->format("Y-m-d") }}</td>
                            </tr>
                        @endforeach

                    </tbody>
                </table>

            </div>
            
            
          
            <!-- Modal -->
            <div class="card-body table-responsive">
                <table class="table table-striped table-bordered default-ordering">
                    <thead> 
                        <tr>
                            <th colspan="5">Generation Third: Total {{ count($thirdGen) }}</th>
                        </tr>
                        <tr>
                            <th scope="col">SL#</th>
                            <th scope="col">Name</th>
                            <th scope="col">email</th>
                            <th scope="col">phone</th>
                            <th scope="col">Date</th>
                        </tr>
                    </thead>
                    <tbody id="user-referral">
                        @foreach($thirdGen as $key=>$value)
                        
                            <tr>
                                <td width="30px">{{ $key+1 }}</td>
                                <td>{{ $value->name }}</td>
                                <td>{{ $value->email }}</td>
                                <td>{{ $value->mobile }}</td>
                                <td>{{ $value->created_at->format("Y-m-d") }}</td>
                            </tr>
                        @endforeach

                    </tbody>
                </table>

            </div>
            
            </div>
            <!-- Button trigger modal -->
          
                       

    </div>
@endsection
@section('scripttop')
@endsection
@section('script')
@endsection

