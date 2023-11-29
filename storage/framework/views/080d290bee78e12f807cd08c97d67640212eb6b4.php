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
                        <h3><?php echo e(trans('labels.product_vendor')); ?></h3>
                    </div>

                    <div class="card-body">
                        <table id="example1" class="table table-striped">
                            <thead>
                              <tr>
                                <th scope="col">SL#</th>
                                <th scope="col">Product Name</th>
                                <th scope="col">Vendor Name</th>
                                <th scope="col">Category</th>
                                <th scope="col">Product Price</th>
                                <th scope="col">Admin Assign Price</th>
                                <th scope="col">Discount Price</th>
                                <th scope="col">Point</th>
                                <th scope="col">Quntity</th>
                                
                              </tr>
                            </thead>
                            <tbody>
                                <?php
                                    $s=1;
                                ?>
                                <?php $__currentLoopData = $product_vendors; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $list): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                   <tr>
                                    <td><?php echo e($s++); ?></td>
                                    <td><?php echo e($list->products->product_name); ?></td>
                                    <td><?php echo e($list->user->name); ?></td>
                                    <td><?php echo e($list->category->category_name); ?></td>
                                    <td><?php echo e($list->product_price); ?></td>
                                    <td><?php echo e($list->admin_product_price); ?></td>
                                    <td><?php echo e($list->discounted_price); ?></td>
                                    <td><?php echo e($list->products->point); ?></td>
                                    <td><?php echo e($list->product_qty); ?></td>
                                    
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

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\eglobalmart\resources\views/Admin/productVedor/index.blade.php ENDPATH**/ ?>