@extends('layouts.admin')
@section('title')
    {{Helper::webinfo()->site_title}} | {{ trans('labels.products') }}
@endsection
@section('css')

@endsection
@section('content')
    <div class="content-wrapper">
        <div class="container">
            <div class="card p-5">
                <div class="card-header">
                    <h3>{{ trans('labels.edit_point') }}t</h3>
                </div>
               <strong> {{ trans('labels.product_name') }}</strong> <span>{{$product->product_name}}</span>
                <div class="card-body">
                <form action="{{url('admin/products/point/'.$product->id.'/update')}}" method="POST">
                    @csrf
                    <div class="">
                        <input type="number" name="point" value="{{$product->point}}" class="w-25 form-control" placeholder="Point...">
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
