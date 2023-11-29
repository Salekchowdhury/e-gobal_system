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
                        <h3><?php echo e(trans('labels.affiliate_commission')); ?></h3>
                        <form method="post" action="<?php echo e(route('admin.commission.search')); ?>">
                            <?php echo csrf_field(); ?>
                            <div class="row py-2">
                                <div class="col-md-12">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <label class="">From Date</label>
                                            <input type="date" name="from_date" class="form-control" value=""
                                                placeholder="From Date...">
                                        </div>
                                        <div class="col-md-3">
                                            <label class="">To Date</label>
                                            <input type="date" name="to_date" class="form-control" value=""
                                                placeholder="To Date...">
                                        </div>
                                        <div class="col-md-3">
                                            <label class="">Product</label>
                                            <select class="form-control select2" name="product_id">
                                                <option value="">Select Product</option>
                                                <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option value="<?php echo e($product->id); ?>"><?php echo e($product->product_name); ?></option>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </select>

                                        </div>
                                         <div class="col-md-3">
                                            <label class="">User</label>
                                            <select class="form-control select2" name="user_id">
                                                <option value="">Select Stockiest</option>
                                                <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option value="<?php echo e($user->id); ?>"><?php echo e($user->name); ?></option>
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
                                <th scope="col">SL#</th>
                                <th scope="col">Product Name</th>
                                <th scope="col">user</th>
                                <th scope="col">lavel</th>
                                <th scope="col">point</th>
                                <th scope="col">Generated Date</th>
                                <th scope="col" class="">Amount</th>
                              </tr>
                            </thead>
                            <tbody>
                                <?php
                                    $s=1;
                                    $total_amount = 0;
                                ?>
                                <?php $__currentLoopData = $productCommission; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $list): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php
                                $total_amount = $total_amount + $list->amount;
                                ?>
                                   <tr>
                                    <td><?php echo e($s++); ?></td>
                                    <td class="w-25"><?php echo e($list->product->product_name); ?></td>
                                    <td><?php echo e($list->user->name); ?></td>
                                    <td><?php echo e($list->level); ?></td>
                                    <td><?php echo e($list->point); ?></td>
                                    <td><?php echo e($list->generated_date); ?></td>
                                    <td class=""><?php echo e($list->amount); ?></td>

                                  </tr>

                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td colspan="6" class="text-right">Total =</td>
                                    <td colspan="7" class=""><?php echo e($total_amount); ?></td>
                                  </tr>
                            </tbody>
                          </table>
                          <div class="float-right"
                              <?php echo e($productCommission->links()); ?>;

                          </div>
                    </div>
            </div>
        </div>

    </div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('scripttop'); ?>

<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\eglobalmart\resources\views/Admin/commissionDistribution/index.blade.php ENDPATH**/ ?>