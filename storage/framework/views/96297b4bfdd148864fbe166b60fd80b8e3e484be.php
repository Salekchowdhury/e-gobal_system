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
                    <div class="content-header"><?php echo e(trans('labels.profile')); ?></div>
                </div>
            </div>

            <div class="row justify-content-md-center">
                <div class="col-md-12">
                    <div class="card px-3">
                        <div class="card-header">

                                <?php if(session('message')): ?>
                                <p class="alert alert-success "><?php echo e((session('message'))); ?></p>
                                <?php endif; ?>


                            <?php if($errors->any()): ?>
                                <div class="alert alert-danger">
                                    <ul>
                                        <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <li><?php echo e($error); ?></li>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </ul>
                                </div>
                            <?php endif; ?>
                        </div>
                        <div class="card-body">

                            <div class="form-body">
                                <h4 class="form-section"><i class="ft-user"></i> Personal Info</h4>
                                <form method="post" action="<?php echo e(route('admin.update.profile')); ?>"
                                    enctype="multipart/form-data">
                                    <?php echo csrf_field(); ?>
                                    <div class="row">

                                        <div class="form-group col-md-6">
                                            <label class="col-md-6 label-control" for="firebase_key">Name</label>
                                            <div class="col-md-9">
                                                <input type="text" name="name" required class="form-control"
                                                    placeholder="Name" value="<?php echo e($profile->name); ?>">
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

                                        <div class="form-group col-md-6">
                                            <label class="col-md-3 label-control" for="currency">Email</label>
                                            <div class="col-md-9">
                                                <input type="email" name="email" readonly required class="form-control"
                                                    placeholder="Email" value="<?php echo e($profile->email); ?>">
                                                <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><span class="text-danger"><?php echo e($message); ?></span>
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label class="col-md-6 label-control" for="currency">Phone</label>
                                                <div class="col-md-9">
                                                    <input type="number" readonly required name="mobile" class="form-control"
                                                        placeholder="Phone" value="<?php echo e($profile->mobile); ?>">
                                                    <?php $__errorArgs = ['phone'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><span class="text-danger"><?php echo e($message); ?></span>
                                                        <?php endif; ?>
                                                    </div>
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label class="col-md-6 label-control" for="currency">Gender</label>
                                                    <div class="col-md-9">
                                                        <select class="form-control" name="gender">
                                                            <option value="">Select Gender</option>
                                                            <?php if(!empty($profile->userInformation)): ?>
                                                            <option value="male" <?php echo e($profile->userInformation->gender == "male"? "selected" : ''); ?>>Male</option>
                                                            <option value="female" <?php echo e($profile->userInformation->gender == 'female'? "selected" : ''); ?>>Female</option>
                                                            <?php else: ?>
                                                            <option value="male">Male</option>
                                                            <option value="female">Female</option>
                                                            <?php endif; ?>

                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label class="col-md-6 label-control" for="firebase_key">Father's Name</label>
                                                    <div class="col-md-9">
                                                        <input type="text" required name="father_name" class="form-control"
                                                            placeholder="Father's Name" value="<?php echo e($profile->userInformation?$profile->userInformation->father_name : ""); ?>">
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
                                                <div class="form-group col-md-6">
                                                    <label class="col-md-6 label-control" for="">Mother's Name</label>
                                                    <div class="col-md-9">
                                                        <input type="text"  required name="mother_name" class="form-control"
                                                            placeholder="Mother's Name" value="<?php echo e($profile->userInformation?$profile->userInformation->mother_name : ""); ?>">
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
                                                <div class="form-group col-md-6">
                                                    <label class="col-md-6 label-control" for="currency">Guardian Phone
                                                        Number</label>
                                                    <div class="col-md-9">
                                                        <input type="number" name="guardian_number" class="form-control"
                                                            placeholder="Guardian Phone Number" value="<?php echo e($profile->userInformation?$profile->userInformation->guardian_number : ""); ?>">
                                                        <?php $__errorArgs = ['phone'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><span class="text-danger"><?php echo e($message); ?></span>
                                                            <?php endif; ?>
                                                        </div>
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <label class="col-md-6 label-control" for="currency">NID</label>
                                                        <div class="col-md-9">
                                                            <input type="number" name="nid" minlength="10" class="form-control"
                                                                placeholder="NID" value="<?php echo e($profile->userInformation?$profile->userInformation->nid: ''); ?>">
                                                            <?php $__errorArgs = ['nid'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><span class="text-danger"><?php echo e($message); ?></span>
                                                                <?php endif; ?>
                                                            </div>
                                                        </div>
                                                        <div class="form-group col-md-6">
                                                            <label class="col-md-6 label-control" for="currency">Permanent Address</label>
                                                            <div class="col-md-9">
                                                                <textarea rows="5" cols="5" type="text" required name="permanent_address" class="form-control"
                                                                    placeholder="Permanent Address" value="<?php echo e($profile->userInformation?$profile->userInformation->permanent_address : ''); ?>"><?php echo e($profile->userInformation?$profile->userInformation->permanent_address : ''); ?></textarea>
                                                                <?php $__errorArgs = ['permanent_address'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><span
                                                                        class="text-danger"><?php echo e($message); ?></span><?php endif; ?>
                                                                </div>
                                                            </div>
                                                            <div class="form-group col-md-6">
                                                                <label class="col-md-6 label-control" for="">Current Address</label>
                                                                <div class="col-md-9">
                                                                    <textarea rows="5" cols="5" type="text" required name="current_address" class="form-control"
                                                                        placeholder="Current address" value="<?php echo e($profile->userInformation?$profile->userInformation->current_address : ''); ?>"><?php echo e($profile->userInformation?$profile->userInformation->current_address : ''); ?></textarea>
                                                                    <?php $__errorArgs = ['current_address'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><span
                                                                            class="text-danger"><?php echo e($message); ?></span><?php endif; ?>
                                                                    </div>
                                                                </div>

                                                                <div class="form-group col-md-6">
                                                                    <label class="col-md-3 label-control" for="">image</label>
                                                                    <div class="col-md-9">
                                                                        <input type="file" name="profile_pic" class="form-control"
                                                                            value="">

                                                                    </div>
                                                                    <div>
                                                                        
                                                                        <?php if(!empty($profile->profile_pic)): ?>
                                                                        <img width="200" height="200" src="<?php echo e(asset('storage/app/public/images/profile/'.$profile->profile_pic)); ?>">
                                                                        <?php endif; ?>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <button type="submit" class="btn btn-success">Update</button>

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


                                function vendorPhone(e) {
                                    // alert(e.value);
                                    var userId = e.value;

                                    $.ajax({
                                        url: "<?php echo e(route('admin.sales.show.user')); ?>",
                                        method: 'GET',
                                        data: {
                                            'user_id': userId
                                        },
                                        success: function(data) {
                                            console.log('idNumber s', data);
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

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\eglobalmart\resources\views/Admin/profile/profile.blade.php ENDPATH**/ ?>