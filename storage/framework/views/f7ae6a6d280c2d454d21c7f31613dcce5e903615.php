<?php $__env->startSection('content'); ?>
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-8">
        <div class="card">
          <div class="card-header"><?php echo e(__('Login 2FA')); ?></div>
          <div class="card-body">
            <form method="POST" action="<?php echo e(route('login.2fa',$user->id)); ?>" aria-label="<?php echo e(__('Login')); ?>">
              <?php echo csrf_field(); ?>
              <div class="form-group row">
                <div class="col-lg-4">
                  <img id="imgQR" src="<?php echo e($urlQR); ?>"/>
                </div>
                <div class="col-lg-8">
                  <div class="form-group">
                    <label for="code_verification" class="col-form-label">
                      <?php echo e(__('CÓDIGO DE VERIFICACIÓN')); ?>

                    </label>
                    <input 
                      id="code_verification" 
                      type="text" 
                      class="form-control<?php echo e($errors->has('code_verification') ? ' is-invalid' : ''); ?>" 
                      name="code_verification"
                      value="<?php echo e(old('code_verification')); ?>" 
                      required
                      autofocus>
                    <?php if($errors->has('code_verification')): ?>
                      <span class="invalid-feedback" role="alert">
                        <strong><?php echo e($errors->first('code_verification')); ?></strong>
                      </span>
                    <?php endif; ?>
                  </div>
                  <button type="submit" class="btn btn-primary">ENVIAR</button>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\wamp64\www\portalmecanico_copia\resources\views/auth/2fa.blade.php ENDPATH**/ ?>