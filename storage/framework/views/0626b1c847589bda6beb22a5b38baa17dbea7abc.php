<?php $__env->startSection('title'); ?>
    <?php echo e(Helper::webinfo()->site_title); ?> | <?php echo e(trans('labels.vendors')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('css'); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <div class="content-wrapper">
        <section id="configuration">
            <div class="row">
                <?php if($errors->any()): ?>
    <div class="alert alert-danger">
        <ul>
            <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <li><?php echo e($error); ?></li>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </ul>
    </div>
<?php endif; ?>
                <div class="col-12">
                    <?php if(Session::has('success')): ?>
                        <div class="alert alert-success">
                            <?php echo e(Session::get('success')); ?>

                            <?php
                                Session::forget('success');
                            ?>
                        </div>
                    <?php endif; ?>
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title"><?php echo e(trans('labels.vendors')); ?></h4>
                            <a href="<?php echo e(route('admin.vendors.add')); ?>"
                                class="btn btn-raised btn-primary btn-min-width mr-1 mb-1 float-right"
                                style="margin-top: -30px;">
                                <?php echo e(trans('labels.add_vendor')); ?>

                            </a>
                        </div>


                        <div class="card-body collapse show">
                            <div class="card-block card-dashboard" id="table-display">
                                <?php echo $__env->make('Admin.vendors.vendorstable', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            

          <div class="modal" id="passModal" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content mt-5">
                    <div class="modal-header">
                        <h5 class="modal-title">Change password </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form  method="post" action="<?php echo e(route('admin.vendors.passChange')); ?>">
                        <?php echo csrf_field(); ?>
                    <div class="modal-body">


                            <div class="row">
                                <div class="col-md-6">
                                    <label for="comment" class="col-form-label">New Password </label>
                                    <input type="hidden" id="userId" name="user_id" value="">
                                    <input required class="form-control" type="text" name="new_pass" value="">
                                </div>
                                <div class="col-md-6">
                                    <label for="comment" class="col-form-label">Confirm Password </label>
                                    <input required class="form-control" type="text" name="confirm_pass" value="">
                                </div>

                                <button type="submit" class="btn btn-success mt-5 ml-3">save</button>
                            </div>
                        </div>
                    </form>
            </div>
        </div>
        </section>
    </div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('scripttop'); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('script'); ?>
    <script type="text/javascript">
        //Change Status

        function chanPass(e,id){
            $('#passModal').modal('show');
            $('#userId').val(id);
            $('.modal-backdrop').remove();

        }

        function AssignStockiest(e) {
            // console.log(e.value)
            let user_id = e.getAttribute('data-id')
            let stockiest_id = e.value;
            console.log(user_id, stockiest_id)

            Swal.fire({
                title: '<?php echo e(trans('labels.are_you_sure')); ?>',
                text: "Assign a vendor",
                type: 'error',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: '<?php echo e(trans('labels.yes')); ?>',
                cancelButtonText: '<?php echo e(trans('labels.no')); ?>'
            }).then((t) => {
                if (t.value == true) {
                    $('#preloader').show();

                    $.ajax({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        url: '<?php echo e(route('admin.assign.vandor')); ?>',
                        type: "POST",
                        data: {
                            'stockiest_id': stockiest_id,
                            'user_id': user_id,

                        },
                        success: function(data) {
                            $('#preloader').hide();
                            location.reload()
                            if (data == 1000) {
                                Swal.fire({
                                    type: 'success',
                                    title: '<?php echo e(trans('labels.success')); ?>',
                                    showConfirmButton: false,
                                    timer: 1500
                                });
                                if (status == '1') {
                                    $('#tdstatus' + id).html(
                                        '<span class="btn btn-raised btn-outline-success round btn-min-width mr-1 mb-1 changeStatus" data-status="2"  data-id="' +
                                        id + '"><?php echo e(trans('labels.active')); ?></span>');
                                } else {
                                    $('#tdstatus' + id).html(
                                        '<span class="btn btn-raised btn-outline-danger round btn-min-width mr-1 mb-1 changeStatus" data-status="1"  data-id="' +
                                        id + '"><?php echo e(trans('labels.deactive')); ?></span>');
                                }
                            } else {
                                Swal.fire({
                                    type: 'error',
                                    title: '<?php echo e(trans('labels.cancelled')); ?>',
                                    showConfirmButton: false,
                                    timer: 1500
                                });
                            }

                        },
                        error: function(data) {
                            $('#preloader').hide();
                            console.log("AJAX error in request: " + JSON.stringify(data, null, 2));
                        }
                    });
                } else {
                    Swal.fire({
                        type: 'error',
                        title: '<?php echo e(trans('labels.cancelled')); ?>',
                        showConfirmButton: false,
                        timer: 1500
                    });

                }
            });
        }
        $('body').on('click', '.changeStatus', function() {
            // alert('kkkk')
            // return;
            let status = $(this).attr('data-status');
            let id = $(this).attr('data-id');
            let stockiest_id = $(this).attr('data-stockiest-id');
            if (stockiest_id != '') {
                Swal.fire({
                title: '<?php echo e(trans('labels.are_you_sure')); ?>',
                text: "<?php echo e(trans('labels.change_status')); ?>",
                type: 'success',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: '<?php echo e(trans('labels.yes')); ?>',
                cancelButtonText: '<?php echo e(trans('labels.no')); ?>'
            }).then((t) => {
                if (t.value == true) {
                    $('#preloader').show();
                    $.ajax({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        url: '<?php echo e(route('admin.vendors.changeStatus')); ?>',
                        type: "POST",
                        data: {
                            'id': id,
                            'status': status
                        },
                        success: function(data) {
                            $('#preloader').hide();
                            if (data == 1000) {
                                Swal.fire({
                                    type: 'success',
                                    title: '<?php echo e(trans('labels.success')); ?>',
                                    showConfirmButton: false,
                                    timer: 1500
                                });
                                if (status == '1') {
                                    $('#tdstatus' + id).html(
                                        '<span class="btn btn-raised btn-outline-success round btn-min-width mr-1 mb-1 changeStatus" data-status="2"  data-id="' +
                                        id + '"><?php echo e(trans('labels.active')); ?></span>');
                                } else {
                                    $('#tdstatus' + id).html(
                                        '<span class="btn btn-raised btn-outline-danger round btn-min-width mr-1 mb-1 changeStatus" data-status="1"  data-id="' +
                                        id + '"><?php echo e(trans('labels.deactive')); ?></span>');
                                }
                            } else {
                                Swal.fire({
                                    type: 'error',
                                    title: '<?php echo e(trans('labels.cancelled')); ?>',
                                    showConfirmButton: false,
                                    timer: 1500
                                });
                            }

                        },
                        error: function(data) {
                            $('#preloader').hide();
                            console.log("AJAX error in request: " + JSON.stringify(data, null,
                                2));
                        }
                    });
                } else {
                    Swal.fire({
                        type: 'error',
                        title: '<?php echo e(trans('labels.cancelled')); ?>',
                        showConfirmButton: false,
                        timer: 1500
                    });

                }
            });
            } else {
                Swal.fire({
                title: 'Sorry',
                text: "Please Select Before Stockiest",
                type: 'error',
                showCancelButton: false,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',

            })
            }


        });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\eglobalmart\resources\views/Admin/vendors/index.blade.php ENDPATH**/ ?>