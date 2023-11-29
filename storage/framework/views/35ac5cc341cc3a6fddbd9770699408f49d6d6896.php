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
                    <h3><?php echo e(trans('labels.stockiest_stock')); ?></h3>
                    <form method="post" action="<?php echo e(route('admin.sales.stock.search')); ?>">
                        <?php echo csrf_field(); ?>
                        <div class="row py-2">
                            <div class="col-md-10">
                                <div class="row">
                                    <div class="col-md-3">
                                        <label class="">Stockiest</label>
                                        <select class="form-control" name="user_id">
                                            <option value="">Select Stockiest</option>
                                            <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($user->user_id); ?>"><?php echo e($user->stock_name); ?></option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>

                                    </div>
                                    <div class="col-md-3 mt-4">
                                        <button type="submit" class="btn btn-success">Search</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>

                <div class="card-body">
                    <table id="e-global-table1" class="table table-striped">
                        <thead>
                            <tr>
                                <th scope="col">Stocked Name</th>
                                <th scope="col">Product Name</th>
                                <th scope="col">Quntity</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__currentLoopData = $stock_list; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $list): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php if($list->currentStock): ?>
                                    <?php $__currentLoopData = $list->currentStock; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr>

                                            <td><?php echo e($list->stock_name); ?></td>
                                            <td><?php echo e($data->product->product_name); ?></td>
                                            <td><?php echo e($data->current_stock); ?></td>
                                        </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php endif; ?>
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


<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\eglobalmart\resources\views/Admin/sales/stockiest_stock.blade.php ENDPATH**/ ?>