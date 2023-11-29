@extends('layouts.admin')
@section('title')
    {{ Helper::webinfo()->site_title }} | {{ trans('labels.withdraw_balance') }}
@endsection
@section('css')
@endsection
@section('content')
    <div class="content-wrapper">

        <section class="vh-100" style="background-color: #acb5c5;">
            <div class="container py-5 h-100">
                <div class="row d-flex justify-content-center align-items-center h-100">
                    <div class="col-12">
                        <div class="card shadow-2-strong" style="border-radius: 1rem;">
                            <div class="card-body p-5 text-center">
                                <div class="form-outline mb-4">
                                    @if (session('message'))
                                        <p class="alert alert-danger ">{{ session('message') }}</p>
                                    @elseif (session('successMessage'))
                                        <p class="alert alert-success">{{ session('successMessage') }}</p>
                                    @endif
                                </div>

                                <div class="col-lg-12 mb-lg-0 mb-5 my-3">
                                    <div class="text-center">
                                        <ul class="nav nav-tabs" role="tablist">
                                            <li class="nav-item active">
                                                <a class="nav-link" style="font-size: 16px" data-toggle="tab"
                                                    href="#mobile-bank">Mobile Bank</a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" style="font-size: 16px" data-toggle="tab"
                                                    href="#bank">Bank</a>
                                            </li>

                                        </ul>
                                    </div>
                                </div>

                                <div class="tab-content" style="">
                                    <div id="mobile-bank" class="container tab-pane active">

                                        <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12 mt-3">
                                            <!-- BEGIN SAMPLE FORM PORTLET-->
                                            <form action="{{ route('admin.withdraw.store') }}" method="POST">
                                                @csrf
                                                <div class="row">
                                                   <div class="col-6 py-1">
                                                    <div class="form-outline">
                                                        {{-- <label class="form-label" for="typeEmailX-2">Amount</label> --}}
                                                        <input type="number" id="" readonly value="{{$amount->wallet}}" placeholder="Amount..." name="amount"
                                                            class="form-control form-control-lg" />
                                                    </div>
                                                   </div>
                                                   <div class="col-6 py-1">
                                                        {{-- <label class="form-label" for="typeEmailX-2">Select Option</label> --}}
                                                        <select id="payment-option" required class="form-control form-control-lg" name="payment_type">
                                                         <option value="">Select Payment Option </option>
                                                         <option value="Bkash">Bkash</option>
                                                         <option value="Nagad">Nagad</option>
                                                         <option value="Rocket">Rocket</option>

                                                        </select>
                                                   </div>

                                                <div class="py-1 col-6">
                                                    {{-- <label class="form-label" for="typePasswordX-2">Receive Number</label> --}}
                                                    <input type="number"  id="mobile"  name="mobile_number"
                                                        placeholder="Mobile Number..." class="mobile-require form-control form-control-lg" />
                                                </div>

                                                <div class="py-1 col-6">
                                                    {{-- <label class="form-label" for="typePasswordX-2">Password</label> --}}
                                                    <input type="password" id="" required name="password"
                                                        placeholder="Password..." class="form-control form-control-lg" />
                                                </div>

                                                </div>
                                                <div class="float-right col-2 mt-3">
                                                    <button type="submit" class="btn btn-primary btn-block mb-4">Withdraw</button>
                                                </div>

                                            </form>

                                        </div>

                                    </div>
                                    <div id="bank" class="container tab-pane">

                                        <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12 mt-3">
                                            <form action="{{ route('admin.withdraw.store') }}" method="POST">
                                                @csrf
                                                <div class="row">
                                                   <div class="col-6 py-1">
                                                    <div class="form-outline">
                                                        {{-- <label class="form-label" for="typeEmailX-2">Amount</label> --}}
                                                        <input type="number" id="" readonly value="{{$amount->wallet}}" placeholder="Amount..." name="amount"
                                                            class="form-control form-control-lg" />
                                                    </div>
                                                   </div>
                                                   <div class="col-6 py-1">
                                                        {{-- <label class="form-label" for="typeEmailX-2">Select Option</label> --}}
                                                        <select id="payment-option" required class="form-control form-control-lg" name="payment_type">
                                                        <option value="Bank">Bank</option>
                                                        </select>
                                                   </div>


                                                <div class="py-1 col-6 ">
                                                    {{-- <label class="form-label" for="typePasswordX-2">A/C Name</label> --}}
                                                    <input type="text" id="" name="account_name"
                                                        placeholder="A/C Name..." required class="bank-require form-control form-control-lg" />
                                                </div>
                                                <div class="py-1 col-6 ">
                                                    {{-- <label class="form-label" for="typePasswordX-2">A/C Name</label> --}}
                                                    <input type="number" id="" name="account_number"
                                                        placeholder="Account Number" required class="form-control form-control-lg" />
                                                </div>
                                                <div class="py-1 col-6">
                                                    {{-- <label class="form-label" for="typePasswordX-2">Bank Name</label> --}}
                                                    <select  class=" form-control form-control-lg" required name="bank_list_id">
                                                        <option value="">Select Bank Name</option>
                                                        @foreach ($banks as $bank)
                                                          <option class="text-uppercase" value="{{$bank->id}}">{{$bank->name}}</option>
                                                        @endforeach
                                                       </select>
                                                </div>
                                                <div class="py-1 col-6">
                                                    {{-- <label class="form-label" for="typePasswordX-2">Branch Name</label> --}}
                                                    <input type="text" id="" required name="branch_name"
                                                        placeholder="Branch Name..." class="bank-require form-control form-control-lg" />
                                                </div>
                                                <div class="py-1 col-6">
                                                    {{-- <label class="form-label" for="typePasswordX-2">City</label> --}}
                                                    <input type="text" id="" required name="city"
                                                        placeholder="City..." class="bank-require form-control form-control-lg" />
                                                </div>

                                                <div class="py-1 col-6">
                                                    {{-- <label class="form-label" for="typePasswordX-2">Routin Number</label> --}}
                                                    <input type="number" id=""  name="routin_number"
                                                        placeholder="Routin Number..." class="bank-require form-control form-control-lg" />
                                                </div>
                                                <div class="py-1 col-6">
                                                    {{-- <label class="form-label" for="typePasswordX-2">Password</label> --}}
                                                    <input type="password" id="" required name="password"
                                                        placeholder="Password..." class="form-control form-control-lg" />
                                                </div>

                                                </div>
                                                <div class="float-right col-2 mt-3">
                                                    <button type="submit" class="btn btn-primary btn-block mb-4">Withdraw</button>
                                                </div>

                                            </form>
                                        </div>

                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

    </div>
@endsection
@section('scripttop')
@endsection
@section('script')
<script>
$(function(){
    // alert('ooo');
    $('.bank').addClass('d-none');
    $('#payment-option').on('change',function(){
        console.log($(this).val());
        let payment_option = $(this).val();
        if(payment_option == 'Bank'){
            $('.mobile').addClass('d-none');
            $('.bank').removeClass('d-none');
            // $('.bank-require').attr("required",'true');
            // $('.mobile-require').attr("required",'false');


        }else{
            $('#element1_id').attr('placeholder','Some New Text 1');
            $('#mobile').attr('placeholder','Enter '+payment_option+ ' Number')
            $('.mobile').removeClass('d-none');
            $('.bank').addClass('d-none');
            // $('.bank-require').attr("required",'false');
            // $('.mobile-require').attr("required",'true');
        }
    })
 });
</script>

@endsection
