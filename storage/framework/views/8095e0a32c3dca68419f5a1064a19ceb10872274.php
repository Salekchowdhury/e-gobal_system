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
                <div class="card-header">
                    <h3><?php echo e(trans('labels.transaction_history')); ?></h3>
                </div>
                <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12 mt-3">
                    <div class="card-body">
                        <table id="e-global-table1" class="table table-striped">
                            <thead>
                                <tr>
                                    <th scope="col">SL#</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Type</th>
                                    <th scope="col">Amount</th>
                                    <th scope="col">Date</th>
                                </tr>

                            </thead>
                            <tbody>
                                 <?php
                                     $s=0;
                                 ?>
                                <?php $__currentLoopData = $single_history_data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $list): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td><?php echo e(++$s); ?></td>
                                        <td><?php echo e($list->user?$list->user->name : ''); ?></td>

                                        <?php if($list->sector == '1'): ?>
                                            <td>Product Sell</td>
                                        <?php elseif($list->sector == '2'): ?>
                                            <td>Stockist</td>
                                        <?php elseif($list->sector == '3'): ?>
                                            <td>Reference</td>
                                        <?php elseif($list->sector == '4'): ?>
                                            <td>Withdraw</td>
                                        <?php elseif($list->sector == '5'): ?>
                                            <td>Ranking</td>
                                        <?php endif; ?>
                                          <?php if($list->sector == '4'): ?>

                                          <td class="text-danger">-<?php echo e($list->earnamnt); ?></td>
                                          <?php else: ?>
                                          <td class="text-success">+<?php echo e($list->earnamnt); ?></td>

                                          <?php endif; ?>
                                        <td><?php echo e($list->earn_date); ?></td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                            </tbody>
                        </table>

                    </div>
                </div>

            </div>

        </div>
    <?php $__env->stopSection(); ?>
    <?php $__env->startSection('scripttop'); ?>
    <?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\eglobalmart\resources\views/Admin/transaction_history/index.blade.php ENDPATH**/ ?>