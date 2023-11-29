@extends('layouts.admin')
@section('title')
    {{ Helper::webinfo()->site_title }} | {{ trans('labels.vendors') }}
@endsection
@section('css')
@endsection
@section('content')
    <div class="content-wrapper">
        <section id="configuration">
            <div class="row">
                @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
                <div class="col-12">
                    @if (Session::has('success'))
                        <div class="alert alert-success">
                            {{ Session::get('success') }}
                            @php
                                Session::forget('success');
                            @endphp
                        </div>
                    @endif
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">{{ trans('labels.vendors') }}</h4>
                            <a href="{{ route('admin.vendors.add') }}"
                                class="btn btn-raised btn-primary btn-min-width mr-1 mb-1 float-right"
                                style="margin-top: -30px;">
                                {{ trans('labels.add_vendor') }}
                            </a>
                        </div>


                        <div class="card-body collapse show">
                            <div class="card-block card-dashboard" id="table-display">
                                @include('Admin.vendors.vendorstable')
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            {{-- <div id="chang_pass" class="modal fade" role="dialog">
                <div class="modal-dialog">

                  <!-- Modal content-->
                  <div class="modal-content">
                        <div class="modal-header"><h4 class="modal-title text-left">{{ trans('labels.write_reason') }}</h4></div>
                        <div class="modal-body">
                          <form >

                                <div class="row">
                                    <div class="col-md-6">
                                        <label for="comment" class="col-form-label">New Password </label>
                                        <input type="text" name="new_pass" value="">
                                    </div>
                                    <div class="col-md-6">
                                        <label for="comment" class="col-form-label">Confirm Password </label>
                                        <input type="text" name="confirm_pass" value="">
                                    </div>

                                    <button class="btn btn-success">save</button>
                                </div>
                          </form>
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">{{ trans('labels.close') }}</button>
                          <button type="button" class="btn btn-sm btn-primary" onclick="StatusUpdate()">{{ trans('labels.submit') }}</button>
                        </div>
                  </div>
                </div>
          </div> --}}

          <div class="modal" id="passModal" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content mt-5">
                    <div class="modal-header">
                        <h5 class="modal-title">Change password </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form  method="post" action="{{ route('admin.vendors.passChange') }}">
                        @csrf
                    <div class="modal-body">


                            <div class="row">
                                <div class="col-md-6">
                                    <label for="comment" class="col-form-label">New Password </label>
                                    <input type="hidden" id="userId" name="user_id" value="">
                                    <input required class="form-control" type="text" name="new_pass" value="">
                                </div>
                                <div class="col-md-6">
                                    <label for="comment" class="col-form-label">Confirm Password </label>
                                    <input required class="form-control" type="text" name="confirm_pass" value="">
                                </div>

                                <button type="submit" class="btn btn-success mt-5 ml-3">save</button>
                            </div>
                        </div>
                    </form>
            </div>
        </div>
        </section>
    </div>
