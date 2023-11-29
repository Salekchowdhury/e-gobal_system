<?php $__env->startSection('title'); ?>
    <?php echo e(Helper::webinfo()->site_title); ?> | <?php echo e(trans('labels.referral')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('css'); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <div class="content-wrapper">
        <div class="container">
            <div class="card">
                <div class="show-success-error"></div>
                <div class="card-header">
                    <h3><?php echo e(trans('labels.referral')); ?></h3>
                </div>

                <div class="card-body">
                    <table id="example1" class="table table-striped">
                        <thead>
                            <tr>
                                <th scope="col">SL#</th>
                                <th scope="col">Lavel</th>
                                <th scope="col">Total Member</th>
                                <th scope="col">View</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <?php if(!empty($user_feferral[0]->member)): ?>
                                <td><?php echo e(1); ?></td>
                                <td>One</td>
                                <td><?php echo e($user_feferral[0]->member); ?></td>
                                <td>
                                    <button value="<?php echo e($user_feferral[0]->refferal_vendor); ?>" onclick="showReferral(this)"
                                        class="btn btn-success"><i class="ti-eye"></i>View</button>
                                </td>
                                <?php endif; ?>

                            </tr>

                            <?php
                            $s = 2;
                            $lavel = ['Two', 'Three'];
                            ?>
                            
                            <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row => $list): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                
                                <?php if($row > 0): ?>
                                    
                                <?php else: ?>
                                    <tr>
                                        <td><?php echo e($s++); ?></td>
                                        <td><?php echo e($lavel[$row]); ?></td>
                                        <td><?php echo e(count($list)); ?></td>
                                        <td>
                                            <?php if(count($list) > 0): ?>
                                                <button value="<?php echo e($list[0]->refferal_vendor); ?>" onclick="showReferral(this)"
                                                    class="btn btn-success"><i class="ti-eye"></i>View</button>
                                            <?php else: ?>
                                            <button
                                                class="btn btn-success"><i class="ti-eye"></i>View
                                            </button>
                                            <?php endif; ?>
                                        </td>
                                    </tr>
                                <?php endif; ?>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                             

                             <?php if(count($third_label)> 0): ?>
                             <tr>
                                <td><?php echo e(3); ?></td>
                                <td>Three</td>
                                <td><?php echo e(count($third_label)); ?></td>
                                <td>
                                    <button value="<?php echo e($third_label[0][0]->refferal_vendor); ?>" onclick="showReferral(this)"
                                        class="btn btn-success"><i class="ti-eye"></i>View</button>
                                </td>
                            </tr>
                             <?php endif; ?>

                        </tbody>
                    </table>

                </div>
            </div>


            <!-- Modal -->
            <div style="z-index: 145698;" class="modal fade" id="showModal" tabindex="-1" role="dialog"
                aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content" style="width: 625px">
                        <div class="modal-header">
                            <h5 class="modal-title" id="referenceModalTitle"></h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="card-body">
                                <table id="example1" class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th scope="col">SL#</th>
                                            <th scope="col">Name</th>
                                            <th scope="col">email</th>
                                            <th scope="col">phone</th>
                                            <th scope="col">Date</th>
                                        </tr>
                                    </thead>
                                    <tbody id="user-referral">


                                    </tbody>
                                </table>

                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

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
    <script>
        $(function() {
            $("#example1").DataTable({
                // "lengthMenu":[ 3,4 ],
                "searching": true,
            });
            $("#example2").DataTable({

                "searching": true,
            });

        });

        function showReferral(e) {
            var referTable = '';
            // alert(e.value);
            // console.log('previousSibling',e.parentElement.previousElementSibling.previousElementSibling.innerText);
            var lavel = e.parentElement.previousElementSibling.previousElementSibling.innerText;

            $('#referenceModalTitle').text("Member of Lavel " + lavel);
            $('#showModal').modal('show');
            $(".modal-backdrop").removeAttr('class');

            $.ajax({
                url: "<?php echo e(route('admin.users.referral.search')); ?>",
                method: 'GET',
                data: {
                    'referral_code': e.value
                },
                success: function(data) {
                    console.log('fff', data.data)



                    $.each(data.data, function(index, value) {
                        referTable += ` <tr>
                    <td>${index+1}</td>
                    <td>${value.name}</td>
                    <td>${value.email}</td>
                    <td>${value.mobile}</td>
                    <td>${value.created_at.split('T')[0]}</td>
                </tr>`

                    });

                    $('#user-referral').html(referTable);

                }
            });
        }
    </script>
    
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\eglobalmart\resources\views/Admin/referral/index.blade.php ENDPATH**/ ?>