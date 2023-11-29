<?php $__env->startSection('title'); ?>
    <?php echo e(Helper::webinfo()->site_title); ?> | <?php echo e(trans('labels.manage_stockiest')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('css'); ?>
    .select2-selection__rendered{

    }
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <div class="content-wrapper">
        <section id="basic-form-layouts">
            <div class="row">
                <div class="col-sm-12">
                    <div class="content-header"><?php echo e(trans('labels.add_stock')); ?></div>
                </div>
            </div>

            <div class="row justify-content-md-center">
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">
                        </div>
                        <div class="card-body">
                            <?php if(Session::has('danger')): ?>
                                <div class="alert alert-danger">
                                    <?php echo e(Session::get('danger')); ?>

                                    <?php
                                        Session::forget('danger');
                                    ?>
                                </div>
                            <?php endif; ?>
                            
                            <div class="px-3">
                                <form class="form" method="post" action="<?php echo e(route('admin.stockiest.store')); ?>"
                                    enctype="multipart/form-data">
                                    <?php echo csrf_field(); ?>
                                    <div class="form-body">
                                        <div class="form-group">
                                            <label for="user_id"><?php echo e(trans('labels.user_number')); ?></label>
                                            <select xid="vendor_phone" onchange="vendorPhone(this)"  class="form-control select2" name="user_id"
                                                id="user_id">

                                                <option value=""><?php echo e(trans('placeholder.user_number')); ?></option>
                                                <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <option value="<?php echo e($value->id); ?>"><?php echo e($value->mobile); ?>

                                                        (<?php echo e($value->name); ?>)</option>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                            </select>
                                            <?php $__errorArgs = ['user_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                <span class="text-danger"><?php echo e($message); ?></span>
                                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                        </div>

                                        <div class="form-group">
                                            <label for="stock_name"><?php echo e(trans('labels.stock_name')); ?></label>
                                            <input type="text" id="stock_name" class="form-control" name="stock_name"
                                                placeholder="<?php echo e(trans('placeholder.stoct_name')); ?>"
                                                value="<?php echo e(old('amount')); ?>">
                                            <?php $__errorArgs = ['stock_name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                <span class="text-danger"><?php echo e($message); ?></span>
                                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                        </div>
                                         <div class="form-group">
                                            <label for="phone"><?php echo e(trans('labels.phone')); ?></label>
                                            <input type="number" id="phone" class="form-control" name="phone"
                                                placeholder="<?php echo e(trans('placeholder.phone')); ?>"
                                                value="<?php echo e(old('phone')); ?>">
                                            <?php $__errorArgs = ['phone'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                <span class="text-danger"><?php echo e($message); ?></span>
                                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                        </div>
                                         <div class="form-group">
                                            <label for="trade_license"><?php echo e(trans('labels.trade_license')); ?></label>
                                            <input type="text" id="trade-license" class="form-control" name="trade_license"
                                                placeholder="<?php echo e(trans('placeholder.trade_license')); ?>"
                                                value="<?php echo e(old('trade_license')); ?>">
                                            <?php $__errorArgs = ['trade_license'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                <span class="text-danger"><?php echo e($message); ?></span>
                                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                        </div>

                                        <div class="form-group">
                                            <label for="address"><?php echo e(trans('labels.address')); ?></label>
                                            <textarea type="text" id="address" class="form-control" name="address"
                                                placeholder="<?php echo e(trans('placeholder.address')); ?>" value="<?php echo e(old('address')); ?>"></textarea>
                                            <?php $__errorArgs = ['address'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                <span class="text-danger"><?php echo e($message); ?></span>
                                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                        </div>

                                        <div class="gallery"></div>
                                    </div>
                                    <div class="form-actions center">
                                        <a href="<?php echo e(route('admin.stockiest')); ?>" class="btn btn-raised btn-warning mr-1"><i
                                                class="ft-x"></i> <?php echo e(trans('labels.cancel')); ?></a>
                                        <?php if(env('Environment') == 'sendbox'): ?>
                                            <button type="button" class="btn btn-raised btn-primary"
                                                onclick="myFunction()"> <i class="fa fa-check-square-o"></i>
                                                <?php echo e(trans('labels.save')); ?></button>
                                        <?php else: ?>
                                            <button type="submit" id="btn_add_category" class="btn btn-raised btn-primary">
                                                <i class="fa fa-check-square-o"></i> <?php echo e(trans('labels.save')); ?></button>
                                        <?php endif; ?>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('scripttop'); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('script'); ?>
    <script type="text/javascript">
        $(function() {
            $(".select2-selection__rendered").addClass('form-control');
            $(".select2-selection--single").addClass('border-0');

        });

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });


         function vendorPhone(e){
            // alert(e.value);
            var userId = e.value;

            $.ajax({
                url: "<?php echo e(route('admin.sales.show.user')); ?>",
                method: 'GET',
                data: {
                    'user_id': userId
                },
                success: function(data) {
                    console.log('idNumber s',data);
                    $('#stock_name').val(data.data[0]['name']);
                    // $('#phone').val(data.data[0]['mobile']);
                    $('#address').val(data.data[0]['store_address'])
                    // stockId = data.data[0].stockiest.id;

                }
            });
        }
        $(document).on('click', '#vendor_phone', function(e) {



            let userId = $(this).val();
            alert(userId);
            // userId = idNumber;



            // console.log('idNumber',idNumber);

        });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\eglobalmart\resources\views/Admin/stockiest/create.blade.php ENDPATH**/ ?>