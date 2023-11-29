<?php $__env->startSection('title'); ?>
    <?php echo e(Helper::webinfo()->site_title); ?> | <?php echo e(trans('labels.distributet_fund')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('css'); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <div class="content-wrapper">
        <section id="basic-form-layouts">
            <div class="row">
                <div class="col-sm-12">
                    <div class="content-header"><?php echo e(trans('labels.distributet_fund')); ?></div>
                </div>
            </div>

            <div class="row justify-content-md-center">
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">
                            <strong class="py-2">Total Amount = <span id="total_distribute"></span></strong><br>
                            <strong class="text-danger d-none" id="over-amount">Sorry!.Can not add more than <?php echo e(Helper::webinfo()->distribute_amount); ?> Taka</strong>
                        </div>
                        <div class="card-body">

                            <div class="px-3">
                                <?php if(Session::has('message')): ?>
                                    <div class="alert alert-success">
                                        <?php echo e(Session::get('message')); ?>

                                        <?php
                                            Session::forget('message');
                                        ?>
                                    </div>
                                <?php endif; ?>
                                 <?php if(Session::has('wrong')): ?>
                                    <div class="alert alert-danger">
                                        <?php echo e(Session::get('wrong')); ?>

                                        <?php
                                            Session::forget('wrong');
                                        ?>
                                    </div>
                                <?php endif; ?>

                                <form class="form" method="post" action="<?php echo e(route('admin.distributetfound.store')); ?>"
                                    enctype="multipart/form-data">
                                    <?php echo csrf_field(); ?>
                                    <div class="form-body">
                                        <?php $__currentLoopData = $datas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            

                                            <div class="form-group">
                                                <label><?php echo e($data->title); ?></label>
                                                <input type="text" required oninput="distributetfound(this)"
                                                    class="form-control distribute-amount" name="<?php echo e($data->title_key); ?>"
                                                    id=""
                                                    
                                                    value="<?php echo e($data->amount); ?>"
                                                     </div>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                       <input type="hidden" id="distribute_amount" value="<?php echo e(Helper::webinfo()->distribute_amount); ?>">
                                       <input type="hidden" id="total_amount" name="total_amount" value="">
                                    </div>

                                    <div class="form-actions left">

                                        <button id="save-btn" type="submit" class="btn  btn-primary"> Save</button>
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

$(document).ready(function () {
            distributetfound();
        });



        function checkRefer(e) {
            // alert('ffff');
            // console.log(e.value)
            var code = e.value;
            $.ajax({
                url: "<?php echo e(route('admin.vendors.checkRefer')); ?>",
                method: 'GET',
                data: {
                    'code': code,
                },
                success: function(data) {
                    if (data.status == 200) {
                        $('#refer-msg').html('Refer code is matched')
                        $('#refer-msg').addClass('text-success')
                        $('#refer-msg').removeClass('text-danger')
                        $('#save-btn').prop("disabled", false);

                    } else {
                        $('#refer-msg').html('Refer code is wrong')
                        $('#refer-msg').removeClass('text-success')
                        $('#refer-msg').addClass('text-danger')
                        $('#save-btn').prop("disabled", true);

                    }

                }
            });
        }

        function distributetfound() {
            var numItems = 0;
             let distributeAmount = $('#distribute_amount').val();
            $(".distribute-amount").each((key, element) => {
                numItems += Number($(element).val());
                if(distributeAmount < numItems){
                     $('#over-amount').removeClass('d-none')
                }else{
                    $('#over-amount').addClass('d-none')
                }
            });
            $("#total_distribute").text(numItems)
            $("#total_amount").val(numItems)
        }

</script>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\eglobalmart\resources\views/Admin/fund_distribution/index.blade.php ENDPATH**/ ?>