<?php $__env->startSection('title'); ?>
    <?php echo e(Helper::webinfo()->site_title); ?> | <?php echo e(trans('labels.products')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('css'); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <div class="content-wrapper">
        <div class="container">
            <div class="card p-3">
                <div class="card-header">
                    <h3><?php echo e(trans('labels.edit_point')); ?></h3>
                </div>
               <span class="mb-2"> <?php echo e(trans('labels.product_name')); ?>: <span><?php echo e($product->product_name); ?></span></span>
                <div class="card-body">
                <form action="<?php echo e(url('admin/products/product/'.$product->id.'/update')); ?>" method="POST">
                    <?php echo csrf_field(); ?>
                    <div class="row">
                        <div class="col-6">
                            <input type="number" name="point" value="<?php echo e($product->point); ?>" class="form-control" placeholder="Point...">
                         </div>
                         <div class="col-6">
                            <input type="number" name="admin_product_price" value="<?php echo e($product->admin_product_price); ?>" class="form-control" placeholder="Product Price...">
                         </div>

                    </div>
                     <button type="submit" class=" mt-2 btn btn-success btn-sm ">Update</button>
                </form>
                </div>
        </div>
        </div>

    </div>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('scripttop'); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('script'); ?>
<script type="text/javascript">

</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\eglobalmart\resources\views/Admin/products/edit_point.blade.php ENDPATH**/ ?>