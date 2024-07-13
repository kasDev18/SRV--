@extends('frontend.layout')

@section('content')
    <div id="test">
        <div class="scontent">

            <form id="cvForm" class="ksFormOuter contactForm" action="{{ route('cv.generate') }}" method="POST">

                @csrf
                <span class="ksFormTitle contatFormTitle">{{ __('cv.generate_cv') }}</span>
                <div class="row ">
                    <div class="col-12 col-md-12 ksForm">
                        <input type='text' name='name' placeholder="{{ __('cv.name') }}" required
                               value='{{old("name")}}'/>
                        @error('name')
                        <div class="fError">{{ $message }}</div>
                        @enderror

                        <input type='text' name='email' placeholder="{{ __('cv.email') }}"
                               value='{{old("email")}}'/>
                        @error('email')
                        <div class="fError">{{ $message }}</div>
                        @enderror

                        <input type='text' name='phone' placeholder="{{ __('cv.telephone') }}"
                               value='{{old("phone")}}'/>
                        @error('phone')
                        <div class="fError">{{ $message }}</div>
                        @enderror

                        <input type='text' name='address' placeholder="{{ __('cv.address') }}"
                               value='{{old("address")}}'/>
                        @error('address')
                        <div class="fError">{{ $message }}</div>
                        @enderror

                        <strong><span style="margin: 15px 0px 5px 10px; display: block">{{__('cv.date_of_birth')}}</span></strong>
                        <input type='date' name='date_of_birth' placeholder="{{ __('cv.date_of_birth') }}"
                               value='{{old("date_of_birth")}}' style="margin-top: 10px"/>
                        @error('date_of_birth')
                        <div class="fError">{{ $message }}</div>
                        @enderror

                        <div class="col-12 col-md-12 ksForm ksFormOuter1">
                            <span class="ksFormTitle contatFormTitle">{{ __('cv.education') }}</span>

                            <div id="education_section">
                                <div class="col-12 col-md-12 ksForm">
                                    <input class="ksInputText" type='text' name='education[]' placeholder="{{ __('cv.school') }}"
                                           value='{{old("education")}}'/>
                                </div>
                                <div class="col-12 col-md-12 ksForm ksDates">
                                    <input type='date' name='educ_from_date[]' placeholder="Date"
                                           value='{{old("education")}}'/>
                                    <span class="toLabel">{{ __('cv.to') }}</span>
                                    <input type='date' name='educ_to_date[]' placeholder="Date"
                                           value='{{old("education")}}'/>
                                </div>
                                <hr>
                            </div>
                            <div class="centerBtn">
                                <a class="btn addBtn" id="addEducBtn">+</a>
                            </div>
                        </div>

                        <div class="col-12 col-md-12 ksForm ksFormOuter1">
                            <span class="ksFormTitle contatFormTitle">{{ __('cv.experience') }}</span>

                            <div id="experience_section">
                                <div class="col-12 col-md-12 ksForm">
                                    <input class="ksInputText" type='text' name='experiences[]' placeholder="{{ __('cv.experience') }}"/>
                                </div>
                                <div class="col-12 col-md-12 ksForm ksDates">
                                    <input type='date' name='experience_from_date[]' placeholder="Date"/>
                                    <span class="toLabel">{{ __('cv.to') }}</span>
                                    <input type='date' name='experience_to_date[]' placeholder="Date"/>
                                </div>
                                <hr>
                            </div>
                            <div class="centerBtn">
                                <a class="btn addBtn" id="addExperienceBtn">+</a>
                            </div>
                        </div>

                        <div class="col-12 col-md-12 ksForm ksFormOuter1">
                            <span class="ksFormTitle contatFormTitle">{{ __('cv.skills') }}</span>

                            <div id="skills_section">
                                <div class="col-12 col-md-12 ksForm">
                                    <input type='text' name='skills[]' placeholder="{{ __('cv.skills') }}"/>
                                </div>
                                <hr>
                            </div>
                            <div class="centerBtn">
                                <a class="btn addBtn" id="addSkillBtn">+</a>
                            </div>
                        </div>

                        <div class="col-12 col-md-12 ksForm ksFormOuter1">
                            <span class="ksFormTitle contatFormTitle">{{ __('cv.language') }}</span>
                            <div id="language_section">
                                <div class="language_flex_section">
                                    <div class="col-12 col-md-12 ksForm">
                                        <input type='text' name='languages[]' placeholder="{{ __('cv.language') }}"/>
                                    </div>
{{--                                    <div class="col-12 col-md-4 ksForm ksRating">--}}
{{--                                        <input type="number" min="0" max="10" name="language_rate[]">--}}
{{--                                    </div>--}}
                                </div>
                                <hr>
                            </div>
                            <div class="centerBtn">
                                <a class="btn addBtn" id="addLanguageBtn">+</a>
                            </div>
                        </div>

                        <div class="col-12 col-md-12 ksForm ksFormOuter1 additionalKsForm">
                            <span class="ksFormTitle contatFormTitle additionalSection">{{ __('cv.additional_info') }}</span>
                                <div class="">

