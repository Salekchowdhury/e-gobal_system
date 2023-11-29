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
                    <h3>{{ trans('labels.withdraw_payment') }}</h3>
                </div>

                <div class="tab-content">

                    <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12 mt-3">
                        <div class="card-body">
                            <div class="card-header">
                                <h2>Bank({{ Helper::CurrencyFormatter($total_bank_amount->total) }})</h2>
                            </div>
                            <table id="e-global-table1" class="table table-striped">
                                <thead>
                                    <tr>
                                        <th scope="col">SL#</th>
                                        <th scope="col">Employee</th>
                                        <th scope="col">Bank</th>
                                        <th scope="col">A\C Name</th>
                                        <th scope="col">Account Number</th>
                                        <th scope="col">Branch</th>
                                        <th scope="col">City</th>
                                        <th scope="col">Routing Number</th>
                                        <th scope="col">Approved</th>
                                        <th scope="col">Amount</th>
                                        <th scope="col">Action</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $s = 1;
                                    $sum = 0;
                                    ?>
                                    @foreach ($bankPayment as $list)
                                        {{-- {{dd($list)}} --}}
                                        @php
                                            $sum = $sum + $list->final_amount;
                                        @endphp
                                        <tr>
                                            <td>{{ $s++ }}</td>
                                            <td>{{ $list->user->name }}</td>
                                            <td>{{ $list->bankList->name }}</td>
                                            <td>{{ $list->account_name }}</td>
                                            <td>{{ $list->account_number }}</td>
                                            <td>{{ $list->branch_name }}</td>
                                            <td>{{ $list->city }}</td>
                                            <td>{{ $list->routin_number }}</td>
                                            <td>{{ $list->approved_date }}</td>
                                            <td>{{ $list->final_amount }}</td>
                                            <td>
                                                <a href="{{ url('admin/withdraw/payment/' . $list->id . '/accept') }}"
                                                    class="btn btn-sm btn-success">Pay</a>
                                            </td>

                                        </tr>
                                    @endforeach

                                    {{-- <tr>
                                        <td colspan="9"></td>
                                        <td colspan="2"><strong>{{ Helper::CurrencyFormatter($sum) }}</strong></td>
                                    </tr> --}}

                                </tbody>
                            </table>

                        </div>
                    </div>

                    <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12 mt-3">
                        <div class="card-body">
                            <div class="card-header">
                                <h2>Mobile Banking({{Helper::CurrencyFormatter($total_mobile_bank_amount->total)}})</h2>
                            </div>
                            <table id="e-global-table2" class="table table-striped">
                                <thead>
                                    <tr>
                                        <th scope="col">SL#</th>
                                        <th scope="col">Employee</th>
                                        <th scope="col">Payment Type</th>
                                        <th scope="col">Number</th>
                                        <th scope="col">Approved</th>
                                        <th scope="col">Amount</th>
                                        <th scope="col">Action</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $s = 1;
                                    $sum = 0;
                                    ?>
                                    @foreach ($mobileBankPayment as $list)

                                        <tr>
                                            <td>{{ $s++ }}</td>
                                            <td>{{ $list->user->name }}</td>
                                            <td>{{ $list->payment_type }}</td>
                                            <td>{{ $list->mobile_number }}</td>
                                            <td>{{ $list->approved_date }}</td>
                                            <td>{{ $list->final_amount }}</td>
                                            <td>
                                                <a href="{{ url('admin/withdraw/payment/' . $list->id . '/accept') }}"
                                                    class="btn btn-sm btn-success">Pay</a>
                                            </td>

                                        </tr>
                                    @endforeach

                                </tbody>
                            </table>

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
