@extends('layouts.admin')
@section('title')
    {{ Helper::webinfo()->site_title }} | {{ trans('labels.orders') }}
@endsection
@section('css')
@endsection
@section('content')
    <div class="content-wrapper">
        @if (Session::has('success'))
            <div class="alert alert-success">
                {{ Session::get('success') }}
                @php
                    Session::forget('success');
                @endphp
            </div>
        @endif

        @if (Session::has('danger'))
            <div class="alert alert-danger">
                {{ Session::get('danger') }}
                @php
                    Session::forget('danger');
                @endphp
            </div>
        @endif
        <section id="configuration">
            <div class="row">
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
                            <h4 class="card-title">{{ trans('labels.orders') }}</h4>
                        </div>
                        @if (session('message'))
                        <p class="alert alert-danger ">{{ session('message') }}</p>
                       @endif
                        <div class="card-body collapse show">

                            <div class="card-block card-dashboard" id="table-display">
                                <form method="post" action="{{ route('admin.orders.orderByDate') }}">
                                    @csrf
                                    <div class="row py-2">
                                        <div class="col-md-9">
                                            <div class="row">
                                                <div class="col-md-3">
                                                    <label class="">From Date</label>
                                                    <input type="date" name="from_date" class="form-control" value="{{old('from_date')}}"
                                                        placeholder="From Date...">
                                                </div>
                                                <div class="col-md-3">
                                                    <label class="">To Date</label>
                                                    <input type="date" name="to_date" class="form-control" value="{{old('to_date')}}"
                                                        placeholder="To Date...">
                                                </div>
                                                <div class="col-md-3 mt-4">
                                                    <button type="submit" class="btn btn-success">Search</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                                @include('Admin.orders.ordersstable')
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal" id="addCommentModal" tabindex="-1" role="dialog">
                <div class="modal-dialog" role="document">
                    <div class="modal-content mt-5">
                        <div class="modal-header">
                            <h5 class="modal-title">Add Comment</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <textarea required class="form-control" id="comment" name="comment" rows="3" cols="5"></textarea>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-primary" onclick="save()">Save</button>
                            <button type="button" class="btn btn-secondary"
                                data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
@section('script')
    <script type="text/javascript">
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        let comment = '';
        let status = '';
        let id = '';
        let price = '';
        let admin_price = '';
        let qty = '';
        let vendor_price = '';
        //Change Status
        $('body').on('click', '.changeStatus', function() {

            $('#addCommentModal').modal('show');
            $('.modal-backdrop').remove()
            status = $(this).attr('data-status');
            id = $(this).attr('data-id');

        });


        function save() {
            // alert('ooo');
            comment = $('#comment').val();
            // console.log('check co',comment,status,id)
            // return;
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
                        url: '{{ route('admin.orders.return') }}',
                        type: "POST",
                        data: {
                            'order_number': id,
                            'status': status,
                            'comment': comment
                        },
                        success: function(data) {
                            $('#preloader').hide();
                            location.reload();
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
        }

     
    </script>
@endsection
