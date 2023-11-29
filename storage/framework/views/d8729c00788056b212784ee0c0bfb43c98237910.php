<?php $__env->startSection('title'); ?>
    <?php echo e(Helper::webinfo()->site_title); ?> | <?php echo e(trans('labels.product_wise_income')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('css'); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
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
                                <?php $__currentLoopData = $datas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=> $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td><?php echo e(++$key); ?></td>
                                    <td><?php echo e($data->amount); ?></td>
                                    <td><?php echo e($data->note); ?></td>
                                    <td><?php echo e($data->acc_head); ?></td>
                                    <td><?php echo e($data->date); ?></td>

                                </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
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
                               <?php $__currentLoopData = $acc_head; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=> $head_data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                 <option value="<?php echo e($head_data->head_title); ?>"><?php echo e($head_data->head_title); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
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
<?php $__env->stopSection(); ?>
<?php $__env->startSection('script'); ?>


<?php $__env->stopSection(); ?>
<?php $__env->startSection('scripttop'); ?>
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
                        url: '<?php echo e(route('admin.expense.store')); ?>',
                        type: "post",
                        data: {
                            'amount': expense_amount,
                            'note': note,
                            'acc_head': acc_head,

                        },
                        success: function(data) {

                            if(data.status == 200){
                                Swal.fire({type: 'success',title: '<?php echo e(trans('labels.success')); ?>',showConfirmButton: false,timer: 1500});
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
<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\eglobalmart\resources\views/Admin/expense/index.blade.php ENDPATH**/ ?>