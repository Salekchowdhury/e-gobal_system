<?php $__env->startSection('title'); ?>
    <?php echo e(Helper::webinfo()->site_title); ?> | <?php echo e(trans('labels.cancel_order')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('css'); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <div class="content-wrapper">
        <div class="container">
            <div class="card">
                <div class="show-success-error"></div>
                    <div class="card-header">
                        <h3><?php echo e(trans('labels.cancel_order')); ?></h3>
                        
                    </div>

                    <div class="card-body">
                        <table id="e-global-table1" class="table table-striped">
                            <tr>
                                <th><?php echo e(trans('labels.srno')); ?></th>
                                <?php if(Auth::user()->type == 1): ?>
                                <th class="text-center"><?php echo e(trans('labels.vendor_name')); ?></th>
                                <?php endif; ?>

                                <th class="text-center"><?php echo e(trans('labels.order_number')); ?></th>
                                <th class="text-center"><?php echo e(trans('labels.sales_point')); ?></th>
                                <th class="text-center"><?php echo e(trans('labels.no_of_products')); ?></th>
                                <th class="text-center"><?php echo e(trans('labels.customer')); ?></th>
                                <th class="text-center"><?php echo e(trans('labels.phone')); ?></th>
                                <th class="text-center"><?php echo e(trans('labels.date')); ?></th>
                                <th class="text-center">Qty</th>
                                <th class="text-center">Amount</th>
                                <th class="text-center"><?php echo e(trans('labels.action')); ?></th>
                            </tr>
                            <tbody>
                                <?php

                                    $total_amount = 0;
                                ?>
                                <?php $__currentLoopData = $datas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $in=> $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php
                                $total_amount = $total_amount + $row->grand_total;
                                ?>

                                   <tr>
                                    <tr id="">
                                        <td class="text-center"><?php echo e(++$in); ?></td>
                                        <?php if(Auth::user()->type == 1): ?>
                                        <td class="text-center"><?php echo e($row['vendors']->name); ?></td>
                                        <?php endif; ?>

                                        <td class="text-center"><?php echo e($row->order_number); ?></td>
                                        <td class="text-center"><?php echo e($row->stockiest ? $row->stockiest->stock_name ? $row->stockiest->stock_name : "" : ""); ?></td>

                                        <td class="text-center"><?php echo e($row->no_products); ?></td>
                                        <td class="text-center"><?php echo e($row->full_name); ?></td>
                                        <td class="text-center"><?php echo e($row->mobile); ?></td>

                                        <td class="text-center"><?php echo e($row->date); ?></td>
                                        <td class="text-center"><?php echo e($row->qty); ?></td>
                                        <td class="text-center"><?php echo e($row->grand_total); ?></td>
                                        <td class="text-center">
                                            <a href="<?php echo e(URL::to('admin/orders/order-details/'.$row->order_number)); ?>" class="success p-0" data-original-title="<?php echo e(trans('labels.view')); ?>" title="<?php echo e(trans('labels.view')); ?>">
                                                <span class="badge badge-warning"><?php echo e(trans('labels.view')); ?></span>
                                            </a>
                                          
                                        </td>
                                    </tr>

                                  </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php if(Auth::user()->type == 1): ?>
                                <tr>
                                    <td colspan="9" class="text-right">Total = </td>
                                    <td colspan="10" class=""><?php echo e($total_amount); ?></td>
                                  </tr>
                                  <?php elseif(Auth::user()->type == 3): ?>
                                  <tr>
                                    <td colspan="8" class="text-right">Total = </td>
                                    <td colspan="9" class=""><?php echo e($total_amount); ?></td>
                                  </tr>
                                <?php endif; ?>

                            </tbody>
                          </table>

                    </div>
            </div>
        </div>

    </div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('scripttop'); ?>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\eglobalmart\resources\views/Admin/cancel_order/index.blade.php ENDPATH**/ ?>