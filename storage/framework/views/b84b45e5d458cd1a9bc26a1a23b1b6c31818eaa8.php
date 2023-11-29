<?php $__env->startSection('title'); ?>
    <?php echo e(Helper::webinfo()->site_title); ?> | <?php echo e(trans('labels.orders')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('css'); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <div class="content-wrapper">
        <?php if(Session::has('success')): ?>
            <div class="alert alert-success">
                <?php echo e(Session::get('success')); ?>

                <?php
                    Session::forget('success');
                ?>
            </div>
        <?php endif; ?>

        <?php if(Session::has('danger')): ?>
            <div class="alert alert-danger">
                <?php echo e(Session::get('danger')); ?>

                <?php
                    Session::forget('danger');
                ?>
            </div>
        <?php endif; ?>
        <section id="configuration">
            <div class="row">
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
                            <h4 class="card-title"><?php echo e(trans('labels.orders')); ?></h4>
                        </div>
                        <?php if(session('message')): ?>
                        <p class="alert alert-danger "><?php echo e(session('message')); ?></p>
                       <?php endif; ?>
                        <div class="card-body collapse show">

                            <div class="card-block card-dashboard" id="table-display">
                                <form method="post" action="<?php echo e(route('admin.orders.orderByDate')); ?>">
                                    <?php echo csrf_field(); ?>
                                    <div class="row py-2">
                                        <div class="col-md-9">
                                            <div class="row">
                                                <div class="col-md-3">
                                                    <label class="">From Date</label>
                                                    <input type="date" name="from_date" class="form-control" value="<?php echo e(old('from_date')); ?>"
                                                        placeholder="From Date...">
                                                </div>
                                                <div class="col-md-3">
                                                    <label class="">To Date</label>
                                                    <input type="date" name="to_date" class="form-control" value="<?php echo e(old('to_date')); ?>"
                                                        placeholder="To Date...">
                                                </div>
                                                <div class="col-md-3 mt-4">
                                                    <button type="submit" class="btn btn-success">Search</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                                <?php echo $__env->make('Admin.orders.ordersstable', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal" id="addCommentModal" tabindex="-1" role="dialog">
                <div class="modal-dialog" role="document">
                    <div class="modal-content mt-5">
                        <div class="modal-header">
                            <h5 class="modal-title">Add Comment</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <textarea required class="form-control" id="comment" name="comment" rows="3" cols="5"></textarea>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-primary" onclick="save()">Save</button>
                            <button type="button" class="btn btn-secondary"
                                data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('script'); ?>
    <script type="text/javascript">
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        let comment = '';
        let status = '';
        let id = '';
        let price = '';
        let admin_price = '';
        let qty = '';
        let vendor_price = '';
        //Change Status
        $('body').on('click', '.changeStatus', function() {

            $('#addCommentModal').modal('show');
            $('.modal-backdrop').remove()
            status = $(this).attr('data-status');
            id = $(this).attr('data-id');

        });


        function save() {
            // alert('ooo');
            comment = $('#comment').val();
            // console.log('check co',comment,status,id)
            // return;
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
                        url: '<?php echo e(route('admin.orders.return')); ?>',
                        type: "POST",
                        data: {
                            'order_number': id,
                            'status': status,
                            'comment': comment
                        },
                        success: function(data) {
                            $('#preloader').hide();
                            location.reload();
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
        }

     
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\eglobalmart\resources\views/Admin/orders/index.blade.php ENDPATH**/ ?>