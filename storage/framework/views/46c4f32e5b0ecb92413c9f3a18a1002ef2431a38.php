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
                        <h3><?php echo e(trans('labels.sales_history')); ?></h3>
                        <form method="post" action="<?php echo e(route('admin.sales.history.search')); ?>">
                            <?php echo csrf_field(); ?>
                            <div class="row py-2">
                                <div class="col-md-10">
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

                                    <?php if(!empty($list->user->name)): ?>
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


<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\eglobalmart\resources\views/Admin/sales/history.blade.php ENDPATH**/ ?>