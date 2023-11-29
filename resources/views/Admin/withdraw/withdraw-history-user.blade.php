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
                    <div class="card-header">
                        <h3>{{ trans('labels.stockiest_commission') }}</h3>
                    </div>

                    <div class="card-body">
                        <table id="example1" class="table table-striped">
                            <thead>
                              <tr>
                                <th scope="col">SL#</th>
                                <th scope="col">Amount</th>
                                <th scope="col">Date</th>

                              </tr>
                            </thead>
                            <tbody>
                                <?php
                                    $s=1;
                                ?>
                                @foreach ($withdrawData as $list)
                                   <tr>
                                    <td>{{$s++}}</td>
                                    <td class="w-25">{{$list->amount}}</td>
                                    <td>{{$list->withdraw_date}}</td>


                                  </tr>

                                @endforeach

                            </tbody>
                          </table>
                          <div class="float-right">
                            {{$salesCommissions->links()}}

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
    $(function () {
        $("#example1").DataTable({
            // "lengthMenu":[ 3,4 ],
            "searching": true,
        });
        $("#example2").DataTable({

            "searching": true,
        });
        $("#example3").DataTable({
            "lengthMenu":[ 3,4 ],
        });
        $('#example4').DataTable({
            "paging": true,
            "lengthMenu":[ 3 ],
            "lengthChange": false,
            "searching": false,
            "ordering": true,
            "info": true,
            "autoWidth": false,
        });

    });
</script>
{{-- @include('Admin.sales.sales_js') --}}
@endsection
