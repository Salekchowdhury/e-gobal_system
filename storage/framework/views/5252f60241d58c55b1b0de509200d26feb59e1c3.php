<?php $__env->startSection('title'); ?>
    <?php echo e(Helper::webinfo()->site_title); ?> | <?php echo e(trans('labels.subscribers')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('css'); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <div class="content-wrapper">
        <section id="striped-light">
            <div class="row">
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title"><?php echo e(trans('labels.subscribers')); ?></h4>
                        </div>

                        <div class="card-body">
                            <div class="card-block">
                                <table id="e-global-table1" class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th><?php echo e(trans('labels.email')); ?></th>
                                            <th><?php echo e(trans('labels.created_at')); ?></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $n=0 ?>
                                        <?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr>
                                            <td><?php echo e($row->email); ?></td>
                                            <td><?php echo e($row->created_at); ?></td>
                                        </tr>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </tbody>
                                </table>
                               
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\eglobalmart\resources\views/Admin/subscribe/index.blade.php ENDPATH**/ ?>