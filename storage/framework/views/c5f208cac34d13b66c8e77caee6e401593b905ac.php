<?php $__env->startSection('title'); ?>
    <?php echo e(Helper::webinfo()->site_title); ?> | <?php echo e(trans('labels.products')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('css'); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <div class="content-wrapper">
        <div class="container">
            <div class="card">
                <div class="show-success-error"></div>
                <div class="form-outline mb-4">
                    <?php if(session('message')): ?>
                        <p class="alert alert-success "><?php echo e(session('message')); ?></p>
                    <?php endif; ?>
                </div>
                <div class="card-header">
                    <h3><?php echo e(trans('labels.withdraw_balance')); ?></h3>
                    <form method="post" action="<?php echo e(route('admin.withdrow.search')); ?>">
                        <?php echo csrf_field(); ?>
                        <div class="row py-2">
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-md-3">
                                        <label class="">From Date</label>
                                        <input type="date" name="from_date" class="form-control" value=""
                                            placeholder="From Date...">
                                    </div>
                                    <div class="col-md-3">
                                        <label class="">To Date</label>
                                        <input type="date" name="to_date" class="form-control" value=""
                                            placeholder="To Date...">
                                    </div>
                                    <?php if(Auth::user()->type == 1): ?>
                                        <div class="col-md-3">
                                            <label class="">User</label>
                                            <select class="form-control select2" name="user_id">
                                                <option value="">Select Stockiest</option>
                                                <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <option value="<?php echo e($user->id); ?>"><?php echo e($user->name); ?></option>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </select>
                                        </div>
                                    <?php endif; ?>
                                    <div class="col-md-3 mt-4">
                                        <button type="submit" class="btn btn-success">Search</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                    <?php if(Auth::user()->type != 1): ?>
                    <div class="">
                        <a href="<?php echo e(route('admin.withdrow.create')); ?>" class="btn btn-sm btn-success ">Withdraw</a>
                    </div>

                    <?php endif; ?>
                </div>


                <div class="col-lg-12 mb-lg-0 mb-5 my-3">
                    <div class="text-center">
                        <ul class="nav nav-tabs" role="tablist">
                            <li class="nav-item active">
                                <a class="nav-link" style="font-size: 16px" data-toggle="tab"
                                    href="#mobile-bank">Mobile Bank List</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" style="font-size: 16px" data-toggle="tab"
                                    href="#bank-list">Bank List</a>
                            </li>

                        </ul>
                    </div>
                </div>

                <div class="tab-content" >
                    <div id="mobile-bank" class="container tab-pane active" style="display: block;
                    overflow-x: auto;
                    white-space: nowrap;">
                        <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12 mt-3">
                            <div class="card-body">
                                <table id="e-global-table1" class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th scope="col">SL#</th>
                                            <th scope="col">Amount</th>
                                            <th scope="col">Tran. Charge</th>
                                            <th scope="col">Other Charge</th>
                                            <th scope="col">Final Amount</th>
                                            <th scope="col">Withdraw Date</th>
                                            <th scope="col">Receive Number</th>
                                            <th scope="col">Payment Type</th>
                                            <th scope="col">Note</th>
                                            <?php if(Auth::user()->type == 3): ?>
                                                <th scope="col">Status</th>
                                            <?php endif; ?>
                                            <?php if(Auth::user()->type == 1): ?>
                                                <th scope="col">User Name</th>
                                                <th scope="col">Approved Date</th>

                                                <th scope="col">Status</th>
                                                <th scope="col">Action</th>
                                            <?php endif; ?>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $s = 1;
                                        ?>
                                        <?php $__currentLoopData = $withdrawDataMobileBank; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $list): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <tr>
                                                <td><?php echo e($s++); ?></td>
                                                <td><?php echo e($list->amount); ?></td>
                                                <td><?php echo e($list->commission); ?></td>
                                                <td><?php echo e($list->extra_charge); ?></td>
                                                <td><?php echo e($list->final_amount); ?></td>
                                                <td><?php echo e($list->withdraw_date); ?></td>
                                                <td><?php echo e($list->mobile_number); ?></td>
                                                <td><?php echo e($list->payment_type); ?></td>
                                                <td><?php echo e($list->note? $list->note : ''); ?></td>

                                                <?php if(Auth::user()->type == 3): ?>
                                                    <?php if($list->status == 0): ?>
                                                        <td>
                                                            <span class="text-danger">Pending</span>
                                                        </td>
                                                    <?php else: ?>
                                                        <td>
                                                            <span class="text-success">Accepted</span>

                                                        </td>
                                                    <?php endif; ?>
                                                <?php endif; ?>

                                                <?php if(Auth::user()->type == 1): ?>
                                                    <td><?php echo e($list->user ? $list->user->name : ''); ?></td>

                                                    <td><?php echo e($list->approved_date ? $list->approved_date : ''); ?></td>

                                                    <td class=""><?php echo e($list->status == 0 ? "Pending" : ($list->status == 1? "Ready" : ($list->status== 2? "Paid" : '') )); ?></td>

                                                    <?php if(Auth::user()->id == $list->user_id || $list->status == 1 || $list->status == 2): ?>
                                                        <td>
                                                            <a href="<?php echo e(url('admin/withdraw/' . $list->id . '/pdfgenerate')); ?>"
                                                                class="btn btn-sm btn-success">PDF</a>
                                                        </td>
                                                    <?php else: ?>
                                                        <td>
                                                            
                                                                <button class="btn btn-success addCharge" data-id="<?php echo e($list->id); ?>">Accept</button>
                                                            <a href="<?php echo e(url('admin/withdraw/' . $list->id . '/pdfgenerate')); ?>"
                                                                class="btn btn-sm btn-success">PDF</a>
                                                        </td>
                                                    <?php endif; ?>
                                                <?php endif; ?>

                                            </tr>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                    </tbody>
                                </table>

                            </div>
                        </div>
                    </div>
                     <div id="bank-list" class="container tab-pane" style="display: block;
                     overflow-x: auto;
                     white-space: nowrap;">
                        <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12 mt-3">
                            <div class="card-body">
                                <table id="e-global-table2" class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th scope="col">SL#</th>
                                            <th scope="col">Amount</th>
                                            <th scope="col">Tran. Charge</th>
                                            <th scope="col">Other Charge</th>
                                            <th scope="col">Final Amount</th>
                                            <th scope="col">Withdraw Date</th>
                                            <th scope="col">Bank</th>
                                            <th scope="col">A\C Name</th>
                                            <th scope="col">Account Number</th>
                                            <th scope="col">Branch</th>
                                            <th scope="col">City</th>
                                            <th scope="col">Routing Number</th>
                                            <th scope="col">Note</th>
                                            <?php if(Auth::user()->type == 3): ?>
                                                <th scope="col">Status</th>
                                            <?php endif; ?>
                                            <?php if(Auth::user()->type == 1): ?>
                                                <th scope="col">User Name</th>
                                                <th scope="col">Approved Date</th>
                                                <th scope="col">Approved By</th>
                                                <th scope="col">Status</th>

                                                <th scope="col">Action</th>
                                            <?php endif; ?>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $s = 1;
                                        ?>
                                        <?php $__currentLoopData = $withdrawDataBank; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $list): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <tr>
                                                <td><?php echo e($s++); ?></td>
                                                <td><?php echo e($list->amount); ?></td>
                                                <td><?php echo e($list->commission); ?></td>
                                                <td><?php echo e($list->extra_charge); ?></td>
                                                <td><?php echo e($list->final_amount); ?></td>
                                                <td><?php echo e($list->withdraw_date); ?></td>
                                                <td class="text-uppercase"><?php echo e($list->bankList->name); ?></td>
                                                <td><?php echo e($list->account_name); ?></td>
                                                <td><?php echo e($list->account_number); ?></td>
                                                <td><?php echo e($list->branch_name); ?></td>
                                                <td><?php echo e($list->city); ?></td>
                                                <td><?php echo e($list->routin_number); ?></td>
                                                <td><?php echo e($list->note ? $list->note : ''); ?></td>
                                                <?php if(Auth::user()->type == 3): ?>
                                                    <?php if($list->status == 0): ?>
                                                        <td>
                                                            <span class="text-danger">Pending</span>
                                                        </td>
                                                    <?php else: ?>
                                                        <td>
                                                            <span class="text-success">Accepted</span>

                                                        </td>
                                                    <?php endif; ?>
                                                <?php endif; ?>

                                                <?php if(Auth::user()->type == 1): ?>
                                                    <td><?php echo e($list->user ? $list->user->name : ''); ?></td>

                                                    <td><?php echo e($list->approved_date ? $list->approved_date : ''); ?></td>
                                                    <td><?php echo e($list->admin ? $list->admin->name : ''); ?></td>
                                                    <td class=""><?php echo e($list->status == 0 ? "Pending" : ($list->status == 1? "Ready" : ($list->status== 2? "Paid" : '') )); ?></td>


                                                    <?php if(Auth::user()->id == $list->user_id || $list->status == 1 || $list->status == 2): ?>
                                                    
                                                        <td>

                                                            <a href="<?php echo e(url('admin/withdraw/' . $list->id . '/pdfgenerate')); ?>"
                                                                class="btn btn-sm btn-success">PDF</a>
                                                        </td>

                                                    <?php elseif($list->status == 0): ?>

                                                        <td>
                                                                <button class="btn btn-success addCharge" data-id="<?php echo e($list->id); ?>">Accept</button>
                                                            <a href="<?php echo e(url('admin/withdraw/' . $list->id . '/pdfgenerate')); ?>"
                                                                class="btn btn-sm btn-success">PDF</a>
                                                        </td>
                                                    <?php endif; ?>
                                                <?php endif; ?>

                                            </tr>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                    </tbody>
                                </table>

                            </div>
                        </div>
                     </div>
                </div>
                <div class="modal" id="addExtraChargeModal" tabindex="-1" role="dialog">
                    <div class="modal-dialog" role="document">
                      <div class="modal-content mt-5">
                        <div class="modal-header">
                          <h5 class="modal-title">Add Charge</h5>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        <form action="<?php echo e(url('admin/withdraw/accept')); ?>" method="post">
                            <?php echo csrf_field(); ?>
                            <div class="modal-body">
                                <div>
                                    <label>Charge</label>
                                    <input type="number" required class="form-control"  id="extra_charge" name="extra_charge" value="" ></input>
                                    <input type="hidden" id="withdrwa_id" name="withdrwa_id" value="" ></input>
                                </div>

                                <div class="mt-1">
                                    <label>Note</label>
                                    <textarea required class="form-control" id="note" name="note" rows="3" cols="5"></textarea>
                                </div>

                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-primary">Save</button>
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                              </div>
                        </form>


                      </div>
                    </div>
                  </div>
            </div>
        </div>

    </div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('scripttop'); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>
<script type="text/javascript">

$('.addCharge').on('click', function() {

    $('#addExtraChargeModal').modal('show');
    $('.modal-backdrop').remove()
     status = $(this).attr('data-status');
     id = $(this).attr('data-id');
    // alert(id);
    $('#withdrwa_id').val(id);

});

</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\eglobalmart\resources\views/Admin/withdraw/index.blade.php ENDPATH**/ ?>