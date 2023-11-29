<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title> <?php echo e(__('Withdraw')); ?> </title>
    <link
        href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,300;0,400;0,500;0,700;0,900;1,300&display=swap"
        rel="stylesheet">
</head>

<body>


    <style>
        @page  {
            margin: 50px 5px;
        }

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
            font-weight: 200;
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
            font-weight: 400;
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

        .cutomer {
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
            font-size: 12px;
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

        .mt-25 {
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

        .float-right {
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

        footer {
            position: fixed;
            bottom: -15px;
            left: 0px;
            right: 0px;
            height: 50px;
            font-size: 20px !important;
            /* background-color: #000;
                color: white; */
            background-color: #000;
            color: white;
            text-align: center;
            line-height: 35px;
        }
    </style>


    <footer>
        <div>
            <div>
                <p class="thank-header" style="font-size: 10px">E-Global Mart software developed by R-Creation. Tel: +880-1813-316786, +880-1722-964303</p>
                
            </div>

        </div>


    </footer>

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



                <div class="item-description">
                    <table class="custom--table">
                        <thead class="" style="background-color: #333; color:#ddd;">
                            <tr>
                                <th style="text-align: center"><?php echo e(__('#')); ?></th>
                                <th><?php echo e(__('Amount')); ?></th>
                                <th><?php echo e(__('Tran. Charge')); ?></th>
                                <th><?php echo e(__('Other Charge')); ?></th>
                                <th><?php echo e(__('Type')); ?></th>
                                <th><?php echo e(__('Final Amount')); ?></th>
                                <th><?php echo e(__('Withdraw Date')); ?></th>
                                <th><?php echo e(__('User Name')); ?></th>
                                <th><?php echo e(__('Appoved Date')); ?></th>
                                <th><?php echo e(__('Appoved By')); ?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $s = 1;
                            ?>

                                <?php $__currentLoopData = $withdraw; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td style="text-align: center"><?php echo e($s++); ?></td>
                                        <td ><?php echo e($item->amount); ?></td>
                                        <td><?php echo e($item->commission); ?></td>
                                        <td><?php echo e($item->extra_charge); ?></td>
                                        <?php if($item->payment_type == 'Bank'): ?>
                                        <td>Bank</td>
                                        <?php else: ?>
                                        <td>Mobile Bank</td>
                                        <?php endif; ?>
                                        <td><?php echo e($item->final_amount); ?></td>
                                        <td><?php echo e($item->withdraw_date); ?></td>
                                        <td><?php echo e($item->user->name); ?></td>
                                        <td><?php echo e($item->approved_date); ?></td>
                                        <?php if($item->admin != null): ?>
                                        <td><?php echo e($item->admin->name); ?></td>
                                        <?php else: ?>
                                        <td>Not Approved</td>
                                        <?php endif; ?>


                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>



                        </tbody>
                    </table>


                </div>

                <div style="margin-top: 20px;">
                    <p class="cutomer" style="">Authorised Sign & Seal</p>
                    <p>Customer Signature</p>
                </div>

            </div>

        </div>

    </main>




</body>

</html>
<?php /**PATH C:\xampp\htdocs\eglobalmart\resources\views/Admin/pdf/withdraw_pdf.blade.php ENDPATH**/ ?>