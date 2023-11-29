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
        <div class="row">
            <div class="col-md-12">
                <h4><?php echo e(trans('labels.return_order')); ?> # <?php echo e($order_info->return_number); ?></h4>
            </div>
        </div>
        <section class="invoice-template">
            <div class="card">
                <div class="card-body p-3">
                    <div id="invoice-template" class="card-block">
                        <!-- Invoice Company Details -->
                        <div id="invoice-company-details" class="row">
                            <div class="col-6 text-left">
                                <img src="<?php echo e($order_info['vendors']->image_url); ?>" alt="company logo" class="mb-2" width="70">
                                <ul class="px-0 list-unstyled">
                                    <li><?php echo e($order_info['vendors']->store_address); ?></li>
                                </ul>
                            </div>
                            <div class="col-6 text-right">
                                <h2><?php echo e(trans('labels.invoice')); ?></h2>
                                <p class="pb-3"><a href="<?php echo e(URL::to('admin/orders/order-details/'.$order_info->order_number)); ?>"> # <?php echo e($order_info->order_number); ?> </a></p>
                            </div>
                        </div>
                        <!--/ Invoice Company Details -->
                        <!-- Invoice Customer Details -->
                        <div id="invoice-customer-details" class="row pt-2">
                            <div class="col-sm-12 text-left">
                                <p class="text-muted"><?php echo e(trans('labels.bill_to')); ?></p>
                            </div>
                            <div class="col-6 text-left">
                                <ul class="px-0 list-unstyled">
                                    <li class="text-bold-800"><?php echo e($order_info->full_name); ?></li>
                                    <li class="text-bold-800"><?php echo e($order_info->email); ?></li>
                                    <li class="text-bold-800"><?php echo e($order_info->mobile); ?></li>
                                    <li><?php echo e($order_info->street_address); ?>,</li>
                                    <li><?php echo e($order_info->landmark); ?>,</li>
                                    <li><?php echo e($order_info->pincode); ?>.</li>
                                </ul>
                            </div>
                            <div class="col-6 text-right">
                                <p><span class="text-muted"><?php echo e(trans('labels.invoice_date')); ?> :</span> <?php echo e($order_info->date); ?></p>
                                <p><span class="text-muted"><?php echo e(trans('labels.return_reason')); ?> :</span> <?php echo e($order_info->return_reason); ?></p>
                                <?php if($order_info->comment != ""): ?>
                                <p><span class="text-muted"><?php echo e(trans('labels.comment')); ?> :</span> <?php echo e($order_info->comment); ?></p>
                                <?php endif; ?>
                                <div class="btn-group">
                                    <?php if(Auth::user()->type == 3): ?>
                                        <?php if($order_info->status != 9 && $order_info->status != 10): ?>
                                        <a class="btn dropdown-toggle" data-toggle="dropdown" href="#">
                                            <?php if($order_info->status == 7): ?>
                                                <?php echo e(trans('labels.accept')); ?> <span class="caret"></span>
                                            <?php endif; ?>
                                            <?php if($order_info->status == 8): ?>
                                                <?php echo e(trans('labels.in_process')); ?> <span class="caret"></span>
                                            <?php endif; ?>
                                            <?php if($order_info->status == 10): ?>
                                                <?php echo e(trans('labels.reject')); ?> <span class="caret"></span>
                                            <?php endif; ?>

                                        </a>
                                        <ul class="dropdown-menu">
                                            <?php if($order_info->status == 7): ?>
                                                <button class="dropdown-item changeStatus active" data-id="<?php echo e($order_info->id); ?>"  data-status="7"><?php echo e(trans('labels.accept')); ?></button>
                                                <button class="dropdown-item changeStatus" data-id="<?php echo e($order_info->id); ?>"  data-status="8"><?php echo e(trans('labels.in_process')); ?></button>
                                                <button class="dropdown-item changeStatus"  data-id="<?php echo e($order_info->id); ?>" data-status="9"><?php echo e(trans('labels.completed')); ?></button>
                                                <button class="dropdown-item reject" data-order-id="<?php echo e($order_info->id); ?>" data-status="10"><?php echo e(trans('labels.reject')); ?></button>
                                            <?php endif; ?>
                                            <?php if($order_info->status == 8): ?>
                                                <button class="dropdown-item changeStatus" data-id="<?php echo e($order_info->id); ?>"  data-status="7"><?php echo e(trans('labels.accept')); ?></button>
                                                <button class="dropdown-item changeStatus active" data-id="<?php echo e($order_info->id); ?>"  data-status="8"><?php echo e(trans('labels.in_process')); ?></button>
                                                <button class="dropdown-item changeStatus"  data-id="<?php echo e($order_info->id); ?>" data-status="9"><?php echo e(trans('labels.completed')); ?></button>
                                                <button class="dropdown-item reject" data-order-id="<?php echo e($order_info->id); ?>" data-status="10"><?php echo e(trans('labels.reject')); ?></button>
                                            <?php endif; ?>
                                        </ul>
                                        <?php endif; ?>
                                        <?php if($order_info->status == 9): ?>
                                            <button class="btn btn-raised btn-primary"><?php echo e(trans('labels.completed')); ?></button>
                                        <?php endif; ?>

                                        <?php if($order_info->status == 10): ?>
                                            <button class="btn btn-raised btn-primary"><?php echo e(trans('labels.reject')); ?></button>
                                        <?php endif; ?>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                        <!--/ Invoice Customer Details -->
                        <ul id="progressbar">
                            <?php if($order_info->status == 7): ?>
                                <li class="step0 text-left active" id="step1"><?php echo e(trans('labels.return_request')); ?> <br> <?php echo e($order_info->returned_at); ?></li>
                                <li class="step0 text-center" id="step2"><?php echo e(trans('labels.in_process')); ?></li>
                                <li class="step0 text-right" id="step3"><?php echo e(trans('labels.completed')); ?></li>
                            <?php endif; ?>
                            <?php if($order_info->status == 8): ?>
                                <li class="step0 text-left active" id="step1"><?php echo e(trans('labels.return_request')); ?> <br> <?php echo e($order_info->returned_at); ?></li>
                                <li class="step0 text-center active" id="step2"><?php echo e(trans('labels.in_process')); ?> <br> <?php echo e($order_info->accepted_at); ?></li>
                                <li class="step0 text-right" id="step3"><?php echo e(trans('labels.completed')); ?></li>
                            <?php endif; ?>
                            <?php if($order_info->status == 9): ?>
                                <li class="step0 text-left active" id="step1"><?php echo e(trans('labels.return_request')); ?> <br> <?php echo e($order_info->returned_at); ?></li>
                                <li class="step0 text-center active" id="step2"><?php echo e(trans('labels.in_process')); ?> <br> <?php echo e($order_info->accepted_at); ?></li>
                                <li class="step0 text-right active" id="step3"><?php echo e(trans('labels.completed')); ?> <br> <?php echo e($order_info->completed_at); ?></li>
                            <?php endif; ?>
                            <?php if($order_info->status == 10): ?>
                                <li class="step0 text-left active" id="step1"><?php echo e(trans('labels.return_request')); ?> <br> <?php echo e($order_info->returned_at); ?></li>
                                <li class="step0 text-center active" id="step2"><?php echo e(trans('labels.return_rejected')); ?> <br> <?php echo e($order_info->rejected_at); ?> <br> <?php echo e($order_info->vendor_comment); ?></li>
                                <li class="step0 text-right" id="step3"><?php echo e(trans('labels.completed')); ?></li>
                            <?php endif; ?>
                        </ul>
                        <!-- Invoice Items Details -->
                        <div id="invoice-items-details" class="pt-2">
                            <div class="row">

                                <div class="table-responsive col-sm-12">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th><?php echo e(trans('labels.image')); ?></th>
                                                <th><?php echo e(trans('labels.name')); ?></th>
                                                <th><?php echo e(trans('labels.price')); ?></th>
                                                <th><?php echo e(trans('labels.qty')); ?></th>
                                                <th><?php echo e(trans('labels.tax')); ?></th>
                                                <th><?php echo e(trans('labels.shipping_charge')); ?></th>
                                                <th><?php echo e(trans('labels.order_total')); ?></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $__currentLoopData = $order_data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                                            <?php if($row->discount_amount == ""): ?>
                                                <?php $grand_total = $row->subtotal+$row->tax+$row->shipping_cost; ?>
                                            <?php else: ?>
                                                <?php $grand_total = $row->subtotal+$row->tax+$row->shipping_cost-$row->discount_amount; ?>
                                            <?php endif; ?>
                                            <tr>
                                                <td><img class="media-object round-media height-50" src="<?php echo e($row->image_url); ?>" alt="Generic placeholder image" /></td>
                                                <td><?php echo e($row->product_name); ?> <?php if($row->variation != ""): ?>(<?php echo e($row->variation); ?>) <?php endif; ?></td>
                                                <td><?php echo e(Helper::CurrencyFormatter($row->price)); ?></td>
                                                <td><?php echo e($row->qty); ?></td>
                                                <td><?php echo e(Helper::CurrencyFormatter($row->tax)); ?></td>
                                                <td><?php echo e(Helper::CurrencyFormatter($row->shipping_cost)); ?></td>
                                                <td><?php echo e(Helper::CurrencyFormatter($row->order_total)); ?></td>
                                            </tr>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 col-sm-12 text-left">
                                    <p class="lead"><?php echo e(trans('labels.payment_methods')); ?></p>
                                    <div class="row">
                                        <div class="col-12">
                                            <table class="table table-borderless table-sm">
                                                <tbody>
                                                    <tr>
                                                        <!-- payment_type = COD : 1, Wallet : 2, RazorPay : 3, Stripe : 4, Flutterwave : 5 , Paystack : 6-->
                                                        <td>
                                                            <?php if($order_info->payment_type == 1): ?>
                                                                <?php echo e(trans('labels.cod')); ?>

                                                            <?php endif; ?>

                                                            <?php if($order_info->payment_type == 2): ?>
                                                                <?php echo e(trans('labels.wallet')); ?>

                                                            <?php endif; ?>

                                                            <?php if($order_info->payment_type == 3): ?>
                                                                <?php echo e(trans('labels.RazorPay')); ?>

                                                            <?php endif; ?>

                                                            <?php if($order_info->payment_type == 4): ?>
                                                                <?php echo e(trans('labels.Stripe')); ?>

                                                            <?php endif; ?>

                                                            <?php if($order_info->payment_type == 5): ?>
                                                                <?php echo e(trans('labels.Flutterwave')); ?>

                                                            <?php endif; ?>

                                                            <?php if($order_info->payment_type == 6): ?>
                                                                <?php echo e(trans('labels.Paystack')); ?>

                                                            <?php endif; ?>
                                                        </td>
                                                        <td class="text-right"><?php echo e($order_info->payment_id); ?></td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-12">
                                    <p class="lead"><?php echo e(trans('labels.Total_due')); ?></p>
                                    <div class="table-responsive">
                                        <table class="table">
                                            <tbody>

                                                 <tr>
                                                    <td><?php echo e(trans('labels.sub_total')); ?></td>
                                                    <td class="text-right"><?php echo e(Helper::CurrencyFormatter($order_info->subtotal)); ?></td>
                                                </tr>
                                                <tr>
                                                    <td><?php echo e(trans('labels.tax')); ?></td>
                                                    <td class="text-right"><?php echo e(Helper::CurrencyFormatter($order_info->tax)); ?></td>
                                                </tr>
                                                <tr>
                                                    <td><?php echo e(trans('labels.Shipping_charges')); ?></td>
                                                    <td class="text-right"><?php echo e(Helper::CurrencyFormatter($order_info->shipping_cost)); ?></td>
                                                </tr>
                                                <tr>
                                                    <td class="text-bold-800"><?php echo e(trans('labels.total')); ?></td>
                                                    <td class="text-bold-800 text-right"><?php echo e(Helper::CurrencyFormatter($order_info->grand_total)); ?></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Invoice Footer -->
                        <div id="invoice-footer mt-3">
                            <div class="row">
                                <div class="col-md-9 col-sm-12">
                                    <p>* After successful return of this item, amount will be credited to user wallet</p>
                                </div>
                            </div>
                        </div>
                        <!--/ Invoice Footer -->
                    </div>
                </div>
            </div>
        </section>
    </div>


