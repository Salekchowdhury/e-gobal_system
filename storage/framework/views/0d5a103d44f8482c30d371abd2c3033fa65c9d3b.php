<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title> <?php echo e(__('Billing Invoice')); ?> </title>
    <link
        href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,300;0,400;0,500;0,700;0,900;1,300&display=swap"
        rel="stylesheet">
</head>

<body>


    <style>
        * {
            font-family: 'Roboto', sans-serif;
            line-height: 26px;
            font-size: 15px;
        }

        ul {
            margin: 0;
            padding: 0;
            list-style: none;
        }

        /*=========================================================
      [ Table ]
    =========================================================*/

        .custom--table {
            width: 100%;
            color: inherit;
            vertical-align: top;
            font-weight: 400;
            border-collapse: collapse;
            border-bottom: 2px solid #ddd;
            margin-top: 0;
            /* border: 1px solid */
        }

        .table-title {
            font-size: 24px;
            font-weight: 600;
            line-height: 32px;
            margin-bottom: 10px;
        }

        .custom--table thead {
            font-weight: 700;
            background: inherit;
            color: inherit;
            font-size: 16px;
            font-weight: 500;
        }

        .custom--table tbody {
            border-top: 0;
            overflow: hidden;
            border-radius: 10px;
        }
.cutomer{
    float: right;
}
        .custom--table thead tr {
            border-top: 2px solid #ddd;
            border-bottom: 2px solid #ddd;
            text-align: left;
        }

        .custom--table thead tr th {
            border-top: 2px solid #ddd;
            border-bottom: 2px solid #ddd;
            text-align: left;
            font-size: 16px;
            padding: 10px 0;
        }

        .custom-row {
            display: flex;
            flex-wrap: wrap;
            margin-right: -15px;
            margin-left: -15px;
        }

        .custom-col-6 {
            flex: 0 0 33.33333%;
            max-width: 33.33333%;
        }

        .custom--table tbody tr {
            vertical-align: top;
        }

        .custom--table tbody tr td {
            font-size: 14px;
            line-height: 18px vertical-align: top;
        }

        .thank-header {
            text-align: center;
            /* text-align: right; */
        }
        .mt-25{
            margin-top: -25px;
        }

        .custom--table tbody tr td:last-child {
            padding-bottom: 10px;
        }

        .custom--table tbody tr td .data-span {
            font-size: 14px;
            font-weight: 500;
            line-height: 18px;
        }

        .custom--table tbody .table_footer_row {
            border-top: 2px solid #ddd;
            margin-bottom: 10px !important;
            padding-bottom: 10px !important;

        }

        .border-top {
            border-top: 2px solid black;
        }

        /* invoice area */
        .invoice-area {
            padding: 10px 0;
        }

        .invoice-wrapper {
            max-width: 650px;
            margin: 0 auto;
            box-shadow: 0 0 10px #f3f3f3;
            padding: 0px;
        }

        .invoice-header {
            margin-bottom: 40px;
        }

        .invoice-flex-contents {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 24px;
            flex-wrap: wrap;
        }

        .invoice-logo {}

        .invoice-logo img {}

        .invoice-header-contents {
            float: right;
        }
        .float-right{
            float: right;
        }

        .invoice-header-contents .invoice-title {
            font-size: 40px;
            font-weight: 700;
        }

        .invoice-details {
            margin-top: 20px;
        }

        .invoice-details-flex {
            /* display: flex;
        align-items: flex-start;
        justify-content: space-between;
        gap: 24px;
        flex-wrap: wrap; */
        }

        .invoice-details-title {
            font-size: 15px;
            font-weight: 700;
            line-height: 32px;
            color: #333;
            margin: 0;
            padding: 0;
        }

        .invoice-single-details {}

        .details-list {
            margin: 0;
            padding: 0;
            list-style: none;
            /* margin-top: 10px; */
        }

        .details-list .list {
            font-size: 14px;
            font-weight: 400;
            line-height: 18px;
            /* color: #666; */
            margin: 0;
            padding: 0;
            transition: all .3s;
        }

        .details-list .list strong {
            font-size: 14px;
            font-weight: 500;
            line-height: 18px;
            /* color: #666; */
            margin: 0;
            padding: 0;
            transition: all .3s;
        }

        .details-list .list a {
            display: inline-block;
            /* color: #666; */
            transition: all .3s;
            text-decoration: none;
            margin: 0;
            line-height: 18px
        }

        .item-description {
            margin-top: 10px;
        }

        .text-align-right {
            text-align: right;
        }

        .products-item {
            text-align: left;
        }

        .invoice-total-count {}

        .invoice-total-count .list-single {
            display: flex;
            align-items: center;
            gap: 30px;
            font-size: 16px;
            line-height: 28px;
        }

        .invoice-total-count .list-single strong {}

        .invoice-subtotal {
            border-bottom: 2px solid #ddd;
            padding-bottom: 15px;
        }

        .invoice-total {
            padding-top: 10px;
        }

        .terms-condition-content {
            margin-top: 30px;
        }

        .terms-flex-contents {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 20px;
            flex-wrap: wrap;
        }

        .terms-left-contents {
            flex-basis: 50%;
        }

        .terms-title {
            font-size: 18px;
            font-weight: 700;
            color: #333;
            margin: 0;
        }

        .terms-para {
            margin-top: 10px;
        }

        .invoice-footer {}

        .invoice-flex-footer {
            display: flex;
            align-items: flex-start;
            justify-content: space-between;
            flex-wrap: wrap;
            gap: 30px;
        }

        .th-bg {
            background-color: #333
        }

        .single-footer-item {
            flex: 1;
        }

        .price_td {
            width: 50%;
        }

        .single-footer {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .single-footer .icon {
            display: flex;
            align-items: center;
            justify-content: center;
            height: 30px;
            width: 30px;
            font-size: 16px;
            background-color: #000e8f;
            color: #fff;
        }

        .icon-details {
            flex: 1;
        }

        .icon-details .list {
            display: block;
            text-decoration: none;
            color: #666;
            transition: all .3s;
            line-height: 24px;
        }
    </style>

    <!-- Invoice area Starts -->

    <main>
        <div class="invoice-area">
            <div class="invoice-wrapper">
                <div class="invoice-header">
                    <div class="invoice-flex-contents">
                        <div class="invoice-logo">
                        </div>
                        <div class="invoice-header-contents" style="float:right;margin-top:-120px;">
                            <h2 class="invoice-title"><?php echo e(__('INVOICE')); ?></h2>
                        </div>
                    </div>
                </div>
                <div>
                    <h1 class="thank-header" style="font-size: 25px">E-Global Mart</h1>
                 </div>
                 <div>
                    <p class="thank-header mt-25" style="font-size: 20px"><?php echo e($setting->address); ?></p>
                 </div>
                 <div>
                     <p class="thank-header  mt-25" style="font-size: 20px">Phone:<?php echo e($setting->contact); ?></p>
                </div>
                <div>
                    <?php

                    $dt = new DateTime('now', new DateTimezone('Asia/Dhaka'));
                    $currentDate = $dt->format('g:i a');

                        foreach ($datas as $data ){
                            $invoice_id = $data->invoice_id;
                            // date('d-m-Y', strtotime($user->from_date))
                            $bill_date = date('d-m-Y', strtotime(date('d-m-Y', strtotime($data->created_at))));
                        }


                        ?>

                   REF: <span><?php echo e($invoice_id); ?></span> <br>
                   Sale Code: <span> </span > <span style="margin-left: 340px"> Invoice No : <span><?php echo e($invoice_id); ?></span></span><br>
                   Bill Date: <span><?php echo e($bill_date); ?></span> <span style="margin-left: 50px">Time: <span><?php echo e($currentDate); ?></span></span>
                   <span style="margin-left: 128px">Creator Name: <span><?php echo e($auth_name); ?></span></span>
                </div>
                <div class="invoice-details" style="border-top: 1px solid black">
                    <div class="invoice-details-flex">
                        <div class="invoice-single-details">
                            <h4 class="invoice-details-title"><?php echo e(__('Customer Info:')); ?></h4>
                            <ul class="details-list">
                                <li class="list">Name: <?php echo e($userData->name); ?> </li>
                                <li class="list">Phone: <?php echo e($userData->email); ?> </li>
                                <li class="list">Address: <?php echo e($userData->store_address); ?> </li>
                            </ul>
                        </div>
                        
                    </div>
                </div>

                <div class="item-description">
                    <table class="custom--table">
                        <thead class="" style="background-color: #333; color:#ddd;">
                            <tr>
                                <th style="text-align: center"><?php echo e(__('SL')); ?></th>
                                <th><?php echo e(__('Product Name')); ?></th>
                                <th><?php echo e(__('Price')); ?></th>
                                <th><?php echo e(__('Quantity')); ?></th>
                                <th><?php echo e(__('Amount')); ?></th>
                                
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $s = 1;
                            ?>
                            <?php $__currentLoopData = $datas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php
                                $vat = ($data->vat * $data->sub_total) / 100;
                                $tax = ($data->tax * $data->sub_total) / 100;
                                ?>
                                <?php $__currentLoopData = $data->purchaseDetails; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td style="text-align: center"><?php echo e($s++); ?></td>
                                        <td class="price_td"><?php echo e($item->product->product_name); ?></td>
                                        <td><?php echo e($item->price); ?></td>
                                        <td><?php echo e($item->qty); ?></td>
                                        <td><?php echo e($item->qty * $item->price); ?></td>

                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                            <tr class="border-top">
                                <td></td>
                                <td></td>
                                <td colspan="2"><strong><?php echo e(__('Sub Total')); ?></strong></td>
                                <td><?php echo e($data->sub_total); ?></td>
                            </tr>
                            <tr class="">
                                <td></td>
                                <td>Sale Return & Exchange is not Acceptable</td>
                                <td colspan="2"><strong><?php echo e(__('Tax')); ?> (<?php echo e($data->tax); ?>%)</strong></td>
                                <td><?php echo e($tax); ?></td>
                            </tr>
                            <tr class="">
                                <td></td>
                                <td></td>
                                <td colspan="2"><strong><?php echo e(__('Vat')); ?> (<?php echo e($data->vat); ?>%)</strong></td>
                                <td><?php echo e($vat); ?></td>
                            </tr>
                            <tr class="">
                                <td></td>
                                <td></td>
                                <td colspan="2"><strong><?php echo e(__('Discount')); ?></strong></td>
                                <td><?php echo e($data->discount); ?></td>
                            </tr>
                            <tr class="">
                                <td></td>
                                <td></td>
                                <td colspan="2"><strong><?php echo e(__('Load/Unload')); ?></strong></td>
                                <td><?php echo e($data->load_unload); ?></td>
                            </tr>
                            <tr>
                                <td></td>
                                <td></td>
                                <td class="border-top" colspan="2"><strong><?php echo e(__('Total')); ?></strong></td>
                                <td class="border-top"><?php echo e($data->amount); ?></td>
                            </tr>

                        </tbody>
                    </table>
                    <h2 class="thank-header">Thank You For Shopping With Us</h2>


                </div>



            </div>
        </div>

    </main>
    <footer>
        <div class="" style="margin-top: 20px;">
            <p class="cutomer" style="margin-left:15px;">Authorised Sign & Seal</p>
              <p>Customer Signature</p>
           </div>
           <div>
               <p class="thank-header" style="font-size: 10px">E-Global Mart software developed by R-Creation</p>
            </div>
            <div>
                <p class="thank-header  mt-25" style="font-size: 10px">Tel: +880-1813-316786, +880-1722-964303</p>
           </div>
    </footer>
    <!-- Invoice area end -->

</body>

</html>


<?php /**PATH C:\xampp\htdocs\eglobalmart\resources\views/Admin/pdf/sales_invoice.blade.php ENDPATH**/ ?>