<?php $__env->startSection('title'); ?>
    <?php echo e(Helper::webinfo()->site_title); ?> | <?php echo e(trans('labels.products')); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="content-wrapper">
        <section class="basic-elements">
            <div class="row">
                <div class="col-sm-12">
                    <div class="content-header"><?php echo e(trans('labels.edit_product')); ?></div>
                </div>
            </div>
            <?php if(Session::has('danger')): ?>
            <div class="alert alert-danger">
                <?php echo e(Session::get('danger')); ?>

                <?php
                    Session::forget('danger');
                ?>
            </div>
            <?php endif; ?>

            <form class="form" method="post" action="<?php echo e(route('admin.products.update')); ?>" enctype="multipart/form-data">
                <?php echo csrf_field(); ?>
                <input type="hidden" name="product_id" id="product_id" value="<?php echo e($data->id); ?>" class="form-control">
                <div class="row">
                    <div class="col-md-8">
                        <div class="card">
                            <div class="card-header">
                                <h6 class="card-title mb-0">Product Information</h6>
                            </div>
                            <div class="card-body">
                                <div class="px-3">
                                    <div class="form-group row">
                                      <label for="cat_id" class="col-sm-2 col-form-label"><?php echo e(trans('labels.category')); ?></label>
                                      <div class="col-sm-10">
                                        <select class="form-control" name="cat_id" id="cat_id">
                                            <option value=""><?php echo e(trans('placeholder.select_category')); ?></option>
                                            <?php $__currentLoopData = $category; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($category->id); ?>" <?php echo e($data->cat_id == $category->id ? 'selected' : ''); ?>><?php echo e($category->category_name); ?></option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>
                                        <?php $__errorArgs = ['cat_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><span class="text-danger"><?php echo e($message); ?></span><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                      </div>
                                    </div>
                                    <div class="form-group row">
                                      <label for="subcat_id" class="col-sm-2 col-form-label"><?php echo e(trans('labels.subcategory')); ?></label>
                                      <div class="col-sm-10">
                                        <select class="form-control" name="subcat_id" id="subcat_id">
                                            <option value=""><?php echo e(trans('placeholder.select_subcategory')); ?></option>
                                            <?php $__currentLoopData = $subcategory; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $subcategory): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($subcategory->id); ?>" <?php echo e($data->subcat_id == $subcategory->id ? 'selected' : ''); ?>><?php echo e($subcategory->subcategory_name); ?></option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>
                                        <?php $__errorArgs = ['subcat_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><span class="text-danger"><?php echo e($message); ?></span><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                      </div>
                                    </div>
                                    <div class="form-group row">
                                      <label for="innersubcat_id" class="col-sm-2 col-form-label"><?php echo e(trans('labels.innersubcategory')); ?></label>
                                      <div class="col-sm-10">
                                        <select class="form-control" name="innersubcat_id" id="innersubcat_id">
                                            <option value=""><?php echo e(trans('placeholder.select_innersubcategory')); ?></option>
                                            <?php $__currentLoopData = $innersubcategory; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $innersubcategory): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($innersubcategory->id); ?>" <?php echo e($data->subcat_id == $innersubcategory->id ? 'selected' : ''); ?>><?php echo e($innersubcategory->innersubcategory_name); ?></option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>
                                        <?php $__errorArgs = ['innersubcat_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><span class="text-danger"><?php echo e($message); ?></span><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                      </div>
                                    </div>
                                    <div class="form-group row">
                                      <label for="product_name" class="col-sm-2 col-form-label"><?php echo e(trans('labels.product_name')); ?></label>
                                      <div class="col-sm-10">
                                        <input type="text" class="form-control" id="product_name" name="product_name" placeholder="<?php echo e(trans('placeholder.product')); ?>" value="<?php echo e($data->product_name); ?>">
                                        <?php $__errorArgs = ['product_name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><span class="text-danger"><?php echo e($message); ?></span><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                      </div>
                                    </div>

                                    <div class="form-group row">
                                      <label for="brand" class="col-sm-2 col-form-label"><?php echo e(trans('labels.brand')); ?></label>
                                      <div class="col-sm-10">
                                        <select class="form-control" name="brand" id="brand">
                                            <option value="">Select brand</option>
                                            <?php $__currentLoopData = $brands; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $brand): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option value="<?php echo e($brand->id); ?>" <?php echo e($data->brand == $brand->id ? 'selected' : ''); ?>><?php echo e($brand->brand_name); ?></option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>
                                        <?php $__errorArgs = ['brand'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><span class="text-danger"><?php echo e($message); ?></span><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                      </div>
                                    </div>

                                    <div class="form-group row">
                                      <label for="brand" class="col-sm-2 col-form-label"><?php echo e(trans('labels.sku')); ?></label>
                                      <div class="col-sm-10">
                                        <input type="text" class="form-control" id="sku" name="sku" placeholder="<?php echo e(trans('placeholder.sku')); ?>" value="<?php echo e($data->sku); ?>">
                                        <?php $__errorArgs = ['sku'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><span class="text-danger"><?php echo e($message); ?></span><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                      </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="product_type" class="col-sm-2 col-form-label"><?php echo e(trans('labels.product_type')); ?> </label>
                                        <div class="col-sm-10">
                                          <select class="form-control" name="product_type" required>
                                             
                                              <option value=""> Product Type</option>
                                              <option  value="own_product" <?php echo e($data->product_type == 'own_product' ? 'selected' : ''); ?>>Own Product </option>
                                              <option value="stockiest_product" <?php echo e($data->product_type == 'stockiest_product' ? 'selected' : ''); ?> >Stockiest Product </option>
                                          </select>

                                          <?php $__errorArgs = ['product_type'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><span class="text-danger"><?php echo e($message); ?></span><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                        </div>
                                      </div>
                                </div>
                            </div>
                        </div>

                        <div class="card">
                            <div class="card-header">
                                <h6 class="card-title mb-0"><?php echo e(trans('labels.tags')); ?></h6>
                            </div>
                            <div class="card-body">
                                <div class="px-3">
                                  <div class="form-group row">
                                    <label for="tags" class="col-sm-2 col-form-label"><?php echo e(trans('labels.tags')); ?></label>
                                    <div class="col-sm-10">
                                      <div class="edit-on-delete form-control" data-tags-input-name="tags"><?php echo e($data->tags); ?></div>
                                      <p class="text-muted"><?php echo e(trans('labels.tags_note')); ?></p>
                                      <?php $__errorArgs = ['tags'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><span class="text-danger"><?php echo e($message); ?></span><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                    </div>
                                  </div>
                                </div>
                            </div>
                        </div>

                        <div class="card">
                            <div class="card-header">
                                <h6 class="card-title mb-0"><?php echo e(trans('labels.price_or_variation')); ?></h6>
                            </div>
                            <div class="card-body">
                                <div class="px-3">

                                  <div class="form-group row">
                                    <label for="is_variation" class="col-sm-2 col-form-label"><?php echo e(trans('labels.is_variation_available')); ?></label>
                                    <div class="col-sm-10">
                                      <input type="checkbox" class="is_variation big-checkbox" name="is_variation" value="1"
                                      <?php if($data->is_variation == 1): ?> checked <?php endif; ?>/>
                                    </div>
                                  </div>

                                  <div class="form-group row default_price" <?php if($data->is_variation == '1'): ?> style="display: none;" <?php endif; ?>>
                                    <label for="product_price" class="col-sm-2 col-form-label">product price</label>
                                    <div class="col-sm-10">
                                      <input type="text" class="form-control" id="product_price" name="product_price" placeholder="<?php echo e(trans('placeholder.price')); ?>" value="<?php echo e($data->product_price); ?>">
                                      <?php $__errorArgs = ['product_price'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><span class="text-danger"><?php echo e($message); ?></span><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                    </div>
                                  </div>

                                  <div class="form-group row default_price" <?php if($data->is_variation == '1'): ?> style="display: none;" <?php endif; ?>>
                                    <label for="discounted_price" class="col-sm-2 col-form-label"><?php echo e(trans('labels.discounted_price')); ?></label>
                                    <div class="col-sm-10">
                                      <input type="text" class="form-control" id="discounted_price" name="discounted_price" placeholder="<?php echo e(trans('placeholder.discounted_price')); ?>" value="<?php echo e($data->discounted_price); ?>">
                                      <?php $__errorArgs = ['discounted_price'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><span class="text-danger"><?php echo e($message); ?></span><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                    </div>
                                  </div>

                                  <div class="form-group row default_price" <?php if($data->is_variation == '1'): ?> style="display: none;" <?php endif; ?>>
                                    <label for="product_qty" class="col-sm-2 col-form-label"><?php echo e(trans('labels.qty')); ?></label>
                                    <div class="col-sm-10">
                                      <input type="text" class="form-control" id="product_qty" name="product_qty" placeholder="<?php echo e(trans('placeholder.product_qty')); ?>" value="<?php echo e($data->product_qty); ?>">
                                      <?php $__errorArgs = ['product_qty'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><span class="text-danger"><?php echo e($message); ?></span><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                    </div>
                                  </div>

                                  <div class="form-group row variation" <?php if($data->is_variation != '1'): ?> style="display: none;" <?php endif; ?>>
                                    <label for="attribute" class="col-sm-2 col-form-label"><?php echo e(trans('labels.attribute')); ?></label>
                                    <div class="col-sm-10">
                                      <select class="form-control" name="attribute" id="attribute">
                                          <option value=""><?php echo e(trans('placeholder.select_attribute')); ?></option>
                                          <?php $__currentLoopData = $attribute; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $attributes): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($attributes->id); ?>" <?php echo e($data->attribute == $attributes->id ? 'selected' : ''); ?>><?php echo e($attributes->attribute); ?></option>
                                          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                      </select>
                                      <?php $__errorArgs = ['attribute'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><span class="text-danger"><?php echo e($message); ?></span><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                    </div>
                                  </div>

                                  <div class="panel-body variation" <?php if($data->is_variation != '1'): ?> style="display: none;" <?php endif; ?>>

                                    <?php $__currentLoopData = $variations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ky => $variation): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <div class="row" id="del-<?php echo e($variation->id); ?>">
                                      <input type="hidden" name="variation_id[]" value="<?php echo e($variation->id); ?>">

                                      <div class="col-sm-3 nopadding">
                                        <div class="form-group">
                                          <label for="variation" class="col-form-label"><?php echo e(trans('labels.variation')); ?></label>
                                            <input type="text" class="form-control" name="variation[<?php echo e($ky); ?>]" id="variation" placeholder="Variation" value="<?php echo e($variation->variation); ?>">
                                        </div>
                                      </div>

                                      <div class="col-sm-3 nopadding">
                                        <div class="form-group">
                                          <label for="price" class="col-form-label"><?php echo e(trans('labels.price')); ?></label>
                                            <input type="text" class="form-control" id="price" name="price[<?php echo e($ky); ?>]" pattern="[0-9]+" placeholder="Price" value="<?php echo e($variation->price); ?>">
                                        </div>
                                      </div>

                                      <div class="col-sm-3 nopadding">
                                        <div class="form-group">
                                          <label for="discounted_variation_price" class="col-form-label"><?php echo e(trans('labels.discounted_price')); ?></label>
                                            <input type="text" class="form-control" id="discounted_variation_price" name="discounted_variation_price[<?php echo e($ky); ?>]" pattern="[0-9]+" placeholder="<?php echo e(trans('placeholder.discounted_price')); ?>" value="<?php echo e($variation->discounted_variation_price); ?>">
                                        </div>
                                      </div>

                                      <div class="col-sm-2 nopadding">
                                        <div class="form-group">
                                          <label for="qty" class="col-form-label"><?php echo e(trans('labels.qty')); ?></label>
                                          <input type="text" class="form-control" name="qty[<?php echo e($ky); ?>]" pattern="[0-9]+" id="qty" value="<?php echo e($variation->qty); ?>">
                                        </div>
                                      </div>

                                      <div class="col-sm-1 nopadding">
                                        <div class="form-group">
                                          <div class="input-group">
                                            <div class="input-group-btn pt-40">
                                              <a href="javascript:void(0);" class="danger p-0" data-original-title="<?php echo e(trans('labels.delete')); ?>" title="<?php echo e(trans('labels.delete')); ?>" onclick="do_delete('<?php echo e($variation->id); ?>','<?php echo e(route('admin.variation.delete')); ?>','<?php echo e(trans('labels.delete_a_variation')); ?>','<?php echo e(trans('labels.delete')); ?>')">
                                                  <i class="ft-trash font-medium-3"></i>
                                              </a>
                                            </div>
                                          </div>
                                        </div>
                                      </div>
                                    </div>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                    <!-- -------------------------------------- -->
                                    <div class="col-sm-1 nopadding">
                                      <div class="form-group">
                                        <div class="input-group">
                                          <div class="input-group-btn">
                                            <button class="btn btn-success" type="button"  onclick="variation_fields();"> + </button>
                                          </div>
                                        </div>
                                      </div>
                                    </div>

                                    <div class="clear"></div>

                                  </div>

                                  <div id="variation_fields"></div>

                                  <?php if(old('update')): ?>
                                    <?php
                                    $i = count($variations);
                                    ?>
                                    <?php $__currentLoopData = old('update'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $quty): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                      <input type="hidden" class="form-control" name="update[]" id="update">
                                      <div class="row removeclass<?php echo e($i); ?>">

                                      <div class="col-sm-3 nopadding">
                                        <div class="form-group">
                                          <label for="variation" class="col-form-label"><?php echo e(trans('labels.variation')); ?></label>
                                            <input type="text" class="form-control" name="variation[<?php echo e($i); ?>]" id="variation" placeholder="Variation">
                                            <?php if($errors->has('variation.'.$i)): ?>
                                                <span class="text-danger"><?php echo e(trans('labels.required')); ?></span>
                                            <?php endif; ?>
                                        </div>
                                      </div>

                                      <div class="col-sm-3 nopadding">
                                        <div class="form-group">
                                          <label for="price" class="col-form-label"><?php echo e(trans('labels.price')); ?></label>
                                            <input type="text" class="form-control" id="price" name="price[<?php echo e($i); ?>]" pattern="[0-9]+" placeholder="Price">
                                            <?php if($errors->has('price.'.$i)): ?>
                                                <span class="text-danger"><?php echo e(trans('labels.required')); ?></span>
                                            <?php endif; ?>
                                        </div>
                                      </div>

                                      <div class="col-sm-3 nopadding">
                                        <div class="form-group">
                                          <label for="discounted_variation_price" class="col-form-label"><?php echo e(trans('labels.discounted_price')); ?></label>
                                            <input type="text" class="form-control" id="discounted_variation_price" name="discounted_variation_price[<?php echo e($i); ?>]" pattern="[0-9]+" placeholder="<?php echo e(trans('placeholder.discounted_variation_price')); ?>">
                                            <?php if($errors->has('discounted_variation_price.'.$i)): ?>
                                                <span class="text-danger"><?php echo e(trans('labels.required')); ?></span>
                                            <?php endif; ?>
                                        </div>
                                      </div>

                                      <div class="col-sm-2 nopadding">
                                        <div class="form-group">
                                          <label for="qty" class="col-form-label"><?php echo e(trans('labels.qty')); ?></label>
                                          <input type="text" class="form-control" name="qty[<?php echo e($i); ?>]" pattern="[0-9]+" id="qty" value="<?php echo e(old('qty')[$i]); ?>">
                                          <?php if($errors->has('qty.'.$i)): ?>
                                              <span class="text-danger"><?php echo e(trans('labels.required')); ?></span>
                                          <?php endif; ?>
                                        </div>
                                      </div>

                                      <div class="col-sm-1 nopadding">
                                        <div class="form-group">
                                          <div class="input-group">
                                            <div class="input-group-btn pt-30">
                                              <button class="btn btn-danger" type="button" onclick="remove_variation_fields('<?php echo e($i); ?>');"> - </button>
                                            </div>
                                          </div>
                                        </div>
                                      </div>
                                      </div>
                                      <?php $i++; ?>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                  <?php endif; ?>

                                </div>
                            </div>
                        </div>

                        <div class="card">
                            <div class="card-header">
                                <h6 class="card-title mb-0">Product Description</h6>
                            </div>
                            <div class="card-body">
                                <div class="px-3">
                                  <div class="form-group row">
                                    <label for="description" class="col-sm-2 col-form-label"><?php echo e(trans('labels.description')); ?></label>
                                    <div class="col-sm-10">
                                      <textarea class="form-control" id="description" name="description" rows="8" placeholder="<?php echo e(trans('placeholder.description')); ?>"><?php echo e($data->description); ?></textarea>
                                      <?php if($errors->has('description')): ?>
                                          <span class="text-danger"><?php echo e($errors->first('description')); ?></span>
                                      <?php endif; ?>
                                    </div>
                                  </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-header">
                                <h6 class="card-title mb-0"><?php echo e(trans('labels.shipping_configuration')); ?></h6>
                            </div>
                            <div class="card-body">
                                <div class="px-3">

                                    <ul class="list-group list-group-flush">
                                      <li class="list-group-item border-none"><?php echo e(trans('labels.free_shipping')); ?>

                                        <span class="float-right">
                                          <input type="checkbox" class="big-checkbox" name="free_shipping" id="free_shipping" value="1"
                                          <?php if($data->free_shipping == '1'): ?> checked="true" <?php endif; ?>>
                                        </span>
                                      </li>
                                      <li class="list-group-item border-none"><?php echo e(trans('labels.flat_rate')); ?>

                                        <span class="float-right">
                                          <input type="checkbox" class="big-checkbox" name="flat_rate" id="flat_rate" value="1"
                                          <?php if(old('flat_rate') == '1'): ?> checked="true" <?php endif; ?> <?php if($data->flat_rate == '1'): ?> checked="true" <?php endif; ?>>
                                        </span>
                                      </li>

                                      <li class="list-group-item border-none flat_rate_shipping_div" <?php if($data->flat_rate == '2'): ?> style="display: none" <?php endif; ?>>
                                        <?php echo e(trans('labels.shipping_cost')); ?>

                                        <span class="float-right">
                                          <input type="text" class="form-control" id="shipping_cost" name="shipping_cost" placeholder="<?php echo e(trans('placeholder.shipping_cost')); ?>" value="<?php echo e($data->shipping_cost); ?>">
                                          <?php $__errorArgs = ['shipping_cost'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><span class="text-danger"><?php echo e($message); ?></span><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                        </span>
                                      </li>

                                    </ul>

                                </div>

                            </div>
                        </div>

                        <div class="card">
                            <div class="card-header">
                                <h6 class="card-title mb-0"><?php echo e(trans('labels.return_policy')); ?></h6>
                            </div>
                            <div class="card-body">
                                <div class="px-3">

                                    <ul class="list-group list-group-flush">
                                      <li class="list-group-item border-none"><?php echo e(trans('labels.is_return_available')); ?>

                                        <span class="float-right">
                                          <input type="checkbox" class="big-checkbox" name="is_return" id="is_return" value="1" <?php if(old('is_return') == "1"): ?> checked="" <?php endif; ?> <?php if($data->is_return == '1'): ?> checked="" <?php endif; ?>>
                                        </span>
                                      </li>
                                      <li class="list-group-item border-none is_return_div"  <?php if($data->is_return == '2'): ?> style="display: none" <?php endif; ?>>
                                        <?php echo e(trans('labels.days')); ?>

                                        <span class="float-right">
                                          <input type="text" class="form-control" id="return_days" name="return_days" placeholder="<?php echo e(trans('placeholder.return_days')); ?>" value="<?php echo e($data->return_days); ?>">
                                          <?php $__errorArgs = ['return_days'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><span class="text-danger"><?php echo e($message); ?></span><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                        </span>
                                      </li>
                                    </ul>

                                </div>
                            </div>
                        </div>

                        <div class="card">
                            <div class="card-header">
                                <h6 class="card-title mb-0"><?php echo e(trans('labels.featured')); ?></h6>
                            </div>
                            <div class="card-body">
                                <div class="px-3">

                                  <ul class="list-group list-group-flush">
                                    <li class="list-group-item border-none"><?php echo e(trans('labels.status')); ?>

                                      <span class="float-right">
                                        <input type="checkbox" class="big-checkbox" name="is_featured" id="is_featured" value="1" <?php if(old('is_featured') == '1'): ?> checked <?php endif; ?> <?php if($data->is_featured == '1'): ?> checked="" <?php endif; ?>>
                                      </span>
                                    </li>
                                  </ul>

                                </div>
                            </div>
                        </div>

                        <div class="card">
                            <div class="card-header">
                                <h6 class="card-title mb-0"><?php echo e(trans('labels.hot_deals')); ?></h6>
                            </div>
                            <div class="card-body">
                                <div class="px-3">

                                  <ul class="list-group list-group-flush">
                                    <li class="list-group-item border-none"><?php echo e(trans('labels.status')); ?>

                                      <span class="float-right">
                                        <input type="checkbox" class="big-checkbox" name="is_hot" id="is_hot" value="1" <?php if(old('is_hot') == '1'): ?> checked <?php endif; ?> <?php if($data->is_hot == '1'): ?> checked="" <?php endif; ?>>
                                      </span>
                                    </li>
                                  </ul>

                                </div>
                            </div>
                        </div>

                        <div class="card">
                            <div class="card-header">
                                <h6 class="card-title mb-0"><?php echo e(trans('labels.low_stoke_qty_warning')); ?></h6>
                            </div>
                            <div class="card-body">
                                <div class="px-3">
                                    <div class="form-group row">
                                      <label for="available_stock" class="col-sm-4 col-form-label">Quantity</label>
                                      <div class="col-sm-8">
                                        <input type="text" class="form-control" id="available_stock" name="available_stock" placeholder="<?php echo e(trans('placeholder.available_stock')); ?>" value="<?php echo e($data->available_stock); ?>">
                                        <?php $__errorArgs = ['available_stock'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><span class="text-danger"><?php echo e($message); ?></span><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                      </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card">
                            <div class="card-header">
                                <h6 class="card-title mb-0"><?php echo e(trans('labels.estimate_shipping_time')); ?></h6>
                            </div>
                            <div class="card-body">
                                <div class="px-3">
                                    <div class="form-group row">
                                      <label for="est_shipping_days" class="col-sm-4 col-form-label"><?php echo e(trans('labels.days')); ?></label>
                                      <div class="col-sm-8">
                                        <input type="text" class="form-control" id="est_shipping_days" name="est_shipping_days" placeholder="<?php echo e(trans('placeholder.est_shipping_days')); ?>" value="<?php echo e($data->est_shipping_days); ?>">
                                        <?php $__errorArgs = ['est_shipping_days'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><span class="text-danger"><?php echo e($message); ?></span><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                      </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card">
                            <div class="card-header">
                                <h6 class="card-title mb-0"><?php echo e(trans('labels.vat_and_tax')); ?></h6>
                            </div>
                            <div class="card-body">
                                <div class="px-3">
                                    <div class="form-group row">
                                      <label for="tax" class="col-sm-4 col-form-label"><?php echo e(trans('labels.vat')); ?></label>
                                      <div class="col-sm-8">
                                        <input type="text" class="form-control" id="tax" name="tax" placeholder="<?php echo e(trans('placeholder.tax')); ?>" value="<?php echo e($data->tax); ?>">
                                        <?php $__errorArgs = ['tax'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><span class="text-danger"><?php echo e($message); ?></span><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                        <select class="form-control mt-3" name="tax_type" id="tax_type">
                                            <option value="amount" <?php echo e($data->tax_type == 'amount' ? 'selected' : ''); ?>>Flat</option>
                                            <option value="percent" <?php echo e($data->tax_type == 'percent' ? 'selected' : ''); ?>>Percent</option>
                                        </select>
                                      </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="text-left">
                    <a href="<?php echo e(route('admin.products')); ?>" class="btn btn-raised btn-warning mr-1">
                        <i class="ft-x"></i> <?php echo e(trans('labels.cancel')); ?>

                    </a>
                    <?php if(env('Environment') == 'sendbox'): ?>
                        <button type="button" class="btn btn-raised btn-primary" onclick="myFunction()"> <i class="fa fa-check-square-o"></i> <?php echo e(trans('labels.update')); ?></button>
                    <?php else: ?>
                        <button type="submit" id="btn_add_category" class="btn btn-raised btn-primary"> <i class="fa fa-check-square-o"></i> <?php echo e(trans('labels.update')); ?></button>
                    <?php endif; ?>
                </div>
            </form>
        </section>

        <section id="header-footer">
          <div class="row">
            <div class="col-12 mt-3 mb-1">
              <button class="btn btn-raised btn-success" data-toggle="modal" data-target="#AddProduct"><?php echo e(trans('labels.new_images')); ?></button>
            </div>
          </div>
          <div class="row match-height">
            <?php $__currentLoopData = $images; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $img): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="col-lg-3 col-md-6">
              <div class="card">
                <div class="card-body">
                  <div class="card-img mt-3">
                    <img class="card-img img-fluid mb-3 w-50" src="<?php echo e($img->image_url); ?>" alt="Product Images">
                  </div>
                </div>
                <div class="card-footer border-top-blue-grey border-top-lighten-5 text-muted">
                  <span class="tags float-right">
                    <span class="badge bg-success white" onClick="EditDocument('<?php echo e($img->id); ?>')"><?php echo e(trans('labels.update')); ?></span>
                    <?php if(env('Environment') == 'sendbox'): ?>
                        <span class="badge bg-danger white" onclick="myFunction()"><?php echo e(trans('labels.delete')); ?></span>
                    <?php else: ?>
                        <span class="badge bg-danger white" onclick="DeleteImage('<?php echo e($img->id); ?>','<?php echo e($img->product_id); ?>')"><?php echo e(trans('labels.delete')); ?></span>
                    <?php endif; ?>
                  </span>
                </div>
              </div>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
          </div>
        </section>
    </div>

<?php $__env->stopSection(); ?>

<!-- Add Item Image -->
<div class="modal fade" id="AddProduct" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form method="post" action="<?php echo e(route('admin.products.storeimages')); ?>" class="addproduct" enctype="multipart/form-data">
          <?php echo csrf_field(); ?>
            <span id="msg"></span>
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"><?php echo e(trans('labels.images')); ?></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="<?php echo e(trans('labels.close')); ?>"><span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <span id="iiemsg"></span>
                <div class="modal-body">
                    <input type="hidden" name="pro_id" id="pro_id" value="<?php echo e($data->id); ?>">
                    <div class="form-group">
                        <label for="colour" class="col-form-label"><?php echo e(trans('labels.images')); ?>:</label>
                        <input type="file" multiple="true" class="form-control" name="file[]" id="file" accept="image/*" required="">
                    </div>
                    <div class="gallery"></div>

                    <input type="hidden" name="itemid" id="itemid" value="<?php echo e(request()->route('id')); ?>">

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal"><?php echo e(trans('labels.close')); ?></button>
                    <?php if(env('Environment') == 'sendbox'): ?>
                        <button type="button" class="btn btn-primary" onclick="myFunction()"><?php echo e(trans('labels.save')); ?></button>
                    <?php else: ?>
                        <button type="submit" name="submit" id="submit" class="btn btn-primary"><?php echo e(trans('labels.save')); ?></button>
                    <?php endif; ?>
                </div>
            </div>
        </form>
    </div>
</div>
<?php $__env->startSection('scripttop'); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('script'); ?>
<script type="text/javascript">
  var variationdata = 0;

  $(document).ready(function(){
    var counter = document.getElementById('counter');
    variationdata = "<?php echo e(old('update') ? count(old('update')) + count($variations) : count($variations)); ?>";

    console.log(variationdata);
  });

  function variation_fields() {

        var objTo = document.getElementById('variation_fields')
        var divtest = document.createElement("div");
        divtest.setAttribute("class", "form-group removeclass"+variationdata);
        var rdiv = 'removeclass'+variationdata;
        divtest.innerHTML = '<input type="hidden" class="form-control" name="update[]" id="update"><div class="row panel-body variation"><div class="col-sm-3 nopadding"> <div class="form-group"> <label for="variation" class="col-form-label">Variation</label> <input type="text" class="form-control" name="variation['+ variationdata +']" id="variation" placeholder="Variation" > </div></div><div class="col-sm-3 nopadding"> <div class="form-group"> <label for="price" class="col-form-label">Price</label> <input type="text" class="form-control" id="price" name="price['+ variationdata +']" pattern="[0-9]+" placeholder="Price" > </div></div><div class="col-sm-3 nopadding"> <div class="form-group"> <label for="discounted_variation_price" class="col-form-label">Discounted Price</label> <input type="text" class="form-control" id="discounted_variation_price" name="discounted_variation_price['+ variationdata +']" pattern="[0-9]+" placeholder="<?php echo e(trans('placeholder.discounted_price')); ?>"> </div></div><div class="col-sm-2 nopadding"> <div class="form-group"> <label for="qty" class="col-form-label"><?php echo e(trans('labels.qty')); ?></label> <input type="text" class="form-control" name="qty['+ variationdata +']" pattern="[0-9]+" id="qty"> </div></div><div class="col-sm-1 nopadding"> <div class="form-group"> <div class="input-group"> <div class="input-group-btn pt-30"> <button class="btn btn-danger" type="button" onclick="remove_variation_fields('+ variationdata +');"> - </button> </div></div></div></div><div class="clear"></div></div>';
      // counter.innerHTML = variationdata;
      variationdata++;
      objTo.appendChild(divtest)
  }
  function remove_variation_fields(rid) {
     $('.removeclass'+rid).remove();
  }

  jQuery(document).ready(function($) {
      $("#cat_id").change(function () {
          var cat_id = $("#cat_id").val();
          jQuery.ajax({
              headers: {
                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
              },
              type:'POST',
              url:"<?php echo e(route('admin.products.subcat')); ?>",
              data:{
              'cat_id':cat_id
              },
              dataType: "json",
              success: function(response) {
                  let html ='';
                  html = '<option value=""><?php echo e(trans('placeholder.select_subcategory')); ?></option>';
                  for(i in response){
                      html+='<option value="'+response[i].id+'">'+response[i].subcategory_name+'</option>'
                  }
                  $('#subcat_id').html(html);
              },
          });
      });

      $("#subcat_id").change(function () {
          var subcat_id = $("#subcat_id").val();
          jQuery.ajax({
              headers: {
                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
              },
              type:'POST',
              url:"<?php echo e(route('admin.products.innersubcat')); ?>",
              data:{
              'subcat_id':subcat_id
              },
              dataType: "json",
              success: function(response) {
                  let html ='';
                  html = '<option value=""><?php echo e(trans('placeholder.select_innersubcategory')); ?></option>';
                  for(i in response){
                      html+='<option value="'+response[i].id+'">'+response[i].innersubcategory_name+'</option>'
                  }
                  $('#innersubcat_id').html(html);
              },
          });
      });
  });

  $(document).ready(function(){
      $('.is_variation').change(function(){
          if(this.checked) {
              $('.variation').fadeIn('slow');
              $('.default_price').fadeOut('slow');
          } else {
              $('.variation').fadeOut('slow');
              $('.default_price').fadeIn('slow');
          }
      });
  });

  $(document).ready(function(){

      $("#free_shipping").on("change",function(){
          $('#flat_rate').prop('checked', false); // Unchecks it
          $(".flat_rate_shipping_div").hide();
      });

      $("#flat_rate").on('change', function() {
          if ($(this).is(':checked')) {
            $(".flat_rate_shipping_div").show();
            $('#free_shipping').prop('checked', false); // Unchecks it
          }
          else {
            $('#free_shipping').prop('checked', false); // Unchecks it
            $(".flat_rate_shipping_div").hide();
          }
      });

      $("#is_return").on('change', function() {
          if ($(this).is(':checked')) {
              $(".is_return_div").show();
              // $('#free_shipping').prop('checked', false); // Unchecks it
          }
          else {
             $(".is_return_div").hide();
          }
      });

      $('#editimg').on('submit', function(event){
          event.preventDefault();
          var form_data = new FormData(this);
          $('#preloader').show();
          $.ajax({
            url:"<?php echo e(route('admin.products.updateimage')); ?>",
              method:'POST',
              data:form_data,
              cache: false,
              contentType: false,
              processData: false,
              dataType: "json",
              success: function(result) {
                  $('#preloader').hide();
                  var msg = '';
                  if(result.ResponseCode == 1)
                  {
                    location.reload();
                  }
                  else
                  {
                    for(var count = 0; count < result.error.length; count++)
                    {
                        msg += '<div class="alert alert-danger">'+result.error[count]+'</div>';
                    }
                    $('#emsg').html(msg);
                    setTimeout(function(){
                      $('#emsg').html('');
                    }, 5000);
                  }
              },
          });
      });
  });

  function do_delete(id,page_name,name,titles)
  {
      Swal.fire({
          title: '<?php echo e(trans('labels.are_you_sure')); ?>',
          text: "<?php echo e(trans('labels.delete_text')); ?> "+name+"!",
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
                  url: page_name,
                  type: "POST",
                  data : {'id':id},

                  success:function(data)
                  {
                      $('#preloader').hide();
                      if(data == 1000)
                      {
                        console.log('#del-'+id);
                          $('#del-'+id).remove();
                          Swal.fire({type: 'success',title: '<?php echo e(trans('labels.success')); ?>',showConfirmButton: false,timer: 1500});
                      }
                      else
                      {
                          Swal.fire({type: 'error',title: '<?php echo e(trans('labels.cancelled')); ?>',showConfirmButton: false,timer: 1500});
                      }
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

  }

  function EditDocument(id) {
      $('#preloader').show();
      $.ajax({
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          },
          url:"<?php echo e(route('admin.products.showimage')); ?>",
          data: {
              id: id
          },
          method: 'POST', //Post method,
          dataType: 'json',
          success: function(response) {
              $('#preloader').hide();
              jQuery("#EditImages").modal('show');
              $('#idd').val(response.ResponseData.id);
              $('.galleryim').html("<img src="+response.ResponseData.img+" class='img-fluid' style='max-height: 200px;'>");
              $('#old_img').val(response.ResponseData.image);
          },
          error: function(error) {
              $('#preloader').hide();
          }
      })
  }

  function DeleteImage(id,product_id) {
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
                  url: '<?php echo e(route("admin.products.destroyimage")); ?>',
                  type: "POST",
                  data : {'id':id,'product_id':product_id},
                  success:function(data)
                  {
                    $('#preloader').hide();
                    if(data == 1)
                    {
                        location.reload();
                    }
                    if(data == 2)
                    {
                        Swal.fire({type: 'error',title: '<?php echo e(trans('labels.cancelled')); ?>',text: "You can't delete this image", showConfirmButton: false,timer: 1500});
                    }
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
  }
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\eglobalmart\resources\views/Admin/products/show.blade.php ENDPATH**/ ?>