<?php $__env->stopSection(); ?>
<?php $__env->startSection('scripttop'); ?>

<!-- Modal -->
<div id="RejectReturn" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title text-left"><?php echo e(trans('labels.write_reason')); ?></h4>
      </div>
      <div class="modal-body">
        <form>
          <div class="form-group">
            <input type="hidden" name="order_id" id="data-order-id">
            <input type="hidden" name="status" id="data-status">
            <label for="vendor_comment" class="col-form-label"><?php echo e(trans('labels.reason')); ?></label>
            <textarea class="form-control" id="vendor_comment" name="vendor_comment"></textarea>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal"><?php echo e(trans('labels.close')); ?></button>
        <button type="button" class="btn btn-primary" onclick="StatusUpdate()"><?php echo e(trans('labels.save')); ?></button>
      </div>
    </div>

  </div>
</div>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('script'); ?>
<script type="text/javascript">
    //Change Status
    $('body').on('click','.changeStatus',function() {
        let status=$(this).attr('data-status');
        let id=$(this).attr('data-id');

        Swal.fire({
            title: '<?php echo e(trans('labels.are_you_sure')); ?>',
            text: "<?php echo e(trans('labels.change_status')); ?>",
            type: 'error',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: '<?php echo e(trans('labels.yes')); ?>',
            cancelButtonText: '<?php echo e(trans('labels.no')); ?>'
        }).then((t) => {
            if(t.value==true){
                $('#preloader').show();
                $.ajax({
                    headers: {
                      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: '<?php echo e(route("admin.returnorders.changeStatus")); ?>',
                    type: "POST",
                    data : {'id':id,'status':status},
                    success:function(data)
                    {
                        $('#preloader').hide();
                        location.reload();
                    },error:function(data){
                        $('#preloader').hide();
                        console.log("AJAX error in request: " + JSON.stringify(data, null, 2));
                    }
                });
            }
            else
            {
                Swal.fire({type: 'error',title: '<?php echo e(trans('labels.cancelled')); ?>',showConfirmButton: false,timer: 1500});
            }
        });
    });

    function StatusUpdate() {
        let id=$('#data-order-id').val();
        let status=$('#data-status').val();
        let vendor_comment=$('#vendor_comment').val();

        $('#preloader').show();
        $.ajax({
            headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: '<?php echo e(route("admin.returnorders.changeStatus")); ?>',
            type: "POST",
            data : {'id':id,'status':status,'vendor_comment':vendor_comment},
            success:function(data)
            {
                $('#preloader').hide();
                location.reload();
            },error:function(data){
                $('#preloader').hide();
                console.log("AJAX error in request: " + JSON.stringify(data, null, 2));
            }
        });
    }

    $(document).ready(function(){
       $(".reject").click(function(){ // Click to only happen on announce links

         $("#data-order-id").val($(this).attr('data-order-id'));
         $("#data-status").val($(this).attr('data-status'));
         $('#RejectReturn').modal('show');
       });
    });
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\eglobalmart\resources\views/Admin/returnorders/order-details.blade.php ENDPATH**/ ?>