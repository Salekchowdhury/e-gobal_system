<?php $__env->startSection('title'); ?>
    <?php echo e(Helper::webinfo()->site_title); ?> | <?php echo e(trans('labels.product_wise_income')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('css'); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <div class="content-wrapper">
        <div class="container">
            <div class="card">
                <div class="show-success-error"></div>
                    <div class="card-header">
                        <h3><?php echo e(trans('labels.product_wise_income')); ?></h3>
                        
                    </div>

                    <div class="card-body">
                        <table id="e-global-table" class="table table-striped">
                            <thead>
                              <tr>
                                <th scope="col">SL#</th>
                                <th scope="col">Product</th>
                                <th scope="col">Vendor Name</th>
                                <th scope="col">Product Price</th>
                                <th scope="col">Admin Assign Price</th>
                                <th scope="col">Qty</th>
                                <?php if(Auth::user()->type == 1): ?>
                                <th scope="col">Admin Profit</th>
                                <?php endif; ?>
                                <th scope="col">Vendor Profit without(D.C)</th>
                                <th scope="col">Delivery Charge</th>
                                <th scope="col">Date</th>

                              </tr>
                            </thead>
                            <tbody>
                                <?php
                                 $total_vendor_profit = 0;
                                 $total_admin_profit = 0;
                                 $total_product_price = 0;
                                 $total_admin_product_price = 0;
                                 $total_delivery_charge = 0;
                                ?>
                                <?php $__currentLoopData = $datas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=> $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php
                                $total_vendor_profit = $total_vendor_profit + $data->vendor_profit;
                                $total_admin_profit = $total_admin_profit + $data->admin_profit;
                                $total_delivery_charge = $total_delivery_charge + $data->delivery_charge;
                                $total_product_price =  $total_product_price + $data->product->product_price;
                                $total_admin_product_price = $total_admin_product_price + $data->product->admin_product_price;
                               ?>
                                <tr>
                                    <td><?php echo e(++$key); ?></td>
                                    <td><?php echo e($data->product->product_name); ?></td>
                                    <td><?php echo e($data->vendor?$data->vendor->name : ''); ?></td>
                                    <td><?php echo e($data->product->product_price); ?></td>
                                    <td><?php echo e($data->product->admin_product_price); ?></td>
                                    <td><?php echo e($data->qty); ?></td>
                                    <?php if(Auth::user()->type == 1): ?>
                                    <td><?php echo e($data->admin_profit); ?></td>
                                    <?php endif; ?>
                                    <td><?php echo e($data->vendor_profit); ?></td>
                                    <td><?php echo e($data->delivery_charge); ?></td>
                                    <td><?php echo e($data->generated_date); ?></td>
                                </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                <tr>
                                    <td class="font-weight-bold" colspan="">Total</td>
                                    <td colspan=""></td>
                                    <td colspan=""></td>
                                    <td class="font-weight-bold" colspan=""><?php echo e($total_product_price); ?></td>
                                    <td class="font-weight-bold" colspan=""><?php echo e($total_admin_product_price); ?></td>
                                    <td colspan=""></td>
                                    <?php if(Auth::user()->type == 1): ?>
                                    <td class="font-weight-bold" colspan=""><?php echo e($total_admin_profit); ?></td>
                                    <?php endif; ?>
                                    <td class="font-weight-bold" colspan=""><?php echo e($total_vendor_profit); ?></td>
                                    <td class="font-weight-bold" colspan=""><?php echo e($total_delivery_charge); ?></td>
                                    

                                </tr>
                            </tbody>
                          </table>

                    </div>
            </div>
        </div>

    </div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('script'); ?>


<?php $__env->stopSection(); ?>
<?php $__env->startSection('scripttop'); ?>
<script>
    $(function() {
        $("#e-global-table").DataTable({
            // "lengthMenu":[ 3,4 ],
            "searching": true,
        });
        $("#example2").DataTable({

            "searching": true,
        });


    });

</script>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\eglobalmart\resources\views/Admin/product_wise_income/index.blade.php ENDPATH**/ ?>