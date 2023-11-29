@extends('layouts.admin')
@section('title')
    {{ Helper::webinfo()->site_title }} | {{ trans('labels.bank') }}
@endsection
@section('css')
@endsection
@section('content')
    <div class="content-wrapper">

        <section class="vh-100" style="background-color: #acb5c5;">
            <div class="container py-3 h-100">
                <div class="row d-flex justify-content-center align-items-center h-100">
                    <div class="col-12">
                        <h3>Add Bank</h3>
                        <div class="card shadow-2-strong" style="border-radius: 1rem;">
                            <div class="card-body p-5 text-center">
                                <div class="form-outline mb-4">
                                    @if (session('message'))
                                        <p class="alert alert-danger ">{{ session('message') }}</p>
                                    @elseif (session('successMessage'))
                                        <p class="alert alert-success">{{ session('successMessage') }}</p>
                                    @endif
                                </div>

                                <form action="{{ url('admin/bank_list/update') }}" method="post">
                                    @csrf
                                    <div class="row">
                                        <div class="py-1 col-10">
                                            {{-- <label class="form-label" for="typePasswordX-2">Receive Number</label> --}}
                                            <input type="text" id="" value="{{$data->name}}" required
                                                name="name" placeholder="Bank Name..."
                                                class="form-control form-control-lg" />
                                                <input type="hidden" name="id" value="{{$data->id}}"/>
                                        </div>
                                        <div class="col-2 mt-2">
                                            <button type="submit" class="btn btn-primary mb-4">Edit</button>
                                        </div>
                                    </div>


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
@endsection
