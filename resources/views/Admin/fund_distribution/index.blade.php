@extends('layouts.admin')
@section('title')
    {{ Helper::webinfo()->site_title }} | {{ trans('labels.distributet_fund') }}
@endsection
@section('css')

@endsection
@section('content')
    <div class="content-wrapper">
        <section id="basic-form-layouts">
            <div class="row">
                <div class="col-sm-12">
                    <div class="content-header">{{ trans('labels.distributet_fund') }}</div>
                </div>
            </div>

            <div class="row justify-content-md-center">
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">
                            <strong class="py-2">Total Amount = <span id="total_distribute"></span></strong><br>
                            <strong class="text-danger d-none" id="over-amount">Sorry!.Can not add more than {{ Helper::webinfo()->distribute_amount }} Taka</strong>
                        </div>
                        <div class="card-body">

                            <div class="px-3">
                                @if (Session::has('message'))
                                    <div class="alert alert-success">
                                        {{ Session::get('message') }}
                                        @php
                                            Session::forget('message');
                                        @endphp
                                    </div>
                                @endif
                                 @if (Session::has('wrong'))
                                    <div class="alert alert-danger">
                                        {{ Session::get('wrong') }}
                                        @php
                                            Session::forget('wrong');
                                        @endphp
                                    </div>
                                @endif

                                <form class="form" method="post" action="{{ route('admin.distributetfound.store') }}"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <div class="form-body">
                                        @foreach ($datas as $data)
                                            {{-- {{dd($data)}} --}}

                                            <div class="form-group">
                                                <label>{{ $data->title }}</label>
                                                <input type="text" required oninput="distributetfound(this)"
                                                    class="form-control distribute-amount" name="{{ $data->title_key }}"
                                                    id=""
                                                    {{-- value="{{ $data->amount * $distribute_amount->distribute_amount }}" --}}
                                                    value="{{ $data->amount}}"
                                                    {{-- placeholder="{{ trans('labels.first_name') }}"> --}} </div>
                                        @endforeach
                                       <input type="hidden" id="distribute_amount" value="{{ Helper::webinfo()->distribute_amount }}">
                                       <input type="hidden" id="total_amount" name="total_amount" value="">
                                    </div>

                                    <div class="form-actions left">

                                        <button id="save-btn" type="submit" class="btn  btn-primary"> Save</button>
                                    </div>
                                </form>
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
<script type="text/javascript">

$(document).ready(function () {
            distributetfound();
        });



        function checkRefer(e) {
            // alert('ffff');
            // console.log(e.value)
            var code = e.value;
            $.ajax({
                url: "{{ route('admin.vendors.checkRefer') }}",
                method: 'GET',
                data: {
                    'code': code,
                },
                success: function(data) {
                    if (data.status == 200) {
                        $('#refer-msg').html('Refer code is matched')
                        $('#refer-msg').addClass('text-success')
                        $('#refer-msg').removeClass('text-danger')
                        $('#save-btn').prop("disabled", false);

                    } else {
                        $('#refer-msg').html('Refer code is wrong')
                        $('#refer-msg').removeClass('text-success')
                        $('#refer-msg').addClass('text-danger')
                        $('#save-btn').prop("disabled", true);

                    }

                }
            });
        }

        function distributetfound() {
            var numItems = 0;
             let distributeAmount = $('#distribute_amount').val();
            $(".distribute-amount").each((key, element) => {
                numItems += Number($(element).val());
                if(distributeAmount < numItems){
                     $('#over-amount').removeClass('d-none')
                }else{
                    $('#over-amount').addClass('d-none')
                }
            });
            $("#total_distribute").text(numItems)
            $("#total_amount").val(numItems)
        }

</script>
@endsection

