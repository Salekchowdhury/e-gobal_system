<?php $__env->startSection('title'); ?>
    <?php echo e(Helper::webinfo()->site_title); ?> | <?php echo e(trans('labels.rank_wise_distribute_fund')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('css'); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <div class="content-wrapper">
        <div class="container">
            <div class="card">
                <div class="show-success-error"></div>
                    <div class="card-header">
                        <h3><?php echo e(trans('labels.rank_wise_distribute_fund')); ?></h3>
                    </div>

                    <div class="container">
                    <div class="card-body py-5">
                            <form class="form" method="post" action="<?php echo e(route('admin.rank.wise.distribute.fund')); ?>">
                                <?php echo csrf_field(); ?>
                                <div class="row">
                                    <div class="col-md-5">
                                        <label>From Date:</label>
                                        <input class="form-control" type="date" required value="" name="from_date"/>
                                    </div>
                                    <div class="col-md-5">
                                        <label>To Date:</label>
                                        <input class="form-control" type="date" required value="" name="to_date"/>
                                    </div>
                                    <div class="col-md-2 mt-4">
                                        <button class="btn btn-success" type="submit"> Save</button>

                                    </div>
                                  </div>

                            </form>
                            <table id="e-global-table1" class="table table-striped">
                                <thead>
                                  <tr>
                                    <th scope="col">SL#</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Rank</th>
                                    <th scope="col">Amount</th>
                                    <th scope="col">Date</th>

                                  </tr>
                                </thead>
                                <tbody>
                                    <?php $__currentLoopData = $datas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=> $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td><?php echo e(++$key); ?></td>
                                        <td><?php echo e($data->user->name); ?></td>
                                        <td><?php echo e($data->rank); ?></td>
                                        <td><?php echo e($data->amount); ?></td>
                                        <td><?php echo e($data->generate_date); ?></td>
                                    </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </tbody>
                              </table>
                            </div>
                        </div>
            </div>
        </div>

    </div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('scripttop'); ?>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\eglobalmart\resources\views/Admin/rankHistory/rank_wise_distribution.blade.php ENDPATH**/ ?>