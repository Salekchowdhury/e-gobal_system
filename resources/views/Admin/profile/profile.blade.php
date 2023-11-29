@extends('layouts.admin')
@section('title')
    {{ Helper::webinfo()->site_title }} | {{ trans('labels.manage_stockiest') }}
@endsection
@section('css')
    .select2-selection__rendered{

    }
@endsection
@section('content')
    <div class="content-wrapper">
        <section id="basic-form-layouts">
            <div class="row">
                <div class="col-sm-12">
                    <div class="content-header">{{ trans('labels.profile') }}</div>
                </div>
            </div>

            <div class="row justify-content-md-center">
                <div class="col-md-12">
                    <div class="card px-3">
                        <div class="card-header">

                                @if (session('message'))
                                <p class="alert alert-success ">{{(session('message'))}}</p>
                                @endif


                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                        </div>
                        <div class="card-body">

                            <div class="form-body">
                                <h4 class="form-section"><i class="ft-user"></i> Personal Info</h4>
                                <form method="post" action="{{ route('admin.update.profile') }}"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <div class="row">

                                        <div class="form-group col-md-6">
                                            <label class="col-md-6 label-control" for="firebase_key">Name</label>
                                            <div class="col-md-9">
                                                <input type="text" name="name" required class="form-control"
                                                    placeholder="Name" value="{{ $profile->name }}">
                                                @error('name')<span class="text-danger">{{ $message }}</span>@enderror
                                            </div>
                                        </div>

                                        <div class="form-group col-md-6">
                                            <label class="col-md-3 label-control" for="currency">Email</label>
                                            <div class="col-md-9">
                                                <input type="email" name="email" readonly required class="form-control"
                                                    placeholder="Email" value="{{ $profile->email }}">
                                                @error('email')<span class="text-danger">{{ $message }}</span>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label class="col-md-6 label-control" for="currency">Phone</label>
                                                <div class="col-md-9">
                                                    <input type="number" readonly required name="mobile" class="form-control"
                                                        placeholder="Phone" value="{{ $profile->mobile }}">
                                                    @error('phone')<span class="text-danger">{{ $message }}</span>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label class="col-md-6 label-control" for="currency">Gender</label>
                                                    <div class="col-md-9">
                                                        <select class="form-control" name="gender">
                                                            <option value="">Select Gender</option>
                                                            @if (!empty($profile->userInformation))
                                                            <option value="male" {{$profile->userInformation->gender == "male"? "selected" : ''}}>Male</option>
                                                            <option value="female" {{$profile->userInformation->gender == 'female'? "selected" : ''}}>Female</option>
                                                            @else
                                                            <option value="male">Male</option>
                                                            <option value="female">Female</option>
                                                            @endif

                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label class="col-md-6 label-control" for="firebase_key">Father's Name</label>
                                                    <div class="col-md-9">
                                                        <input type="text" required name="father_name" class="form-control"
                                                            placeholder="Father's Name" value="{{$profile->userInformation?$profile->userInformation->father_name : ""}}">
                                                        @error('name')<span class="text-danger">{{ $message }}</span>@enderror
                                                    </div>
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label class="col-md-6 label-control" for="">Mother's Name</label>
                                                    <div class="col-md-9">
                                                        <input type="text"  required name="mother_name" class="form-control"
                                                            placeholder="Mother's Name" value="{{$profile->userInformation?$profile->userInformation->mother_name : ""}}">
                                                        @error('name')<span class="text-danger">{{ $message }}</span>@enderror
                                                    </div>
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label class="col-md-6 label-control" for="currency">Guardian Phone
                                                        Number</label>
                                                    <div class="col-md-9">
                                                        <input type="number" name="guardian_number" class="form-control"
                                                            placeholder="Guardian Phone Number" value="{{$profile->userInformation?$profile->userInformation->guardian_number : ""}}">
                                                        @error('phone')<span class="text-danger">{{ $message }}</span>
                                                            @endif
                                                        </div>
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <label class="col-md-6 label-control" for="currency">NID</label>
                                                        <div class="col-md-9">
                                                            <input type="number" name="nid" minlength="10" class="form-control"
                                                                placeholder="NID" value="{{$profile->userInformation?$profile->userInformation->nid: ''}}">
                                                            @error('nid')<span class="text-danger">{{ $message }}</span>
                                                                @endif
                                                            </div>
                                                        </div>
                                                        <div class="form-group col-md-6">
                                                            <label class="col-md-6 label-control" for="currency">Permanent Address</label>
                                                            <div class="col-md-9">
                                                                <textarea rows="5" cols="5" type="text" required name="permanent_address" class="form-control"
                                                                    placeholder="Permanent Address" value="{{$profile->userInformation?$profile->userInformation->permanent_address : ''}}">{{$profile->userInformation?$profile->userInformation->permanent_address : ''}}</textarea>
                                                                @error('permanent_address')<span
                                                                        class="text-danger">{{ $message }}</span>@endif
                                                                </div>
                                                            </div>
                                                            <div class="form-group col-md-6">
                                                                <label class="col-md-6 label-control" for="">Current Address</label>
                                                                <div class="col-md-9">
                                                                    <textarea rows="5" cols="5" type="text" required name="current_address" class="form-control"
                                                                        placeholder="Current address" value="{{$profile->userInformation?$profile->userInformation->current_address : ''}}">{{$profile->userInformation?$profile->userInformation->current_address : ''}}</textarea>
                                                                    @error('current_address')<span
                                                                            class="text-danger">{{ $message }}</span>@endif
                                                                    </div>
                                                                </div>

                                                                <div class="form-group col-md-6">
                                                                    <label class="col-md-3 label-control" for="">image</label>
                                                                    <div class="col-md-9">
                                                                        <input type="file" name="profile_pic" class="form-control"
                                                                            value="">

                                                                    </div>
                                                                    <div>
                                                                        {{-- <img src="{{Helper::image_path($profile->profile_pic)}}"> --}}
                                                                        @if (!empty($profile->profile_pic))
                                                                        <img width="200" height="200" src="{{asset('storage/app/public/images/profile/'.$profile->profile_pic)}}">
                                                                        @endif
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <button type="submit" class="btn btn-success">Update</button>

                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </section>
                            </div>
                        @endsection
                        @section('scripttop')
                        @endsection
                        @section('script')
                            <script type="text/javascript">
                                $(function() {
                                    $(".select2-selection__rendered").addClass('form-control');
                                    $(".select2-selection--single").addClass('border-0');

                                });

                                $.ajaxSetup({
                                    headers: {
                                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                    }
                                });


                                function vendorPhone(e) {
                                    // alert(e.value);
                                    var userId = e.value;

                                    $.ajax({
                                        url: "{{ route('admin.sales.show.user') }}",
                                        method: 'GET',
                                        data: {
                                            'user_id': userId
                                        },
                                        success: function(data) {
                                            console.log('idNumber s', data);
                                            $('#stock_name').val(data.data[0]['name']);
                                            // $('#phone').val(data.data[0]['mobile']);
                                            $('#address').val(data.data[0]['store_address'])
                                            // stockId = data.data[0].stockiest.id;

                                        }
                                    });
                                }
                                $(document).on('click', '#vendor_phone', function(e) {



                                    let userId = $(this).val();
                                    alert(userId);
                                    // userId = idNumber;



                                    // console.log('idNumber',idNumber);

                                });
                            </script>
                        @endsection
