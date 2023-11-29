<?php $__env->startSection('title'); ?>
    <?php echo e(Helper::webinfo()->site_title); ?> | <?php echo e(trans('labels.withdraw_balance')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('css'); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <div class="content-wrapper">

        <section class="vh-100" style="background-color: #acb5c5;">
            <div class="container py-5 h-100">
                <div class="row d-flex justify-content-center align-items-center h-100">
                    <div class="col-12">
                        <div class="card shadow-2-strong" style="border-radius: 1rem;">
                            <div class="card-body p-5 text-center">
                                <div class="form-outline mb-4">
                                    <?php if(session('message')): ?>
                                        <p class="alert alert-danger "><?php echo e(session('message')); ?></p>
                                    <?php elseif(session('successMessage')): ?>
                                        <p class="alert alert-success"><?php echo e(session('successMessage')); ?></p>
                                    <?php endif; ?>
                                </div>

                                <div class="col-lg-12 mb-lg-0 mb-5 my-3">
                                    <div class="text-center">
                                        <ul class="nav nav-tabs" role="tablist">
                                            <li class="nav-item active">
                                                <a class="nav-link" style="font-size: 16px" data-toggle="tab"
                                                    href="#mobile-bank">Mobile Bank</a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" style="font-size: 16px" data-toggle="tab"
                                                    href="#bank">Bank</a>
                                            </li>

                                        </ul>
                                    </div>
                                </div>

                                <div class="tab-content" style="">
                                    <div id="mobile-bank" class="container tab-pane active">

                                        <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12 mt-3">
                                            <!-- BEGIN SAMPLE FORM PORTLET-->
                                            <form action="<?php echo e(route('admin.withdraw.store')); ?>" method="POST">
                                                <?php echo csrf_field(); ?>
                                                <div class="row">
                                                   <div class="col-6 py-1">
                                                    <div class="form-outline">
                                                        
                                                        <input type="number" id="" readonly value="<?php echo e($amount->wallet); ?>" placeholder="Amount..." name="amount"
                                                            class="form-control form-control-lg" />
                                                    </div>
                                                   </div>
                                                   <div class="col-6 py-1">
                                                        
                                                        <select id="payment-option" required class="form-control form-control-lg" name="payment_type">
                                                         <option value="">Select Payment Option </option>
                                                         <option value="Bkash">Bkash</option>
                                                         <option value="Nagad">Nagad</option>
                                                         <option value="Rocket">Rocket</option>

                                                        </select>
                                                   </div>

                                                <div class="py-1 col-6">
                                                    
                                                    <input type="number"  id="mobile"  name="mobile_number"
                                                        placeholder="Mobile Number..." class="mobile-require form-control form-control-lg" />
                                                </div>

                                                <div class="py-1 col-6">
                                                    
                                                    <input type="password" id="" required name="password"
                                                        placeholder="Password..." class="form-control form-control-lg" />
                                                </div>

                                                </div>
                                                <div class="float-right col-2 mt-3">
                                                    <button type="submit" class="btn btn-primary btn-block mb-4">Withdraw</button>
                                                </div>

                                            </form>

                                        </div>

                                    </div>
                                    <div id="bank" class="container tab-pane">

                                        <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12 mt-3">
                                            <form action="<?php echo e(route('admin.withdraw.store')); ?>" method="POST">
                                                <?php echo csrf_field(); ?>
                                                <div class="row">
                                                   <div class="col-6 py-1">
                                                    <div class="form-outline">
                                                        
                                                        <input type="number" id="" readonly value="<?php echo e($amount->wallet); ?>" placeholder="Amount..." name="amount"
                                                            class="form-control form-control-lg" />
                                                    </div>
                                                   </div>
                                                   <div class="col-6 py-1">
                                                        
                                                        <select id="payment-option" required class="form-control form-control-lg" name="payment_type">
                                                        <option value="Bank">Bank</option>
                                                        </select>
                                                   </div>


                                                <div class="py-1 col-6 ">
                                                    
                                                    <input type="text" id="" name="account_name"
                                                        placeholder="A/C Name..." required class="bank-require form-control form-control-lg" />
                                                </div>
                                                <div class="py-1 col-6 ">
                                                    
                                                    <input type="number" id="" name="account_number"
                                                        placeholder="Account Number" required class="form-control form-control-lg" />
                                                </div>
                                                <div class="py-1 col-6">
                                                    
                                                    <select  class=" form-control form-control-lg" required name="bank_list_id">
                                                        <option value="">Select Bank Name</option>
                                                        <?php $__currentLoopData = $banks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $bank): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                          <option class="text-uppercase" value="<?php echo e($bank->id); ?>"><?php echo e($bank->name); ?></option>
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                       </select>
                                                </div>
                                                <div class="py-1 col-6">
                                                    
                                                    <input type="text" id="" required name="branch_name"
                                                        placeholder="Branch Name..." class="bank-require form-control form-control-lg" />
                                                </div>
                                                <div class="py-1 col-6">
                                                    
                                                    <input type="text" id="" required name="city"
                                                        placeholder="City..." class="bank-require form-control form-control-lg" />
                                                </div>

                                                <div class="py-1 col-6">
                                                    
                                                    <input type="number" id=""  name="routin_number"
                                                        placeholder="Routin Number..." class="bank-require form-control form-control-lg" />
                                                </div>
                                                <div class="py-1 col-6">
                                                    
                                                    <input type="password" id="" required name="password"
                                                        placeholder="Password..." class="form-control form-control-lg" />
                                                </div>

                                                </div>
                                                <div class="float-right col-2 mt-3">
                                                    <button type="submit" class="btn btn-primary btn-block mb-4">Withdraw</button>
                                                </div>

                                            </form>
                                        </div>

                                    </div>
                                </div>

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
<script>
$(function(){
    // alert('ooo');
    $('.bank').addClass('d-none');
    $('#payment-option').on('change',function(){
        console.log($(this).val());
        let payment_option = $(this).val();
        if(payment_option == 'Bank'){
            $('.mobile').addClass('d-none');
            $('.bank').removeClass('d-none');
            // $('.bank-require').attr("required",'true');
            // $('.mobile-require').attr("required",'false');


        }else{
            $('#element1_id').attr('placeholder','Some New Text 1');
            $('#mobile').attr('placeholder','Enter '+payment_option+ ' Number')
            $('.mobile').removeClass('d-none');
            $('.bank').addClass('d-none');
            // $('.bank-require').attr("required",'false');
            // $('.mobile-require').attr("required",'true');
        }
    })
 });
</script>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\eglobalmart\resources\views/Admin/withdraw/create.blade.php ENDPATH**/ ?>