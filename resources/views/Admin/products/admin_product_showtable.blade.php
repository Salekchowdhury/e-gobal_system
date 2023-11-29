<table id="e-global-table" class="table table-striped table-bordered zero-configuration">
    <thead>
        <tr>
            <th>#</th>
            <th>{{ trans('labels.category') }}</th>
            <th>{{ trans('labels.subcategory') }}</th>
            <th>{{ trans('labels.product_price') }}</th>
            <th>{{ trans('labels.admin_assign_price') }}</th>
            <th>{{ trans('labels.vendor_name') }}</th>
            <th>{{ trans('labels.product_name') }}</th>
            <th>{{ trans('labels.stock') }}</th>
            <th>{{ trans('labels.point') }}</th>
            <th>{{ trans('labels.action') }}</th>
        </tr>
    </thead>
    <tbody>
        @php $n=0 @endphp
        {{-- {{dd($data)}} --}}
        @forelse($data as $row)
         {{-- {{dd($row)}} --}}
        <tr id="del-{{$row->id}}">
            <td>{{++$n}}</td>
            <td>{{$row['category']->category_name}}</td>
            <td>{{$row['subcategory']->subcategory_name}}</td>
            <td>{{$row->product_price}}</td>
            <td>{{$row->admin_product_price}}</td>
            <td>
                {{$row->user?$row->user->name : ''}}
            </td>
            <td>
                {{$row->product_name}}
            </td>
            <td>
                {{$row->product_qty}}
            </td>
            <td>
                {{$row->point}}
            </td>
             <td>
                @if ($row->approve_status == 1)
                <a class="btn btn-danger btn-sm" href="{{url('admin/products/product/'.$row->id.'/cancel')}}">Cancel</a>
                @endif
                <a class="btn btn-success btn-sm" href="{{url('admin/products/product/'.$row->id.'/edit')}}">Edit</a>
            </td>
        </tr>
        @empty

        @endforelse
  </tbody>
</table>

@section('script')
    <script>
        $(function() {
            $("#e-global-table").DataTable({
                // "lengthMenu":[ 3,4 ],
                "searching": true,
            });
            $("#example2").DataTable({

                "searching": true,
            });


        });
    </script>

@endsection
