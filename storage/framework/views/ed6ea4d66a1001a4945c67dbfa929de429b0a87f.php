<table id="e-global-table1" class="table table-striped table-bordered zero-configuration">
    <thead>
        <tr>
            <th><?php echo e(trans('labels.srno')); ?></th>
            <th><?php echo e(trans('labels.name')); ?></th>
            <th>Balance</th>
             <th><?php echo e(trans('labels.vendor_ref_code')); ?></th>
             <th>Refferal Vendor</th>
            <th><?php echo e(trans('labels.email')); ?></th>
            <th><?php echo e(trans('labels.mobile')); ?></th>
            <th><?php echo e(trans('labels.assign_stockiest')); ?></th>
            <th><?php echo e(trans('labels.status')); ?></th>

            <th>Fund Distribution</th>
            <th><?php echo e(trans('labels.action')); ?></th>
        </tr>
    </thead>
    <tbody>
        <?php $n=0 ?>
        <?php $__empty_1 = true; $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
        <tr id="del-<?php echo e($row->id); ?>">
            <td><?php echo e(++$n); ?></td>
            <td><?php echo e($row->name); ?></td>
            <td><?php echo e($row->wallet); ?></td>
             <td><?php echo e($row->referral_code); ?></td>
             <td><?php echo e($row->refferal_vendor); ?></td>
            <td><?php echo e($row->email); ?></td>
            <td><?php echo e($row->mobile); ?></td>
            <td>
                <select class="form-control" data-id="<?php echo e($row->id); ?>" name="stockiest_id" onchange="AssignStockiest(this)">
                    <option value="">Select Stockiest</option>
                    <?php $__currentLoopData = $stockiest; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $s_row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option <?php echo e(($row->stockiest_id == $s_row->id? "selected" : '')); ?> value="<?php echo e($s_row->id); ?>"><?php echo e($s_row->stock_name); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                 </select>

            </td>
            <td id="tdstatus<?php echo e($row->id); ?>">
                <?php if($row->is_available=='1'): ?>
                    <span class="btn btn-raised btn-outline-success round btn-min-width mr-1 mb-1 changeStatus" data-status="2"  data-stockiest-id="<?php echo e($row->stockiest_id); ?>" data-id="<?php echo e($row->id); ?>">
                      <span class="green-text"><?php echo e(trans('labels.active')); ?></span>
                    </span>
                <?php else: ?>
                    <span class="btn btn-raised btn-outline-danger round btn-min-width mr-1 mb-1 changeStatus" data-status="1" data-stockiest-id="<?php echo e($row->stockiest_id); ?>" data-id="<?php echo e($row->id); ?>">
                        <span class="red-text"><?php echo e(trans('labels.deactive')); ?></span>
                    </span>
                <?php endif; ?>
            </td>
            <td>
                <?php if($row->vendor_status == 1): ?>
                    <a href="<?php echo e(URL::to('admin/vendors/deactive/vendor-status/'.$row->id)); ?>"  title="Active">
                        <span class="btn btn-raised btn-outline-info round btn-min-width mr-1 mb-1">Active</span>
                    </a>
                <?php else: ?>
                <a href="<?php echo e(URL::to('admin/vendors/active/vendor-status/'.$row->id)); ?>"  title="Deactive">
                    <span class="btn btn-raised btn-outline-danger round btn-min-width mr-1 mb-1">Deactive</span>
                </a>
                <?php endif; ?>

            </td>
            <td>
                <a class="btn btn-sm" href="<?php echo e(URL::to('admin/vendors/vendor-details/'.$row->id)); ?>" data-original-title="<?php echo e(trans('labels.view')); ?>" title="<?php echo e(trans('labels.view')); ?>">
                    <span class="btn btn-raised btn-outline-warning round btn-min-width mr-1 mb-1"><?php echo e(trans('labels.view')); ?></span>
                </a>
                <a class="btn btn-sm" href="<?php echo e(URL::to('admin/vendors/login/'.$row->slug)); ?>" data-original-title="<?php echo e(trans('labels.login')); ?>" title="<?php echo e(trans('labels.login')); ?>">
                    <span class="btn btn-raised btn-outline-info round btn-min-width mr-1 mb-1"><?php echo e(trans('labels.login')); ?></span>
                </a>
                <button class="btn btn-sm btn-success" onclick="chanPass(this,<?php echo e($row->id); ?>)">Change pass</button>

            </td>
        </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>

        <?php endif; ?>
  </tbody>
</table>

<?php /**PATH C:\xampp\htdocs\eglobalmart\resources\views/Admin/vendors/vendorstable.blade.php ENDPATH**/ ?>