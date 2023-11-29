
<script type="text/javascript">
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    // variables

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





 // phone number validation


//  function phoneNumberValidation (){
//      var phIn = cardPhoneNumber

//         phIn.addEventListener('input', () => {
//         phIn.setCustomValidity('')
//         phIn.checkValidity()
//         })

//         phIn.addEventListener('invalid', () => {
//         if (phIn.value === '') {
//             phIn.setCustomValidity('Enter phone number!')
//             return false
//         } else {
//             phIn.setCustomValidity(
//             'Enter a phone number in this format: 123-456-7890',
//             )
//             return false
//         }
//         })
//         return true;
//  }


        //  function phonenumber(inputPhone)
        // {

        // var phoneno = /^\(?([0-9]{5})\)?[-. ]?([0-9]{6})$/;
        // console.log(inputPhone);
        // console.log(phoneno);

        // if(inputPhone.value.match(phoneno))
        //     {
        //     return true;
        //     }
        // else
        //     {
        //     alert("Not a valid Phone Number");
        //     return false;
        //     }
        // }

    // payment method selection
    function selectMobileBankingPayment() {
        method = 'mobile banking'
        var mblBanking = document.getElementById('mobileBanking');
        if (mblBanking.checked == true) {
            var element = document.getElementById('mobile-option');
            element.classList.toggle("d-none");

        }

    }

     function selectCardPayment() {
        method = 'card'
        var cardPayment = document.getElementById('cardPayment');
        if (cardPayment.checked == true) {
            var element = document.getElementById('card-option');
            element.classList.toggle("d-none");

        }

    }

    function selectCashPayment() {
        method = 'cash'
        cardPhoneNumber = '';
        paymentBy = '';
        console.log('cardPhoneNumber',cardPhoneNumber)
        console.log('paymentBy',paymentBy)
        console.log('method',method)
    }

    function selectBkashPayment() {
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
        paymentBy = 'nagad'
        var nagadCheckbox = document.getElementById('nagad');
        if (nagadCheckbox.checked == true) {
            var element = document.getElementById('nagad-input-field');
            element.classList.toggle("d-none");
        }
    }

    function selectRocketPayment() {
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
            data: {'name':searchValue},
            success:function(data){
                $("#user-list").html(data)
            }
        });


        // clientName = client;

    });

    // $("#client-name").on("input", function() {

    //     let client = $(this).val();
    //     clientName = client;

    // });

     $("#invoice-no").on("input", function() {

        let invoiceNumber = $(this).val();
        invoiceNo = invoiceNumber;
        console.log('invoiceNo',invoiceNo)

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
        paymentBy = '';

    });


    /// '''''''' Delete ''''''''//

    // delete Vat

    $(document).on('click', '#delete-vat', function(){
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

    $(document).on('click', '#delete-tax', function(){

        inputTaxValue = 0;
        totalTax = 0;
        $('#taxAmount').text('');
        $('#tax').val('');
        $('#show-tax-amount').text('Tax(' + '' + '%)');
        calculatePrice(subTotal, totalTax, totalVat, totalDiscount, totalLoadUnload);


    })

    // Delete Discount

    $(document).on('click', '#delete-discount', function(){

        totalDiscount = 0;
        $('#discount').val('');
        calculatePrice(subTotal, totalTax, totalVat, totalDiscount, totalLoadUnload);

    })

    // Delete Load Unload

    $(document).on('click', '#delete-load-unload', function(){

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
            data: {'user_id': userId},
            success:function(data){
                $('#client-name').val(data.data[0]['name']);
                $('#email').val(data.data[0]['email'])
                $('#address').val(data.data[0]['store_address'])
                stockId = data.data[0].stockiest.id;


                // console.log('data is', data.data[0]['email'])
                // console.log('data is', data.data[0]['name'])
                // console.log('data is', data.data[0].stockiest.id)
                // console.log('data is', data.data.stockiest.id)
                // $("#user-list").html(data)
            }
        });

        console.log('idNumber',idNumber);

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
        alert(e.target.value);
        var taxInput = document.getElementById("tax");
        let subTotal = $('#subTotalAmout').text();
        alert(subTotal);
        // console.log(taxInput);
        var tax = taxInput.value;
        alert(subTotal.value);

        document.getElementById("taxAmount").innerHTML = tax
    }

    //Save Imtem in Database

    $(document).on('click', '.save-item', function(e) {

        e.preventDefault();
        // items[...items, name: 'salek'];
        // items.push('salek chy');


        // phoneNumberValidation();

         if(!userId){
             alert('is emplty');
         return false;
         }else{
            alert('is not emplty');
         return false;
         }

        purchaseData.push({
            user_id: userId,
            stock_id: stockId,
            Invoice_no: invoiceNo,
            due_date: dueDate,
            tax: inputTaxValue,
            vat: inputVatValue,
            discount: totalDiscount,
            load_unload: totalLoadUnload,
            amount: finalTotal,
            note: note,
            cardPhoneNumber: cardPhoneNumber,
            paymentBy: paymentBy,
            method: method,
        });
        // purchaseData.push(...purchaseData, tax: totalTax);
        // purchaseData.push({tax: totalTax});
        let saveData = [...items, ...purchaseData];

        $.ajax({
            url: "<?php echo e(route('admin.sales.store')); ?>",
            method: 'post',
            data: {
                saveData
            },
            success: function(res) {
                if(res.status == 200){
                 $('.show-success-error').html(res.message)
                 alert("Insert data successfully")
                 location.reload();

                }else{
                    $('.show-success-error').html(res.message)
                }
                // console.log(res)
                // items =[];
                // purchaseData =[];
            }
        })
        // console.log('array data', combine)
    })

    $(document).on('click', '.add-product', function(e) {
        e.preventDefault();
        var productId = $("#foo option:selected").attr('value')
        var productName = $("#foo option:selected").text()
        let price = $('#price-input').val();
        let qty = $('#qty').val();
        let totalPrice = $('#total-price-input').val();
        let subTotal = $('#subTotalAmout').text();

        let newItem = {
            productId: productId,
            productName: productName,
            price: price,
            qty: qty,
            totalPrice: totalPrice,
            // subTotal: subTotal,
        }
        items.push(newItem);
        // var itemHtml = '';

        itemMap()

        // console.log('salek',parseInt(totalVat)+parseInt(totalTax)+parseInt(totalDiscount)+parseInt(totalLoadUnload));


    })

    function itemMap() {
        var itemHtml = '';
        let sumSubTotal = 0;
        items.map((item, index) => {
            console.log('items data', totalVat, totalTax, totalLoadUnload, totalDiscount)
            sumSubTotal = sumSubTotal + parseInt(item.totalPrice)
            itemHtml = `<div class="row mt-4">
                            <div class="col-4">
                                <div class="">
                                <input type="text" readonly name="productName"  value="${item.productName}" class="item-input form-control" placeholder="Product name">
                                </div>
                            </div>
                            <div class="col-2">
                            <input type="text" name="price" readonly value="${item.price}" class="price-input form-control" placeholder="Price...">
                            </div>
                    <div class="col-2">
                    <input type="number" id="upQty" name="qty" value="${item.qty}"  onchange="updateQty(this,${item.productId})"  class="qty form-control" placeholder="Qty...">
                    </div>
                    <div class="col-2">
                    <input type="number" readonly name="amount" value="${item.totalPrice}" class="total-price-input form-control" placeholder="Total Amount...">
                    </div>
                    <div class="col-2">
                    <button type="button"  value="" onclick="removeItem(this, ${item.productId})" class=" btn bg-danger  text-white remove-product" >-</button>
                    </div>
                    <hr>
             </div>`
        });
        subTotal = sumSubTotal;
        calculatePrice(subTotal, totalTax, totalVat, totalDiscount, totalLoadUnload);
        $('#subTotalAmout').val(subTotal);
        $(itemHtml).insertBefore('.add-item');
    }


    function removeItem(e, id) {

        $.each(items, function(i) {
            console.log(items[i]);
            if (parseInt(items[i].productId) === id) {

                items.splice(i, 1);
                return false;
            }
        });
        e.parentElement.parentElement.remove();
        itemMap();
        calculatePrice(subTotal, totalTax, totalVat, totalDiscount, totalLoadUnload);
    }

    function calculatePrice(subTotal, totalTax, totalVat, totalDiscount, totalLoadUnload) {

        var total = parseInt(subTotal) - (parseInt(totalVat) + parseInt(totalTax) + parseInt(totalDiscount) + parseInt(
        totalLoadUnload))
        finalTotal = total;
        console.log('finalTotal', finalTotal);
        $('#final-total').text(finalTotal);
    }

    function updatePrice() {

        var qtyInput = document.getElementById("qty");
        var qty = qtyInput.value;
        let temprice = pPrice;

        $("#total-price-input").val(temprice * qty);
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

          e.parentElement.nextElementSibling.children[0].value = price * updateQuntity;
        // console.log('target',e.value);

       items.map(item=>{
        if(parseInt(item.productId) == parseInt(productId)){
            console.log('product id is', productId)
            item.qty = updateQuntity;
            item.totalPrice = (item.price*updateQuntity);

        }
        // debugger
        // console.log(e)
        e.parentElement.parentElement.remove();
    })
        itemMap();
       console.log('show imtems data', items)
    }


    $('select').change(function() {
        var id = $("#foo option:selected").attr('value')
        // alert(id);

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
                console.log('response is', response.data.product_price)
                var price = response.data.product_price;
                pPrice = price;
                $("#price-input").val(price);
                $("#qty").val(1);
                $("#total-price-input").val(price);
            }
        });
    });
</script>
<?php /**PATH C:\xampp\htdocs\eglobalmart\resources\views/Admin/invoice/invoice_js.blade.php ENDPATH**/ ?>