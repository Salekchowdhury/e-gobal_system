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
        <section id="configuration">
            <div class="row">


                <div class="card">

                    <div class="card-body collapse show">

                        <div class="card-block card-dashboard" id="table-display">
                            

                            <div class="checked-shop">

                                <div class="row">
                                    <div class="col-3">
                                        <a href="#"><img src="<?php echo e($order_info->image_url); ?>" alt="..."
                                                class="img-fluid" style="width: 800px; object-fit: scale-down;"></a>

                                    </div>
                                    <div class="col-5">
                                        <p class="mb-2 font-size-sm font-weight-bold">
                                            <a class="text-body" href="#"><?php echo e($order_info->product_name); ?></a>
                                        </p>

                                    </div>
                                    <div class="col-1">
                                        <?php echo e(trans('labels.qty')); ?>: <?php echo e($order_info->qty); ?>

                                    </div>
                                    <div class="col-3">
                                        <div class="float-right">
                                            <p class="text-right theme-cl">
                                                <?php echo e(Helper::CurrencyFormatter($order_info->price * $order_info->qty)); ?></p>
                                        </div>
                                    </div>
                                </div>


                                <div class="row">
                                    <div class="col-lg-12 col-md-12 col-sm-12">
                                        <?php if(Auth::user()->type == 3): ?>
                                            <?php if($order_info['status'] != 5 && $order_info['status'] != 6 && $order_info['status'] == 4 && $ratting != 1): ?>
                                                <div class="float-right">
                                                    <button class="btn btn-sm btn-success write-review"
                                                        data-product-id="<?php echo e($order_info->product_id); ?>"
                                                        data-vendor-id="<?php echo e($order_info->vendor_id); ?>"
                                                        data-product-name="<?php echo e($order_info->product_name); ?>"
                                                        data-product-image="<?php echo e($order_info->image_url); ?>"><?php echo e(trans('labels.write_review')); ?></button>
                                                </div>
                                            <?php endif; ?>
                                        <?php endif; ?>


                                        <ul class="track_order_list mt-4">
                                            <?php if($order_info['status'] == 1): ?>
                                                <li class="complete">
                                                    <div class="trach_single_list">
                                                        <div class="trach_icon_list"><i class="ti-write"></i></div>
                                                        <div class="track_list_caption">
                                                            <h4 class="mb-0"><?php echo e(trans('labels.order_placed')); ?></h4>
                                                            <p><?php echo e(trans('labels.order_placed_text')); ?></p>
                                                        </div>
                                                    </div>
                                                </li>
                                                <li class="processing">
                                                    <div class="col-7">
                                                        <div class="trach_single_list">
                                                            <div class="trach_icon_list"><i class="ti-package"></i></div>
                                                            <div class="track_list_caption">
                                                                <h4 class="mb-0"><?php echo e(trans('labels.confirmed')); ?></h4>
                                                                <p><?php echo e(trans('labels.order_confirmed_text')); ?></p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-5">
                                                        <?php $__currentLoopData = $order_info->orderComment; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $comment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <?php if($comment->status == 2): ?>
                                                            <span><?php echo e($comment->generate_date); ?><p class="text-justify"><?php echo e($comment->comment); ?></p>
                                                            <?php endif; ?>
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="col-7">
                                                        <div class="trach_single_list">
                                                            <div class="trach_icon_list"><i class="ti-gift"></i></div>
                                                            <div class="track_list_caption">
                                                                <h4 class="mb-0"><?php echo e(trans('labels.order_shipped')); ?></h4>
                                                                <p><?php echo e(trans('labels.order_shipped')); ?></p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-5">
                                                        <?php $__currentLoopData = $order_info->orderComment; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $comment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <?php if($comment->status == 3): ?>
                                                            <span><?php echo e($comment->generate_date); ?><p class="text-justify"><?php echo e($comment->comment); ?></p>
                                                            <?php endif; ?>
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="col-7">
                                                        <div class="trach_single_list">
                                                            <div class="trach_icon_list"><i class="ti-truck"></i></div>
                                                            <div class="track_list_caption">
                                                                <h4 class="mb-0"><?php echo e(trans('labels.assigned_to_rider')); ?>

                                                                </h4>
                                                                <p><?php echo e(trans('labels.assigned_to_rider')); ?></p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-5">
                                                        <?php $__currentLoopData = $order_info->orderComment; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $comment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <?php if($comment->status == 11): ?>
                                                            <span><?php echo e($comment->generate_date); ?><p class="text-justify"><?php echo e($comment->comment); ?></p>
                                                            <?php endif; ?>
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="col-7">
                                                        <div class="trach_single_list">
                                                            <div class="trach_icon_list"><i class="ti-thumb-up"></i></div>
                                                            <div class="track_list_caption">
                                                                <h4 class="mb-0"><?php echo e(trans('labels.delivered')); ?></h4>
                                                                <p><?php echo e(trans('labels.delivered_text')); ?></p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-5">
                                                        <?php $__currentLoopData = $order_info->orderComment; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $comment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <?php if($comment->status == 4): ?>
                                                            <span><?php echo e($comment->generate_date); ?><p class="text-justify"><?php echo e($comment->comment); ?></p>
                                                            <?php endif; ?>
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                    </div>
                                                </li>
                                            <?php endif; ?>
                                            <?php if($order_info['status'] == 2): ?>
                                                <li class="complete">
                                                    <div class="trach_single_list">
                                                        <div class="trach_icon_list"><i class="ti-write"></i></div>
                                                        <div class="track_list_caption">
                                                            <h4 class="mb-0"><?php echo e(trans('labels.order_placed')); ?></h4>
                                                            <p><?php echo e(trans('labels.order_placed_text')); ?></p>
                                                        </div>
                                                    </div>
                                                </li>
                                                <li class="complete">
                                                    <div class="col-7">
                                                        <div class="trach_single_list">
                                                            <div class="trach_icon_list"><i class="ti-package"></i></div>
                                                            <div class="track_list_caption">
                                                                <h4 class="mb-0"><?php echo e(trans('labels.confirmed')); ?></h4>
                                                                <p><?php echo e(trans('labels.order_confirmed_text')); ?></p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-5">
                                                        <?php $__currentLoopData = $order_info->orderComment; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $comment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <?php if($comment->status == 2): ?>
                                                            <span><?php echo e($comment->generate_date); ?><p class="text-justify"><?php echo e($comment->comment); ?></p>
                                                            <?php endif; ?>
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                    </div>
                                                </li>
                                                <li class="processing">
                                                    <div class="col-7">
                                                        <div class="trach_single_list">
                                                            <div class="trach_icon_list"><i class="ti-gift"></i></div>
                                                            <div class="track_list_caption">
                                                                <h4 class="mb-0"><?php echo e(trans('labels.order_shipped')); ?></h4>
                                                                <p><?php echo e(trans('labels.order_shipped')); ?></p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-5">
                                                        <?php $__currentLoopData = $order_info->orderComment; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $comment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <?php if($comment->status == 3): ?>
                                                            <span><?php echo e($comment->generate_date); ?><p class="text-justify"><?php echo e($comment->comment); ?></p>
                                                            <?php endif; ?>
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="col-7">
                                                        <div class="trach_single_list">
                                                            <div class="trach_icon_list"><i class="ti-truck"></i></div>
                                                            <div class="track_list_caption">
                                                                <h4 class="mb-0"><?php echo e(trans('labels.assigned_to_rider')); ?>

                                                                </h4>
                                                                <p><?php echo e(trans('labels.assigned_to_rider')); ?></p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-5">
                                                        <?php $__currentLoopData = $order_info->orderComment; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $comment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <?php if($comment->status == 11): ?>
                                                            <span><?php echo e($comment->generate_date); ?><p class="text-justify"><?php echo e($comment->comment); ?></p>
                                                            <?php endif; ?>
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="col-7">
                                                        <div class="trach_single_list">
                                                            <div class="trach_icon_list"><i class="ti-thumb-up"></i></div>
                                                            <div class="track_list_caption">
                                                                <h4 class="mb-0"><?php echo e(trans('labels.delivered')); ?></h4>
                                                                <p><?php echo e(trans('labels.delivered_text')); ?></p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-5">
                                                        <?php $__currentLoopData = $order_info->orderComment; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $comment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <?php if($comment->status == 4): ?>
                                                            <span><?php echo e($comment->generate_date); ?><p class="text-justify"><?php echo e($comment->comment); ?></p>
                                                            <?php endif; ?>
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                    </div>
                                                </li>
                                            <?php endif; ?>
                                            <?php if($order_info['status'] == 3): ?>
                                                <li class="complete">
                                                    <div class="trach_single_list">
                                                        <div class="trach_icon_list"><i class="ti-write"></i></div>
                                                        <div class="track_list_caption">
                                                            <h4 class="mb-0"><?php echo e(trans('labels.order_placed')); ?></h4>
                                                            <p><?php echo e(trans('labels.order_placed_text')); ?></p>
                                                        </div>
                                                    </div>
                                                </li>
                                                <li class="complete">
                                                    <div class="col-7">
                                                        <div class="trach_single_list">
                                                            <div class="trach_icon_list"><i class="ti-package"></i></div>
                                                            <div class="track_list_caption">
                                                                <h4 class="mb-0"><?php echo e(trans('labels.confirmed')); ?></h4>
                                                                <p><?php echo e(trans('labels.order_confirmed_text')); ?></p>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-5">
                                                        <?php $__currentLoopData = $order_info->orderComment; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $comment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <?php if($comment->status == 2): ?>
                                                            <span><?php echo e($comment->generate_date); ?><p class="text-justify"><?php echo e($comment->comment); ?></p>
                                                            <?php endif; ?>
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                    </div>
                                                </li>
                                                <li class="complete">
                                                    <div class="col-7">
                                                        <div class="trach_single_list">
                                                            <div class="trach_icon_list"><i class="ti-gift"></i></div>
                                                            <div class="track_list_caption">
                                                                <h4 class="mb-0"><?php echo e(trans('labels.order_shipped')); ?>

                                                                </h4>
                                                                <p><?php echo e(trans('labels.order_shipped')); ?></p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-5">
                                                        <?php $__currentLoopData = $order_info->orderComment; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $comment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <?php if($comment->status == 3): ?>
                                                            <span><?php echo e($comment->generate_date); ?><p class="text-justify"><?php echo e($comment->comment); ?></p>
                                                            <?php endif; ?>
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                    </div>
                                                </li>
                                                <li class="processing">
                                                    <div class="col-7">
                                                        <div class="trach_single_list">
                                                            <div class="trach_icon_list"><i class="ti-truck"></i></div>
                                                            <div class="track_list_caption">
                                                                <h4 class="mb-0"><?php echo e(trans('labels.assigned_to_rider')); ?>

                                                                </h4>
                                                                <p><?php echo e(trans('labels.assigned_to_rider')); ?></p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-5">
                                                        <?php $__currentLoopData = $order_info->orderComment; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $comment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <?php if($comment->status == 11): ?>
                                                            <span><?php echo e($comment->generate_date); ?> <p class="text-justify"><?php echo e($comment->comment); ?></p>
                                                            <?php endif; ?>
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="col-7">
                                                        <div class="trach_single_list">
                                                            <div class="trach_icon_list"><i class="ti-thumb-up"></i></div>
                                                            <div class="track_list_caption">
                                                                <h4 class="mb-0"><?php echo e(trans('labels.delivered')); ?></h4>
                                                                <p><?php echo e(trans('labels.delivered_text')); ?></p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-5">
                                                        <?php $__currentLoopData = $order_info->orderComment; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $comment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <?php if($comment->status == 4): ?>
                                                            <span><?php echo e($comment->generate_date); ?><p class="text-justify"><?php echo e($comment->comment); ?></p>
                                                            <?php endif; ?>
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                    </div>
                                                </li>
                                            <?php endif; ?>
                                            <?php if($order_info['status'] == 11): ?>
                                                <li class="complete">
                                                    <div class="trach_single_list">
                                                        <div class="trach_icon_list"><i class="ti-write"></i></div>
                                                        <div class="track_list_caption">
                                                            <h4 class="mb-0"><?php echo e(trans('labels.order_placed')); ?></h4>
                                                            <p><?php echo e(trans('labels.order_placed_text')); ?></p>
                                                        </div>
                                                    </div>
                                                </li>
                                                <li class="complete">
                                                    <div class="col-7">
                                                        <div class="trach_single_list">
                                                            <div class="trach_icon_list"><i class="ti-package"></i></div>
                                                            <div class="track_list_caption">
                                                                <h4 class="mb-0"><?php echo e(trans('labels.confirmed')); ?></h4>
                                                                <p><?php echo e(trans('labels.order_confirmed_text')); ?></p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-5">
                                                        <?php $__currentLoopData = $order_info->orderComment; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $comment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <?php if($comment->status == 2): ?>
                                                            <span><?php echo e($comment->generate_date); ?><p class="text-justify"><?php echo e($comment->comment); ?></p>
                                                            <?php endif; ?>
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                    </div>
                                                </li>
                                                <li class="complete">
                                                    <div class="col-7">
                                                        <div class="trach_single_list">
                                                            <div class="trach_icon_list"><i class="ti-gift"></i></div>
                                                            <div class="track_list_caption">
                                                                <h4 class="mb-0"><?php echo e(trans('labels.order_shipped')); ?>

                                                                </h4>
                                                                <p><?php echo e(trans('labels.order_shipped')); ?></p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-5">
                                                        <?php $__currentLoopData = $order_info->orderComment; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $comment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <?php if($comment->status == 3): ?>
                                                            <span><?php echo e($comment->generate_date); ?> <p class="text-justify"><?php echo e($comment->comment); ?></p>
                                                            <?php endif; ?>
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                    </div>
                                                </li>
                                                <li class="complete">
                                                    <div class="col-7">
                                                        <div class="trach_single_list">
                                                            <div class="trach_icon_list"><i class="ti-truck"></i></div>
                                                            <div class="track_list_caption">
                                                                <h4 class="mb-0"><?php echo e(trans('labels.assigned_to_rider')); ?>

                                                                </h4>
                                                                <p><?php echo e(trans('labels.assigned_to_rider')); ?></p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-5">
                                                        <?php $__currentLoopData = $order_info->orderComment; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $comment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <?php if($comment->status == 11): ?>
                                                            <span><?php echo e($comment->generate_date); ?><p class="text-justify"><?php echo e($comment->comment); ?></p>
                                                            <?php endif; ?>
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                    </div>
                                                </li>
                                                <li class="processing">
                                                    <div class="col-7">
                                                        <div class="trach_single_list">
                                                            <div class="trach_icon_list"><i class="ti-thumb-up"></i></div>
                                                            <div class="track_list_caption">
                                                                <h4 class="mb-0"><?php echo e(trans('labels.delivered')); ?></h4>
                                                                <p><?php echo e(trans('labels.delivered_text')); ?></p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-5">
                                                        <?php $__currentLoopData = $order_info->orderComment; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $comment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <?php if($comment->status == 4): ?>
                                                            <span><?php echo e($comment->generate_date); ?> <p class="text-justify"><?php echo e($comment->comment); ?></p>
                                                            <?php endif; ?>
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                    </div>
                                                </li>
                                            <?php endif; ?>
                                            <?php if($order_info['status'] == 4): ?>
                                                <li class="complete">
                                                    <div class="trach_single_list">
                                                        <div class="trach_icon_list"><i class="ti-write"></i></div>
                                                        <div class="track_list_caption">
                                                            <h4 class="mb-0"><?php echo e(trans('labels.order_placed')); ?></h4>
                                                            <p><?php echo e(trans('labels.order_placed_text')); ?></p>
                                                        </div>
                                                    </div>
                                                </li>
                                                <li class="complete">
                                                    <div class="col-7">
                                                        <div class="trach_single_list">
                                                            <div class="trach_icon_list"><i class="ti-package"></i></div>
                                                            <div class="track_list_caption">
                                                                <h4 class="mb-0"><?php echo e(trans('labels.confirmed')); ?></h4>
                                                                <p><?php echo e(trans('labels.order_confirmed_text')); ?></p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-5">
                                                        <?php $__currentLoopData = $order_info->orderComment; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $comment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <?php if($comment->status == 2): ?>
                                                            <span><?php echo e($comment->generate_date); ?><p class="text-justify"><?php echo e($comment->comment); ?></p>
                                                            <?php endif; ?>
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                    </div>
                                                </li>
                                                <li class="complete">
                                                    <div class="col-7">
                                                        <div class="trach_single_list">
                                                            <div class="trach_icon_list"><i class="ti-gift"></i></div>
                                                            <div class="track_list_caption">
                                                                <h4 class="mb-0"><?php echo e(trans('labels.order_shipped')); ?>

                                                                </h4>
                                                                <p><?php echo e(trans('labels.order_shipped')); ?></p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-5">
                                                        <?php $__currentLoopData = $order_info->orderComment; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $comment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <?php if($comment->status == 3): ?>
                                                            <span><?php echo e($comment->generate_date); ?><p class="text-justify"><?php echo e($comment->comment); ?> bbb</p>
                                                            <?php endif; ?>
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                    </div>
                                                </li>
                                                <li class="complete">
                                                    <div class="col-7">
                                                        <div class="trach_single_list">
                                                            <div class="trach_icon_list"><i class="ti-truck"></i></div>
                                                            <div class="track_list_caption">
                                                                <h4 class="mb-0"><?php echo e(trans('labels.assigned_to_rider')); ?>

                                                                </h4>
                                                                <p><?php echo e(trans('labels.assigned_to_rider')); ?></p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-5">
                                                        <?php $__currentLoopData = $order_info->orderComment; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $comment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <?php if($comment->status == 11): ?>
                                                            <span><?php echo e($comment->generate_date); ?><p class="text-justify"><?php echo e($comment->comment); ?></p>
                                                            <?php endif; ?>
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                    </div>
                                                </li>
                                                <li class="complete">
                                                    <div class="col-7">
                                                        <div class="trach_single_list">
                                                            <div class="trach_icon_list"><i class="ti-thumb-up"></i></div>
                                                            <div class="track_list_caption">
                                                                <h4 class="mb-0"><?php echo e(trans('labels.delivered')); ?></h4>
                                                                <p><?php echo e(trans('labels.delivered_text')); ?></p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-5">
                                                        <?php $__currentLoopData = $order_info->orderComment; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $comment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <?php if($comment->status == 4): ?>
                                                            <span><?php echo e($comment->generate_date); ?><p class="text-justify"><?php echo e($comment->comment); ?></p>
                                                            <?php endif; ?>
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                    </div>
                                                </li>
                                            <?php endif; ?>

                                            <?php if($order_info['status'] == 5): ?>
                                                <li class="cancel">
                                                    <div class="col-7">
                                                        <div class="trach_single_list">
                                                            <div class="trach_icon_list"><i class="ti-close"></i></div>
                                                            <div class="track_list_caption">
                                                                <h4 class="mb-0"><?php echo e(trans('labels.cancelled')); ?></h4>
                                                                <p><?php echo e(trans('labels.cancelled_by_vendor')); ?></p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-5">
                                                        <?php $__currentLoopData = $order_info->orderComment; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $comment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <?php if($comment->status == 5): ?>
                                                            <span><?php echo e($comment->generate_date); ?><p class="text-justify"><?php echo e($comment->comment); ?></p>
                                                            <?php endif; ?>
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                    </div>
                                                </li>
                                            <?php endif; ?>
                                            <?php if($order_info['status'] == 6): ?>
                                                <li class="cancel">
                                                    <div class="trach_single_list">
                                                        <div class="trach_icon_list"><i class="ti-close"></i></div>
                                                        <div class="track_list_caption">
                                                            <h4 class="mb-0"><?php echo e(trans('labels.cancelled')); ?></h4>
                                                            <p><?php echo e(trans('labels.cancelled_by_user')); ?></p>
                                                        </div>
                                                    </div>
                                                </li>
                                            <?php endif; ?>
                                            <?php if($order_info['status'] == 7): ?>
                                                <li class="complete">
                                                    <div class="trach_single_list">
                                                        <div class="trach_icon_list"><i class="ti-write"></i></div>
                                                        <div class="track_list_caption">
                                                            <h4 class="mb-0"><?php echo e(trans('labels.return')); ?></h4>
                                                            <p><?php echo e(trans('labels.return')); ?></p>
                                                        </div>
                                                    </div>
                                                </li>
                                                <li class="processing">
                                                    <div class="trach_single_list">
                                                        <div class="trach_icon_list"><i class="ti-package"></i></div>
                                                        <div class="track_list_caption">
                                                            <h4 class="mb-0"><?php echo e(trans('labels.return_progress')); ?></h4>
                                                            <p><?php echo e(trans('labels.return_progress')); ?></p>
                                                        </div>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="trach_single_list">
                                                        <div class="trach_icon_list"><i class="ti-gift"></i></div>
                                                        <div class="track_list_caption">
                                                            <h4 class="mb-0"><?php echo e(trans('labels.return_complete')); ?></h4>
                                                            <p><?php echo e(trans('labels.return_complete')); ?></p>
                                                        </div>
                                                    </div>
                                                </li>
                                            <?php endif; ?>
                                            <?php if($order_info['status'] == 8): ?>
                                                <li class="complete">
                                                    <div class="trach_single_list">
                                                        <div class="trach_icon_list"><i class="ti-write"></i></div>
                                                        <div class="track_list_caption">
                                                            <h4 class="mb-0"><?php echo e(trans('labels.return')); ?></h4>
                                                            <p><?php echo e(trans('labels.return')); ?></p>
                                                        </div>
                                                    </div>
                                                </li>
                                                <li class="complete">
                                                    <div class="trach_single_list">
                                                        <div class="trach_icon_list"><i class="ti-package"></i></div>
                                                        <div class="track_list_caption">
                                                            <h4 class="mb-0"><?php echo e(trans('labels.return_progress')); ?></h4>
                                                            <p><?php echo e(trans('labels.return_progress')); ?></p>
                                                        </div>
                                                    </div>
                                                </li>
                                                <li class="processing">
                                                    <div class="trach_single_list">
                                                        <div class="trach_icon_list"><i class="ti-gift"></i></div>
                                                        <div class="track_list_caption">
                                                            <h4 class="mb-0"><?php echo e(trans('labels.return_complete')); ?></h4>
                                                            <p><?php echo e(trans('labels.return_complete')); ?></p>
                                                        </div>
                                                    </div>
                                                </li>
                                            <?php endif; ?>
                                            <?php if($order_info['status'] == 9): ?>
                                                <li class="complete">
                                                    <div class="trach_single_list">
                                                        <div class="trach_icon_list"><i class="ti-write"></i></div>
                                                        <div class="track_list_caption">
                                                            <h4 class="mb-0"><?php echo e(trans('labels.return')); ?></h4>
                                                            <p><?php echo e(trans('labels.return_text')); ?></p>
                                                        </div>
                                                    </div>
                                                </li>
                                                <li class="complete">
                                                    <div class="trach_single_list">
                                                        <div class="trach_icon_list"><i class="ti-package"></i></div>
                                                        <div class="track_list_caption">
                                                            <h4 class="mb-0"><?php echo e(trans('labels.return_progress')); ?></h4>
                                                            <p><?php echo e(trans('labels.return_progress')); ?></p>
                                                        </div>
                                                    </div>
                                                </li>
                                                <li class="complete">
                                                    <div class="trach_single_list">
                                                        <div class="trach_icon_list"><i class="ti-gift"></i></div>
                                                        <div class="track_list_caption">
                                                            <h4 class="mb-0"><?php echo e(trans('labels.return_complete')); ?></h4>
                                                            <p><?php echo e(trans('labels.return_complete')); ?></p>
                                                        </div>
                                                    </div>
                                                </li>
                                            <?php endif; ?>
                                            <?php if($order_info['status'] == 10): ?>
                                                <li class="cancel">
                                                    <div class="trach_single_list">
                                                        <div class="trach_icon_list"><i class="ti-close"></i></div>
                                                        <div class="track_list_caption">
                                                            <h4 class="mb-0"><?php echo e(trans('labels.return_reject')); ?></h4>
                                                            <p><?php echo e($order_info['vendor_comment']); ?></p>
                                                        </div>
                                                    </div>
                                                </li>
                                            <?php endif; ?>
                                        </ul>
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

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\eglobalmart\resources\views/Admin/order_track/track-order.blade.php ENDPATH**/ ?>