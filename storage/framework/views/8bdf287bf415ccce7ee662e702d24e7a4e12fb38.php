<?php $__env->startSection('title'); ?>
<?php echo e(Helper::webinfo()->site_title); ?> | <?php echo e(trans('labels.products')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('css'); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<div class="content-wrapper">
    <div class="container">
        <div class="card">
            <div class="show-success-error"></div>
            <div class="form-outline mb-4">
                <?php if(session('message')): ?>
                <p class="alert alert-success "><?php echo e(session('message')); ?></p>
                <?php endif; ?>
            </div>
            <div class="card-header">
                <h3><?php echo e(trans('labels.withdraw_payment')); ?></h3>
            </div>

            <div class="tab-content">

                <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12 mt-3">
                    <div class="card-body">
                        <div class="card-header">
                            <h2>Bank(<?php echo e(Helper::CurrencyFormatter($total_bank_amount->total)); ?>)</h2>
                        </div>
                        <table id="e-global-table1" class="table table-striped">
                            <thead>
                                <tr>
                                    <th scope="col">SL#</th>
                                    <th scope="col">Vendor</th>
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
                                <?php $__currentLoopData = $bankPayment; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $list): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                                <?php
                                            $sum = $sum + $list->final_amount;
                                        ?>
                                <tr>
                                    <td><?php echo e($s++); ?></td>
                                    <td><?php echo e($list->user->name); ?></td>
                                    <td><?php echo e($list->bankList->name); ?></td>
                                    <td><?php echo e($list->account_name); ?></td>
                                    <td><?php echo e($list->account_number); ?></td>
                                    <td><?php echo e($list->branch_name); ?></td>
                                    <td><?php echo e($list->city); ?></td>
                                    <td><?php echo e($list->routin_number); ?></td>
                                    <td><?php echo e($list->approved_date); ?></td>
                                    <td><?php echo e($list->final_amount); ?></td>
                                    <td>
                                        <a href="<?php echo e(url('admin/withdraw/payment/' . $list->id . '/accept')); ?>"
                                            class="btn btn-sm btn-success">Pay</a>
                                    </td>

                                </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>



                            </tbody>
                        </table>

                    </div>
                </div>

                <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12 mt-3">
                    <div class="card-body">
                        <div class="card-header">
                            <h2>Mobile
                                Banking(<?php echo e(Helper::CurrencyFormatter($total_mobile_bank_amount->total)); ?>)
                            </h2>
                        </div>
                        <table id="e-global-table2" class="table table-striped">
                            <thead>
                                <tr>
                                    <th scope="col">SL#</th>
                                    <th scope="col">Vendor</th>
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
                                <?php $__currentLoopData = $mobileBankPayment; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $list): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                                <tr>
                                    <td><?php echo e($s++); ?></td>
                                    <td><?php echo e($list->user->name); ?></td>
                                    <td><?php echo e($list->payment_type); ?></td>
                                    <td><?php echo e($list->mobile_number); ?></td>
                                    <td><?php echo e($list->approved_date); ?></td>
                                    <td><?php echo e($list->final_amount); ?></td>
                                    <td>
                                        <a href="<?php echo e(url('admin/withdraw/payment/' . $list->id . '/accept')); ?>"
                                            class="btn btn-sm btn-success">Pay</a>
                                    </td>

                                </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                            </tbody>
                        </table>

                    </div>
                </div>

            </div>

        </div>
    </div>

</div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('scripttop'); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>
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
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\eglobalmart\resources\views/Admin/withdraw/payment.blade.php ENDPATH**/ ?>
