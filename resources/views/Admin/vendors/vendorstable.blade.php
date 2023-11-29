<table id="e-global-table1" class="table table-striped table-bordered zero-configuration">
    <thead>
        <tr>
            <th>{{ trans('labels.srno') }}</th>
            <th>{{ trans('labels.name') }}</th>
            <th>Balance</th>
             <th>{{ trans('labels.vendor_ref_code') }}</th>
             <th>Refferal Vendor</th>
            <th>{{ trans('labels.email') }}</th>
            <th>{{ trans('labels.mobile') }}</th>
            <th>{{ trans('labels.assign_stockiest') }}</th>
            <th>{{ trans('labels.status') }}</th>

            <th>Fund Distribution</th>
            <th>{{ trans('labels.action') }}</th>
        </tr>
    </thead>
    <tbody>
        @php $n=0 @endphp
        @forelse($data as $row)
        <tr id="del-{{$row->id}}">
            <td>{{++$n}}</td>
            <td>{{$row->name}}</td>
            <td>{{$row->wallet}}</td>
             <td>{{$row->referral_code}}</td>
             <td>{{$row->refferal_vendor}}</td>
            <td>{{$row->email}}</td>
            <td>{{$row->mobile}}</td>
            <td>
                <select class="form-control" data-id="{{$row->id}}" name="stockiest_id" onchange="AssignStockiest(this)">
                    <option value="">Select Stockiest</option>
                    @foreach ($stockiest as $s_row)
                    <option {{ ($row->stockiest_id == $s_row->id? "selected" : '') }} value="{{$s_row->id}}">{{$s_row->stock_name}}</option>
                    @endforeach
                 </select>

            </td>
            <td id="tdstatus{{$row->id}}">
                @if($row->is_available=='1')
                    <span class="btn btn-raised btn-outline-success round btn-min-width mr-1 mb-1 changeStatus" data-status="2"  data-stockiest-id="{{$row->stockiest_id}}" data-id="{{$row->id}}">
                      <span class="green-text">{{ trans('labels.active') }}</span>
                    </span>
                @else
                    <span class="btn btn-raised btn-outline-danger round btn-min-width mr-1 mb-1 changeStatus" data-status="1" data-stockiest-id="{{$row->stockiest_id}}" data-id="{{$row->id}}">
                        <span class="red-text">{{ trans('labels.deactive') }}</span>
                    </span>
                @endif
            </td>
            <td>
                @if($row->vendor_status == 1)
                    <a href="{{URL::to('admin/vendors/deactive/vendor-status/'.$row->id)}}"  title="Active">
                        <span class="btn btn-raised btn-outline-info round btn-min-width mr-1 mb-1">Active</span>
                    </a>
                @else
                <a href="{{URL::to('admin/vendors/active/vendor-status/'.$row->id)}}"  title="Deactive">
                    <span class="btn btn-raised btn-outline-danger round btn-min-width mr-1 mb-1">Deactive</span>
                </a>
                @endif

            </td>
            <td>
                <a class="btn btn-sm" href="{{URL::to('admin/vendors/vendor-details/'.$row->id)}}" data-original-title="{{ trans('labels.view') }}" title="{{ trans('labels.view') }}">
                    <span class="btn btn-raised btn-outline-warning round btn-min-width mr-1 mb-1">{{ trans('labels.view') }}</span>
                </a>
                <a class="btn btn-sm" href="{{URL::to('admin/vendors/login/'.$row->slug)}}" data-original-title="{{ trans('labels.login') }}" title="{{ trans('labels.login') }}">
                    <span class="btn btn-raised btn-outline-info round btn-min-width mr-1 mb-1">{{ trans('labels.login') }}</span>
                </a>
                <button class="btn btn-sm btn-success" onclick="chanPass(this,{{$row->id}})">Change pass</button>

            </td>
        </tr>
        @empty

        @endforelse
  </tbody>
</table>