@endsection
@section('scripttop')
@endsection
@section('script')
    <script type="text/javascript">
        //Change Status

        function chanPass(e,id){
            $('#passModal').modal('show');
            $('#userId').val(id);
            $('.modal-backdrop').remove();

        }

        function AssignStockiest(e) {
            // console.log(e.value)
            let user_id = e.getAttribute('data-id')
            let stockiest_id = e.value;
            console.log(user_id, stockiest_id)

            Swal.fire({
                title: '{{ trans('labels.are_you_sure') }}',
                text: "Assign a vendor",
                type: 'error',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: '{{ trans('labels.yes') }}',
                cancelButtonText: '{{ trans('labels.no') }}'
            }).then((t) => {
                if (t.value == true) {
                    $('#preloader').show();

                    $.ajax({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        url: '{{ route('admin.assign.vandor') }}',
                        type: "POST",
                        data: {
                            'stockiest_id': stockiest_id,
                            'user_id': user_id,

                        },
                        success: function(data) {
                            $('#preloader').hide();
                            location.reload()
                            if (data == 1000) {
                                Swal.fire({
                                    type: 'success',
                                    title: '{{ trans('labels.success') }}',
                                    showConfirmButton: false,
                                    timer: 1500
                                });
                                if (status == '1') {
                                    $('#tdstatus' + id).html(
                                        '<span class="btn btn-raised btn-outline-success round btn-min-width mr-1 mb-1 changeStatus" data-status="2"  data-id="' +
                                        id + '">{{ trans('labels.active') }}</span>');
                                } else {
                                    $('#tdstatus' + id).html(
                                        '<span class="btn btn-raised btn-outline-danger round btn-min-width mr-1 mb-1 changeStatus" data-status="1"  data-id="' +
                                        id + '">{{ trans('labels.deactive') }}</span>');
                                }
                            } else {
                                Swal.fire({
                                    type: 'error',
                                    title: '{{ trans('labels.cancelled') }}',
                                    showConfirmButton: false,
                                    timer: 1500
                                });
                            }

                        },
                        error: function(data) {
                            $('#preloader').hide();
                            console.log("AJAX error in request: " + JSON.stringify(data, null, 2));
                        }
                    });
                } else {
                    Swal.fire({
                        type: 'error',
                        title: '{{ trans('labels.cancelled') }}',
                        showConfirmButton: false,
                        timer: 1500
                    });

                }
            });
        }
        $('body').on('click', '.changeStatus', function() {
            // alert('kkkk')
            // return;
            let status = $(this).attr('data-status');
            let id = $(this).attr('data-id');
            let stockiest_id = $(this).attr('data-stockiest-id');
            if (stockiest_id != '') {
                Swal.fire({
                title: '{{ trans('labels.are_you_sure') }}',
                text: "{{ trans('labels.change_status') }}",
                type: 'success',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: '{{ trans('labels.yes') }}',
                cancelButtonText: '{{ trans('labels.no') }}'
            }).then((t) => {
                if (t.value == true) {
                    $('#preloader').show();
                    $.ajax({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        url: '{{ route('admin.vendors.changeStatus') }}',
                        type: "POST",
                        data: {
                            'id': id,
                            'status': status
                        },
                        success: function(data) {
                            $('#preloader').hide();
                            if (data == 1000) {
                                Swal.fire({
                                    type: 'success',
                                    title: '{{ trans('labels.success') }}',
                                    showConfirmButton: false,
                                    timer: 1500
                                });
                                if (status == '1') {
                                    $('#tdstatus' + id).html(
                                        '<span class="btn btn-raised btn-outline-success round btn-min-width mr-1 mb-1 changeStatus" data-status="2"  data-id="' +
                                        id + '">{{ trans('labels.active') }}</span>');
                                } else {
                                    $('#tdstatus' + id).html(
                                        '<span class="btn btn-raised btn-outline-danger round btn-min-width mr-1 mb-1 changeStatus" data-status="1"  data-id="' +
                                        id + '">{{ trans('labels.deactive') }}</span>');
                                }
                            } else {
                                Swal.fire({
                                    type: 'error',
                                    title: '{{ trans('labels.cancelled') }}',
                                    showConfirmButton: false,
                                    timer: 1500
                                });
                            }

                        },
                        error: function(data) {
                            $('#preloader').hide();
                            console.log("AJAX error in request: " + JSON.stringify(data, null,
                                2));
                        }
                    });
                } else {
                    Swal.fire({
                        type: 'error',
                        title: '{{ trans('labels.cancelled') }}',
                        showConfirmButton: false,
                        timer: 1500
                    });

                }
            });
            } else {
                Swal.fire({
                title: 'Sorry',
                text: "Please Select Before Stockiest",
                type: 'error',
                showCancelButton: false,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',

            })
            }


        });
    </script>
@endsection
