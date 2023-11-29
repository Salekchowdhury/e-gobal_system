<table id="e-global-table1" class="table table-striped table-responsive-sm table-striped">
    <thead>
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
            <th class="text-center"><?php echo e(trans('labels.order_total')); ?></th>
            <th class="text-center"><?php echo e(trans('labels.status')); ?></th>
            <th class="text-center"><?php echo e(trans('labels.date')); ?></th>
            <th class="text-center"><?php echo e(trans('labels.action')); ?></th>
        </tr>
    </thead>
    <tbody>
        <?php $n=0 ?>
        <?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <tr id="del-<?php echo e($row->id); ?>">
            <td class="text-center"><?php echo e(++$n); ?></td>
            <?php if(Auth::user()->type == 1): ?>
            <td class="text-center"><?php echo e($row['vendors']->name); ?></td>
            <?php endif; ?>

            <td class="text-center"><?php echo e($row->order_number); ?></td>
            <td class="text-center"><?php echo e($row->stockiest ? $row->stockiest->stock_name ? $row->stockiest->stock_name : "" : ""); ?></td>

            <td class="text-center"><?php echo e($row->no_products); ?></td>
            <td class="text-center"><?php echo e($row->full_name); ?></td>
            <td class="text-center"><?php echo e($row->mobile); ?></td>
            <td class="text-center"><?php echo e(Helper::CurrencyFormatter($row->grand_total)); ?></td>
            <?php if($row->admin_status == 0): ?>
            <td class="text-center text-warning">Pending</td>
            <?php elseif($row->admin_status == 1): ?>
            <td class="text-center text-success">Accepted</td>
            <?php elseif($row->admin_status == 2): ?>
            <td class="text-center text-danger">Cancel</td>
            <?php endif; ?>

            <td class="text-center"><?php echo e($row->date); ?></td>
            <td class="text-center">

                <a href="<?php echo e(URL::to('admin/orders/order-details/'.$row->order_number)); ?>" class="success p-0" data-original-title="<?php echo e(trans('labels.view')); ?>" title="<?php echo e(trans('labels.view')); ?>">
                    <span class="badge badge-warning"><?php echo e(trans('labels.view')); ?></span>
                </a>

                
                <span class="badge badge-danger changeStatus" data-status="8" data-id=<?php echo e($row->order_number); ?>>
                    <?php echo e(trans('labels.return')); ?>

                </span>
            </td>
        </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </tbody>
</table>

<?php /**PATH C:\xampp\htdocs\eglobalmart\resources\views/Admin/orders/ordersstable.blade.php ENDPATH**/ ?>