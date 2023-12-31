<?php $__env->startSection('title'); ?>
    <?php echo e(Helper::webinfo()->site_title); ?> | <?php echo e(trans('labels.returnorders')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('css'); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <div class="content-wrapper">
        <?php if(Session::has('success')): ?>
        <div class="alert alert-success">
            <?php echo e(Session::get('success')); ?>

            <?php
                Session::forget('success');
            ?>
        </div>
        <?php endif; ?>

        <?php if(Session::has('danger')): ?>
        <div class="alert alert-danger">
            <?php echo e(Session::get('danger')); ?>

            <?php
                Session::forget('danger');
            ?>
        </div>
        <?php endif; ?>
        <section id="configuration">
            <div class="row">
                <div class="col-12">
                    <?php if(Session::has('success')): ?>
                    <div class="alert alert-success">
                        <?php echo e(Session::get('success')); ?>

                        <?php
                            Session::forget('success');
                        ?>
                    </div>
                    <?php endif; ?>
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title"><?php echo e(trans('labels.returnorders')); ?></h4>
                        </div>

                        <div class="card-body collapse show">
                            <div class="card-block card-dashboard" id="table-display">
                                <?php echo $__env->make('Admin.returnorders.ordersstable', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </section>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\eglobalmart\resources\views/Admin/returnorders/index.blade.php ENDPATH**/ ?>