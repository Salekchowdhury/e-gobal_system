@extends('layouts.admin')
@section('title')
    {{ Helper::webinfo()->site_title }} | {{ trans('labels.manage_stockiest') }}
@endsection
@section('css')
    .select2-selection__rendered{

    }
@endsection
@section('content')
    <div class="content-wrapper">
        <section id="basic-form-layouts">
            <div class="row">
                <div class="col-sm-12">
                    <div class="content-header">{{ trans('labels.add_stock') }}</div>
                </div>
            </div>

            <div class="row justify-content-md-center">
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">
                        </div>
                        <div class="card-body">
                            @if (Session::has('danger'))
                                <div class="alert alert-danger">
                                    {{ Session::get('danger') }}
                                    @php
                                        Session::forget('danger');
                                    @endphp
                                </div>
                            @endif
                            {{-- {{dd($users)}} --}}
                            <div class="px-3">
                                <form class="form" method="post" action="{{ route('admin.stockiest.store') }}"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <div class="form-body">
                                        <div class="form-group">
                                            <label for="user_id">{{ trans('labels.user_number') }}</label>
                                            <select xid="vendor_phone" onchange="vendorPhone(this)"  class="form-control select2" name="user_id"
                                                id="user_id">

                                                <option value="">{{ trans('placeholder.user_number') }}</option>
                                                @foreach ($users as $value)
                                                    <option value="{{ $value->id }}">{{ $value->mobile }}
                                                        ({{ $value->name }})</option>
                                                @endforeach

                                            </select>
                                            @error('user_id')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label for="stock_name">{{ trans('labels.stock_name') }}</label>
                                            <input type="text" id="stock_name" class="form-control" name="stock_name"
                                                placeholder="{{ trans('placeholder.stoct_name') }}"
                                                value="{{ old('amount') }}">
                                            @error('stock_name')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                         <div class="form-group">
                                            <label for="phone">{{ trans('labels.phone') }}</label>
                                            <input type="number" id="phone" class="form-control" name="phone"
                                                placeholder="{{ trans('placeholder.phone') }}"
                                                value="{{ old('phone') }}">
                                            @error('phone')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                         <div class="form-group">
                                            <label for="trade_license">{{ trans('labels.trade_license') }}</label>
                                            <input type="text" id="trade-license" class="form-control" name="trade_license"
                                                placeholder="{{ trans('placeholder.trade_license') }}"
                                                value="{{ old('trade_license') }}">
                                            @error('trade_license')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label for="address">{{ trans('labels.address') }}</label>
                                            <textarea type="text" id="address" class="form-control" name="address"
                                                placeholder="{{ trans('placeholder.address') }}" value="{{ old('address') }}"></textarea>
                                            @error('address')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="gallery"></div>
                                    </div>
                                    <div class="form-actions center">
                                        <a href="{{ route('admin.stockiest') }}" class="btn btn-raised btn-warning mr-1"><i
                                                class="ft-x"></i> {{ trans('labels.cancel') }}</a>
                                        @if (env('Environment') == 'sendbox')
                                            <button type="button" class="btn btn-raised btn-primary"
                                                onclick="myFunction()"> <i class="fa fa-check-square-o"></i>
                                                {{ trans('labels.save') }}</button>
                                        @else
                                            <button type="submit" id="btn_add_category" class="btn btn-raised btn-primary">
                                                <i class="fa fa-check-square-o"></i> {{ trans('labels.save') }}</button>
                                        @endif
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
        $(function() {
            $(".select2-selection__rendered").addClass('form-control');
            $(".select2-selection--single").addClass('border-0');

        });

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });


         function vendorPhone(e){
            // alert(e.value);
            var userId = e.value;

            $.ajax({
                url: "{{ route('admin.sales.show.user') }}",
                method: 'GET',
                data: {
                    'user_id': userId
                },
                success: function(data) {
                    console.log('idNumber s',data);
                    $('#stock_name').val(data.data[0]['name']);
                    // $('#phone').val(data.data[0]['mobile']);
                    $('#address').val(data.data[0]['store_address'])
                    // stockId = data.data[0].stockiest.id;

                }
            });
        }
        $(document).on('click', '#vendor_phone', function(e) {



            let userId = $(this).val();
            alert(userId);
            // userId = idNumber;



            // console.log('idNumber',idNumber);

        });
    </script>
@endsection
