<?php $__env->startSection('title'); ?>
    <?php echo e(Helper::webinfo()->site_title); ?> | <?php echo e(trans('labels.address')); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
	<!-- =========================== Breadcrumbs =================================== -->
	<div class="brd_wraps pt-2 pb-2">
		<div class="container">
			<nav aria-label="breadcrumb" class="simple_breadcrumbs">
			  <ol class="breadcrumb">
				<li class="breadcrumb-item"><a href="#"><i class="ti-home"></i></a></li>
				<li class="breadcrumb-item active" aria-current="page"><?php echo e(trans('labels.address')); ?></li>
			  </ol>
			</nav>
		</div>
	</div>
	<!-- =========================== Breadcrumbs =================================== -->

	<!-- =========================== My Address =================================== -->
	<section class="gray">
		<div class="container">
			<div class="row">
				<?php echo $__env->make('includes.web.order-sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

				<div class="col-lg-8 col-md-9">
					<?php if(Auth::user()): ?>
						<div class="row">
							<?php $__currentLoopData = $myaddress; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $myadd): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
							<!-- Single card -->
							<div class="col-lg-6 col-md-6">
								<div class="card-header">
									<h4><?php echo e($myadd->first_name); ?> <?php echo e($myadd->last_name); ?>

										<p class="float-right">
											<span class="badge badge-success" onclick="getAddress('<?php echo e($myadd->id); ?>','<?php echo e($myadd->first_name); ?>','<?php echo e($myadd->last_name); ?>','<?php echo e($myadd->street_address); ?>','<?php echo e($myadd->landmark); ?>','<?php echo e($myadd->pincode); ?>','<?php echo e($myadd->email); ?>','<?php echo e($myadd->mobile); ?>')"><?php echo e(trans('labels.edit')); ?></span> <span class="badge badge-danger" onclick="DeleteAddress('<?php echo e($myadd->id); ?>')"><?php echo e(trans('labels.delete')); ?></span>
										</p>
									</h4>
								</div>
								<div class="add-payment-card">
									<div class="ap-card-body">
										<div class="ml-auto mb-3"><?php echo e($myadd->street_address); ?> <?php echo e($myadd->landmark); ?> - <?php echo e($myadd->pincode); ?></div>
										<div class="ml-auto mb-3"><?php echo e($myadd->mobile); ?></div>
										<div class="ml-auto mb-3"><?php echo e($myadd->email); ?></div>
									</div>
								</div>
							</div>
							<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

							<!-- Single card -->
							<div class="col-lg-6 col-md-6">
								<div class="add-payment-card center">
									<div class="add-pay-card">
										<a href="#" data-toggle="modal" data-target="#AddAddress" class="btn btn-pay"><i class="ti-home"></i></a>
									</div>
									<span><?php echo e(trans('labels.add_address')); ?></span>
								</div>
							</div>

						</div>
					<?php else: ?>
						<div class="text-center">
							<img src="<?php echo e(Helper::image_path('no-data.png')); ?>">
							<h2 class="error_title mt-4"><?php echo e(trans('labels.please_login')); ?></h2>
							<a href="<?php echo e(URL::to('/signin')); ?>" class="btn btn-primary"><?php echo e(trans('labels.login')); ?></a>
						</div>
					<?php endif; ?>
				</div>
			</div>
		</div>
	</section>
	<!-- =========================== My All Orders =================================== -->

	<!-- Modal Edit Address-->
	<div class="modal fade text-left" id="EditAddress" tabindex="-1" role="dialog" aria-labelledby="RditProduct"
	aria-hidden="true">
	  <div class="modal-dialog modal-lg" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <label class="modal-title text-text-bold-600" id="RditProduct"><?php echo e(trans('labels.edit_address')); ?></label>
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	          <span aria-hidden="true">&times;</span>
	        </button>
	      </div>
	      <div id="errorr" style="color: red;"></div>

	      <form method="post" action="<?php echo e(URL::to('editaddress')); ?>" method="post">
	      <?php echo e(csrf_field()); ?>

	        <div class="modal-body">
	        	<input class="form-control" type="hidden" name="address_id" id="data-id">

	        	<div class="form-row">
					<div class="form-group col-md-6">
					  	<label><?php echo e(trans('labels.first_name')); ?></label>
					  	<input class="form-control" type="text" name="first_name" id="data-firstname" placeholder="<?php echo e(trans('labels.first_name')); ?>" required="">
					</div>

					<div class="form-group col-md-6">
					  	<label><?php echo e(trans('labels.last_name')); ?></label>
			          	<input class="form-control" type="text" name="last_name" id="data-lastname" placeholder="<?php echo e(trans('labels.last_name')); ?>" required="">
					</div>
				</div>

				<div class="form-row">
					<div class="form-group col-md-6">
					  	<label><?php echo e(trans('labels.email')); ?></label>
			          	<input class="form-control" type="text" name="email" id="data-email" placeholder="<?php echo e(trans('labels.email')); ?>" required="">
					</div>

					<div class="form-group col-md-6">
						<label><?php echo e(trans('labels.mobile')); ?></label>
			          	<input class="form-control" type="text" name="mobile" id="data-mobile" placeholder="<?php echo e(trans('labels.mobile')); ?>" required="">
					</div>
				</div>

				<div class="form-group col-md-12">
				  	<label><?php echo e(trans('labels.street_address')); ?></label>
		          	<textarea class="form-control" name="street_address" id="data-address" placeholder="<?php echo e(trans('labels.street_address')); ?>" required=""></textarea>
				</div>

				

	        </div>
	        <div class="modal-footer">
	          <input type="submit" class="btn btn-theme" value="<?php echo e(trans('labels.submit')); ?>">
	        </div>
	      </form>
	    </div>
	  </div>
	</div>

	<!-- Modal Add Address-->
	<div class="modal fade text-left" id="AddAddress" tabindex="-1" role="dialog" aria-labelledby="RditProduct"
	aria-hidden="true">
	  <div class="modal-dialog modal-lg" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <label class="modal-title text-text-bold-600" id="RditProduct"><?php echo e(trans('labels.add_address')); ?></label>
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	          <span aria-hidden="true">&times;</span>
	        </button>
	      </div>
	      <div id="errorr" style="color: red;"></div>

	      <form method="post" action="<?php echo e(URL::to('saveaddress')); ?>" method="post">
	      <?php echo e(csrf_field()); ?>

	        <div class="modal-body">
	        	<input class="form-control" type="hidden" name="address_id">

	        	<div class="form-row">
					<div class="form-group col-md-6">
					  	<label><?php echo e(trans('labels.first_name')); ?></label>
					  	<input class="form-control" type="text" name="first_name" placeholder="<?php echo e(trans('labels.first_name')); ?>" required="">
					</div>

					<div class="form-group col-md-6">
					  	<label><?php echo e(trans('labels.last_name')); ?></label>
			          	<input class="form-control" type="text" name="last_name" placeholder="<?php echo e(trans('labels.last_name')); ?>" required="">
					</div>
				</div>

				<div class="form-row">
					<div class="form-group col-md-6">
					  	<label><?php echo e(trans('labels.email')); ?></label>
			          	<input class="form-control" type="text" name="email" placeholder="<?php echo e(trans('labels.email')); ?>" required="">
					</div>

					<div class="form-group col-md-6">
						<label><?php echo e(trans('labels.mobile')); ?></label>
			          	<input class="form-control" type="text" name="mobile" placeholder="<?php echo e(trans('labels.mobile')); ?>" required="">
					</div>
				</div>

				<div class="form-group col-md-12">
				  	<label><?php echo e(trans('labels.street_address')); ?></label>
		          	<textarea class="form-control" name="street_address" placeholder="<?php echo e(trans('labels.street_address')); ?>" required=""></textarea>
				</div>

				

	        </div>
	        <div class="modal-footer">
	          <input type="submit" class="btn btn-theme" value="<?php echo e(trans('labels.submit')); ?>">
	        </div>
	      </form>
	    </div>
	  </div>
	</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripttop'); ?>
