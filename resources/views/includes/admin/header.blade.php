
@php
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


@endphp
<nav class="navbar navbar-expand-lg navbar-light bg-faded header-navbar">
    <div class="container-fluid">
      <div class="navbar-header">
        <button type="button" data-toggle="collapse" class="navbar-toggle d-lg-none float-left">
          <span class="sr-only">{{ trans('labels.toggle_navigation') }}</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
        <span class="d-lg-none navbar-right navbar-collapse-toggle">
          <a aria-controls="navbarSupportedContent" href="javascript:;" class="open-navbar-container black">
            <i class="ft-more-vertical"></i>
          </a>
        </span>

        @if(Session::get('back_admin'))
          <a class="btn btn-dark btn-raised mr-1" href="{{URL::to('/admin/go-back')}}" type="button">
            {{trans('labels.back_to_admin')}}
          </a>
        @endif

        {{-- <form method="POST" action="{{route('admin.withdrawal')}}" class="navbar-form navbar-right">
          @csrf
          <div class="position-relative has-icon-right">
            <button class="btn btn-success btn-raised" type="button">
              {{trans('labels.earnings')}} <span class="badge badge-light">{{Helper::getwalletbalance(Auth::user()->id)}}</span>
            </button>
            @if(Auth::user()->type == 3 && Helper::PayoutRequest() <=0)
              @if(Helper::MinBalanceForWithdraw(Auth::user()->id) == 1)
              <input type="hidden" name="balance" value="{{Auth::user()->wallet}}">
              <button class="btn btn-info btn-raised" type="submit">
                {{trans('labels.send_withdrawal_request')}}
              </button>
              @endif
            @endif
          </div>
        </form> --}}

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

            {{-- <button class="btn btn-success btn-raised" type="button">
              {{trans('labels.earnings')}} <span class="badge badge-light">{{Helper::getwalletbalance(Auth::user()->id)}}</span>
            </button> --}}
            @if(Auth::user()->type == 3 && Helper::PayoutRequest() <=0)
              @if(Helper::MinBalanceForWithdraw(Auth::user()->id) == 1)
              <input type="hidden" name="balance" value="{{Auth::user()->wallet}}">
              {{-- <a href="{{Route('admin.withdrow.create')}}" class="btn btn-info btn-raised">
                {{trans('labels.send_withdrawal_request')}}
              </a> --}}
              @endif
            @endif
            {{-- {!! $star!!} --}}
           <!--@if ($star == 1)-->

           <!--<img src="{{asset('public/storage/images/star/1_star.jpg')}}" width='40' height='40' style="margin-bottom: 15px">-->
           <!--@elseif ($star == 2)-->

           <!--<img src="{{asset('public/storage/images/star/2_star.jpg')}}" width='40' height='40' style="margin-bottom: 15px">-->
           <!--@endif-->

          </div>

      </div>
      <div class="navbar-container">
        <div id="navbarSupportedContent" class="collapse navbar-collapse">
          @if(Auth::user()->type == 3)
            @if(Helper::CheckInfo(Auth::user()->id) == 1)
              <div id="top-message" class="container">
                <div class="alert alert-danger">
                  {{trans('labels.complete_your_store')}} <a href="{{route('admin.vendor-profile')}}">{{trans('labels.click_here')}}</a>
                </div>
              </div>
            @endif
          @endif
          <ul class="navbar-nav">
            <li class="dropdown nav-item"><a id="dropdownBasic3" href="#" data-toggle="dropdown" class="nav-link position-relative dropdown-toggle">{{ Auth::user()->name }}
                <p class="d-none">{{ trans('labels.user_settings') }}</p></a>
                <div ngbdropdownmenu="" aria-labelledby="dropdownBasic3" class="dropdown-menu text-left dropdown-menu-right">
                    <a href="{{route('admin.profile')}}"  class="dropdown-item"><i class="fa fa-user mr-2"></i><span>{{ trans('labels.profile') }}</span></a>
                  <a href="javascript:void(0);" data-toggle="modal" data-target="#ChangePasswordModal" class="dropdown-item"><i class="fa fa-key mr-2"></i><span>{{ trans('labels.change_password') }}</span></a>
                  <a href="{{route('admin.logout')}}" class="dropdown-item"><i class="ft-power mr-2"></i><span>{{ trans('labels.logout') }}</span></a>
                  {{-- <a href="{{route('admin.logout')}}" class="dropdown-item"><i class="ft-power mr-2"></i><span>{{ trans('labels.logout') }}</span></a> --}}
                </div>
            </li>

          </ul>
        </div>
      </div>
    </div>
</nav>
