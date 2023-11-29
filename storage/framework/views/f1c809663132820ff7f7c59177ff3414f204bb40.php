<?php $__env->startSection('title'); ?>
    <?php echo e(Helper::webinfo()->site_title); ?> | <?php echo e(trans('labels.manage_stockiest')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('css'); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <div class="content-wrapper card">
        <section id="basic-form-layouts">
            <div class="row">
                <div class="col-sm-12">
                    <div class="content-header"><?php echo e(trans('labels.stockiest_order_summary')); ?></div>
                </div>
            </div>
            <form  method="post" action="<?php echo e(route('admin.stockiest.search.order')); ?>">
                <?php echo csrf_field(); ?>
                <div class="row py-2">
                    <div class="col-md-9">
                        <div class="row">
                            <div class="col-md-3">
                                <label class="">From Date</label>
                                <input type="date" name="from_date" class="form-control" value="" placeholder="From Date...">
                            </div>
                            <div class="col-md-3">
                                <label class="">To Date</label>
                                <input type="date" name="to_date" class="form-control" value="" placeholder="To Date...">
                            </div>
                            <div class="col-md-3">
                                <label class="">Select type</label>
                               <select class="form-control" name="status">
                                 <option value="">Select Option</option>
                                <option value="total">Total Order</option>
                                 <option value="1">Placed</option>
                                 <option value="2">Confirmed</option>
                                 <option value="3">Shipped</option>
                                 <option value="11">Assign to Rider</option>
                                 <option value="4">Delivered</option>
                                <option value="8">Returned</option>
                                 <option value="5">Cancelled By Vendor</option>
                                 <option value="6">Cancelled By User</option>
                               </select>
                            </div>
                            <div class="col-md-3 mt-4">
                                <button type="submit" class="btn btn-success">Search</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>

            <div class="cart-body">
                <table class="table table-striped table-bordered zero-configuration">
                    <thead>
                        <tr>
                            <th>Title</th>
                            <th>No</th>
                            <th>Amount</th>

                        </tr>
                    </thead>
                    <tbody>
                       <?php if($status != null): ?>

                        <?php if($status_name == 1): ?>
                        <tr>
                            <td class="text-success"> Placed Order </td>
                            <td class="font-weight-bold"><?php echo e($totalPlacedOrder); ?></td>
                            <td class="font-weight-bold"><?php echo e($totalPlaceAmount); ?></td>
                        </tr>
                         <?php elseif($status_name == 2): ?>
                         <tr>
                            <td class="text-secondary"> Confirmed Order </td>
                        <td class="font-weight-bold"><?php echo e($totalConfirmOrder); ?></td>
                        <td class="font-weight-bold"><?php echo e($totalConfirmAmount); ?></td>
                        </tr>
                        <?php elseif($status_name == 3): ?>
                        <tr>
                            <td>Order Shipped</td>
                            <td class="font-weight-bold"><?php echo e($totalShippedOrder); ?></td>
                            <td class="font-weight-bold"><?php echo e($totalShippedAmount); ?></td>
                        </tr>
                        <?php elseif($status_name == 4): ?>
                        <tr>
                            <td class="text-success">Order Delivered</td>
                            <td class="font-weight-bold"><?php echo e($totalDeleveredOrder); ?></td>
                            <td class="font-weight-bold"><?php echo e($totalDeleveredAmount); ?></td>

                        </tr>
                        <?php elseif($status_name == 5): ?>
                        <tr>
                            <td>Cancel By Vendor</td>
                            <td class="font-weight-bold"><?php echo e($totalCancelByVendorOrder); ?></td>
                            <td class="font-weight-bold"><?php echo e($totalCancelByVendorAmount); ?></td>
                        </tr>

                        <?php elseif($status_name == 6): ?>
                        <tr>
                            <td class="text-danger">Cancel By User</td>
                            <td class="font-weight-bold"><?php echo e($totalCancelByUserOrder); ?></td>
                            <td class="font-weight-bold"><?php echo e($totalCancelByUserAmount); ?></td>
                        </tr>
                         <?php elseif($status_name == 8): ?>
                        <tr>
                            <td class="text-danger">Return Order</td>
                            <td class="font-weight-bold"><?php echo e($totalReturnOrder); ?></td>
                            <td class="font-weight-bold"><?php echo e($totalReturnOrder); ?></td>
                        </tr>
                        <?php elseif($status_name == 11): ?>
                        <tr>
                            <td class="text-warning">Assign To Rider</td>
                        <td class="font-weight-bold"><?php echo e($totalAssignRiderOrder); ?></td>
                        <td class="font-weight-bold"><?php echo e($totalAssignRiderAmount); ?></td>
                        </tr>
                       <?php endif; ?>

                       <?php else: ?>

                    <tr>
                        <td class="text-success"> Placed Order </td>
                        <td class="font-weight-bold"><?php echo e($totalPlacedOrder); ?></td>
                        <td class="font-weight-bold"><?php echo e($totalPlaceAmount); ?></td>
                    </tr>
                    <tr>
                        <td class="text-secondary"> Confirmed Order </td>
                        <td class="font-weight-bold"><?php echo e($totalConfirmOrder); ?></td>
                        <td class="font-weight-bold"><?php echo e($totalConfirmAmount); ?></td>
                    </tr>
                    <tr>
                        <td class="text-warning">Shipped Order</td>
                        <td class="font-weight-bold"><?php echo e($totalShippedOrder); ?></td>
                        <td class="font-weight-bold"><?php echo e($totalShippedAmount); ?></td>
                    </tr>
                    <tr>
                        <td class="text-success">Order Delivered</td>
                        <td class="font-weight-bold"><?php echo e($totalDeleveredOrder); ?></td>
                        <td class="font-weight-bold"><?php echo e($totalDeleveredAmount); ?></td>
                    </tr>
                    <tr>
                        <td>Cancel By Vendor</td>
                        <td class="font-weight-bold"><?php echo e($totalCancelByVendorOrder); ?></td>
                        <td class="font-weight-bold"><?php echo e($totalCancelByVendorAmount); ?></td>
                    </tr>

                    <tr>
                        <td class="text-danger">Cancel By User</td>
                        <td class="font-weight-bold"><?php echo e($totalCancelByUserOrder); ?></td>
                        <td class="font-weight-bold"><?php echo e($totalCancelByUserAmount); ?></td>
                    </tr>
                       <tr>
                        <td class="text-warning">Assign To Rider</td>
                        <td class="font-weight-bold"><?php echo e($totalAssignRiderOrder); ?></td>
                        <td class="font-weight-bold"><?php echo e($totalAssignRiderAmount); ?></td>
                    </tr>

                     <tr>
                        <td class="text-danger">Return Order</td>
                        <td class="font-weight-bold"><?php echo e($totalReturnOrder); ?></td>
                        <td class="font-weight-bold"><?php echo e($totalReturnOrder); ?></td>
                    </tr>
                    <tr>
                        <td class="fw-bold"><strong>Total Order</strong> </td>
                        <td class="font-weight-bold">Total Order=<?php echo e($totalOrder); ?>,Total Product= <?php echo e($totalProduct); ?></td>
                        <td class="font-weight-bold"><?php echo e($totalAmount); ?></td>
                    </tr>
                       <?php endif; ?>

                    </tbody>
                </table>
                <div class="float-right">
                    
                </div>
            </div>


        </section>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\eglobalmart\resources\views/Admin/stockiest/order_summary.blade.php ENDPATH**/ ?>