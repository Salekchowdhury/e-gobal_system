<table id="e-global-table1" class="table table-striped table-bordered zero-configuration">
    <thead>
        <tr>
            <th>#</th>
            <th>{{ trans('labels.category') }}</th>
            <th>{{ trans('labels.subcategory') }}</th>
            <th>{{ trans('labels.status') }}</th>
            <th>{{ trans('labels.action') }}</th>
        </tr>
    </thead>
    <tbody>
        @php $n=0 @endphp
        @forelse($data as $row)
        <tr id="del-{{$row->id}}">
            <td>{{++$n}}</td>
            <td>{{$row['category']->category_name}}</td>
            <td>{{$row->subcategory_name}}</td>
            <td id="tdstatus{{$row->id}}">
                @if (env('Environment') == 'sendbox')
                    @if($row->status=='1')
                        <span class="btn btn-raised btn-outline-success round btn-min-width mr-1 mb-1" onclick="myFunction()">
                        <span class="green-text">{{ trans('labels.active') }}</span>
                        </span>
                    @else
                        <span class="btn btn-raised btn-outline-danger round btn-min-width mr-1 mb-1" onclick="myFunction()">
                            <span class="red-text">{{ trans('labels.deactive') }}</span>
                        </span>
                    @endif
                @else
                    @if($row->status=='1')
                        <span class="btn btn-raised btn-outline-success round btn-min-width mr-1 mb-1 changeStatus" data-status="2" data-id="{{$row->id}}">
                        <span class="green-text">{{ trans('labels.active') }}</span>
                        </span>
                    @else
                        <span class="btn btn-raised btn-outline-danger round btn-min-width mr-1 mb-1 changeStatus" data-status="1" data-id="{{$row->id}}">
                            <span class="red-text">{{ trans('labels.deactive') }}</span>
                        </span>
                    @endif
                @endif
            </td>
            <td>
                <a href="{{URL::to('admin/subcategory/show/'.$row->id)}}" class="success p-0 edit" title="{{ trans('labels.edit') }}" title="{{ trans('labels.edit') }}" data-original-title="{{ trans('labels.edit') }}">
                    <i class="ft-edit-2 font-medium-3 mr-2"></i>
                </a>
                @if (env('Environment') == 'sendbox')
                    <a href="javascript:void(0);" class="danger p-0" onclick="myFunction()">
                        <i class="ft-trash font-medium-3"></i>
                    </a>
                @else
                    <a href="javascript:void(0);" class="danger p-0" data-original-title="{{ trans('labels.delete') }}" title="{{ trans('labels.delete') }}" onclick="do_delete('{{$row->id}}','{{route('admin.subcategory.delete')}}','{{ trans('labels.delete_subcategory') }}','{{ trans('labels.delete') }}')">
                        <i class="ft-trash font-medium-3"></i>
                    </a>
                @endif
            </td>
        </tr>
        @empty

        @endforelse
  </tbody>
</table>
