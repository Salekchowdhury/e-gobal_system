@extends('layouts.admin')
@section('title')
    {{ Helper::webinfo()->site_title }} | {{ trans('labels.Bank_list') }}
@endsection
@section('css')
@endsection
@section('content')
    <div class="content-wrapper">
        <div class="container">
            <div class="card">
                <div class="show-success-error"></div>
                    <div class="card-header">
                        <h3>{{ trans('labels.Bank_list') }}</h3>
                    </div>

                    <div class="card-body">
                        <table id="example1" class="table table-striped">
                            <thead>
                              <tr>
                                <th scope="col">SL#</th>
                                <th scope="col">Name</th>
                                <th scope="col">Action</th>
                              </tr>
                            </thead>
                            <tbody>
                                <?php
                                    $s=1;
                                ?>
                                @foreach ($banks as $list)
                                   <tr>
                                    <td>{{$s++}}</td>
                                    <td class="text-uppercase">{{$list->name}}</td>

                                    <td>
                                        <a class="btn btn-primary btn-sm" href="{{url('/admin/bank_list/'.$list->id.'/edit')}}">Edit</a>
                                        {{-- <a class="btn btn-danger btn-sm" href="{{url('/admin/bank_list/'.$list->id.'/delete')}}">Delete</a> --}}

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
@section('script')
<script>
    $(function () {
        $("#example1").DataTable({
            // "lengthMenu":[ 3,4 ],
            "searching": true,
        });
        $("#example2").DataTable({

            "searching": true,
        });

    });
</script>
{{-- @include('Admin.sales.sales_js') --}}
@endsection
