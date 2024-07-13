@extends('layout')

@section('content')

<div id="contantTop" >
    <div class="scontent"  >
<span class="contHead" ><i class="fas fa-phone-alt"></i> {{ __('contact.phone_head') }}:</span><br />
 <a href="tel:+48733100050" class='contactPhoneLink' >+48 733 100 050</a><br />
 <a href="tel:+48733200050" class='contactPhoneLink' >+48 733 200 050</a><br />
<br />
<span class="contHead" ><i class="fas fa-home"></i> {{ __('contact.adress_head') }}:</span><br />
      K&S Holding Sp. z o.o.<a><br />Graniczna 2K/4, 32-050 Skawina<a><br />Regon: 524172416<br />
<br />
<span class="contHead" ><i class="far fa-clock"></i> {{ __('contact.work_time_head') }}:</span><br />

{{ __('contact.working_hours_days') }}: 10:00–17:00<br />
{{ __('contact.working_hours_sa') }}: {{ __('contact.not_working_message') }}<br />
{{ __('contact.working_hours_su') }}: {{ __('contact.not_working_message') }}<br />
    </div>
</div>

        <div id="test" >
            <div class="scontent"  >
             
                <form method="POST" action="" id="contactForm" class="ksFormOuter contactForm" enctype="multipart/form-data" >
    
 @csrf
 <span class="ksFormTitle contatFormTitle" >{{ __('contact.form_head') }}</span>
 
 @if( $showContactFormMessage )
  <div class="row " >
      <div class="col-12 contactFormMessage" >
          {{ __('contact.after_send_message') }}
      </div>
  </div>
 @endif
 
 <div class="row " >
     <div class="col-12 col-md-6 ksForm" >
         
         
<input type='text' name='name' placeholder="{{ __('contact.field_name') }}" value='{{old("name")}}' />
@error('name')
    <div class="fError">{{ $message }}</div>
@enderror
            
<input type='text' name='email' placeholder="{{ __('contact.field_email') }}" value='{{old("email")}}' />
@error('email')
    <div class="fError">{{ $message }}</div>
@enderror

<input type='text' name='phone' placeholder="{{ __('contact.field_phone') }}" value='{{old("phone")}}' />
@error('phone')
    <div class="fError">{{ $message }}</div>
@enderror
         
     </div>
     <div class="col-12 col-md-6 ksForm contactTextarea" >
         
<textarea name="content" placeholder="{{ __('contact.field_content') }}" >{{old("content")}}</textarea>
         @error('content')
    <div class="fError">{{ $message }}</div>
@enderror
     </div>
 </div>
 <div class="col-12 ksForm" >
   
 


<script src='https://www.google.com/recaptcha/api.js' async defer></script>

<div id="recaptchaBox" >       
      <div class="g-recaptcha" data-sitekey="6LeiiwwpAAAAAJ9LS9LStkqL1lppahwYRWO6TmoZ"
           
             data-callback="onRecaptchaSuccess"
        data-expired-callback="onRecaptchaResponseExpiry"
        data-error-callback="onRecaptchaError"
        ></div>
        </div>

<div
        id="recaptchaMsg"
        style="display: none"
      
      >
     <div class="fError" >Potwierdź że nie jesteś robotem.</div>
       


 </div>
 

           
      
  
<input type="hidden" name="sendMessage" value="1" />

 <button name='sendMessage2' class="ksFormBtn" >{{ __('contact.form_btn') }}</button>
</form>
                
                
            </div>
        </div>
    



     
      <script>
isRecaptchaValidated = false;

@if( Session::get('captchaError') )
$('#recaptcha-form-error').show();
@endif


function onRecaptchaSuccess() {
  isRecaptchaValidated = true;
  $('#recaptchaMsg').hide();
    
}

function onRecaptchaError() {
    $('#recaptchaMsg').show();
    
}

function onRecaptchaResponseExpiry() {
  $('#recaptchaMsg').show();
    
}


$('.ksFormBtn').click(function(e){
    e.preventDefault();
  
    if (!isRecaptchaValidated) {
        $('#recaptchaMsg').show(); 
      return;
    }

  
     $('#recaptchaMsg').hide();
    $("#contactForm").submit();
});

  

  </script>
  
  

<style>
        #recaptchaBox{
            text-align: center;
            margin-top: 20px;
            overflow: auto;
        }
        
        .g-recaptcha{
            display: inline-block;
        }
        
        #recaptchaMsg{
            text-align: center;
            margin-top: -10px;
        }
    </style>


        
@endsection