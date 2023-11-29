@extends('layouts.admin')
@section('title')
    {{ Helper::webinfo()->site_title }} | {{ trans('labels.orders') }}
@endsection
{{-- <link href="{{asset('storage/app/public/Webassets/css/styles.css')}}" rel="stylesheet"> --}}
{{-- <link href="https://cdnjs.cloudflare.com/ajax/libs/flat-ui/2.3.0/css/flat-ui.min.css" rel="stylesheet"/> --}}

@section('css')
@endsection
@section('content')
    <div class="content-wrapper">
        @if (Session::has('success'))
            <div class="alert alert-success">
                {{ Session::get('success') }}
                @php
                    Session::forget('success');
                @endphp
            </div>
        @endif
        <section id="configuration">
            <div class="row">


                <div class="card">

                    <div class="card-body collapse show">

                        <div class="card-block card-dashboard" id="table-display">
                            {{-- <div class="col-lg-8 col-md-9 col-sm-12 col-12"> --}}

                            <div class="checked-shop">

                                <div class="row">
                                    <div class="col-3">
                                        <a href="#"><img src="{{ $order_info->image_url }}" alt="..."
                                                class="img-fluid" style="width: 800px; object-fit: scale-down;"></a>

                                    </div>
                                    <div class="col-5">
                                        <p class="mb-2 font-size-sm font-weight-bold">
                                            <a class="text-body" href="#">{{ $order_info->product_name }}</a>
                                        </p>

                                    </div>
                                    <div class="col-1">
                                        {{ trans('labels.qty') }}: {{ $order_info->qty }}
                                    </div>
                                    <div class="col-3">
                                        <div class="float-right">
                                            <p class="text-right theme-cl">
                                                {{ Helper::CurrencyFormatter($order_info->price * $order_info->qty) }}</p>
                                        </div>
                                    </div>
                                </div>


                                <div class="row">
                                    <div class="col-lg-12 col-md-12 col-sm-12">
                                        @if (Auth::user()->type == 3)
                                            @if ($order_info['status'] != 5 && $order_info['status'] != 6 && $order_info['status'] == 4 && $ratting != 1)
                                                <div class="float-right">
                                                    <button class="btn btn-sm btn-success write-review"
                                                        data-product-id="{{ $order_info->product_id }}"
                                                        data-vendor-id="{{ $order_info->vendor_id }}"
                                                        data-product-name="{{ $order_info->product_name }}"
                                                        data-product-image="{{ $order_info->image_url }}">{{ trans('labels.write_review') }}</button>
                                                </div>
                                            @endif
                                        @endif


                                        <ul class="track_order_list mt-4">
                                            @if ($order_info['status'] == 1)
                                                <li class="complete">
                                                    <div class="trach_single_list">
                                                        <div class="trach_icon_list"><i class="ti-write"></i></div>
                                                        <div class="track_list_caption">
                                                            <h4 class="mb-0">{{ trans('labels.order_placed') }}</h4>
                                                            <p>{{ trans('labels.order_placed_text') }}</p>
                                                        </div>
                                                    </div>
                                                </li>
                                                <li class="processing">
                                                    <div class="col-7">
                                                        <div class="trach_single_list">
                                                            <div class="trach_icon_list"><i class="ti-package"></i></div>
                                                            <div class="track_list_caption">
                                                                <h4 class="mb-0">{{ trans('labels.confirmed') }}</h4>
                                                                <p>{{ trans('labels.order_confirmed_text') }}</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-5">
                                                        @foreach ($order_info->orderComment as $comment)
                                                            @if ($comment->status == 2)
                                                            <span>{{$comment->generate_date}}<p class="text-justify">{{ $comment->comment }}</p>
                                                            @endif
                                                        @endforeach
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="col-7">
                                                        <div class="trach_single_list">
                                                            <div class="trach_icon_list"><i class="ti-gift"></i></div>
                                                            <div class="track_list_caption">
                                                                <h4 class="mb-0">{{ trans('labels.order_shipped') }}</h4>
                                                                <p>{{ trans('labels.order_shipped') }}</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-5">
                                                        @foreach ($order_info->orderComment as $comment)
                                                            @if ($comment->status == 3)
                                                            <span>{{$comment->generate_date}}<p class="text-justify">{{ $comment->comment }}</p>
                                                            @endif
                                                        @endforeach
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="col-7">
                                                        <div class="trach_single_list">
                                                            <div class="trach_icon_list"><i class="ti-truck"></i></div>
                                                            <div class="track_list_caption">
                                                                <h4 class="mb-0">{{ trans('labels.assigned_to_rider') }}
                                                                </h4>
                                                                <p>{{ trans('labels.assigned_to_rider') }}</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-5">
                                                        @foreach ($order_info->orderComment as $comment)
                                                            @if ($comment->status == 11)
                                                            <span>{{$comment->generate_date}}<p class="text-justify">{{ $comment->comment }}</p>
                                                            @endif
                                                        @endforeach
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="col-7">
                                                        <div class="trach_single_list">
                                                            <div class="trach_icon_list"><i class="ti-thumb-up"></i></div>
                                                            <div class="track_list_caption">
                                                                <h4 class="mb-0">{{ trans('labels.delivered') }}</h4>
                                                                <p>{{ trans('labels.delivered_text') }}</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-5">
                                                        @foreach ($order_info->orderComment as $comment)
                                                            @if ($comment->status == 4)
                                                            <span>{{$comment->generate_date}}<p class="text-justify">{{ $comment->comment }}</p>
                                                            @endif
                                                        @endforeach
                                                    </div>
                                                </li>
                                            @endif
                                            @if ($order_info['status'] == 2)
                                                <li class="complete">
                                                    <div class="trach_single_list">
                                                        <div class="trach_icon_list"><i class="ti-write"></i></div>
                                                        <div class="track_list_caption">
                                                            <h4 class="mb-0">{{ trans('labels.order_placed') }}</h4>
                                                            <p>{{ trans('labels.order_placed_text') }}</p>
                                                        </div>
                                                    </div>
                                                </li>
                                                <li class="complete">
                                                    <div class="col-7">
                                                        <div class="trach_single_list">
                                                            <div class="trach_icon_list"><i class="ti-package"></i></div>
                                                            <div class="track_list_caption">
                                                                <h4 class="mb-0">{{ trans('labels.confirmed') }}</h4>
                                                                <p>{{ trans('labels.order_confirmed_text') }}</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-5">
                                                        @foreach ($order_info->orderComment as $comment)
                                                            @if ($comment->status == 2)
                                                            <span>{{$comment->generate_date}}<p class="text-justify">{{ $comment->comment }}</p>
                                                            @endif
                                                        @endforeach
                                                    </div>
                                                </li>
                                                <li class="processing">
                                                    <div class="col-7">
                                                        <div class="trach_single_list">
                                                            <div class="trach_icon_list"><i class="ti-gift"></i></div>
                                                            <div class="track_list_caption">
                                                                <h4 class="mb-0">{{ trans('labels.order_shipped') }}</h4>
                                                                <p>{{ trans('labels.order_shipped') }}</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-5">
                                                        @foreach ($order_info->orderComment as $comment)
                                                            @if ($comment->status == 3)
                                                            <span>{{$comment->generate_date}}<p class="text-justify">{{ $comment->comment }}</p>
                                                            @endif
                                                        @endforeach
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="col-7">
                                                        <div class="trach_single_list">
                                                            <div class="trach_icon_list"><i class="ti-truck"></i></div>
                                                            <div class="track_list_caption">
                                                                <h4 class="mb-0">{{ trans('labels.assigned_to_rider') }}
                                                                </h4>
                                                                <p>{{ trans('labels.assigned_to_rider') }}</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-5">
                                                        @foreach ($order_info->orderComment as $comment)
                                                            @if ($comment->status == 11)
                                                            <span>{{$comment->generate_date}}<p class="text-justify">{{ $comment->comment }}</p>
                                                            @endif
                                                        @endforeach
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="col-7">
                                                        <div class="trach_single_list">
                                                            <div class="trach_icon_list"><i class="ti-thumb-up"></i></div>
                                                            <div class="track_list_caption">
                                                                <h4 class="mb-0">{{ trans('labels.delivered') }}</h4>
                                                                <p>{{ trans('labels.delivered_text') }}</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-5">
                                                        @foreach ($order_info->orderComment as $comment)
                                                            @if ($comment->status == 4)
                                                            <span>{{$comment->generate_date}}<p class="text-justify">{{ $comment->comment }}</p>
                                                            @endif
                                                        @endforeach
                                                    </div>
                                                </li>
                                            @endif
                                            @if ($order_info['status'] == 3)
                                                <li class="complete">
                                                    <div class="trach_single_list">
                                                        <div class="trach_icon_list"><i class="ti-write"></i></div>
                                                        <div class="track_list_caption">
                                                            <h4 class="mb-0">{{ trans('labels.order_placed') }}</h4>
                                                            <p>{{ trans('labels.order_placed_text') }}</p>
                                                        </div>
                                                    </div>
                                                </li>
                                                <li class="complete">
                                                    <div class="col-7">
                                                        <div class="trach_single_list">
                                                            <div class="trach_icon_list"><i class="ti-package"></i></div>
                                                            <div class="track_list_caption">
                                                                <h4 class="mb-0">{{ trans('labels.confirmed') }}</h4>
                                                                <p>{{ trans('labels.order_confirmed_text') }}</p>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-5">
                                                        @foreach ($order_info->orderComment as $comment)
                                                            @if ($comment->status == 2)
                                                            <span>{{$comment->generate_date}}<p class="text-justify">{{ $comment->comment }}</p>
                                                            @endif
                                                        @endforeach
                                                    </div>
                                                </li>
                                                <li class="complete">
                                                    <div class="col-7">
                                                        <div class="trach_single_list">
                                                            <div class="trach_icon_list"><i class="ti-gift"></i></div>
                                                            <div class="track_list_caption">
                                                                <h4 class="mb-0">{{ trans('labels.order_shipped') }}
                                                                </h4>
                                                                <p>{{ trans('labels.order_shipped') }}</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-5">
                                                        @foreach ($order_info->orderComment as $comment)
                                                            @if ($comment->status == 3)
                                                            <span>{{$comment->generate_date}}<p class="text-justify">{{ $comment->comment }}</p>
                                                            @endif
                                                        @endforeach
                                                    </div>
                                                </li>
                                                <li class="processing">
                                                    <div class="col-7">
                                                        <div class="trach_single_list">
                                                            <div class="trach_icon_list"><i class="ti-truck"></i></div>
                                                            <div class="track_list_caption">
                                                                <h4 class="mb-0">{{ trans('labels.assigned_to_rider') }}
                                                                </h4>
                                                                <p>{{ trans('labels.assigned_to_rider') }}</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-5">
                                                        @foreach ($order_info->orderComment as $comment)
                                                            @if ($comment->status == 11)
                                                            <span>{{$comment->generate_date}} <p class="text-justify">{{ $comment->comment }}</p>
                                                            @endif
                                                        @endforeach
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="col-7">
                                                        <div class="trach_single_list">
                                                            <div class="trach_icon_list"><i class="ti-thumb-up"></i></div>
                                                            <div class="track_list_caption">
                                                                <h4 class="mb-0">{{ trans('labels.delivered') }}</h4>
                                                                <p>{{ trans('labels.delivered_text') }}</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-5">
                                                        @foreach ($order_info->orderComment as $comment)
                                                            @if ($comment->status == 4)
                                                            <span>{{$comment->generate_date}}<p class="text-justify">{{ $comment->comment }}</p>
                                                            @endif
                                                        @endforeach
                                                    </div>
                                                </li>
                                            @endif
                                            @if ($order_info['status'] == 11)
                                                <li class="complete">
                                                    <div class="trach_single_list">
                                                        <div class="trach_icon_list"><i class="ti-write"></i></div>
                                                        <div class="track_list_caption">
                                                            <h4 class="mb-0">{{ trans('labels.order_placed') }}</h4>
                                                            <p>{{ trans('labels.order_placed_text') }}</p>
                                                        </div>
                                                    </div>
                                                </li>
                                                <li class="complete">
                                                    <div class="col-7">
                                                        <div class="trach_single_list">
                                                            <div class="trach_icon_list"><i class="ti-package"></i></div>
                                                            <div class="track_list_caption">
                                                                <h4 class="mb-0">{{ trans('labels.confirmed') }}</h4>
                                                                <p>{{ trans('labels.order_confirmed_text') }}</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-5">
                                                        @foreach ($order_info->orderComment as $comment)
                                                            @if ($comment->status == 2)
                                                            <span>{{$comment->generate_date}}<p class="text-justify">{{ $comment->comment }}</p>
                                                            @endif
                                                        @endforeach
                                                    </div>
                                                </li>
                                                <li class="complete">
                                                    <div class="col-7">
                                                        <div class="trach_single_list">
                                                            <div class="trach_icon_list"><i class="ti-gift"></i></div>
                                                            <div class="track_list_caption">
                                                                <h4 class="mb-0">{{ trans('labels.order_shipped') }}
                                                                </h4>
                                                                <p>{{ trans('labels.order_shipped') }}</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-5">
                                                        @foreach ($order_info->orderComment as $comment)
                                                            @if ($comment->status == 3)
                                                            <span>{{$comment->generate_date}} <p class="text-justify">{{ $comment->comment }}</p>
                                                            @endif
                                                        @endforeach
                                                    </div>
                                                </li>
                                                <li class="complete">
                                                    <div class="col-7">
                                                        <div class="trach_single_list">
                                                            <div class="trach_icon_list"><i class="ti-truck"></i></div>
                                                            <div class="track_list_caption">
                                                                <h4 class="mb-0">{{ trans('labels.assigned_to_rider') }}
                                                                </h4>
                                                                <p>{{ trans('labels.assigned_to_rider') }}</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-5">
                                                        @foreach ($order_info->orderComment as $comment)
                                                            @if ($comment->status == 11)
                                                            <span>{{$comment->generate_date}}<p class="text-justify">{{ $comment->comment }}</p>
                                                            @endif
                                                        @endforeach
                                                    </div>
                                                </li>
                                                <li class="processing">
                                                    <div class="col-7">
                                                        <div class="trach_single_list">
                                                            <div class="trach_icon_list"><i class="ti-thumb-up"></i></div>
                                                            <div class="track_list_caption">
                                                                <h4 class="mb-0">{{ trans('labels.delivered') }}</h4>
                                                                <p>{{ trans('labels.delivered_text') }}</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-5">
                                                        @foreach ($order_info->orderComment as $comment)
                                                            @if ($comment->status == 4)
                                                            <span>{{$comment->generate_date}} <p class="text-justify">{{ $comment->comment }}</p>
                                                            @endif
                                                        @endforeach
                                                    </div>
                                                </li>
                                            @endif
                                            @if ($order_info['status'] == 4)
                                                <li class="complete">
                                                    <div class="trach_single_list">
                                                        <div class="trach_icon_list"><i class="ti-write"></i></div>
                                                        <div class="track_list_caption">
                                                            <h4 class="mb-0">{{ trans('labels.order_placed') }}</h4>
                                                            <p>{{ trans('labels.order_placed_text') }}</p>
                                                        </div>
                                                    </div>
                                                </li>
                                                <li class="complete">
                                                    <div class="col-7">
                                                        <div class="trach_single_list">
                                                            <div class="trach_icon_list"><i class="ti-package"></i></div>
                                                            <div class="track_list_caption">
                                                                <h4 class="mb-0">{{ trans('labels.confirmed') }}</h4>
                                                                <p>{{ trans('labels.order_confirmed_text') }}</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-5">
                                                        @foreach ($order_info->orderComment as $comment)
                                                            @if ($comment->status == 2)
                                                            <span>{{$comment->generate_date}}<p class="text-justify">{{ $comment->comment }}</p>
                                                            @endif
                                                        @endforeach
                                                    </div>
                                                </li>
                                                <li class="complete">
                                                    <div class="col-7">
                                                        <div class="trach_single_list">
                                                            <div class="trach_icon_list"><i class="ti-gift"></i></div>
                                                            <div class="track_list_caption">
                                                                <h4 class="mb-0">{{ trans('labels.order_shipped') }}
                                                                </h4>
                                                                <p>{{ trans('labels.order_shipped') }}</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-5">
                                                        @foreach ($order_info->orderComment as $comment)
                                                            @if ($comment->status == 3)
                                                            <span>{{$comment->generate_date}}<p class="text-justify">{{ $comment->comment }} bbb</p>
                                                            @endif
                                                        @endforeach
                                                    </div>
                                                </li>
                                                <li class="complete">
                                                    <div class="col-7">
                                                        <div class="trach_single_list">
                                                            <div class="trach_icon_list"><i class="ti-truck"></i></div>
                                                            <div class="track_list_caption">
                                                                <h4 class="mb-0">{{ trans('labels.assigned_to_rider') }}
                                                                </h4>
                                                                <p>{{ trans('labels.assigned_to_rider') }}</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-5">
                                                        @foreach ($order_info->orderComment as $comment)
                                                            @if ($comment->status == 11)
                                                            <span>{{$comment->generate_date}}<p class="text-justify">{{ $comment->comment }}</p>
                                                            @endif
                                                        @endforeach
                                                    </div>
                                                </li>
                                                <li class="complete">
                                                    <div class="col-7">
                                                        <div class="trach_single_list">
                                                            <div class="trach_icon_list"><i class="ti-thumb-up"></i></div>
                                                            <div class="track_list_caption">
                                                                <h4 class="mb-0">{{ trans('labels.delivered') }}</h4>
                                                                <p>{{ trans('labels.delivered_text') }}</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-5">
                                                        @foreach ($order_info->orderComment as $comment)
                                                            @if ($comment->status == 4)
                                                            <span>{{$comment->generate_date}}<p class="text-justify">{{ $comment->comment }}</p>
                                                            @endif
                                                        @endforeach
                                                    </div>
                                                </li>
                                            @endif

                                            @if ($order_info['status'] == 5)
                                                <li class="cancel">
                                                    <div class="col-7">
                                                        <div class="trach_single_list">
                                                            <div class="trach_icon_list"><i class="ti-close"></i></div>
                                                            <div class="track_list_caption">
                                                                <h4 class="mb-0">{{ trans('labels.cancelled') }}</h4>
                                                                <p>{{ trans('labels.cancelled_by_vendor') }}</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-5">
                                                        @foreach ($order_info->orderComment as $comment)
                                                            @if ($comment->status == 5)
                                                            <span>{{$comment->generate_date}}<p class="text-justify">{{ $comment->comment }}</p>
                                                            @endif
                                                        @endforeach
                                                    </div>
                                                </li>
                                            @endif
                                            @if ($order_info['status'] == 6)
                                                <li class="cancel">
                                                    <div class="trach_single_list">
                                                        <div class="trach_icon_list"><i class="ti-close"></i></div>
                                                        <div class="track_list_caption">
                                                            <h4 class="mb-0">{{ trans('labels.cancelled') }}</h4>
                                                            <p>{{ trans('labels.cancelled_by_user') }}</p>
                                                        </div>
                                                    </div>
                                                </li>
                                            @endif
                                            @if ($order_info['status'] == 7)
                                                <li class="complete">
                                                    <div class="trach_single_list">
                                                        <div class="trach_icon_list"><i class="ti-write"></i></div>
                                                        <div class="track_list_caption">
                                                            <h4 class="mb-0">{{ trans('labels.return') }}</h4>
                                                            <p>{{ trans('labels.return') }}</p>
                                                        </div>
                                                    </div>
                                                </li>
                                                <li class="processing">
                                                    <div class="trach_single_list">
                                                        <div class="trach_icon_list"><i class="ti-package"></i></div>
                                                        <div class="track_list_caption">
                                                            <h4 class="mb-0">{{ trans('labels.return_progress') }}</h4>
                                                            <p>{{ trans('labels.return_progress') }}</p>
                                                        </div>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="trach_single_list">
                                                        <div class="trach_icon_list"><i class="ti-gift"></i></div>
                                                        <div class="track_list_caption">
                                                            <h4 class="mb-0">{{ trans('labels.return_complete') }}</h4>
                                                            <p>{{ trans('labels.return_complete') }}</p>
                                                        </div>
                                                    </div>
                                                </li>
                                            @endif
                                            @if ($order_info['status'] == 8)
                                                <li class="complete">
                                                    <div class="trach_single_list">
                                                        <div class="trach_icon_list"><i class="ti-write"></i></div>
                                                        <div class="track_list_caption">
                                                            <h4 class="mb-0">{{ trans('labels.return') }}</h4>
                                                            <p>{{ trans('labels.return') }}</p>
                                                        </div>
                                                    </div>
                                                </li>
                                                <li class="complete">
                                                    <div class="trach_single_list">
                                                        <div class="trach_icon_list"><i class="ti-package"></i></div>
                                                        <div class="track_list_caption">
                                                            <h4 class="mb-0">{{ trans('labels.return_progress') }}</h4>
                                                            <p>{{ trans('labels.return_progress') }}</p>
                                                        </div>
                                                    </div>
                                                </li>
                                                <li class="processing">
                                                    <div class="trach_single_list">
                                                        <div class="trach_icon_list"><i class="ti-gift"></i></div>
                                                        <div class="track_list_caption">
                                                            <h4 class="mb-0">{{ trans('labels.return_complete') }}</h4>
                                                            <p>{{ trans('labels.return_complete') }}</p>
                                                        </div>
                                                    </div>
                                                </li>
                                            @endif
                                            @if ($order_info['status'] == 9)
                                                <li class="complete">
                                                    <div class="trach_single_list">
                                                        <div class="trach_icon_list"><i class="ti-write"></i></div>
                                                        <div class="track_list_caption">
                                                            <h4 class="mb-0">{{ trans('labels.return') }}</h4>
                                                            <p>{{ trans('labels.return_text') }}</p>
                                                        </div>
                                                    </div>
                                                </li>
                                                <li class="complete">
                                                    <div class="trach_single_list">
                                                        <div class="trach_icon_list"><i class="ti-package"></i></div>
                                                        <div class="track_list_caption">
                                                            <h4 class="mb-0">{{ trans('labels.return_progress') }}</h4>
                                                            <p>{{ trans('labels.return_progress') }}</p>
                                                        </div>
                                                    </div>
                                                </li>
                                                <li class="complete">
                                                    <div class="trach_single_list">
                                                        <div class="trach_icon_list"><i class="ti-gift"></i></div>
                                                        <div class="track_list_caption">
                                                            <h4 class="mb-0">{{ trans('labels.return_complete') }}</h4>
                                                            <p>{{ trans('labels.return_complete') }}</p>
                                                        </div>
                                                    </div>
                                                </li>
                                            @endif
                                            @if ($order_info['status'] == 10)
                                                <li class="cancel">
                                                    <div class="trach_single_list">
                                                        <div class="trach_icon_list"><i class="ti-close"></i></div>
                                                        <div class="track_list_caption">
                                                            <h4 class="mb-0">{{ trans('labels.return_reject') }}</h4>
                                                            <p>{{ $order_info['vendor_comment'] }}</p>
                                                        </div>
                                                    </div>
                                                </li>
                                            @endif
                                        </ul>
                                    </div>
                                </div>

                            </div>

                            {{-- </div> --}}

                        </div>
                    </div>

                </div>

            </div>

        </section>
    </div>
@endsection
