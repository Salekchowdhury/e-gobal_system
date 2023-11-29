@extends('layouts.admin')
@section('title')
    {{ Helper::webinfo()->site_title }} | {{ trans('labels.products') }}
@endsection
@section('css')
@endsection
@section('content')
    <div class="content-wrapper">
        <div class="container">
            <div class="card p-2">
                <div class="show-success-error"></div>
                <div class="card-header">
                    <h3>{{ trans('labels.sales_product') }}</h3>
                </div>
                @if (Session::has('success'))
                    <div class="row">
                        <div class="col-md-6">
                            <div class="alert alert-info">{{ Session::get('success') }}</div>
                        </div>
                        <div class="col-md-6">

                        </div>
                    </div>
                @endif
                <div class="card-body">
                    <form action="{{ route('admin.sales.store') }}" method="POST">
                        @csrf
                        <div class="row border-bottom">
                            <div class="col-4">
                                <input type="text" required id="client-name" name="name" value=""
                                    class=" form-control" placeholder="Client Name...">
                                <div id="user-list">

                                </div>
                            </div>
                            <div class="col-4">
                                <input type="date" id="due-date" required name="due_date" value=""
                                    class=" form-control" placeholder="Due Date...">

                                <input type="hidden" id="stock-id" name="stock_id" value="">
                                <input type="hidden" id="user-id" name="user_id" value="">

                            </div>
                            <div class="col-2">
                                <input type="text" name="InvoiceNo" required value="INV-" id="invoice-no""
                                    class="form-control" placeholder="Invoice...">
                            </div>

                            <div class="col-4 my-2">
                                <input type="text" id="email" disabled name="email" value=""
                                    class="form-control" placeholder="Email...">
                            </div>
                            <div class="col-4 my-2">
                                <input type="text" id="address" disabled name="address" value=""
                                    class="form-control" placeholder="Address...">
                            </div>
                            <hr>
                        </div>

                        <div class="row mt-4">
                            <div class="col-4">
                                <select id="foo" onchange="SelectProduct(this)" type="text" id="product_id"
                                    name="product_id[]" class="form-control form-select-lg select2 abc"
                                    aria-label=".form-select-lg example" style="height: 40px">
                                    <option value="">Select Product</option>
                                    @foreach ($products as $product)
                                        <option value="{{ $product->id }}">{{ $product->product_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-2">
                                <input type="number" readonly name="price[]" id="price-input" value=""
                                    class=" form-control" placeholder="Price...">
                            </div>
                            <div class="col-2">
                                <input type="number" name="qty[]" min="1"
                                    oninput="validity.valid||(value='');"" value="1" id="qty"
                                    onchange="updatePrice(this)"" class="qty form-control" placeholder="Qty...">
                            </div>
                            <div class="col-2">
                                <input type="number" readonly id="total-price-input" name="amount[]" value=""
                                    class="single-product-price form-control" placeholder="Total Amount...">
                            </div>
                            <div class="col-2 ">
                                <button type="button" value=""
                                    class="btn btn-success text-white add-product">+</button>
                            </div>
                        </div>
                        <hr class="add-item">


                        <div class="row">
                            <div class="col-12 col-md-7">

                                <textarea id="note" name="note" placeholder="Note..." cols="25" rows="3"></textarea>
                                <div class="">
                                    <label class="mt-2">Select Payment Method</label>
                                    <br>

                                    <div class="">
                                        <div class="form-check">
                                            <input class="form-check-input" onclick="selectMobileBankingPayment()"
                                                type="radio" name="paymentOption" id="mobileBanking">
                                            <label class="form-check-label" for="mobileBanking">
                                                Mobile Banking
                                            </label>
                                        </div>

                                        <div id="mobile-option" class="d-none">
                                            <div class="pl-3">
                                                <div class="form-check">
                                                    <input class="form-check-input hide-show"
                                                        onclick="selectBkashPayment()" type="radio"
                                                        name="mobileBankingName" id="bkash">
                                                    <label class="form-check-label" for="bkash">
                                                        Bkash
                                                    </label>
                                                    <div id="bkash-input-field" class="d-none">
                                                        <input type="tel" id="bkash-number" class="w-50 form-control"
                                                            name="bkash" placeholder="Bkash Number..." />
                                                    </div>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input hide-show"
                                                        onclick="selectNagadPayment()" type="radio"
                                                        name="mobileBankingName" id="nagad">
                                                    <label class="form-check-label" for="nagad">
                                                        Nagad
                                                    </label>
                                                    <div id="nagad-input-field" class="d-none">
                                                        <input type="number" id="nagad-number" class="w-50 form-control"
                                                            name="nagad" placeholder="Nagad Number..." />
                                                    </div>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input hide-show"
                                                        onclick="selectRocketPayment()" type="radio"
                                                        name="mobileBankingName" id="rocket">
                                                    <label class="form-check-label" for="rocket">
                                                        Rocket
                                                    </label>
                                                    <div id="rocket-input-field" class="d-none">
                                                        <input type="number" id="rocket-number"
                                                            class="w-50 form-control" name="rocket"
                                                            placeholder="Rocket Number..." />
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-check">
                                            <input class="form-check-input" onclick="selectCardPayment()" type="radio"
                                                name="paymentOption" id="cardPayment">
                                            <label class="form-check-label" for="cardPayment">
                                                Card
                                            </label>
                                        </div>
                                        <div id="card-option" class="d-none">
                                            <div class="">
                                                <div class="form-check">
                                                    <input type="number" id="card-number" class="w-50 form-control"
                                                        name="card" placeholder="Card Number..." />
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-check">
                                        <input checked class="form-check-input" onclick="selectCashPayment()"
                                            type="radio" name="paymentOption" id="cashPayment">
                                        <label class="form-check-label" for="cashPayment">
                                            Cash
                                        </label>
                                        <input type="hidden" id="payment-by" name="payment_by" value="cash">
                                        <input type="hidden" id="method" name="method" value="cash">
                                    </div>
                                </div>
                                {{-- <button type="submit" class=" mt-2 btn btn-success btn-sm save-item">Save</button> --}}
                                <button type="submit" class=" mt-2 btn btn-success btn-sm">Save</button>
                            </div>
                            <div class="col-12 col-md-5">
                                <div class="row">
                                    <div class="col-5 col-md-4 mt-1">
                                        <strong>Sub Total:</strong>
                                    </div>
                                    <div class="col-7 col-md-8 mt-1">
                                        <input type="number" id="subTotalAmout" readonly name="sub_total"
                                            value="" class="form-control" placeholder="sub total...">
                                        {{-- <p id="subTotalAmout"></p> --}}
                                    </div>
                                    <div class="col-5 col-md-4 mt-1">
                                        <strong id="show-vat-amount">Vat(%):</strong>
                                    </div>
                                    <div class="col-5 col-md-6 mt-1">
                                        <input type="number" min="0" oninput="validity.valid||(value='');""
                                            id="vat" name="vat" value="" class="form-control"
                                            placeholder="Vat...">
                                    </div>
                                    <div class="col-2 col-md-2 mt-1">
                                        <button type="button" id="delete-vat" title="Delete Vat"
                                            class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></button>
                                    </div>
                                    <div class="col-5 col-md-4 mt-1">
                                        <strong id="show-tax-amount">Tax(%)</strong>

                                    </div>
                                    <div class="col-5 col-md-6 mt-1">
                                        <input type="number" min="0" oninput="validity.valid||(value='');"
                                            id="tax" name="tax" value="" class="form-control"
                                            placeholder="tax...">
                                        {{-- <p id='taxAmount'>0</p> --}}
                                    </div>
                                    <div class="col-2 col-md-2 mt-1">
                                        <button type="button" id="delete-tax" title="Delete Vat"
                                            class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></button>
                                    </div>
                                    <div class="col-5 col-md-4 mt-1">
                                        <strong>Discount:</strong>
                                    </div>
                                    <div class="col-5 col-md-6 mt-1">
                                        <input type="number" min="0" oninput="validity.valid||(value='');"
                                            id="discount" name="discount" value="" class="form-control"
                                            placeholder="Discount...">
                                    </div>
                                    <div class="col-2 col-md-2 mt-1">
                                        <button type="button" id="delete-discount" title="Delete Discount"
                                            class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></button>
                                    </div>
                                    <div class="col-5 col-md-4 mt-1">
                                        <strong>Load/Unload:</strong>
                                    </div>
                                    <div class="col-5 col-md-6 mt-1">
                                        <input type="number" min="0" oninput="validity.valid||(value='');"
                                            id="load-unload" name="load_unload" value="" class="form-control"
                                            placeholder="Load/Unload...">
                                    </div>
                                    <div class="col-2 col-md-2 mt-1">
                                        <button type="button" id="delete-load-unload" title="Delete"
                                            class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></button>
                                    </div>
                                    <div class="col-5 col-md-4 border-top mt-2">
                                        <strong>Total:</strong>
                                    </div>
                                    <div class="col-7 col-md-8 border-top mt-2">
                                        <strong id="final-total">0</strong>
                                        <input type="hidden" id="totalAmount" name="total_amount" value="">
                                    </div>
                                </div>

                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>
@endsection
@section('scripttop')
@endsection
@section('script')
    @include('Admin.sales.sales_js')
@endsection
