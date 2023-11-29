@extends('layouts.admin')
@section('title')
    {{Helper::webinfo()->site_title}} | {{ trans('labels.products') }}
@endsection
@section('css')

@endsection
@section('content')
    <div class="content-wrapper">
        <div class="container">
            <div class="card p-3">
                <div class="card-header">
                    <h3>{{ trans('labels.edit_product') }}</h3>
                </div>
               <span class="mb-2"> {{ trans('labels.product_name') }}: <span>{{$product->product_name}}</span></span>
                <div class="card-body">
                <form action="{{url('admin/products/product/'.$product->id.'/update')}}" method="POST">
                    @csrf
                    <div class="row">

                         <div class="col-4">
                         <label>Vendor Product Price</label>
                            <input type="number" readonly name="product_price" value="{{$product->product_price}}" class="form-control" placeholder="Product Price...">
                         </div>
                         <div class="col-4">
                         <label>Admin Product Price</label>

                            <input type="number" name="admin_product_price" value="{{$product->admin_product_price}}" class="form-control" placeholder="Product Price...">
                         </div>
                         <div class="col-4">
                            <label>point</label>
                            <input type="number" name="point" value="{{$product->point}}" class="form-control" placeholder="Point...">
                            <input type="hidden" name="id" value="{{$product->id}}">
                         </div>

                    </div>
                     <button type="submit" class=" mt-2 btn btn-success btn-sm ">Update</button>
                </form>
                </div>
        </div>
        </div>

    </div>

@endsection
@section('scripttop')
@endsection
@section('script')
<script type="text/javascript">

</script>
@endsection
