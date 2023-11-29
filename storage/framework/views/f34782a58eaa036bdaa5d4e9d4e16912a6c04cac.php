<?php $__env->startSection('title'); ?>
    <?php echo e(Helper::webinfo()->site_title); ?> | <?php echo e(trans('labels.add_purchase')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('css'); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <div class="content-wrapper">
        <section id="basic-form-layouts">
            <div class="row">
                <div class="col-sm-12">
                    <div class="content-header"><?php echo e(trans('labels.add_purchase')); ?></div>
                </div>
            </div>

            <div class="row justify-content-md-center">
                <div class="col-md-12">
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
                                <form class="form" method="post" action="<?php echo e(route('admin.supplier.store')); ?>" enctype="multipart/form-data">
                                <?php echo csrf_field(); ?>
                                <div class="form-row">
                                    <div class="col-2">
                                      <label for="name"><?php echo e(trans('labels.supplier_name')); ?></label>
                                      <select class="form-control" name="cat_id" id="cat_id">
                                        <option selected>Choose...</option>
                                        
                                      </select>
                                      <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><span class="text-danger"><?php echo e($message); ?></span><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                    </div>
                                    <div class="col-2">
                                        <label for="name"><?php echo e(trans('labels.product_name')); ?></label>
                                        <select class="form-control" name="cat_id" id="cat_id">
                                          <option selected>Choose...</option>
                                          
                                        </select>
                                        <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><span class="text-danger"><?php echo e($message); ?></span><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                     </div>
                                     <div class="col-2">
                                        <label for="name"><?php echo e(trans('labels.price')); ?></label>
                                        <input type="number" id="name" class="form-control" name="name" placeholder="<?php echo e(trans('placeholder.price_pur')); ?>" value="<?php echo e(old('name')); ?>">
                                         <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><span class="text-danger"><?php echo e($message); ?></span><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                     </div>
                                     <div class="col-2">
                                        <label for="name"><?php echo e(trans('labels.quantity_sup')); ?></label>
                                        <input type="number" id="name" class="form-control" name="name" placeholder="<?php echo e(trans('placeholder.quantity_pur')); ?>" value="<?php echo e(old('name')); ?>">
                                         <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><span class="text-danger"><?php echo e($message); ?></span><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                     </div>
                                     <div class="col-2">
                                        <label for="name"><?php echo e(trans('labels.price_sup')); ?></label>
                                        <input type="number" id="name" class="form-control" name="name" placeholder="<?php echo e(trans('placeholder.total_price_pur')); ?>" value="<?php echo e(old('name')); ?>">
                                         <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><span class="text-danger"><?php echo e($message); ?></span><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                     </div>
                                     <div class="col-2">
                                        <label for="name"><?php echo e(trans('labels.description')); ?></label>
                                        <textarea type="text" id="name" class="form-control" name="name" placeholder="<?php echo e(trans('placeholder.description_pur')); ?>" value="<?php echo e(old('name')); ?>"> </textarea>
                                         <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><span class="text-danger"><?php echo e($message); ?></span><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                     </div>
                                </div>
                                <div class="form-row"  id="myDIV">
                                    <div class="col-2">
                                      <label for="name"><?php echo e(trans('labels.supplier_name')); ?></label>
                                      <select class="form-control" name="cat_id" id="cat_id">
                                        <option selected>Choose...</option>
                                        
                                      </select>
                                      <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><span class="text-danger"><?php echo e($message); ?></span><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                    </div>
                                    <div class="col-2">
                                        <label for="name"><?php echo e(trans('labels.product_name')); ?></label>
                                        <select class="form-control" name="cat_id" id="cat_id">
                                          <option selected>Choose...</option>
                                          
                                        </select>
                                        <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><span class="text-danger"><?php echo e($message); ?></span><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                     </div>
                                     <div class="col-2">
                                        <label for="name"><?php echo e(trans('labels.price')); ?></label>
                                        <input type="number" id="name" class="form-control" name="name" placeholder="<?php echo e(trans('placeholder.price_pur')); ?>" value="<?php echo e(old('name')); ?>">
                                         <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><span class="text-danger"><?php echo e($message); ?></span><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                     </div>
                                     <div class="col-2">
                                        <label for="name"><?php echo e(trans('labels.quantity_sup')); ?></label>
                                        <input type="number" id="name" class="form-control" name="name" placeholder="<?php echo e(trans('placeholder.quantity_pur')); ?>" value="<?php echo e(old('name')); ?>">
                                         <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><span class="text-danger"><?php echo e($message); ?></span><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                     </div>
                                     <div class="col-2">
                                        <label for="name"><?php echo e(trans('labels.price_sup')); ?></label>
                                        <input type="number" id="name" class="form-control" name="name" placeholder="<?php echo e(trans('placeholder.total_price_pur')); ?>" value="<?php echo e(old('name')); ?>">
                                         <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><span class="text-danger"><?php echo e($message); ?></span><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                     </div>
                                     <div class="col-2">
                                        <label for="name"><?php echo e(trans('labels.description')); ?></label>
                                        <textarea type="text" id="name" class="form-control" name="name" placeholder="<?php echo e(trans('placeholder.description_pur')); ?>" value="<?php echo e(old('name')); ?>"> </textarea>
                                         <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><span class="text-danger"><?php echo e($message); ?></span><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                     </div>
                                </div>
                                <div class="col-2">
                                    <button onclick="myFunction()">Add More</button>
                                 </div>
                                    

                                        
                                    <div class="form-actions center">
                                        <a href="<?php echo e(route('admin.supplier')); ?>" class="btn btn-raised btn-warning mr-1"><i class="ft-x"></i> <?php echo e(trans('labels.cancel')); ?></a>
                                        <?php if(env('Environment') == 'sendbox'): ?>
                                            <button type="button" class="btn btn-raised btn-primary" onclick="myFunction()"> <i class="fa fa-check-square-o"></i> <?php echo e(trans('labels.save')); ?></button>
                                        <?php else: ?>
                                            <button type="submit" id="btn_add_category" class="btn btn-raised btn-primary"> <i class="fa fa-check-square-o"></i> <?php echo e(trans('labels.save')); ?></button>
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

<?php $__env->startSection('script'); ?>
<script type="text/javascript">
function myFunction() {
  var x = document.getElementById("myDIV");
  if (x.style.display === "none") {
    x.style.display = "block";
  } else {
    x.style.display = "none";
  }
}
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\eglobalmart\resources\views/Admin/product_purchase/create.blade.php ENDPATH**/ ?>