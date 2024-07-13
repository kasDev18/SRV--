@extends('frontend.layout')

@section('content')

    <div id="contantTop">
        <div class="scontent">
            <span class="contHead"><i class="fas fa-phone-alt"></i> {{ __('contact.phone_head') }}:</span><br/>
            <a href="tel:+48733100050" class='contactPhoneLink'>+48 733 100 050</a><br/>
            <a href="tel:+48733200050" class='contactPhoneLink'>+48 733 200 050</a><br/>
            <br/>
            <span class="contHead"><i class="fas fa-home"></i> {{ __('contact.adress_head') }}:</span><a><br/>
                szukampracy.eu<a><br/>Graniczna 2K/4, 32-050 Skawina<a><br/>Regon: 367900995<br/>
                        <br/>
                        <span class="contHead"><i
                                class="far fa-clock"></i> {{ __('contact.work_time_head') }}:</span><br/>

                        {{ __('contact.working_hours_days') }}: 10:00–17:00<br/>
                        {{ __('contact.working_hours_sa') }}: {{ __('contact.not_working_message') }}<br/>
                        {{ __('contact.working_hours_su') }}: {{ __('contact.not_working_message') }}<br/>
        </div>
    </div>

    <div id="test">
        <div class="scontent">

            <form method="POST" action="" class="ksFormOuter contactForm" enctype="multipart/form-data">

                @csrf
                <span class="ksFormTitle contatFormTitle">{{ __('contact.form_head') }}</span>

                @if( $showContactFormMessage )
                    <div class="row ">
                        <div class="col-12 contactFormMessage">
                            {{ __('contact.after_send_message') }}
                        </div>
                    </div>
                @endif

                <div class="row ">
                    <div class="col-12 col-md-6 ksForm">


                        <input type='text' name='name' placeholder="{{ __('contact.field_name') }}"
                               value='{{old("name")}}'/>
                        @error('name')
                        <div class="fError">{{ $message }}</div>
                        @enderror

                        <input type='text' name='email' placeholder="{{ __('contact.field_email') }}"
                               value='{{old("email")}}'/>
                        @error('email')
                        <div class="fError">{{ $message }}</div>
                        @enderror

                        <input type='text' name='phone' placeholder="{{ __('contact.field_phone') }}"
                               value='{{old("phone")}}'/>
                        @error('phone')
                        <div class="fError">{{ $message }}</div>
                        @enderror

                        <label class="cvFile">
                            <input type='file' name='cv' placeholder="CV" value='{{old("cv")}}' id="cvInput"/>
                            <i class="fa fa-cloud-upload"></i>
                            <span id="fileName">Upload file</span>
                        </label>
                        @error('cv')
                        <div class="fError">{{ $message }}</div>
                        @enderror

                    </div>
                    <div class="col-12 col-md-6 ksForm contactTextarea">

                        <textarea name="message_content"
                                  placeholder="{{ __('contact.field_content') }}">{{old("message_content")}}</textarea>
                        @error('message_content')
                        <div class="fError">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-12 ksForm">
                    {{--      <input id="captcha" type="text" class="form-control" placeholder="Przepisz kod z obrazka" name="captcha">--}}
                    <div class="captcha mt-4">
                        <span>{!! htmlFormSnippet() !!}</span>
                        @if($errors->has('g-recaptcha-response'))
                            <div>
                                <small class="fError">
                                    {{$errors->first('g-recaptcha-response')}}
                                </small>
                            </div>
                        @endif

                        {{--                    <button type="button" class="btn btn-danger" class="reload" id="reload">--}}
                        {{--                        &#x21bb;--}}
                        {{--                    </button>--}}
                    </div>
                    @error('captcha')
                    <div class="fError">{{ $message }}</div>
                    @enderror
                </div>


                <button name='sendMessage' class="ksFormBtn">{{ __('contact.form_btn') }}</button>
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
                fileNameSpan.textContent = "{{ __('offers.field_cv') }}";
            }
        });
    </script>

@endsection
