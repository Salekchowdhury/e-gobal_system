@extends('layouts.admin')
@section('title')
    {{ Helper::webinfo()->site_title }} | {{ trans('labels.product_wise_income') }}
@endsection
@section('css')
@endsection
@section('content')
    <div class="content-wrapper">
        <div class="container">
            <div class="card">
                <div class="show-success-error"></div>
                    <div class="card-header">
                        <h3>Expense List</h3>
                        <button class="btn btn-success" onclick="expense()">Expense</button>
                    </div>

                    <div class="card-body">
                        <table id="e-global-table" class="table table-striped">
                            <thead>
                              <tr>
                                <th scope="col">SL#</th>
                                <th scope="col">Amount</th>
                                <th scope="col">Note</th>
                                <th scope="col">Acc Head</th>
                                <th scope="col">Date</th>

                              </tr>
                            </thead>
                            <tbody>
                                @foreach ($datas as $key=> $data)
                                <tr>
                                    <td>{{++$key}}</td>
                                    <td>{{$data->amount}}</td>
                                    <td>{{$data->note}}</td>
                                    <td>{{$data->acc_head}}</td>
                                    <td>{{$data->date}}</td>

                                </tr>
                                @endforeach
                            </tbody>
                          </table>

                    </div>
            </div>
        </div>
        <div class="modal" id="expenseModal" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content mt-5">
                    <div class="modal-header">
                        <h5 class="modal-title">Expense </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">

                        <div>
                            <label>Acc Head</label>
                          <select id="acc_head" name="acc_head" class="form-control">
                              <option value=''>--Please Select Acc Head--</option>
                               @foreach ($acc_head as $key=> $head_data)
                                 <option value="{{$head_data->head_title}}">{{$head_data->head_title}}</option>
                                @endforeach
                          </select>

                        </div>

                        <div>
                            <label>Amount</label>
                            <input type="number" id="expense-amount" required class="form-control"
                                " name="amount"
                                value=""></input>

                        </div>

                        <div class="mt-1">
                            <label>Note</label>
                            <input type="text" required class="form-control"
                                id="note" name="note" value=""></input>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary"
                            onclick="saveExpense()">Save</button>
                        <button type="button" class="btn btn-secondary"
                            data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')


@endsection
@section('scripttop')
<script>
    $(function() {
        $("#e-global-table").DataTable({
            // "lengthMenu":[ 3,4 ],
            "searching": true,
        });
        $("#example2").DataTable({

            "searching": true,
        });


    });
    function expense(){
         $('#expenseModal').modal('show');
         $('.modal-backdrop').remove()
    }
    function saveExpense(){
     let expense_amount = $('#expense-amount').val();
     let note = $('#note').val();
     let acc_head = $('#acc_head').val();
    //  console.log('note',acc_head,expense_amount,note)
    //  return;

    if(expense_amount.length> 0 && note.length>0){
        $.ajax({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        url: '{{ route('admin.expense.store') }}',
                        type: "post",
                        data: {
                            'amount': expense_amount,
                            'note': note,
                            'acc_head': acc_head,

                        },
                        success: function(data) {

                            if(data.status == 200){
                                Swal.fire({type: 'success',title: '{{ trans('labels.success') }}',showConfirmButton: false,timer: 1500});
                            }else{
                                Swal.fire({type: 'error',title: 'You Can not expense more than '+data.amount+ ' Taka',showConfirmButton: false,timer: 3000});

                            }
                            $('#expenseModal').modal('hide');
                            location.reload();
                        }
                    });
    }

    }
</script>
@endsection

