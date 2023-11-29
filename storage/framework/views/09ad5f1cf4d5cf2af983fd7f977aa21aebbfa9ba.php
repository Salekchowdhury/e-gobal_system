<?php $__env->startSection('title'); ?>
    <?php echo e(Helper::webinfo()->site_title); ?> | <?php echo e(trans('labels.product_details')); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
	<!-- =========================== Breadcrumbs =================================== -->
	<div class="brd_wraps pt-2 pb-2">
		<div class="container">
			<nav aria-label="breadcrumb" class="simple_breadcrumbs">
			  <ol class="breadcrumb">
				<li class="breadcrumb-item"><a href="#"><i class="ti-home"></i></a></li>
				<li class="breadcrumb-item active" aria-current="page"><?php echo e($vendorProductData->product_name); ?></li>
			  </ol>
			</nav>
		</div>
	</div>
	<!-- =========================== Breadcrumbs =================================== -->

	<!-- =========================== Product Detail =================================== -->
	<section>
		<div class="container">
			<div class="row">

            <?php if($vendorProductData): ?>
            <?php $__currentLoopData = $vendorProductData->product; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $productData): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            
            <div class="col-3">
            <div class="card " xstyle="height: 10rem;">
                <a href="<?php echo e(URL::to('products/product-details/'.$productData->slug)); ?>">
                <img  height="230px" class="card-img-top" src="<?php echo e($productData->productimage->image_url); ?>" alt="Card image cap">
            </a>
                <div class="card-body">

                  <h4 class=" card-text">  <a href="<?php echo e(URL::to('products/product-details/'.$productData->slug)); ?>">
                    <?php echo e(Str::limit($productData->product_name, 32)); ?>

                </a></h4>
                <div class="woo_price mt-2">
                    <h6><?php echo e(Helper::CurrencyFormatter($productData->product_price)); ?><span class="less_price"><?php echo e(Helper::CurrencyFormatter($productData->discounted_price)); ?></span></h6>
                    
                </div>
                <?php if($productData->product_price): ?>
                    <span class="post-article-cat theme-bg mt-2"><?php echo e(trans('labels.save')); ?> <?php echo e(Helper::CurrencyFormatter( $productData->product_price - $productData->discounted_price )); ?></span>
                <?php endif; ?>
                </div>
              </div>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

            <?php endif; ?>

				



			</div>



		</div>
	</section>
	<!-- =========================== Product Detail =================================== -->

	<!-- =========================== Related Products =================================== -->

	<!-- =========================== Related Products =================================== -->

<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripttop'); ?>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.web', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\eglobalmart\resources\views/Front/vendor-product.blade.php ENDPATH**/ ?>