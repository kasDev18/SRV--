<?php $__env->startSection('content'); ?>
    <div id="test">
        <div class="scontent">

            <form id="cvForm" class="ksFormOuter contactForm" action="<?php echo e(route('cv.generate')); ?>" method="POST">

                <?php echo csrf_field(); ?>
                <span class="ksFormTitle contatFormTitle"><?php echo e(__('cv.generate_cv')); ?></span>
                <div class="row ">
                    <div class="col-12 col-md-12 ksForm">
                        <input type='text' name='name' placeholder="<?php echo e(__('cv.name')); ?>" required
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

                        <input type='text' name='email' placeholder="<?php echo e(__('cv.email')); ?>"
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

                        <input type='text' name='phone' placeholder="<?php echo e(__('cv.telephone')); ?>"
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

                        <input type='text' name='address' placeholder="<?php echo e(__('cv.address')); ?>"
                               value='<?php echo e(old("address")); ?>'/>
                        <?php $__errorArgs = ['address'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <div class="fError"><?php echo e($message); ?></div>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>

                        <strong><span style="margin: 15px 0px 5px 10px; display: block"><?php echo e(__('cv.date_of_birth')); ?></span></strong>
                        <input type='date' name='date_of_birth' placeholder="<?php echo e(__('cv.date_of_birth')); ?>"
                               value='<?php echo e(old("date_of_birth")); ?>' style="margin-top: 10px"/>
                        <?php $__errorArgs = ['date_of_birth'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <div class="fError"><?php echo e($message); ?></div>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>

                        <div class="col-12 col-md-12 ksForm ksFormOuter1">
                            <span class="ksFormTitle contatFormTitle"><?php echo e(__('cv.education')); ?></span>

                            <div id="education_section">
                                <div class="col-12 col-md-12 ksForm">
                                    <input class="ksInputText" type='text' name='education[]' placeholder="<?php echo e(__('cv.school')); ?>"
                                           value='<?php echo e(old("education")); ?>'/>
                                </div>
                                <div class="col-12 col-md-12 ksForm ksDates">
                                    <input type='date' name='educ_from_date[]' placeholder="Date"
                                           value='<?php echo e(old("education")); ?>'/>
                                    <span class="toLabel"><?php echo e(__('cv.to')); ?></span>
                                    <input type='date' name='educ_to_date[]' placeholder="Date"
                                           value='<?php echo e(old("education")); ?>'/>
                                </div>
                                <hr>
                            </div>
                            <div class="centerBtn">
                                <a class="btn addBtn" id="addEducBtn">+</a>
                            </div>
                        </div>

                        <div class="col-12 col-md-12 ksForm ksFormOuter1">
                            <span class="ksFormTitle contatFormTitle"><?php echo e(__('cv.experience')); ?></span>

                            <div id="experience_section">
                                <div class="col-12 col-md-12 ksForm">
                                    <input class="ksInputText" type='text' name='experiences[]' placeholder="<?php echo e(__('cv.experience')); ?>"/>
                                </div>
                                <div class="col-12 col-md-12 ksForm ksDates">
                                    <input type='date' name='experience_from_date[]' placeholder="Date"/>
                                    <span class="toLabel"><?php echo e(__('cv.to')); ?></span>
                                    <input type='date' name='experience_to_date[]' placeholder="Date"/>
                                </div>
                                <hr>
                            </div>
                            <div class="centerBtn">
                                <a class="btn addBtn" id="addExperienceBtn">+</a>
                            </div>
                        </div>

                        <div class="col-12 col-md-12 ksForm ksFormOuter1">
                            <span class="ksFormTitle contatFormTitle"><?php echo e(__('cv.skills')); ?></span>

                            <div id="skills_section">
                                <div class="col-12 col-md-12 ksForm">
                                    <input type='text' name='skills[]' placeholder="<?php echo e(__('cv.skills')); ?>"/>
                                </div>
                                <hr>
                            </div>
                            <div class="centerBtn">
                                <a class="btn addBtn" id="addSkillBtn">+</a>
                            </div>
                        </div>

                        <div class="col-12 col-md-12 ksForm ksFormOuter1">
                            <span class="ksFormTitle contatFormTitle"><?php echo e(__('cv.language')); ?></span>
                            <div id="language_section">
                                <div class="language_flex_section">
                                    <div class="col-12 col-md-12 ksForm">
                                        <input type='text' name='languages[]' placeholder="<?php echo e(__('cv.language')); ?>"/>
                                    </div>



                                </div>
                                <hr>
                            </div>
                            <div class="centerBtn">
                                <a class="btn addBtn" id="addLanguageBtn">+</a>
                            </div>
                        </div>

                        <div class="col-12 col-md-12 ksForm ksFormOuter1 additionalKsForm">
                            <span class="ksFormTitle contatFormTitle additionalSection"><?php echo e(__('cv.additional_info')); ?></span>
                                <div class="">





















                                    <div class="radio-flex-section">
                                        <div class="radio-div-label">
                                            <span class="radio-field-label"><?php echo e(__('cv.include_dl')); ?></span>
                                        </div>
                                        <div class="radio-button-container">
                                            <div class="radio-button">
                                                <input type="radio" class="radio-button__input" id="radio1" value="1" name="with_license">
                                                <label class="radio-button__label" for="radio1">
                                                    <span class="radio-button__custom"></span>
                                                    <?php echo e(__('cv.yes')); ?>

                                                </label>
                                            </div>
                                            <div class="radio-button">
                                                <input type="radio" class="radio-button__input" id="radio2" value="0" name="with_license" checked>
                                                <label class="radio-button__label" for="radio2">
                                                    <span class="radio-button__custom"></span>
                                                    <?php echo e(__('cv.no')); ?>

                                                </label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="radio-flex-section">
                                        <div class="radio-div-label">
                                            <span class="radio-field-label"><?php echo e(__('cv.own_transport')); ?></span>
                                        </div>
                                        <div class="radio-button-container">
                                            <div class="radio-button">
                                                <input type="radio" class="radio-button__input" id="radio3" value="1" name="own_transport">
                                                <label class="radio-button__label" for="radio3">
                                                    <span class="radio-button__custom"></span>
                                                    <?php echo e(__('cv.yes')); ?>

                                                </label>
                                            </div>
                                            <div class="radio-button">
                                                <input type="radio" class="radio-button__input" id="radio4" value="0" name="own_transport" checked>
                                                <label class="radio-button__label" for="radio4">
                                                    <span class="radio-button__custom"></span>
                                                    <?php echo e(__('cv.no')); ?>

                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                        </div>

                    </div>
                </div>
                <button name='sendMessage' class="ksFormBtn"><?php echo e(__('cv.generate_cv')); ?></button>
            </form>


        </div>
    </div>

    <script>
        var experiencePlaceholder = "<?php echo e(__('cv.experience')); ?>";
        var schoolPlaceholder = "<?php echo e(__('cv.school')); ?>";
        var skillsPlaceholder = "<?php echo e(__('cv.skills')); ?>";
        var langPlaceholder = "<?php echo e(__('cv.language')); ?>";
        var to = "<?php echo e(__('cv.to')); ?>";

        function submitToDifferentRoute(route) {
            var form = document.getElementById('cvForm');
            form.action = route;
            form.submit();
        }
    </script>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('frontend.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/srv68915/domains/srv68915.seohost.com.pl/public_html/resources/views/cv/create_cv.blade.php ENDPATH**/ ?>