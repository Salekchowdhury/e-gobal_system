
<?php
    $checkStar = Helper::checkStar();
    $total_referer = count($checkStar);

    // dd($checkStar);
    // dd(count($checkStar['first']));
     $total_refer = (count($checkStar['first'])+ count($checkStar['second']) + count($checkStar['third']));
     $star = null;
    if(count($checkStar['first'])>=10){
      $star = 1;
     }else if(count($checkStar['first']) >3 && $total_refer >= 10 ){
        $star = 2;
     }


?>
<nav class="navbar navbar-expand-lg navbar-light bg-faded header-navbar">
    <div class="container-fluid">
      <div class="navbar-header">
        <button type="button" data-toggle="collapse" class="navbar-toggle d-lg-none float-left">
          <span class="sr-only"><?php echo e(trans('labels.toggle_navigation')); ?></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
        <span class="d-lg-none navbar-right navbar-collapse-toggle">
          <a aria-controls="navbarSupportedContent" href="javascript:;" class="open-navbar-container black">
            <i class="ft-more-vertical"></i>
          </a>
        </span>

        <?php if(Session::get('back_admin')): ?>
          <a class="btn btn-dark btn-raised mr-1" href="<?php echo e(URL::to('/admin/go-back')); ?>" type="button">
            <?php echo e(trans('labels.back_to_admin')); ?>

          </a>
        <?php endif; ?>

        

        <div class="position-relative has-icon-right" style="
        color: green;
        border-radius: 3px;">

                <div class="container clock-container">
                    <span id="hours">00</span>
                    <span>:</span>
                    <span id="minutes">00</span>
                    <span>:</span>
                    <span id="seconds">00</span>
                    <span id="session">AM</span>
                </div>

            
            <?php if(Auth::user()->type == 3 && Helper::PayoutRequest() <=0): ?>
              <?php if(Helper::MinBalanceForWithdraw(Auth::user()->id) == 1): ?>
              <input type="hidden" name="balance" value="<?php echo e(Auth::user()->wallet); ?>">
              
              <?php endif; ?>
            <?php endif; ?>
            
           <!--<?php if($star == 1): ?>-->

           <!--<img src="<?php echo e(asset('public/storage/images/star/1_star.jpg')); ?>" width='40' height='40' style="margin-bottom: 15px">-->
           <!--<?php elseif($star == 2): ?>-->

           <!--<img src="<?php echo e(asset('public/storage/images/star/2_star.jpg')); ?>" width='40' height='40' style="margin-bottom: 15px">-->
           <!--<?php endif; ?>-->

          </div>

      </div>
      <div class="navbar-container">
        <div id="navbarSupportedContent" class="collapse navbar-collapse">
          <?php if(Auth::user()->type == 3): ?>
            <?php if(Helper::CheckInfo(Auth::user()->id) == 1): ?>
              <div id="top-message" class="container">
                <div class="alert alert-danger">
                  <?php echo e(trans('labels.complete_your_store')); ?> <a href="<?php echo e(route('admin.vendor-profile')); ?>"><?php echo e(trans('labels.click_here')); ?></a>
                </div>
              </div>
            <?php endif; ?>
          <?php endif; ?>
          <ul class="navbar-nav">
            <li class="dropdown nav-item"><a id="dropdownBasic3" href="#" data-toggle="dropdown" class="nav-link position-relative dropdown-toggle"><?php echo e(Auth::user()->name); ?>

                <p class="d-none"><?php echo e(trans('labels.user_settings')); ?></p></a>
                <div ngbdropdownmenu="" aria-labelledby="dropdownBasic3" class="dropdown-menu text-left dropdown-menu-right">
                    <a href="<?php echo e(route('admin.profile')); ?>"  class="dropdown-item"><i class="fa fa-user mr-2"></i><span><?php echo e(trans('labels.profile')); ?></span></a>
                  <a href="javascript:void(0);" data-toggle="modal" data-target="#ChangePasswordModal" class="dropdown-item"><i class="fa fa-key mr-2"></i><span><?php echo e(trans('labels.change_password')); ?></span></a>
                  <a href="<?php echo e(route('admin.logout')); ?>" class="dropdown-item"><i class="ft-power mr-2"></i><span><?php echo e(trans('labels.logout')); ?></span></a>
                  
                </div>
            </li>

          </ul>
        </div>
      </div>
    </div>
</nav>
<?php /**PATH C:\xampp\htdocs\eglobalmart\resources\views/includes/admin/header.blade.php ENDPATH**/ ?>