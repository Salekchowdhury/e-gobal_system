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
                        <h3>{{ trans('labels.product_vendor') }}</h3>
                    </div>

                    <div class="card-body">
                        <table id="example1" class="table table-striped">
                            <thead>
                              <tr>
                                <th scope="col">SL#</th>
                                <th scope="col">Product Name</th>
                                <th scope="col">Vendor Name</th>
                                <th scope="col">Category</th>
                                <th scope="col">Product Price</th>
                                <th scope="col">Admin Assign Price</th>
                                <th scope="col">Discount Price</th>
                                <th scope="col">Point</th>
                                <th scope="col">Quntity</th>
                                {{-- <th scope="col">Action</th> --}}
                              </tr>
                            </thead>
                            <tbody>
                                <?php
                                    $s=1;
                                ?>
                                @foreach ($product_vendors as $list)
                                   <tr>
                                    <td>{{$s++}}</td>
                                    <td>{{$list->products->product_name}}</td>
                                    <td>{{$list->user->name}}</td>
                                    <td>{{$list->category->category_name}}</td>
                                    <td>{{$list->product_price}}</td>
                                    <td>{{$list->admin_product_price}}</td>
                                    <td>{{$list->discounted_price}}</td>
                                    <td>{{$list->products->point}}</td>
                                    <td>{{$list->product_qty}}</td>
                                    {{-- <td>
                                        @if ($list->approve_status == 0)
                                        <a class="btn btn-primary btn-sm" href="{{url('admin/products/product/'.$list->id.'/confirm')}}">Confirm</a>
                                        @else
                                        <a class="btn btn-danger btn-sm" href="{{url('admin/products/product/'.$list->id.'/cancel')}}">Cancel</a>
                                        @endif
                                    </td> --}}
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
