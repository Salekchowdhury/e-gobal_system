<table id="e-global-table" class="table table-striped table-bordered zero-configuration">
    <thead>
        <tr>
            <th>#</th>
            <th><?php echo e(trans('labels.category')); ?></th>
            <th><?php echo e(trans('labels.subcategory')); ?></th>
            <th><?php echo e(trans('labels.product_price')); ?></th>
            <th><?php echo e(trans('labels.admin_assign_price')); ?></th>
            <th><?php echo e(trans('labels.vendor_name')); ?></th>
            <th><?php echo e(trans('labels.product_name')); ?></th>
            <th><?php echo e(trans('labels.stock')); ?></th>
            <th><?php echo e(trans('labels.point')); ?></th>
            <th><?php echo e(trans('labels.action')); ?></th>
        </tr>
    </thead>
    <tbody>
        <?php $n=0 ?>
        
        <?php $__empty_1 = true; $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
         
        <tr id="del-<?php echo e($row->id); ?>">
            <td><?php echo e(++$n); ?></td>
            <td><?php echo e($row['category']->category_name); ?></td>
            <td><?php echo e($row['subcategory']->subcategory_name); ?></td>
            <td><?php echo e($row->product_price); ?></td>
            <td><?php echo e($row->admin_product_price); ?></td>
            <td>
                <?php echo e($row->user?$row->user->name : ''); ?>

            </td>
            <td>
                <?php echo e($row->product_name); ?>

            </td>
            <td>
                <?php echo e($row->product_qty); ?>

            </td>
            <td>
                <?php echo e($row->point); ?>

            </td>
             <td>
                <?php if($row->approve_status == 1): ?>
                <a class="btn btn-danger btn-sm" href="<?php echo e(url('admin/products/product/'.$row->id.'/cancel')); ?>">Cancel</a>
                <?php endif; ?>
                <a class="btn btn-success btn-sm" href="<?php echo e(url('admin/products/product/'.$row->id.'/edit')); ?>">Edit</a>
            </td>
        </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>

        <?php endif; ?>
  </tbody>
</table>

<?php $__env->startSection('script'); ?>
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
    </script>

<?php $__env->stopSection(); ?>
<?php /**PATH C:\xampp\htdocs\eglobalmart\resources\views/Admin/products/admin_product_showtable.blade.php ENDPATH**/ ?>