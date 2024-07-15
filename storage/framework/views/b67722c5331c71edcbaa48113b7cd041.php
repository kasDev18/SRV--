<?php $__env->startSection('content'); ?>

    <div id="contantTop">
        <div class="scontent">
            <span class="contHead"><i class="fas fa-phone-alt"></i> <?php echo e(__('contact.phone_head')); ?>:</span><br/>
            <a href="tel:+48733100050" class='contactPhoneLink'>+48 733 100 050</a><br/>
            <a href="tel:+48733200050" class='contactPhoneLink'>+48 733 200 050</a><br/>
            <br/>
            <span class="contHead"><i class="fas fa-home"></i> <?php echo e(__('contact.adress_head')); ?>:</span><a><br/>
                szukampracy.eu<a><br/>Graniczna 2K/4, 32-050 Skawina<a><br/>Regon: 367900995<br/>
                        <br/>
                        <span class="contHead"><i
                                class="far fa-clock"></i> <?php echo e(__('contact.work_time_head')); ?>:</span><br/>

                        <?php echo e(__('contact.working_hours_days')); ?>: 10:00–17:00<br/>
                        <?php echo e(__('contact.working_hours_sa')); ?>: <?php echo e(__('contact.not_working_message')); ?><br/>
                        <?php echo e(__('contact.working_hours_su')); ?>: <?php echo e(__('contact.not_working_message')); ?><br/>
        </div>
    </div>

    <div id="test">
        <div class="scontent">

            <form method="POST" action="" class="ksFormOuter contactForm" enctype="multipart/form-data">

                <?php echo csrf_field(); ?>
                <span class="ksFormTitle contatFormTitle"><?php echo e(__('contact.form_head')); ?></span>

                <?php if( $showContactFormMessage ): ?>
                    <div class="row ">
                        <div class="col-12 contactFormMessage">
                            <?php echo e(__('contact.after_send_message')); ?>

                        </div>
                    </div>
                <?php endif; ?>

                <div class="row ">
                    <div class="col-12 col-md-6 ksForm">


                        <input type='text' name='name' placeholder="<?php echo e(__('contact.field_name')); ?>"
                               value='<?php echo e(old("name")); ?>'/>
                        <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <div class="fError"><?php echo e($message); ?></div>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>

                        <input type='text' name='email' placeholder="<?php echo e(__('contact.field_email')); ?>"
                               value='<?php echo e(old("email")); ?>'/>
                        <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <div class="fError"><?php echo e($message); ?></div>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>

                        <input type='text' name='phone' placeholder="<?php echo e(__('contact.field_phone')); ?>"
                               value='<?php echo e(old("phone")); ?>'/>
                        <?php $__errorArgs = ['phone'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <div class="fError"><?php echo e($message); ?></div>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>

                        <label class="cvFile">
                            <input type='file' name='cv' placeholder="CV" value='<?php echo e(old("cv")); ?>' id="cvInput"/>
                            <i class="fa fa-cloud-upload"></i>
                            <span id="fileName">Upload file</span>
                        </label>
                        <?php $__errorArgs = ['cv'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <div class="fError"><?php echo e($message); ?></div>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>

                    </div>
                    <div class="col-12 col-md-6 ksForm contactTextarea">

                        <textarea name="message_content"
                                  placeholder="<?php echo e(__('contact.field_content')); ?>"><?php echo e(old("message_content")); ?></textarea>
                        <?php $__errorArgs = ['message_content'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <div class="fError"><?php echo e($message); ?></div>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>
                </div>
                <div class="col-12 ksForm">
                    
                    <div class="captcha mt-4">
                        <span><?php echo htmlFormSnippet(); ?></span>
                        <?php if($errors->has('g-recaptcha-response')): ?>
                            <div>
                                <small class="fError">
                                    <?php echo e($errors->first('g-recaptcha-response')); ?>

                                </small>
                            </div>
                        <?php endif; ?>

                        
                        
                        
                    </div>
                    <?php $__errorArgs = ['captcha'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <div class="fError"><?php echo e($message); ?></div>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>


                <button name='sendMessage' class="ksFormBtn"><?php echo e(__('contact.form_btn')); ?></button>
            </form>


        </div>
    </div>

    <script>
        document.getElementById('cvInput').addEventListener('change', function(event) {
            const fileNameSpan = document.getElementById('fileName');
            const input = event.target;

            if (input.files && input.files.length > 0) {
                fileNameSpan.textContent = input.files[0].name;
            } else {
                fileNameSpan.textContent = "<?php echo e(__('offers.field_cv')); ?>";
            }
        });
    </script>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('frontend.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\SRV!^\resources\views/frontend/contact.blade.php ENDPATH**/ ?>