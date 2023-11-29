<?php $__env->startSection('title'); ?>
    Dashboard
<?php $__env->stopSection(); ?>
<style type="text/css">
    .chart {
        width: 100%;
        min-height: 450px;
    }
</style>
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

        <!--Statistics cards Starts-->

        <div class="row">
            
            <input type="hidden" name="role" id="role" value="<?php echo e(Auth::user()->type); ?>">
            <div class="col-xl-3 col-lg-6 col-12">
                <div class="card bg-primary">
                    <div class="card-body">
                        <div class="px-3 py-3">
                            <a href="<?php echo e(route('admin.transaction.history')); ?>">
                            <div class="media">
                                <div class="media-left align-self-center">
                                    <i class="icon-graph white font-large-2 float-left"></i>
                                </div>
                                <div class="media-body white text-right">


                                        <!--<?php echo e(Helper::getwalletbalance(Auth::user()->id)); ?>-->


                                           <?php if(Auth::user()->type == 1): ?>

                                                                  <?php
                                            $final_ammount = Helper::CurrencyFormatter(Helper::getwalletbalance(Auth::user()->id,false) + $ttl1stStarexpens_Amount + $ttl2ndStarexpens_Amount + $ttl3rdStarexpens_Amount);
                                        ?>
                                          <h3>  <?php echo e($final_ammount); ?></h3>
                                        <span>Your Balance</span>

                                    <?php elseif(Auth::user()->type == 3): ?>
                                    <?php echo e(Helper::getwalletbalance(Auth::user()->id)); ?>

                                        <span>Cash Wallet</span>

                                    <?php endif; ?>
                                </div>
                            </div>
                        </a>
                        </div>
                    </div>
                </div>
            </div>
            <?php if(Auth::user()->type == 1): ?>

            <div class="col-xl-3 col-lg-6 col-12">
                <div class="card" style="background-color: #FF7F50">
                    <div class="card-body">
                        <div class="px-3 py-3">
                            <a href="<?php echo e(route('admin.sales.history')); ?>">
                            <div class="media">
                                <div class="media-left align-self-center">
                                    <i class="fa fa-list-alt white font-large-2 float-right"></i>
                                </div>
                                <div class="media-body white text-right">
                                    <h3><?php echo e(Helper::getCashWallet(Auth::user()->id)); ?></h3>
                                    <span>Cash Wallet </span>
                                </div>
                            </div>
                        </a>
                        </div>
                    </div>
                </div>
            </div>
            <?php endif; ?>
            <div class="col-xl-3 col-lg-6 col-12">
                <div class="card bg-success">
                    <div class="card-body">
                        <div class="px-3 py-3">
                            <div class="media">
                                <div class="media-left align-self-center">
                                    <i class="icon-pie-chart white font-large-2 float-left"></i>
                                </div>
                                <div class="media-body white text-right">
                                    <h3><?php echo e(Helper::CurrencyFormatter($ttlvalueofsales)); ?></h3>
                                    <span><?php echo e(trans('labels.total_value_of_sales')); ?></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-lg-6 col-12">
                <div class="card" style="background-color: #58a445">
                    <div class="card-body">
                        <div class="px-3 py-3">
                            <a href="<?php echo e(route('admin.product.wise.income')); ?>">
                                <div class="media">
                                    
                                    <div class="media-body white text-left">
                                        <?php if(Auth::user()->type == 1): ?>
                                            <h3 class="font-large-1 mb-0">
                                                <?php echo e(Helper::CurrencyFormatter($total_income)); ?></h3>
                                        <?php else: ?>
                                            <h3 class="font-large-1 mb-0">
                                                <?php echo e(Helper::CurrencyFormatter($total_income->profit)); ?></h3>
                                        <?php endif; ?>
                                        <span><?php echo e(trans('labels.product_wise_income')); ?></span>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <?php if(Auth::user()->type == 3 && $ttlstockiestAmount > 0): ?>
                <div class="col-xl-3 col-lg-6 col-12">
                    <div class="card bg-primary">
                        <div class="card-body">
                            <div class="px-3 py-3">
                                <a href="<?php echo e(route('admin.sales')); ?>">
                                <div class="media">
                                    <div class="media-body white text-left">
                                        <h3 class="font-large-1 mb-0"><?php echo e($ttlstockiestAmount); ?></h3>
                                        <span>Total Stockiest</span>
                                    </div>
                                    <div class="media-right align-self-center">
                                        <i class="fa fa-list-alt white font-large-2 float-right"></i>
                                    </div>
                                </div>
                            </a>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endif; ?>

             <?php if(Auth::user()->type == 2): ?>
                <div class="col-xl-3 col-lg-6 col-12">
                    <div class="card bg-primary">
                        <div class="card-body">
                            <div class="px-3 py-3">

                                <div class="media">
                                    <div class="media-body white text-left">
                                        <h3 class="font-large-1 mb-0"><?php echo e(count($ttlproducts)); ?></h3>
                                        <span><?php echo e(trans('labels.total_products')); ?></span>
                                    </div>
                                    <div class="media-right align-self-center">
                                        <i class="fa fa-list-alt white font-large-2 float-right"></i>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            <?php endif; ?>

            <?php if(Auth::user()->type == 1): ?>
                <div class="col-xl-3 col-lg-6 col-12">
                    <div class="card" style="background-color: #22127f">
                        <div class="card-body">
                            <div class="px-3 py-3">
                                <a href="<?php echo e(route('admin.expense.index')); ?>">
                                    <div class="media">
                                        <div class="media-body white text-left">
                                            <h3 class="font-large-1 mb-0"><?php echo e(Helper::CurrencyFormatter($total_expense->totalAmount)); ?></h3>
                                            <span>Expense</span>
                                        </div>
                                        <div class="media-right align-self-center">
                                            <i class="fa fa-users white font-large-2 float-right"></i>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-6 col-12">
                    <div class="card bg-warning">
                        <div class="card-body">
                            <div class="px-3 py-3">
                                <a href="<?php echo e(route('admin.stockiest')); ?>">
                                    <div class="media">
                                        <div class="media-body white text-left">
                                            <h3 class="font-large-1 mb-0"><?php echo e(count($ttlstockiest)); ?></h3>
                                            <span><?php echo e(trans('labels.total_stockiest')); ?></span>
                                        </div>
                                        <div class="media-right align-self-center">
                                            <i class="fa fa-users white font-large-2 float-right"></i>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-3 col-lg-6 col-12">
                    <div class="card" style="background-color: #9a227e">
                        <div class="card-body">
                            <div class="px-3 py-3">
                                <a href="<?php echo e(route('admin.vendors')); ?>">
                                    <div class="media">
                                        <div class="media-left align-self-center">
                                            <i class="icon-users white font-large-2 float-left"></i>
                                        </div>
                                        <div class="media-body white text-right">
                                            <h3><?php echo e(count($ttlvendors)); ?></h3>
                                            <span><?php echo e(trans('labels.total_vendors')); ?></span>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-3 col-lg-6 col-12">
                    <div class="card" style="background-color: #1D8348">
                        <div class="card-body">
                            <div class="px-3 py-3">
                                <a href="<?php echo e(route('admin.users')); ?>">
                                    <div class="media">
                                        <div class="media-body white text-left">
                                            <h3 class="font-large-1 mb-0"><?php echo e(count($ttlusers)); ?></h3>
                                            <span><?php echo e(trans('labels.total_customers')); ?></span>
                                        </div>
                                        <div class="media-right align-self-center">
                                            <i class="fa fa-users white font-large-2 float-right"></i>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-6 col-12">
                    <div class="card" style="background-color: #9ce013">
                        <div class="card-body">
                            <div class="px-3 py-3">
                                
                                    <div class="media">
                                        <div class="media-body white text-left">
                                            <h3 class="font-large-1 mb-0"><?php echo e(Helper::CurrencyFormatter($ttlboostingCharge->boostChargr)); ?></h3>
                                            <span>Boosting Charge</span>
                                        </div>
                                        <div class="media-right align-self-center">
                                            
                                        </div>
                                    </div>
                                
                            </div>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
            <div class="col-xl-3 col-lg-6 col-12">
                <div class="card bg-secondary">
                    <div class="card-body">
                        <div class="px-3 py-3">
                            <a href="<?php echo e(route('admin.order.delivery')); ?>">
                                <div class="media">
                                    <div class="media-body white text-left">
                                        <h3 class="font-large-1 mb-0"><?php echo e(count($ttlDelivered)); ?></h3>
                                        <span><?php echo e(trans('labels.total_delivered')); ?></span>
                                    </div>
                                    <div class="media-right align-self-center">
                                        <i class="fa fa-users white font-large-2 float-right"></i>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-lg-6 col-12">
                <div class="card bg-success">
                    <div class="card-body">
                        <div class="px-3 py-3">
                            <a href="<?php echo e(route('admin.orders')); ?>">
                                <div class="media">
                                    <div class="media-body white text-left">
                                        <h3 class="font-large-1 mb-0"><?php echo e(count($ttlorders)); ?></h3>
                                        <span><?php echo e(trans('labels.total_orders')); ?></span>
                                    </div>
                                    <div class="media-right align-self-center">
                                        <i class="fa fa-shopping-cart white font-large-2 float-right"></i>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>



            <div class="col-xl-3 col-lg-6 col-12">
                <div class="card bg-danger">
                    <div class="card-body">
                        <div class="px-3 py-3">
                            <a href="<?php echo e(route('admin.returnorders')); ?>">
                                <div class="media">
                                    <div class="media-body white text-left">
                                        <h3 class="font-large-1 mb-0"><?php echo e(count($ttlreturn)); ?></h3>
                                        <span><?php echo e(trans('labels.total_return_orders')); ?></span>
                                    </div>
                                    <div class="media-right align-self-center">
                                        <i class="fa fa-undo white font-large-2 float-right"></i>
                                    </div>
                                </div>
                            </a>

                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-lg-6 col-12">
                <div class="card" style="background-color: #562d11">
                    <div class="card-body">
                        <div class="px-3 py-3">
                            <a href="<?php echo e(route('admin.order.cancel')); ?>">
                                <div class="media">
                                    <div class="media-body white text-left">
                                        <h3 class="font-large-1 mb-0"><?php echo e(count($ttlcancel)); ?></h3>
                                        <span><?php echo e(trans('labels.total_cancel_orders')); ?></span>
                                    </div>
                                    <div class="media-right align-self-center">
                                        <i class="fa fa-times white font-large-2 float-right"></i>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-lg-6 col-12">
                <div class="card" style="background-color: #a4a245">
                    <div class="card-body">
                        <div class="px-3 py-3">
                            <div class="media">
                                <div class="media-left align-self-center">
                                    <i class="icon-wallet white font-large-2 float-left"></i>
                                </div>
                                <div class="media-body white text-right">
                                    <h3><?php echo e(count($ttlpayrequest)); ?></h3>
                                    <span><?php echo e(trans('labels.total_payout_request')); ?></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-lg-6 col-12">
                <div class="card" style="background-color: #4c32e1">
                    <div class="card-body">
                        <div class="px-3 py-3">
                            <a href="<?php echo e(route('admin.product.wise.income')); ?>">
                                <h4 class="text-light"><?php echo e(trans('labels.total_delivey_charge')); ?></h4>
                                <div class="media ">
                                    <div class="media-body white text-right">
                                        <?php if(Auth::user()->type == 1): ?>
                                            <span class="mb-0">
                                                <?php echo e(Helper::CurrencyFormatter($total_delivery_charge->deliveryCharge + $total_return_delivery_charge->deliveryCharge)); ?>

                                            </span>
                                        <?php else: ?>
                                            <span class="mb-0">
                                                <?php echo e(Helper::CurrencyFormatter($total_delivery_charge->deliveryCharge + $total_return_delivery_charge->deliveryCharge)); ?>

                                            </span>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <?php if(Auth::user()->type == 1 && $fund_titles_length > 0): ?>
                
                <?php
                    // $title=['','#C81149','#239B56','#45B39D','#BB8FCE','#E74C3C','#E59866 ','#CD5C5C','#FF7F50','#DE3163','#6495ED','#40E0D0','#9FE2BF']
                    $color_array = ['#C70039', '#C81149', '#239B56', '#45B39D', '#BB8FCE', '#E74C3C', '#E59866 ', '#CD5C5C', '#FF7F50', '#DE3163', '#6495ED', '#40E0D0', '#9FE2BF'];
                ?>

                <div class="col-xl-3 col-lg-6 col-12">
                    <div class="card" style="background-color: #C70039">
                        <div class="card-body">
                            <div class="px-3 py-3">
                                <div class="media">
                                    
                                    <div class="media-body white text-right">
                                        <h3>1st Generation</h3>

                                        <span><?php echo e(Helper::CurrencyFormatter($total_1st_generation->tamount)); ?></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                 <div class="col-xl-3 col-lg-6 col-12">
                    <div class="card" style="background-color: #C81149">
                        <div class="card-body">
                            <div class="px-3 py-3">
                                <div class="media">
                                    
                                    <div class="media-body white text-right">
                                        <h3>2nd Generation</h3>
                                        <span><?php echo e(Helper::CurrencyFormatter($total_2nd_generation->tamount)); ?></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-3 col-lg-6 col-12">
                    <div class="card" style="background-color: #239B56">
                        <div class="card-body">
                            <div class="px-3 py-3">
                                <div class="media">
                                    
                                    <div class="media-body white text-right">
                                        <h3>3rd Generation</h3>
                                        <span><?php echo e(Helper::CurrencyFormatter($total_3rd_generation->tamount)); ?></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-3 col-lg-6 col-12">
                    <div class="card" style="background-color: #45B39D">
                        <div class="card-body">
                            <div class="px-3 py-3">
                                <div class="media">
                                    
                                    <div class="media-body white text-right">
                                        <h3>1st Star</h3>
                                        <span><?php echo e(Helper::CurrencyFormatter($ttl1stStarexpens_Amount)); ?></span>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-6 col-12">
                    <div class="card" style="background-color: #BB8FCE">
                        <div class="card-body">
                            <div class="px-3 py-3">
                                <div class="media">
                                    
                                    <div class="media-body white text-right">
                                        <h3>2nd Star</h3>
                                        <span><?php echo e(Helper::CurrencyFormatter($ttl2ndStarexpens_Amount)); ?></span>
                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-3 col-lg-6 col-12">
                    <div class="card" style="background-color: #E74C3C">
                        <div class="card-body">
                            <div class="px-3 py-3">
                                <div class="media">
                                    
                                    <div class="media-body white text-right">
                                        <h3>3rd Star</h3>
                                        <span><?php echo e(Helper::CurrencyFormatter($ttl3rdStarexpens_Amount)); ?></span>
                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-6 col-12">
                    <div class="card" style="background-color: #E59866">
                        <div class="card-body">
                            <div class="px-3 py-3">
                                <div class="media">
                                    
                                    <div class="media-body white text-right">
                                        <h3>Health Fund</h3>
                                        <span><?php echo e(Helper::CurrencyFormatter($ttlHealthexpens_Amount)); ?></span>
                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-3 col-lg-6 col-12">
                    <div class="card" style="background-color: #FF7F50">
                        <div class="card-body">
                            <div class="px-3 py-3">
                                <div class="media">
                                    
                                    <div class="media-body white text-right">
                                        <h3>Pension Fund</h3>
                                        <span><?php echo e(Helper::CurrencyFormatter($ttlPensionexpens_Amount)); ?></span>
                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-3 col-lg-6 col-12">
                    <div class="card" style="background-color: #CD5C5C">
                        <div class="card-body">
                            <div class="px-3 py-3">
                                <div class="media">
                                    
                                    <div class="media-body white text-right">
                                        <h3>Religion Fund</h3>
                                        <span><?php echo e(Helper::CurrencyFormatter($ttlReligionexpens_Amount)); ?></span>
                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-3 col-lg-6 col-12">
                    <div class="card" style="background-color: #E74C3C">
                        <div class="card-body">
                            <div class="px-3 py-3">
                                <div class="media">
                                    
                                    <div class="media-body white text-right">
                                        <h3>Poor helping Fund</h3>
                                        <span><?php echo e(Helper::CurrencyFormatter($ttlPoorexpens_Amount)); ?></span>
                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-3 col-lg-6 col-12">
                    <div class="card" style="background-color: #CD5C5C">
                        <div class="card-body">
                            <div class="px-3 py-3">
                                <div class="media">
                                    
                                    <div class="media-body white text-right">
                                        <h3>Incentive</h3>
                                        <span><?php echo e(Helper::CurrencyFormatter($ttlexpens_amount)); ?></span>
                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-3 col-lg-6 col-12">
                    <div class="card bg-dark">
                        <div class="card-body">
                            <div class="px-3 py-3">
                                
                                    <div class="media">
                                        <div class="media-left align-self-center">
                                            <i class="fa fa-user white font-large-2 float-right"></i>

                                        </div>
                                        <div class="media-body white text-right">
                                            <h3><?php echo e(Helper::CurrencyFormatter($total_stockiest_amount->stockiest)); ?></h3>
                                            
                                            <span>Total Stockiest Amount</span>
                                        </div>
                                    </div>
                                

                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-3 col-lg-6 col-12">
                    <div class="card bg-success">
                        <div class="card-body">
                            <div class="px-3 py-3">
                                <a href="<?php echo e(route('admin.commission.distribution')); ?>">
                                    <div class="media">
                                        <div class="media-left align-self-center">
                                            <i class="fa fa-eye white font-large-2 float-right"></i>
                                        </div>
                                        <div class="media-body white text-right">
                                            <h3><?php echo e(Helper::CurrencyFormatter($total_commission->commission)); ?></h3>
                                            <span><?php echo e(trans('labels.total_generation')); ?></span>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endif; ?>


        </div>

        <div class="row match-height">
            <?php if(Auth::user()->type == 3): ?>
                <div class="col-xl-12 col-lg-12 col-12">

                    <div class="card-content collpase show">
                        <div class="card-body ">

                            <div class="form-group row">
                                <p id="" class="d-none">
                                    <?php echo url(''); ?>/vendor-ref-signup/<?php echo e(Auth::user()->referral_code); ?></p>
                                <input type="text" class="form-control referral_css_mobile  referral_css_desktop"
                                    id="myInput"
                                    value="<?php echo url(''); ?>/vendor-ref-signup/<?php echo e(Auth::user()->referral_code); ?>"
                                    readonly /> &nbsp;
                                <button onclick="copyText()"
                                    class="w-50
                                d-block mx-auto mt-1 btn btn_copy waves-effect waves-light">
                                    <i class="fa fa-copy"> Copy Link</i>

                                    

                                </button>

                                <!-- The button used to copy the text -->
                            </div>

                            <!-- ---------  referral link search box -=--- -->

                        </div>
                    </div>

                </div>
            <?php endif; ?>


            <div class="col-xl-4 col-lg-12 col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Statistics</h4>
                    </div>
                    <div class="card-body">

                        <p class="font-medium-2 text-muted text-center pb-2">Last 6 Months Sales</p>
                        <div id="piechart" class="height-300 Stackbarchart mb-2">
                        </div>

                    </div>
                </div>
            </div>
            <div class="col-xl-8 col-lg-12 col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">New orders</h4>
                    </div>
                    <div class="card-body">
                        <table id="e-global-table1" class="table table-responsive-sm text-center table-striped">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th class="text-center"><?php echo e(trans('labels.vendor_name')); ?></th>
                                    <th class="text-center"><?php echo e(trans('labels.order_number')); ?></th>
                                    <th class="text-center"><?php echo e(trans('labels.no_of_products')); ?></th>
                                    <th class="text-center"><?php echo e(trans('labels.customer')); ?></th>
                                    <th class="text-center"><?php echo e(trans('labels.order_total')); ?></th>
                                    
                                    <th class="text-center"><?php echo e(trans('labels.date')); ?></th>
                                    <th class="text-center"><?php echo e(trans('labels.action')); ?></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $n=0 ?>
                                <?php $__empty_1 = true; $__currentLoopData = $datas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                    <tr id="del-<?php echo e($row->id); ?>">
                                        <td class="text-center"><?php echo e(++$n); ?></td>
                                        <td class="text-center">
                                            <?php echo e($row['vendors'] ? ($row['vendors']->name ? $row['vendors']->name : '') : ''); ?>

                                        </td>
                                        <td class="text-center"><?php echo e($row->order_number); ?></td>
                                        <td class="text-center"><?php echo e($row->no_products); ?></td>
                                        <td class="text-center"><?php echo e($row->full_name); ?></td>
                                        <td class="text-center"><?php echo e(Helper::CurrencyFormatter($row->grand_total)); ?></td>
                                        
                                        <td class="text-center"><?php echo e($row->date); ?></td>
                                        <td class="text-center">
                                            <a href="<?php echo e(URL::to('admin/orders/order-details/' . $row->order_number)); ?>"
                                                class="success p-0" data-original-title="<?php echo e(trans('labels.view')); ?>"
                                                title="<?php echo e(trans('labels.view')); ?>">
                                                <span class="badge badge-warning">View</span>
                                            </a>
                                        </td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <?php if(Auth::user()->type == 1): ?>
        <div class="row match-height">
            <div class="col-xl-6 col-lg-12 col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title mb-0">Monthly orders</h4>

                    </div>
                    <div class="card-body">

                        <div class="card-block">
                            <div class="cart-body">
                                <table class="table table-striped table-bordered zero-configuration">
                                    <thead>
                                        <tr>
                                            <th>Title</th>
                                            <th>No</th>
                                            <th>Amount</th>

                                        </tr>
                                    </thead>
                                    <tbody>


                                    <tr>
                                        <td class="text-success"> Placed Order </td>
                                        <td class="font-weight-bold"><?php echo e($totalPlacedOrder); ?></td>
                                        <td class="font-weight-bold"><?php echo e($totalPlaceAmount); ?></td>
                                    </tr>
                                    <tr>
                                        <td class="text-secondary"> Confirmed Order </td>
                                        <td class="font-weight-bold"><?php echo e($totalConfirmOrder); ?></td>
                                        <td class="font-weight-bold"><?php echo e($totalConfirmAmount); ?></td>
                                    </tr>
                                    <tr>
                                        <td class="text-warning">Shipped Order</td>
                                        <td class="font-weight-bold"><?php echo e($totalShippedOrder); ?></td>
                                        <td class="font-weight-bold"><?php echo e($totalShippedAmount); ?></td>
                                    </tr>
                                    <tr>
                                        <td class="text-success">Order Delivered</td>
                                        <td class="font-weight-bold"><?php echo e($totalDeleveredOrder); ?></td>
                                        <td class="font-weight-bold"><?php echo e($totalDeleveredAmount); ?></td>
                                    </tr>
                                    <tr>
                                        <td>Cancel By Vendor</td>
                                        <td class="font-weight-bold"><?php echo e($totalCancelByVendorOrder); ?></td>
                                        <td class="font-weight-bold"><?php echo e($totalCancelByVendorAmount); ?></td>
                                    </tr>

                                    <tr>
                                        <td class="text-danger">Cancel By User</td>
                                        <td class="font-weight-bold"><?php echo e($totalCancelByUserOrder); ?></td>
                                        <td class="font-weight-bold"><?php echo e($totalCancelByUserAmount); ?></td>
                                    </tr>
                                       <tr>
                                        <td class="text-warning">Assign To Rider</td>
                                        <td class="font-weight-bold"><?php echo e($totalAssignRiderOrder); ?></td>
                                        <td class="font-weight-bold"><?php echo e($totalAssignRiderAmount); ?></td>
                                    </tr>

                                     <tr>
                                        <td class="text-danger">Return Order</td>
                                        <td class="font-weight-bold"><?php echo e($totalReturnOrder); ?></td>
                                        <td class="font-weight-bold"><?php echo e($totalReturnOrder); ?></td>
                                    </tr>
                                    <tr>
                                        <td class="fw-bold"><strong>Total Order</strong> </td>
                                        <td class="font-weight-bold">Total Order=<?php echo e($totalOrder); ?>,Total Product= <?php echo e($totalProduct); ?></td>
                                        <td class="font-weight-bold"><?php echo e($totalAmount); ?></td>
                                    </tr>

                                    </tbody>
                                </table>
                                <div class="float-right">

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <?php if(Auth::user()->type == 1): ?>
                <div class="col-xl-6 col-lg-12 col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title mb-0">Monthly users</h4>
                        </div>
                        <div class="card-body">
                            <p class="font-medium-2 text-muted text-center pb-2">Last 6 Months Sales</p>
                            <div class="card-block">
                                <div id="linechart" class="height-400 lineAreaDashboard">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
        </div>
        <?php endif; ?>
        <!--Statistics cards Ends-->
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripttop'); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('script'); ?>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
        google.charts.load('current', {
            'packages': ['corechart']
        });
        google.charts.setOnLoadCallback(drawChart);

        function drawChart() {

            var data = google.visualization.arrayToDataTable([
                ['Month Name', 'amount'],

                <?php
                    foreach ($orders as $order) {
                        echo "['" . $order->month_name . "', " . $order->amount . '],';
                    }
                ?>
            ]);

            var options = {
                title: 'Monthly earnings',
                is3D: true,
            };

            var chart = new google.visualization.PieChart(document.getElementById('piechart'));

            chart.draw(data, options);
        }

        //
        var role = $("#role").val();
        if (role == "super-admin") {
            google.charts.load('current', {
                'packages': ['corechart']
            });
            google.charts.setOnLoadCallback(lineChart);

            function lineChart() {
                var dataa = google.visualization.arrayToDataTable([
                    ['Month Name', 'Users'],

                    <?php
                        foreach ($users as $key => $val) {
                            echo "['" . $val->month_name . "', " . (int) $val->total . '],';
                        }
                    ?>
                ]);

                var optionsa = {
                    title: '',
                    curveType: 'function',
                    legend: {
                        position: 'bottom'
                    },
                    vAxis: {
                        viewWindow: {
                            min: 0
                        }
                    }
                };
                var charts = new google.visualization.LineChart(document.getElementById('linechart'));
                charts.draw(dataa, optionsa);
            }
        }

        google.charts.load('current', {
            'packages': ['bar']
        });
        google.charts.setOnLoadCallback(barChart);

        function barChart() {
            var datab = google.visualization.arrayToDataTable([
                ['Month Name', 'Orders'],

                <?php
                    foreach ($linereport as $product) {
                        echo "['" . $product->month_name . "', " . (int) $product->orders . '],';
                    }
                ?>
            ]);

            var optionb = {
                width: 730,
                chart: {
                    title: '',
                    subtitle: '',
                },
                bars: 'vertical'
            };
            var chart1 = new google.charts.Bar(document.getElementById('barchart_material'));
            chart1.draw(datab, optionb);
        }
    </script>
   <script>
        function copyText() {
            // Get the text field
            var copyText = document.getElementById("myInput");

            // Select the text field
            copyText.select();
            copyText.setSelectionRange(0, 99999); // For mobile devices

            // Copy the text inside the text field
            document.execCommand("copy");

            // Alert the copied text
            alert("Copied the text: " + copyText.value);
        }
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\eglobalmart\resources\views/Admin/home.blade.php ENDPATH**/ ?>