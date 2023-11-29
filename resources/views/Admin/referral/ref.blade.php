@extends('layouts.admin')
@section('title')
    {{ Helper::webinfo()->site_title }} | {{ trans('labels.referral') }}
@endsection
@section('css')
@endsection
@section('content')
    <div class="content-wrapper">
        <div class="container">
            <div class="card">
                <div class="show-success-error"></div>
                <div class="card-header">
                    <h3>{{ trans('labels.referral') }}</h3>
                </div>

                <div class="card-body">
                    <table id="example1" class="table table-striped">
                        <thead>
                            <tr>
                                <th scope="col">SL#</th>
                                <th scope="col">Lavel</th>
                                <th scope="col">Total Member</th>
                                <th scope="col">View</th>
                            </tr>
                        </thead>
                        <tbody>
                           @for ($i = 1; $i <= 3; $i++)
                           @if($i==1)
                           
                                                   <tr>
                               <td>{{ $i }}</td>
                               <td>Generation One</td>
                               <td>
                                   {{ $first_level }}</td>
                               <td>View</td>
                           </tr>
                           @elseif($i==2)
                                                            <tr>
                               <td>{{ $i }}</td>
                               <td>Generation Two</td>
                               <td>Total Member</td>
                               <td>View</td>
                           </tr>
                            @elseif($i==3)
                                                            <tr>
                               <td>{{ $i }}</td>
                               <td>Generation Three</td>
                               <td>Total Member</td>
                               <td>View</td>
                           </tr>
                           @endif
                           @endfor

                           
                         
                        </tbody>
                    </table>

                </div>
            </div>
            <!-- Button trigger modal -->
       

            <!-- Modal -->
            <div style="z-index: 145698;" class="modal fade" id="showModal" tabindex="-1" role="dialog"
                aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content" style="width: 625px">
                        <div class="modal-header">
                            <h5 class="modal-title" id="referenceModalTitle"></h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="card-body">
                                <table id="example1" class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th scope="col">SL#</th>
                                            <th scope="col">Name</th>
                                            <th scope="col">email</th>
                                            <th scope="col">phone</th>
                                            <th scope="col">Date</th>
                                        </tr>
                                    </thead>
                                    <tbody id="user-referral">


                                    </tbody>
                                </table>

                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

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
    <script>
        $(function() {
            $("#example1").DataTable({
                // "lengthMenu":[ 3,4 ],
                "searching": true,
            });
            $("#example2").DataTable({

                "searching": true,
            });

        });

        function showReferral(e) {
            var referTable = '';
            // alert(e.value);
            // console.log('previousSibling',e.parentElement.previousElementSibling.previousElementSibling.innerText);
            var lavel = e.parentElement.previousElementSibling.previousElementSibling.innerText;

            $('#referenceModalTitle').text("Member of Lavel " + lavel);
            $('#showModal').modal('show');
            $(".modal-backdrop").removeAttr('class');

            $.ajax({
                url: "{{ route('admin.users.referral.search') }}",
                method: 'GET',
                data: {
                    'referral_code': e.value
                },
                success: function(data) {
                    console.log('fff', data.data)



                    $.each(data.data, function(index, value) {
                        referTable += ` <tr>
                    <td>${index+1}</td>
                    <td>${value.name}</td>
                    <td>${value.email}</td>
                    <td>${value.mobile}</td>
                    <td>${value.created_at.split('T')[0]}</td>
                </tr>`

                    });

                    $('#user-referral').html(referTable);

                }
            });
        }
    </script>
    {{-- @include('Admin.sales.sales_js') --}}
@endsection
