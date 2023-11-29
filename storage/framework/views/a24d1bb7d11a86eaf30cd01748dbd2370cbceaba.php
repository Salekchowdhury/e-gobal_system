<?php $__env->startSection('title'); ?>
    <?php echo e(Helper::webinfo()->site_title); ?> | <?php echo e(trans('labels.bank')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('css'); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <div class="content-wrapper">

        <section class="vh-100" style="background-color: #acb5c5;">
            <div class="container py-3 h-100">
                <div class="row d-flex justify-content-center align-items-center h-100">
                    <div class="col-12">
                        <h3>Add Bank</h3>
                        <div class="card shadow-2-strong" style="border-radius: 1rem;">
                            <div class="card-body p-5 text-center">
                                <div class="form-outline mb-4">
                                    <?php if(session('message')): ?>
                                        <p class="alert alert-danger "><?php echo e(session('message')); ?></p>
                                    <?php elseif(session('successMessage')): ?>
                                        <p class="alert alert-success"><?php echo e(session('successMessage')); ?></p>
                                    <?php endif; ?>
                                </div>

                                <form action="<?php echo e(route('admin.bank_list.store')); ?>" method="post">
                                    <?php echo csrf_field(); ?>
                                    <div class="row">
                                        <div class="py-1 col-10">
                                            
                                            <input type="text" id="" required
                                                name="name" placeholder="Bank Name..."
                                                class="form-control form-control-lg" />
                                        </div>
                                        <div class="col-2 mt-2">
                                            <button type="submit" class="btn btn-primary mb-4">Save</button>
                                        </div>
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
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\eglobalmart\resources\views/Admin/bank/create.blade.php ENDPATH**/ ?>