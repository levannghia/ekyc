
<?php $__env->startSection('title', $row->title); ?>
<?php $__env->startSection('content'); ?>
<div class="row mt-5 pt-5">
    <div class="col-12">
        <div id="kyc">
            <div class="bg-email"></div>
            <h1 class="mb-4">Verify your email</h1>
            <h3 class="text-3">Confirm verify email to next steps if you want continue</h3>
            <div class="row">
                <div class="col-md-6 col-sm-12">
                    <div class="ver-content d-flex mt-5">
                        <div class="num">1</div>
                        <div class="text">
                            <strong>Enter email</strong> <br>
                            <span>Enter your email to receive verify code</span></div>
                    </div>
                    <div class="ver-content d-flex mt-4">
                        <div class="num">2</div>
                        <div class="text">
                            <strong>Enter verify code</strong> <br>
                            <span>Enter verify code to next step 2</span></div>
                    </div>
                </div>                   
                <div class="col-md-6 col-sm-12">

                    <form action="<?php echo e(route('kyc.email')); ?>" method="post" class="verify">
                        <?php echo csrf_field(); ?>
                        <div class="form-group mt-5 mb-3">
                            <?php if(isset($error)): ?>
                            <div class="alert alert-danger text-center">
                                <?php echo e($error); ?>

                            </div>
                            <?php endif; ?>
                            <div class="label mb-3">* Email</div>
                            <input type="email" name="email" class="form-control" placeholder="Enter your email" required>
                        </div>
                        <input type="submit" class="btn-submit mt-4" value="Get verify code">
                    </form>
                </div>
            </div>
            
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('Sites::layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\wamp64\www\ekyc\app\Modules/Sites/Views/email/index.blade.php ENDPATH**/ ?>