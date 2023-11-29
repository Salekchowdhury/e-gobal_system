<script type="text/javascript">
    $(document).ready(function() {


        $.ajax({
            url: "<?php echo e(route('admin.sales.product')); ?>",
            method: 'get',

            success: function(res) {
                if (res.status == 200) {
                    console.log('res', res)
                    // $('.show-success-error').html(res.message)
                    // alert("Insert data successfully")
                    // location.reload();

                } else {
                    $('.show-success-error').html(res.message)
                }

            }
        })



    });
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    // variables
    var productData = [];
    var totalVat = 0;

    var pPrice = '';
    var items = [];
    var purchaseData = [];
    var clientName = '';
    var dueDate = '';
    var invoiceNo = '';
    var userId = '';
    var stockId = '';
    var payment = 'online';
    var method = '';
    var paymentBy = '';
    var cardPhoneNumber = '';
    var note = '';
    var subTotal = 0;
    var inputVatValue = 0;
    var totalVat = 0;
    var inputTaxValue = 0;
    var totalTax = 0;
    var totalDiscount = 0;
    var totalLoadUnload = 0;
    var finalTotal = 0;
    var updateQuntity = 0;


    function selectMobileBankingPayment() {
        method = 'mobile banking'
        var mblBanking = document.getElementById('mobileBanking');
        if (mblBanking.checked == true) {
            var element = document.getElementById('mobile-option');
            element.classList.toggle("d-none");

        }

    }

    function selectCardPayment() {
        $('#payment-by').val('card')
        $('#method').val('banking')
        method = 'card'
        var cardPayment = document.getElementById('cardPayment');
        if (cardPayment.checked == true) {
            var element = document.getElementById('card-option');
            element.classList.toggle("d-none");

        }

    }

    function selectCashPayment() {
        $('#payment-by').val('cash')
        $('#method').val('cash')
        method = 'cash'
        cardPhoneNumber = 'cash';
        paymentBy = 'cash';
        console.log('cardPhoneNumber', cardPhoneNumber)
        console.log('paymentBy', paymentBy)
        console.log('method', method)
    }

    function selectBkashPayment() {
        $('#payment-by').val('bkash')
        $('#method').val('mobile')
        paymentBy = 'bkash'
        // $.each( $('.hide-show'), function( key, value ) {
        //     console.log( key + ": " + value );
        //     });
        var bkashCheckbox = document.getElementById('bkash');
        if (bkashCheckbox.checked == true) {
            var element = document.getElementById('bkash-input-field');
            element.classList.toggle("d-none");
        }

    }

    function selectNagadPayment() {
        $('#payment-by').val('nagad')
        $('#method').val('mobile')
        paymentBy = 'nagad'
        var nagadCheckbox = document.getElementById('nagad');
        if (nagadCheckbox.checked == true) {
            var element = document.getElementById('nagad-input-field');
            element.classList.toggle("d-none");
        }
    }

    function selectRocketPayment() {
        $('#payment-by').val('rocket')
        $('#method').val('mobile')
        paymentBy = 'rocket'
        var rocketCheckbox = document.getElementById('rocket');
        if (rocketCheckbox.checked == true) {
            var element = document.getElementById('rocket-input-field');
            element.classList.toggle("d-none");
        }
    }

    // Get Client Name

    $("#client-name").on("keyup", function() {

        let searchValue = $(this).val();

        $.ajax({
            url: "<?php echo e(route('admin.sales.search')); ?>",
            method: 'GET',
            data: {
                'name': searchValue
            },
            success: function(data) {
                $("#user-list").html(data)
            }
        });

    });

    // $("#client-name").on("input", function() {

    //     let client = $(this).val();
    //     clientName = client;

    // });

    $("#invoice-no").on("input", function() {

        let invoiceNumber = $(this).val();
        invoiceNo = invoiceNumber;
        console.log('invoiceNo', invoiceNo)

    });

    // Get Client Name

    $("#note").on("input", function() {

        let inputNote = $(this).val();

        note = inputNote;

    });

    // Get Due Date


    $("#due-date").on("input", function() {

        let date = $(this).val();

        dueDate = date;

    });

    //calculate tax

    $("#bkash-number").on("input", function() {

        let bkashNumber = $(this).val();

        cardPhoneNumber = bkashNumber;

    });

    $("#nagad-number").on("input", function() {

        let nagadhNumber = $(this).val();

        cardPhoneNumber = nagadhNumber;

    });

    $("#rocket-number").on("input", function() {

        let rocketNumber = $(this).val();

        cardPhoneNumber = rocketNumber;

    });

    $("#card-number").on("input", function() {

        let cardNumber = $(this).val();

        cardPhoneNumber = cardNumber;
        paymentBy = 'card';

    });


    /// '''''''' Delete ''''''''//

    // delete Vat

    $(document).on('click', '#delete-vat', function() {
        // alert('hello')
        console.log(inputTaxValue)
        inputVatValue = 0;
        totalVat = 0;
        $('#vatAmount').text('');
        $('#vat').val('');
        $('#show-vat-amount').text('Vat(' + '' + '%)');
        calculatePrice(subTotal, totalTax, totalVat, totalDiscount, totalLoadUnload);


    })

    // delete Tax

    $(document).on('click', '#delete-tax', function() {

        inputTaxValue = 0;
        totalTax = 0;
        $('#taxAmount').text('');
        $('#tax').val('');
        $('#show-tax-amount').text('Tax(' + '' + '%)');
        calculatePrice(subTotal, totalTax, totalVat, totalDiscount, totalLoadUnload);


    })

    // Delete Discount

    $(document).on('click', '#delete-discount', function() {

        totalDiscount = 0;
        $('#discount').val('');
        calculatePrice(subTotal, totalTax, totalVat, totalDiscount, totalLoadUnload);

    })

    // Delete Load Unload

    $(document).on('click', '#delete-load-unload', function() {

        totalLoadUnload = 0;
        $('#load-unload').val('');
        calculatePrice(subTotal, totalTax, totalVat, totalDiscount, totalLoadUnload);

    })

    $(document).on('click', '.user-id', function(e) {

        let value = $('.user-id').text();

        $('#client-name').val(value);
        $('#user-list').html('');

        let idNumber = $(this).val();
        userId = idNumber;

        $.ajax({
            url: "<?php echo e(route('admin.sales.show.user')); ?>",
            method: 'GET',
            data: {
                'user_id': userId
            },
            success: function(data) {
                $('#client-name').val(data.data[0]['name']);
                $('#email').val(data.data[0]['email'])
                $('#address').val(data.data[0]['store_address'])
                $('#stock-id').val(data.data[0].stockiest.id)
                $('#user-id').val(idNumber)
                // stockId = data.data[0].stockiest.id;

            }
        });

        console.log('idNumber', idNumber);

    });



    $("#tax").on("input", function() {
        let subTotalAmount = $('#subTotalAmout').val();
        subTotal = subTotalAmount;
        let tax = $(this).val();

        let caluTax = (subTotal * tax) / 100;
        inputTaxValue = tax;
        totalTax = caluTax;
        $('#taxAmount').text(caluTax);
        $('#show-tax-amount').text('Tax(' + tax + '%)');
        calculatePrice(subTotal, totalTax, totalVat, totalDiscount, totalLoadUnload);

    });

    //calculate Vat

    $("#vat").on("input", function() {

        let subTotalAmount = $('#subTotalAmout').val();
        subTotal = subTotalAmount;
        let vat = $(this).val();
        inputVatValue = vat;
        let caluVat = (subTotal * vat) / 100;
        totalVat = caluVat;
        $('#vatAmount').text(caluVat);
        $('#show-vat-amount').text('Vat(' + vat + '%)');
        calculatePrice(subTotal, totalTax, totalVat, totalDiscount, totalLoadUnload);

    });

    //calculate discount

    $("#discount").on("input", function() {

        let subTotalAmount = $('#subTotalAmout').val();
        subTotal = subTotalAmount;
        let discount = $(this).val();
        totalDiscount = discount;
        console.log('totalDiscount, subTotal', totalDiscount, subTotal)
        $('#show-discount').text(discount);
        calculatePrice(subTotal, totalTax, totalVat, totalDiscount, totalLoadUnload);

    });

    //calculate load-unload

    $("#load-unload").on("input", function() {
        let subTotalAmount = $('#subTotalAmout').val();
        subTotal = subTotalAmount;
        let loadUnload = $(this).val();
        totalLoadUnload = loadUnload;
        $('#show-load-unload').text(loadUnload);
        calculatePrice(subTotal, totalTax, totalVat, totalDiscount, totalLoadUnload);

    });

    function handleTax(e) {

        var taxInput = document.getElementById("tax");
        let subTotal = $('#subTotalAmout').text();

        // console.log(taxInput);
        var tax = taxInput.value;


        document.getElementById("taxAmount").innerHTML = tax
    }

    //Save Imtem in Database



    $(document).on('click', '.add-product', function(e) {
        e.preventDefault();

        var productId = $("#foo option:selected").attr('value')
        // var productId = $(this).val();
        // alert(productId);



        itemMap(productId)
        product();


    })

    function itemMap(id = 0) {

        var itemHtml = '';
        let sumSubTotal = 0;

        itemHtml = `<div class="row mt-4">

                            <div class="col-4">
                                <select id="foo" onchange="SelectProduct(this)" type="text" id="product_id"
                                    name="product_id[]" class="form-control form-select-lg select2 abc"
                                    aria-label=".form-select-lg example" style="height: 40px">
                                    <option value="">Select Product</option>
                                    <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($product->id); ?>"><?php echo e($product->product_name); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </div>
                        <div class="col-2">
                            <input type="text" name="price[]" readonly value="" class="price-input form-control"
                                placeholder="Price...">
                        </div>
                        <div class="col-2">
                            <input type="number" id="upQty" name="qty[]" min="1"
                                oninput="validity.valid||(value='');" value="1" onchange="updatePrice(this)"
                                class="qty form-control" placeholder="Qty...">
                        </div>
                        <div class="col-2">
                            <input type="number" readonly name="amount[]" value=""
                                class="single-product-price form-control" placeholder="Total Amount...">
                        </div>
                        <div class="col-2">
                            <button type="button" value="" onclick="removeItem(this)"
                                class=" btn bg-danger  text-white remove-product">-</button>
                        </div>
                            <hr>
             </div>`
        subTotal = sumSubTotal;
        console.log('productData 1', productData)
        calculatePrice(subTotal, totalTax, totalVat, totalDiscount, totalLoadUnload);
        // $('#subTotalAmout').val(subTotal);
        calculateSubTotal();
        $(itemHtml).insertBefore('.add-item');
        $('.select2').select2();
    }


    function removeItem(e, id) {
        // alert(e.value);

        // productData = productData.filter(function(item) {
        //     return item !== e.value
        // })
        // productData.remove(e.value);
        // console.log('productData'productData)
        e.parentElement.parentElement.remove();
        calculateSubTotal();
        // itemMap();
        calculatePrice(subTotal, totalTax, totalVat, totalDiscount, totalLoadUnload);
        console.log('productData', productData)
    }

    function calculatePrice(subTotal, totalTax, totalVat, totalDiscount, totalLoadUnload) {

        var total = parseInt(subTotal) + (parseInt(totalVat) + parseInt(totalTax) - parseInt(totalDiscount) + parseInt(
            totalLoadUnload))
        finalTotal = total;
        console.log('finalTotal', finalTotal);
        $('#final-total').text(finalTotal);
        $('#totalAmount').val(finalTotal);
    }


    function updatePrice(e) {
        // alert(e.value);

        var qty = e.value;
        console.log('qty', qty)




        var price = e.parentElement.previousElementSibling.children[0].value;
        if (price) {
            var totalSingleProductPrice = e.parentElement.nextElementSibling.children[0].value = (qty * price);
        } else {
            alert('Please Select Product')
        }
        calculateSubTotal();


    }

    function calculateSubTotal() {
        var allProductPrice = 0;
        $.each($('.single-product-price'), function(key, item) {
            console.log('item', item.value)
            allProductPrice += parseInt(item.value);

        })
        $('#subTotalAmout').val(allProductPrice);
        $('#totalAmount').val(allProductPrice);
        $('#final-total').text(allProductPrice);
        // console.log('allProductPrice', allProductPrice)
    }




    function updateQty(e, productId) {
        // e.stopPropagation();

        // $("#upQty").on("input", function() {
        // // alert('hi')
        //    let Qty = $(this).val();

        //    updateQuntity = Qty;

        //     console.log('upQty',Qty);

        //   });

        let price = e.parentElement.previousElementSibling.children[0].value;

        updateQuntity = e.value;

        e.parentElement.nextElementSibling.children[0].value = (price * updateQuntity);
        // console.log('target',e.value);

        items.map(item => {
            if (parseInt(item.productId) == parseInt(productId)) {
                console.log('product id is', productId)
                item.qty = updateQuntity;
                item.totalPrice = (item.price * updateQuntity);

            }
            // debugger
            // console.log(e)
            e.parentElement.parentElement.remove();
        })
        itemMap();
        console.log('show imtems data', items)
    }


    function SelectProduct(e) {
        // alert('hi');
        var id = e.value;
        $(".remove-product").val(id);
        console.log(e.parentElement.nextElementSibling)
        $.ajax({
            // headers: {
            //     'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            // },
            url: '<?php echo e(route('admin.sales.show')); ?>',
            type: "get",
            data: {
                'id': id
            },
            success: function(response) {

                var producPrice = response.data.admin_product_price;
                e.parentElement.nextElementSibling.children[0].value = producPrice;
                e.parentElement.nextElementSibling.nextElementSibling.children[0].value = 1
                e.parentElement.nextElementSibling.nextElementSibling.nextElementSibling.children[0].value =
                    producPrice;
                calculateSubTotal();
            }
        });
    }


    function product() {
        var product = [];
        var itemHtml = '';

        var allProduct = $('.select2');


        $.each(allProduct, function(index, value) {

            if (value.value != undefined) {
                product.push(value.value);

                // console.log('value is ', value.value);
            }

        })

        $.each($('.abc option'), function(ind, obj) {
            var productItem = 0;
            $.each(product, function(index, object) {
                if (object.getAttribute("value") == obj.getAttribute("value")) {
                    obj.setAttribute("disabled")


                }
            });

        })
    }

    //  function itemMap(id=0) {

    // var itemHtml = '';
    // let sumSubTotal = 0;

    // var allProduct = $('.select2');
    // console.log('allProduct',allProduct)

    // $.each(allProduct, function(index, value) {

    //     if (value.value != undefined) {
    //         productData.push(value.value);

    //     }

    // })

    // itemHtml = `<div class="row mt-4">
    //                  <div class="col-4">
    //                         <select  onchange="SelectProduct(this)" type="text" id="product_id" name="product_id[]"
    //                             class="form-control select2 product-select">

    //                             <option  value="">Select Product</option>
    //                         <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>`
    //                 var productItem = 0;
    //                 $.each(productData, function(index, ele) {
    //                     if (ele == <?php echo e($product->id); ?> && ele ==id) {
    //                         productItem = 1;
    //                         itemHtml +=
    //                             `<option value="<?php echo e($product->id); ?>" selected><?php echo e($product->product_name); ?></option>`;

    //                     }else if (ele == <?php echo e($product->id); ?>) {
    //                         productItem = 1;
    //                         itemHtml +=
    //                             `<option value="<?php echo e($product->id); ?>" disabled><?php echo e($product->product_name); ?></option>`;
    //                     }

    //                 })
    //                 if (productItem == 0) {
    //                     itemHtml += `<option value="<?php echo e($product->id); ?>"><?php echo e($product->product_name); ?></option>`;
    //                 }
    //                 itemHtml += `
    //                             <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    //                         </select>
    //                     </div>
    //                     <div class="col-2">
    //                     <input type="text" name="price[]" readonly value="" class="price-input form-control" placeholder="Price...">
    //                     </div>
    //             <div class="col-2">
    //             <input type="number" id="upQty" name="qty[]" min="1" oninput="validity.valid||(value='');" value="1"  onchange="updatePrice(this)"  class="qty form-control" placeholder="Qty...">
    //             </div>
    //             <div class="col-2">
    //             <input type="number" readonly name="amount[]" value="" class="single-product-price form-control" placeholder="Total Amount...">
    //             </div>
    //             <div class="col-2">
    //             <button type="button"  value="" onclick="removeItem(this)" class=" btn bg-danger  text-white remove-product" >-</button>
    //             </div>
    //             <hr>
    //      </div>`
    // subTotal = sumSubTotal;
    // console.log('productData 1', productData)
    // calculatePrice(subTotal, totalTax, totalVat, totalDiscount, totalLoadUnload);
    // $('#subTotalAmout').val(subTotal);
    // $(itemHtml).insertBefore('.add-item');
    // $('.select2').select2();
    // }
</script>
<?php /**PATH C:\xampp\htdocs\eglobalmart\resources\views/Admin/sales/sales_js.blade.php ENDPATH**/ ?>