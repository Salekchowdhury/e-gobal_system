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
                <div class="form-outline mb-4">
                    @if (session('message'))
                        <p class="alert alert-success ">{{ session('message') }}</p>
                    @endif
                </div>
                <div class="card-header">
                    <h3>{{ trans('labels.withdraw_balance') }}</h3>
                    <form method="post" action="{{ route('admin.withdrow.search') }}">
                        @csrf
                        <div class="row py-2">
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-md-3">
                                        <label class="">From Date</label>
                                        <input type="date" name="from_date" class="form-control" value=""
                                            placeholder="From Date...">
                                    </div>
                                    <div class="col-md-3">
                                        <label class="">To Date</label>
                                        <input type="date" name="to_date" class="form-control" value=""
                                            placeholder="To Date...">
                                    </div>
                                    @if (Auth::user()->type == 1)
                                        <div class="col-md-3">
                                            <label class="">User</label>
                                            <select class="form-control select2" name="user_id">
                                                <option value="">Select Stockiest</option>
                                                @foreach ($users as $user)
                                                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    @endif
                                    <div class="col-md-3 mt-4">
                                        <button type="submit" class="btn btn-success">Search</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                    @if (Auth::user()->type != 1)
                    <div class="">
                        <a href="{{ route('admin.withdrow.create') }}" class="btn btn-sm btn-success ">Withdraw</a>
                    </div>

                    @endif
                </div>


                <div class="col-lg-12 mb-lg-0 mb-5 my-3">
                    <div class="text-center">
                        <ul class="nav nav-tabs" role="tablist">
                            <li class="nav-item active">
                                <a class="nav-link" style="font-size: 16px" data-toggle="tab"
                                    href="#mobile-bank">Mobile Bank List</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" style="font-size: 16px" data-toggle="tab"
                                    href="#bank-list">Bank List</a>
                            </li>

                        </ul>
                    </div>
                </div>

                <div class="tab-content" >
                    <div id="mobile-bank" class="container tab-pane active" style="display: block;
                    overflow-x: auto;
                    white-space: nowrap;">
                        <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12 mt-3">
                            <div class="card-body">
                                <table id="e-global-table1" class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th scope="col">SL#</th>
                                            <th scope="col">Amount</th>
                                            <th scope="col">Tran. Charge</th>
                                            <th scope="col">Other Charge</th>
                                            <th scope="col">Final Amount</th>
                                            <th scope="col">Withdraw Date</th>
                                            <th scope="col">Receive Number</th>
                                            <th scope="col">Payment Type</th>
                                            <th scope="col">Note</th>
                                            @if (Auth::user()->type == 3)
                                                <th scope="col">Status</th>
                                            @endif
                                            @if (Auth::user()->type == 1)
                                                <th scope="col">User Name</th>
                                                <th scope="col">Approved Date</th>

                                                <th scope="col">Status</th>
                                                <th scope="col">Action</th>
                                            @endif

                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $s = 1;
                                        ?>
                                        @foreach ($withdrawDataMobileBank as $list)
                                            <tr>
                                                <td>{{ $s++ }}</td>
                                                <td>{{ $list->amount }}</td>
                                                <td>{{ $list->commission }}</td>
                                                <td>{{ $list->extra_charge }}</td>
                                                <td>{{ $list->final_amount }}</td>
                                                <td>{{ $list->withdraw_date }}</td>
                                                <td>{{ $list->mobile_number }}</td>
                                                <td>{{ $list->payment_type }}</td>
                                                <td>{{ $list->note? $list->note : '' }}</td>

                                      @if (Auth::user()->type == 3)
                                                    <!--@if ($list->status == 0)-->
                                                    <!--    <td>-->
                                                    <!--        <span class="text-danger">Pending</span>-->
                                                    <!--    </td>-->
                                                        
                                                    <!--@ elseif ($list->status == 1)-->
                                                    <!--    <td>-->
                                                    <!--        <span class="text-info">Processing</span>-->
                                                    <!--    </td>-->
                                                    <!--@elseif ($list->status == 2)                                                    -->
                                                    <!--     <td>-->
                                                    <!--        <span class="text-success">Paid</span>-->
                                                    <!--    </td>-->
                                                    <!--@else-->
                                                    <!--    <td>-->
                                                    <!--        <span class="text-success">Accepted</span>-->

                                                    <!--    </td>-->
                                                    <!--@endif-->
      <td class="">{{ $list->status == 0 ? "Pending" : ($list->status == 1? "Processing" : ($list->status== 2? "Paid" : '') ) }}</td>
                                                
                                                    
                                                    
                                                @endif

                                                @if (Auth::user()->type == 1)
                                                    <td>{{ $list->user ? $list->user->name : '' }}</td>

                                                    <td>{{ $list->approved_date ? $list->approved_date : '' }}</td>

                                                    <td class="">{{ $list->status == 0 ? "Pending" : ($list->status == 1? "Processing" : ($list->status== 2? "Paid" : '') ) }}</td>

                                                    
                                                   

                                                    @if (Auth::user()->id == $list->user_id || $list->status == 1 || $list->status == 2)
                                                        <td>
                                                            <a href="{{ url('admin/withdraw/' . $list->id . '/pdfgenerate') }}"
                                                                class="btn btn-sm btn-success">PDF</a>
                                                        </td>
                                                    @else
                                                        <td>
                                                            {{-- <a href="{{ url('admin/withdraw/' . $list->id . '/accept') }}"
                                                                class="btn btn-sm btn-success">Accept</a> --}}
                                                                <button class="btn btn-success addCharge" data-id="{{$list->id}}">Accept</button>
                                                            <a href="{{ url('admin/withdraw/' . $list->id . '/pdfgenerate') }}"
                                                                class="btn btn-sm btn-success">PDF</a>
                                                        </td>
                                                    @endif
                                                @endif

                                            </tr>
                                        @endforeach

                                    </tbody>
                                </table>

                            </div>
                        </div>
                    </div>
                     <div id="bank-list" class="container tab-pane" style="display: block;
                     overflow-x: auto;
                     white-space: nowrap;">
                        <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12 mt-3">
                            <div class="card-body">
                                <table id="e-global-table2" class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th scope="col">SL#</th>
                                            <th scope="col">Amount</th>
                                            <th scope="col">Tran. Charge</th>
                                            <th scope="col">Other Charge</th>
                                            <th scope="col">Final Amount</th>
                                            <th scope="col">Withdraw Date</th>
                                            <th scope="col">Bank</th>
                                            <th scope="col">A\C Name</th>
                                            <th scope="col">Account Number</th>
                                            <th scope="col">Branch</th>
                                            <th scope="col">City</th>
                                            <th scope="col">Routing Number</th>
                                            <th scope="col">Note</th>
                                            @if (Auth::user()->type == 3)
                                                <th scope="col">Status</th>
                                            @endif
                                            @if (Auth::user()->type == 1)
                                                <th scope="col">User Name</th>
                                                <th scope="col">Approved Date</th>
                                                <th scope="col">Approved By</th>
                                                <th scope="col">Status</th>

                                                <th scope="col">Action</th>
                                            @endif

                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $s = 1;
                                        ?>
                                        @foreach ($withdrawDataBank as $list)
                                            <tr>
                                                <td>{{ $s++ }}</td>
                                                <td>{{ $list->amount }}</td>
                                                <td>{{ $list->commission }}</td>
                                                <td>{{ $list->extra_charge }}</td>
                                                <td>{{ $list->final_amount }}</td>
                                                <td>{{ $list->withdraw_date }}</td>
                                                <td class="text-uppercase">{{ $list->bankList->name }}</td>
                                                <td>{{ $list->account_name }}</td>
                                                <td>{{ $list->account_number }}</td>
                                                <td>{{ $list->branch_name }}</td>
                                                <td>{{ $list->city }}</td>
                                                <td>{{ $list->routin_number }}</td>
                                                <td>{{ $list->note ? $list->note : '' }}</td>
                                                @if (Auth::user()->type == 3)
                                                    @if ($list->status == 0)
                                                        <td>
                                                            <span class="text-danger">Pending</span>
                                                        </td>
                                                        
                                                    @ elseif ($list->status == 1)
                                                        <td>
                                                            <span class="text-info">Processing</span>
                                                        </td>
                                                    @elseif ($list->status == 2)                                                    
                                                         <td>
                                                            <span class="text-success">Paid</span>
                                                        </td>
                                                    @else
                                                        <td>
                                                            <span class="text-success">Accepted</span>

                                                        </td>
                                                    @endif
                                                @endif

                                                @if (Auth::user()->type == 1)
                                                    <td>{{ $list->user ? $list->user->name : '' }}</td>

                                                    <td>{{ $list->approved_date ? $list->approved_date : '' }}</td>
                                                    <td>{{ $list->admin ? $list->admin->name : '' }}</td>
                                                    <td class="">{{ $list->status == 0 ? "Pending" : ($list->status == 1? "Processing" : ($list->status== 2? "Paid" : '') ) }}</td>


                                                    @if (Auth::user()->id == $list->user_id || $list->status == 1 || $list->status == 2)
                                                    {{-- {{dd($list->status)}} --}}
                                                        <td>

                                                            <a href="{{ url('admin/withdraw/' . $list->id . '/pdfgenerate') }}"
                                                                class="btn btn-sm btn-success">PDF</a>
                                                        </td>

                                                    @elseif($list->status == 0)

                                                        <td>
                                                                <button class="btn btn-success addCharge" data-id="{{$list->id}}">Accept</button>
                                                            <a href="{{ url('admin/withdraw/' . $list->id . '/pdfgenerate') }}"
                                                                class="btn btn-sm btn-success">PDF</a>
                                                        </td>
                                                    @endif
                                                @endif

                                            </tr>
                                        @endforeach

                                    </tbody>
                                </table>

                            </div>
                        </div>
                     </div>
                </div>
                <div class="modal" id="addExtraChargeModal" tabindex="-1" role="dialog">
                    <div class="modal-dialog" role="document">
                      <div class="modal-content mt-5">
                        <div class="modal-header">
                          <h5 class="modal-title">Add Charge</h5>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        <form action="{{url('admin/withdraw/accept')}}" method="post">
                            @csrf
                            <div class="modal-body">
                                <div>
                                    <label>Charge</label>
                                    <input type="number" required class="form-control"  id="extra_charge" name="extra_charge" value="" ></input>
                                    <input type="hidden" id="withdrwa_id" name="withdrwa_id" value="" ></input>
                                </div>

                                <div class="mt-1">
                                    <label>Note</label>
                                    <textarea required class="form-control" id="note" name="note" rows="3" cols="5"></textarea>
                                </div>

                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-primary">Save</button>
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                              </div>
                        </form>


                      </div>
                    </div>
                  </div>
            </div>
        </div>

    </div>
@endsection
@section('scripttop')
@endsection

@section('script')
<script type="text/javascript">

$('.addCharge').on('click', function() {

    $('#addExtraChargeModal').modal('show');
    $('.modal-backdrop').remove()
     status = $(this).attr('data-status');
     id = $(this).attr('data-id');
    // alert(id);
    $('#withdrwa_id').val(id);

});

</script>
@endsection