{{--                                    <div class="additional_flex_section">--}}
{{--                                        <div class="ksYesNo">--}}
{{--                                            <select name="with_license">--}}
{{--                                                <option value="0">{{ __('cv.no') }}</option>--}}
{{--                                                <option value="1">{{ __('cv.yes') }}</option>--}}
{{--                                            </select>--}}
{{--                                        </div>--}}
{{--                                        <span>{{ __('cv.include_dl') }}</span>--}}
{{--                                    </div>--}}

{{--                                    <div class="language_flex_section">--}}
{{--                                        <div class="ksYesNo">--}}
{{--                                            <select name="own_transport">--}}
{{--                                                <option value="0">{{ __('cv.no') }}</option>--}}
{{--                                                <option value="1">{{ __('cv.yes') }}</option>--}}
{{--                                            </select>--}}
{{--                                        </div>--}}
{{--                                        <span>{{ __('cv.own_transport') }}</span>--}}
{{--                                    </div>--}}

                                    <div class="radio-flex-section">
                                        <div class="radio-div-label">
                                            <span class="radio-field-label">{{ __('cv.include_dl') }}</span>
                                        </div>
                                        <div class="radio-button-container">
                                            <div class="radio-button">
                                                <input type="radio" class="radio-button__input" id="radio1" value="1" name="with_license">
                                                <label class="radio-button__label" for="radio1">
                                                    <span class="radio-button__custom"></span>
                                                    {{ __('cv.yes') }}
                                                </label>
                                            </div>
                                            <div class="radio-button">
                                                <input type="radio" class="radio-button__input" id="radio2" value="0" name="with_license" checked>
                                                <label class="radio-button__label" for="radio2">
                                                    <span class="radio-button__custom"></span>
                                                    {{ __('cv.no') }}
                                                </label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="radio-flex-section">
                                        <div class="radio-div-label">
                                            <span class="radio-field-label">{{ __('cv.own_transport') }}</span>
                                        </div>
                                        <div class="radio-button-container">
                                            <div class="radio-button">
                                                <input type="radio" class="radio-button__input" id="radio3" value="1" name="own_transport">
                                                <label class="radio-button__label" for="radio3">
                                                    <span class="radio-button__custom"></span>
                                                    {{ __('cv.yes') }}
                                                </label>
                                            </div>
                                            <div class="radio-button">
                                                <input type="radio" class="radio-button__input" id="radio4" value="0" name="own_transport" checked>
                                                <label class="radio-button__label" for="radio4">
                                                    <span class="radio-button__custom"></span>
                                                    {{ __('cv.no') }}
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                        </div>

                    </div>
                </div>
                <button name='sendMessage' class="ksFormBtn">{{ __('cv.generate_cv') }}</button>
            </form>


        </div>
    </div>

    <script>
        var experiencePlaceholder = "{{ __('cv.experience') }}";
        var schoolPlaceholder = "{{ __('cv.school') }}";
        var skillsPlaceholder = "{{ __('cv.skills') }}";
        var langPlaceholder = "{{ __('cv.language') }}";
        var to = "{{ __('cv.to') }}";

        function submitToDifferentRoute(route) {
            var form = document.getElementById('cvForm');
            form.action = route;
            form.submit();
        }
    </script>

@endsection