<script type="text/javascript">
	function getAddress(id,firstname,lastname,streetaddress,landmark,pincode,email,mobile) {

	     $("#data-id").val(id);
	     $("#data-firstname").val(firstname);
	     $("#data-lastname").val(lastname);
	     $("#data-address").val(streetaddress);
	     $("#data-landmark").val(landmark);
	     $("#data-pincode").val(pincode);
	     $("#data-email").val(email);
	     $("#data-mobile").val(mobile);
	     $('#EditAddress').modal('show');
	};

	function DeleteAddress(id) {
	    swal({
	        title: "Are you sure?",
	        text: "Are you sure want to Delete this address ?",
	        type: "warning",
	        showCancelButton: true,
	        confirmButtonClass: "btn-danger",
	        confirmButtonText: "Yes, Delete it!",
	        cancelButtonText: "No, cancel plz!",
	        closeOnConfirm: false,
	        closeOnCancel: false,
	        showLoaderOnConfirm: true,
	    },
	    function(isConfirm) {
	        if (isConfirm) {
	            $.ajax({
	                headers: {
	                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	                },
	                url:"<?php echo e(URL::to('deleteaddress')); ?>",
	                data: {
	                    id: id
	                },
	                method: 'POST',

	                success: function(response) {
	                    if (response.status == 1) {
	                        swal({
	                            title: "Approved!",
	                            text: "Address has been deleted.",
	                            type: "success",
	                            showCancelButton: true,
	                            confirmButtonClass: "btn-danger",
	                            confirmButtonText: "Ok",
	                            closeOnConfirm: false,
	                            showLoaderOnConfirm: true,
	                        },
	                        function(isConfirm) {
	                            if (isConfirm) {
	                                swal.close();
	                                location.reload();
	                            }
	                        });
	                    } else {
	                        swal("Cancelled", "Something Went Wrong :(", "error");
	                    }
	                },
	                error: function(e) {
	                    swal("Cancelled", "Something Went Wrong :(", "error");
	                }
	            });
	        } else {
	            swal("Cancelled", "Your record is safe :)", "error");
	        }
	    });
	}
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.web', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\eglobalmart\resources\views/Front/address.blade.php ENDPATH**/ ?>