<?php $__env->startSection('title'); ?>
    <?php echo e(Helper::webinfo()->site_title); ?> | <?php echo e(trans('labels.products')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('css'); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <div class="content-wrapper">
        <div class="container">
            <div class="card p-5">
                <div class="show-success-error"></div>
                    <div class="card-header">
                        <h3><?php echo e(trans('labels.sales_history')); ?></h3>
                    </div>

                    <div class="card-body">
                        <table id="example1" class="table table-striped">
                            <thead>
                              <tr>
                                <th scope="col">SL#</th>
                                <th scope="col">Customer Name</th>
                                <th scope="col">Sales Date</th>
                                <th scope="col">Tax</th>
                                <th scope="col">Vat</th>
                                <th scope="col">Discount</th>
                                <th scope="col">Load/Unload</th>
                                <th scope="col">Sub Total</th>
                                <th scope="col">Amount</th>
                                <th scope="col">Action</th>
                              </tr>
                            </thead>
                            <tbody>
                                <?php
                                    $s=1;
                                ?>
                                <?php $__currentLoopData = $salesHistory; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $list): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                   <tr>
                                    <td><?php echo e($s++); ?></td>

                                    <?php if($list->user->name): ?>
                                    <td><?php echo e($list->user->name); ?></td>
                                    <?php else: ?>
                                    <td></td>
                                    <?php endif; ?>

                                    
                                    <td><?php echo e($list->created_at); ?></td>
                                    <td><?php echo e($list->tax); ?></td>
                                    <td><?php echo e($list->vat); ?></td>
                                    <td><?php echo e($list->discount); ?></td>
                                    <td><?php echo e($list->load_unload); ?></td>
                                    <td><?php echo e($list->sub_total); ?></td>
                                    <td><?php echo e($list->amount); ?></td>
                                    <td>
                                        <a href="<?php echo e(url('/admin/pdf/generate/'.$list->id)); ?>" class="btn btn-success btn-sm ">View PDF</a>
                                        <a href="<?php echo e(url('/admin/pdf/view/report/'.$list->id)); ?>" class="btn btn-secondary btn-sm ">View</a>
                                        <a href="<?php echo e(url('/admin/pdf/download/'.$list->id)); ?>" class="btn btn-primary btn-sm ">Dowload</a>
                                    </td>


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
<?php $__env->startSection('script'); ?>
<script>
    $(function () {
        $("#example1").DataTable({
            // "lengthMenu":[ 3,4 ],
            "searching": true,
        });
        $("#example2").DataTable({

            "searching": true,
        });

    });
</script>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\eglobalmart\resources\views/admin/sales/history.blade.php ENDPATH**/ ?>