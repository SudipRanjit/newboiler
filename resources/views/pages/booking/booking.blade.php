@extends('pages.layouts.master')

@section('title') Booking @endsection

@section('container-css') pb-5 @endsection

@section('progress-bar')
<div class="progress-bar" role="progressbar" style="width: 100%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
@endsection

@php $completed_wizards = ['boiler','control','radiator','smart-device'] @endphp

@php $Selection = Session()->get('selection') @endphp

@section('content')
<div class="row justify-content-center question-wrapper">

  <div class="col-md-12">

    <div class="final__accordion" id="priceAccordion">
      <div class="accordion__item">
          <h2 class="accordion__header" id="priceHeading">
              <button class="accordion__button" type="button" id="togglePriceBox">
                Your total fixed price is £{{ $Selection['total_price'] }} <small class="mb-4">(including VAT)</small></button>
          </h2>
          <div id="priceBox" class="accordion__collapse">
              <div class="accordion__body">
                <div class="info__box">
                  <div class="__info_image">
                    <img style="width:100%;" src="{{asset('assets/img/extras.png?v1.1')}}" class="extras" />
                  </div>
                
                
                <div class="row">
                  <div class="col-md-8 offset-md-2">
                    <table class="info__table">
                      <tr>
                        <td class="_row_title _wd10"><img src="{{$boiler->image}}" class="__title_img" /></td>
                        <td class="_row_title">
                          <a href="{!! route('page.boiler', ['id' => $boiler->id]) !!}" target="_blank">{{ $boiler->boiler_name }}</a>
                          <div class="__row_warranty">With {{$boiler->warranty}} years warranty</div>
                        </td>
                        <td class="_row_value">£{{ $boiler->price - $boiler->discount??0 }}</td>
                      </tr>
                      <tr>
                        <td class="_row_title _wd10"><img style="width:60%;" src="{{asset('assets/img/free/gas-safe.png')}}" class="__title_img" /></td>
                        <td class="_row_title">Gas Safe Installation</td>
                        <td class="_row_value">Included</td>
                      </tr>
                      <tr>
                        <td class="_row_title _wd10"><img src="{{ $addon->image}}" class="__title_img" /></td>
                        <td class="_row_title"><a href="{!! route('page.controls') !!}">{{ $addon->addon_name}} </a></td>
                        <td class="_row_value">@if($addon->price > 0)£{{ $addon->price }}@else Free @endif</td>
                      </tr>
                      @if(!empty($radiator))
                      <tr>
                        <td class="_row_title _wd10"><img src="{{ asset('assets/img/radiator.jpg') }}" class="__title_img" /></td>
                        <td class="_row_title">{{$Selection['radiator']['quantity']}}</span>x {{$radiator->radiator_name}}</td>
                        <td class="_row_value">£{{round($Selection['radiator']['quantity']*$radiator_price->price,2);}}</td>
                      </tr>
                      @endif
                      @if($devices)
                      @foreach($devices as $device)
                      <tr>
                        <td class="_row_title _wd10"><img src="{{ $device->image}}" class="__title_img" /></td>
                        <td class="_row_title"><a href="{!! route('page.smart-devices') !!}"><span class="device-quantity">{{ $Selection['devices'][$device->id]['quantity'] }}</span>x  <span class="device-name">{{$device->device_name}}</span></a></p>
                         
                        </td>
                        <td class="_row_value"><p class="m-0  device-price">
                          @if($Selection['devices'][$device->id]['quantity']>1)
                              £{{round($device->price * $Selection['devices'][$device->id]['quantity'],2)}} (£{{$device->price}}*{{$Selection['devices'][$device->id]['quantity']}})
                          @else
                              £{{$device->price}}
                          @endif    
                      </p></td>
                      </tr>
                      @endforeach
                      @endif

                      <tr class="included-hidden">
                        <td class="_row_title _wd10"><img style="width:60%;" src="{{asset('assets/img/free/free-carbon-mono.png')}}" class="__title_img" /></td>
                        <td class="_row_title">Free Carbon Monoxide Detector</td>
                        <td class="_row_value">FREE</td>
                      </tr>

                      <tr class="included-hidden">
                        <td class="_row_title _wd10"><img style="width:60%;" src="{{asset('assets/img/free/free-fernox-f1.png')}}" class="__title_img" /></td>
                        <td class="_row_title">Free Fernox F1 central heating protector</td>
                        <td class="_row_value">FREE</td>
                      </tr>

                      <tr class="included-hidden">
                        <td class="_row_title _wd10"><img style="width:60%;" src="{{asset('assets/img/free/free-ferox-f3.png')}}" class="__title_img" /></td>
                        <td class="_row_title">Free Fernox F3 Central Heating Cleaner</td>
                        <td class="_row_value">FREE</td>
                      </tr>

                      <tr class="included-hidden">
                        <td class="_row_title _wd10"><img style="width:60%;" src="{{asset('assets/img/free/free-magnetic.png')}}" class="__title_img" /></td>
                        <td class="_row_title">Free Magnetic central heating Filter</td>
                        <td class="_row_value">FREE</td>
                      </tr>

                      <tr class="included-hidden">
                        <td class="_row_title _wd10"><img style="width:60%;" src="{{asset('assets/img/free/free-fernox-scale.png')}}" class="__title_img" /></td>
                        <td class="_row_title">Free Fernox Magnetic Scale Remover</td>
                        <td class="_row_value">FREE</td>
                      </tr>

                      <tr class="included-hidden">
                        <td class="_row_title _wd10"><img style="width:60%;" src="{{asset('assets/img/free/free-magnacleanse.png')}}" class="__title_img" /></td>
                        <td class="_row_title">Free MagnaCleanse system flush</td>
                        <td class="_row_value">FREE</td>
                      </tr>

                      @if (!empty($Selection['moving_boiler']['type']))
                      <tr class="included-hidden">
                        <td class="_row_title _wd10"><img style="width:60%;" src="{{asset('assets/questions/images/q4a/o8.svg')}}" class="__title_img" /></td>
                        <td class="_row_title">Moving boiler to {{ $Selection['moving_boiler']['type'] }}</td>
                        <td class="_row_value">£{{ $Selection['moving_boiler']['price'] }}</td>
                      </tr>
                      @endif

                      @if(!empty($Selection['scaffolding']['type']))
                      <tr class="included-hidden">
                        <td class="_row_title _wd10"><img style="width:60%;" src="{{asset('assets/questions/images/q10b/o1.svg')}}" class="__title_img" /></td>
                        <td class="_row_title">{{ $Selection['scaffolding']['type'] }}</td>
                        <td class="_row_value">£{{ $Selection['scaffolding']['price'] }}</td>
                      </tr>
                      @endif

                      @if (!empty($Selection['conversion_charge']))
                      <tr>
                        <td class="_row_title _wd10"><img style="width:60%;" src="{{asset('assets/questions/images/q2/o1.svg')}}" class="__title_img" /></td>
                        <td class="_row_title">Conversion charge (converting to a Combi boiler)</td>
                        <td class="_row_value">£{{ $Selection['conversion_charge'] }}</td>
                      </tr>
                      @endif

                      <tr class="included-hidden">
                        <td class="_row_title _wd10"><img style="width:60%;" src="{{asset('assets/img/free/boiler-installation.png')}}" class="__title_img" /></td>
                        <td class="_row_title">Boiler & pipework installation, including any alterations and upgrades</td>
                        <td class="_row_value">Included</td>
                      </tr>
                      <tr class="included-hidden">
                        <td class="_row_title _wd10"><img style="width:60%;" src="{{asset('assets/img/free/new-flue.png')}}" class="__title_img" /></td>
                        <td class="_row_title">New Flue Installation and any required brickwork</td>
                        <td class="_row_value">Included</td>
                      </tr>
                      <tr class="included-hidden">
                        <td class="_row_title _wd10"><img style="width:60%;" src="{{asset('assets/img/free/electrical-work.png')}}" class="__title_img" /></td>
                        <td class="_row_title">Electrical work</td>
                        <td class="_row_value">Included</td>
                      </tr>
                      <tr class="included-hidden">
                        <td class="_row_title _wd10"><img style="width:60%;" src="{{asset('assets/img/free/removal-tanks.png')}}" class="__title_img" /></td>
                        <td class="_row_title">Removal and disposal of existing boiler</td>
                        <td class="_row_value">Included</td>
                      </tr>
                      
                      <tr class="included-hidden">
                        <td class="_row_title _wd10"><img style="width:60%;" src="{{asset('assets/img/free/removal-cylinder.png')}}" class="__title_img" /></td>
                        <td class="_row_title">Removal of existing tanks and cylinder</td>
                        <td class="_row_value">Included</td>
                      </tr>
                      <tr class="included-hidden">
                        <td class="_row_title _wd10"><img style="width:60%;" src="{{asset('assets/img/free/register-warranty.png')}}" class="__title_img" /></td>
                        <td class="_row_title">Gasking register the warranty & Building Control Certificate</td>
                        <td class="_row_value">Included</td>
                      </tr>
                      
                      <tr class="included-hidden">
                        <td class="_row_title _wd10"><img style="width:60%;" src="{{asset('assets/img/free/free-pipework.png')}}" class="__title_img" /></td>
                        <td class="_row_title">Free Pipework installation, alterations, and upgrades</td>
                        <td class="_row_value">Included</td>
                      </tr>
                      <tr class="included-hidden">
                        <td class="_row_title _wd10"><img style="width:60%;" src="{{asset('assets/img/free/free-extended.png')}}" class="__title_img" /></td>
                        <td class="_row_title">Free extended Boiler Aftercare warranty ( Warranty must be reactive)</td>
                        <td class="_row_value">Included</td>
                      </tr>
                    </table>

                    <div class="_hr"></div>

                    <div class="_show_everything" >
                      <a href="javascript:void(0);" id="expand-included"> 
                         <i class="fa-solid fa-plus me-2"></i>
                         Show everything included in your installation</a>
                    </div>

                    <div class="__total_price">
                      <table class="info__table">
                        <tr>
                          <td class="_row_title __total_price">
                            Total Fixed Price
                            <small class="mb-4">(including VAT)</small>
                          </td>
                          <td class="_row_value __total_price">£{{ $Selection['total_price'] }}</td>
                        </tr>
                      </table>
                    </div>

                    <div class="__next_date">
                      <button class="btn btn-secondary text-white px-2 px-sm-4 my-2 m-sm-2 d-flex justify-content-center  align-items-center next_date" >Next</button>
                    </div>

                    <div class="__save_quote">
                      <button class="btn btn-secondary text-white px-2 px-sm-4 my-2 m-sm-2 d-flex justify-content-center  align-items-center save_this_quote" data-boiler="{{$boiler->id}}" data-bs-toggle="modal" data-bs-target="#save-quote" >Save Quote</button>
                    </div>

                  </div>
                </div>

              </div>
              </div>
          </div>
      </div>

      <div class="accordion__item" id="dateAccordion">
        <h2 class="accordion__header" id="dateHeading">
            <button class="accordion__button" type="button" id="toggleDateBox">
            When should we install?</button>
        </h2>
        <div id="dateBox" class="accordion__collapse display_none" aria-labelledby="headingDate" data-bs-parent="#priceAccordion">
            <div class="accordion__body">
              <div class="info__box">

              <div class="row">
                <div class="col-md-8 offset-md-2">
              <br>
              <h3 class="mb-5 px-4 px-lg-5 date_title">Appointment Date</h3>
              <br>
              <div class="d-flex justify-content-center">
                  <div class="col-md-8">
                      <div id="showcase-wrapper">
                          <div id="myCalendarWrapper"></div>
                      </div>
                      <div class="px-4 px-lg-5">
                          <p class="h5 font-semibold text-center">Selected date: <u id="current-datestring">22 June</u></p>
                          <p class="mb-0"><small>Your local installer will arrive between 7.30 - 9.30am and your delivery will arrive separately by courier. If anything changes, we’ll be in touch.</small></p>
                      </div>
                  </div>
              </div>

              <div class="_hr"></div>

              <div class="__next_date">
                <button class="btn btn-secondary text-white px-2 px-sm-4 my-2 m-sm-2 d-flex justify-content-center  align-items-center next_address" >Next</button>
              </div>
            </div>
              </div>
            </div>
            </div>
        </div>
    </div>


    <div class="accordion__item" id="addressAccordion">
      <h2 class="accordion__header" id="addressHeading">
          <button class="accordion__button" type="button" id="toggleAddressBox">
          Where are we visiting?</button>
      </h2>
      <div id="addressBox" class="accordion__collapse display_none" aria-labelledby="headingAddress" data-bs-parent="#priceAccordion">
          <div class="accordion__body">
            <div class="info__box">
            
            <div class="row">
              <div class="col-md-8 offset-md-2">
            <form action="#" id="form-billing-address" onsubmit="return false;">    
              @csrf
              <input type="hidden" name="appointment_date" id="appointment_date" />    
              <div class="address  pt-4 px-4 px-lg-5 mt-4">
                  <h3 class="mb-5 date_title">Installation address</h3>
                  <div class="row justify-content-center">
                      <div class="col-md-8">
                          <div class="mb-4">
                              <label for="address-line1" class="form-label ps-4">Address line 1*</label>
                              <input type="text" class="form-control" name="address_line_1" id="address-line1" placeholder="Address line 1" value="105 Broadway">
                          </div>
                          <div class="mb-4">
                              <label for="address-line2" class="form-label ps-4">Address line 2 (optional)</label>
                              <input type="text" class="form-control" name="address_line_2" id="address-line2" placeholder="Address line 2 (optional)">
                          </div>
                          <div class="mb-4">
                              <label for="address-line3" class="form-label ps-4">Address line 3 (optional)</label>
                              <input type="text" class="form-control" name="address_line_3" id="address-line3" placeholder="Address line 3 (optional)">
                          </div>
                          <div class="mb-4">
                              <label for="city-town" class="form-label ps-4">City or Town*</label>
                              <input type="text" class="form-control" name="city" id="city-town" placeholder="City or Town" required="required">
                          </div>
                          <div class="mb-4">
                              <label for="county" class="form-label ps-4">County (optional)</label>
                              <input type="text" class="form-control" name="county" id="county" placeholder="County (optional)">
                          </div>
                          <div class="mb-4">
                              <label for="postcode" class="form-label ps-4">Postcode*</label>
                              <input type="text" class="form-control" name="postcode" value="{{$Selection['post_code_first_part']}}" id="postcode" placeholder="Postcode" required="required">
                          </div>
                          <div class="mb-4">
                              <label for="note" class="form-label ps-4">A note for the enginner</label>
                              <textarea name="note" id="note" class="form-control" placeholder="A note for the enginner"></textarea>
                          </div>
                      </div>
                  </div>
              </div>

             
            <div class="_hr"></div>

            <div class="__next_date">
              <button class="btn btn-secondary text-white px-2 px-sm-4 my-2 m-sm-2 d-flex justify-content-center  align-items-center next_contact" >Next</button>
            </div>

          </div>
        </div>
            </div>
          </div>
      </div>
  </div>

  <div class="accordion__item" id="contactAccordion">
    <h2 class="accordion__header" id="contactHeading">
        <button class="accordion__button" type="button" id="toggleContactBox">
        How do we reach you?</button>
    </h2>
    <div id="contactBox" class="accordion__collapse display_none" aria-labelledby="headingContact" data-bs-parent="#priceAccordion">
        <div class="accordion__body">
          <div class="info__box">
            
            <div class="row">
              <div class="col-md-8 offset-md-2">

            <div class="your-detail  pt-4 px-4 px-lg-5 mt-4">
              <h3 class="mb-5">Your details</h3>
              <div class="row justify-content-center">
                  <div class="col-md-8">
                      <div class="mb-4">
                          <label for="first-name" class="form-label ps-4">First name*</label>
                          <input type="text" class="form-control" name="first_name" id="first-name" placeholder="First name" required="required">
                      </div>
                      <div class="mb-4">
                          <label for="surname" class="form-label ps-4">Surname*</label>
                          <input type="text" class="form-control" name="last_name" id="last-name" placeholder="Surname" required="required">
                      </div>
                      <div class="mb-4">
                          <label for="email" class="form-label ps-4">Email address*</label>
                          <input type="email" class="form-control" name="email" id="email" placeholder="Email address" required="required">
                      </div>
                      <div class="mb-4">
                          <label for="contact" class="form-label ps-4">Contact number*</label>
                          <input type="text" class="form-control" name="contact_number" id="contact" placeholder="Contact number (only digits)" pattern="[0-9]+" required="required">
                      </div>
                  </div>
              </div>
          </div>
          <div class="_hr"></div>

          <div class="__next_date">
            <button class="btn btn-secondary text-white px-2 px-sm-4 my-2 m-sm-2 d-flex justify-content-center  align-items-center next_payment" >Next</button>
          </div>
        </div>
      </div>
          </div>
        </div>
    </div>
</div>

<div class="accordion__item" id="paymentAccordion">
  <h2 class="accordion__header" id="paymentHeading">
      <button class="accordion__button" type="button" id="togglePaymentBox">
      How would you like to pay?</button>
  </h2>
  <div id="paymentBox" class="accordion__collapse display_none" aria-labelledby="headingPayment" data-bs-parent="#priceAccordion">
      <div class="accordion__body">
        <div class="info__box">
            
          <div class="row">
            <div class="col-md-8 offset-md-2">
        <div class="payment-option  pt-4 px-4 px-lg-5 mt-4">
          <h3 class="mb-5">Payment options</h3>
          <div class="row justify-content-center">
              <div class="col-md-8">
                  <div class="mb-4">
                      <div class="form-check">
                          <input class="form-check-input payment-option" type="radio" name="payment_option" id="pay-card" value="stripe">
                          <label class="form-check-label" for="pay-card">
                              <span class="f-20 font-semibold">Pay by card</span>
                              <p class="m-0"><small>Morbi condimentum odio sed ex cursus euismod. Ut iaculis, leo placerat efficitur facilisis, tortor turpis dapibus</small></p>
                          </label>
                           @include('pages.booking.stripe_future.form')
                      </div>
                  </div>
                  <div class="mb-4">
                      <div class="form-check">
                          <input class="form-check-input payment-option" type="radio" name="payment_option" id="pay-paypal" value="paypal">
                          <label class="form-check-label" for="pay-paypal">
                              <span class="f-20 font-semibold">Pay using Paypal</span>
                              <p class="m-0"><small>Morbi condimentum odio sed ex cursus euismod. Ut iaculis, leo placerat efficitur facilisis, tortor turpis dapibus</small></p>
                          </label>
                          <div id="paypal-button-container" class="mt-4" style="display:none"></div>
                      </div>
                  </div>
                  <div class="mb-4">
                      <div class="form-check">
                          <input class="form-check-input payment-option" type="radio" name="payment_option" id="pay-with-finance" value="pay_with_finance">
                          <label class="form-check-label" for="pay-with-finance">
                              <span class="f-20 font-semibold">Pay with Finance</span>
                              <p class="m-0"><small>Morbi condimentum odio sed ex cursus euismod. Ut iaculis, leo placerat efficitur facilisis, tortor turpis dapibus</small></p>
                          </label>
                          <div id="div-pay-with-finance" class="mt-4" style="display:none">
                              <button class="btn btn-secondary" type="submit" id="btn-submit-pay-with-finance">Complete Booking</button>
                          </div>
                      </div>
                  </div>
              </div>
          </div>
      </div>
      
      <div class="payment-option  text-center pt-4 px-4 px-lg-5 mt-4">
          <button class="btn btn-lg btn-secondary" type="submit" id="btn-submit" style="display:none">Complete Booking</button>
      </div>
          

        
      </div>
  </div>
</div>
      </div>
  </div>
    </div>

  </div>


</div>
@endsection

@section('custom-scripts')

<script src="{!! asset('assets/js/CalendarPicker.js') !!}"></script>
<script>
    var disable_dates = {!! $block_dates !!} ; 
    const months = ["Jan","Feb","Mar","Apr","May","Jun","Jul","Aug","Sep","Oct","Nov","Dec"];
    const nextYear = new Date().getFullYear() + 1;
    const myCalender = new CalendarPicker('#myCalendarWrapper', {
        // If max < min or min > max then the only available day will be today.
        min: new Date(),
        max: new Date(nextYear, 10), // NOTE: new Date(nextYear, 10) is "Nov 01 <nextYear>"
        locale: 'en-US', // Can be any locale or language code supported by Intl.DateTimeFormat, defaults to 'en-US'
        showShortWeekdays: true, // Can be used to fit calendar onto smaller (mobile) screens, defaults to false
        disable_dates: disable_dates
    });

    const currentToDateString = document.getElementById('current-datestring');
    {{--
    //currentToDateString.textContent = myCalender.value.getDate()+' '+months[myCalender.value.getMonth()]+' '+myCalender.value.getFullYear();
    //document.querySelector('#appointment_date').value = currentToDateString.textContent;
    --}}
    currentToDateString.textContent ='';

    myCalender.onValueChange((currentValue) => {
        currentToDateString.textContent = currentValue.getDate()+' '+months[currentValue.getMonth()]+' '+myCalender.value.getFullYear();
        document.querySelector('#appointment_date').value = currentToDateString.textContent;
        {{--
        //do_disable_dates(currentValue.getFullYear(), currentValue.getMonth()+1);
        --}}
    });

{{--
    function do_disable_dates(disable_dates, current_year, current_month)
    {   
        disable_dates.forEach(function(date){
           var date_split = date.split("-");
           var year = parseInt(date_split[0]);
           var month = parseInt(date_split[1]);
           var day = parseInt(date_split[2]);
          
           if (month==current_month && year == current_year)
           {
               //console.log(month);
                //add disable class
                const headings = document.evaluate(
                "//time[contains(., "+day+")]",
                document,
                null,
                XPathResult.ANY_TYPE,
                null
                );
                
                const thisHeading = headings.iterateNext();
                if (thisHeading)
                {
                    //console.log(thisHeading.textContent);
                    thisHeading.classList.add('disabled');
                    //thisHeading.style.backgroundColor = "#CC0000";
                    thisHeading.title = 'Please choose another date.';
                    var text = thisHeading.textContent+' Full';
                    thisHeading.textContent = text;
                }
           }

        });
    }
--}}
   
   var current_month = myCalender.value.getMonth();
   var current_year = myCalender.value.getFullYear();
   {{--
   //do_disable_dates(disable_dates, current_year, current_month+1);
   --}}

</script>

<script>
var selection = JSON.parse('{!! json_encode($Selection) !!}');
function formvalidate(form)
  {
       
    var el=$(form).find( "input:visible" ); 
    var valid=true;
        
    $.each(el,function(i,v){
        
    valid=v.checkValidity();  
    if (!valid) {
    
    return false;
    } 
    
    });
                
   return valid;       
  }

  $("#expand-included").click(function(){
    $(".included-hidden").slideDown(200);
    $(this).hide(200);
  });

  $('.payment-option').change(function(e){
    
    if (!$('#appointment_date').val())
    {
      alert('Please select appointment date.');
      $('.payment-option').prop('checked',false);
      return false;
    }

    var value = $(this).val();  
    if (value=='paypal')
    {
        $('#paypal-button-container').show();
        $('#stripe-payment-form').hide();
        $('#div-pay-with-finance').hide();
        remove_stripe_submit_event();
        remove_pay_with_finance_submit_event();
    }
    else if (value=='stripe')
    {
        $('#stripe-payment-form').show();
        $('#paypal-button-container').hide();
        $('#div-pay-with-finance').hide();
        add_stripe_submit_event();
        remove_pay_with_finance_submit_event();
    }
    else if (value=='pay_with_finance')
    {
        $('#div-pay-with-finance').show();
        $('#stripe-payment-form').hide();
        $('#paypal-button-container').hide();
        remove_stripe_submit_event();
        add_pay_with_finance_submit_event();
    }
  });

  $(".next_date").click(function(){
    $("#priceBox").hide(0);
    $("#contactBox").hide(0);
    $("#paymentBox").hide(0);
    $("#addressBox").hide(0);
    $("#dateBox").slideDown(100);
    $("html, body").animate({ scrollTop: $('#toggleDateBox').offset().top - 100 }, 1);
  });

  $(".next_address").click(function(){
    if (!$('#appointment_date').val()){
    Swal.fire({
      icon: 'error',
      title: 'Oops...',
      text: 'Select Appointment Date!'
    });
    return false;
    }
    $("#priceBox").hide(0);
    $("#paymentBox").hide(0);
    $("#contactBox").hide(0);
    $("#dateBox").hide(0);
    $("#addressBox").slideDown(100);
    $("html, body").animate({ scrollTop: $('#toggleAddressBox').offset().top - 100 }, 1);
  });

  $(".next_contact").click(function(){
    if (!$('#appointment_date').val()){
    Swal.fire({
      icon: 'error',
      title: 'Oops...',
      text: 'Please select the appointment date!'
    });
    return false;
    }

    if($("#address-line1").val() == "" || $("#city-town").val() == "" || $("#postcode").val() == "")
    {
      Swal.fire({
      icon: 'error',
      title: 'Oops...',
      text: 'Please fill all the required address information!'
    });
    return false;
    }

    $("#priceBox").hide(0);
    $("#paymentBox").hide(0);
    $("#addressBox").hide(0);
    $("#dateBox").hide(0);
    $("#contactBox").slideDown(100);
    $("html, body").animate({ scrollTop: $('#toggleContactBox').offset().top - 100 }, 1);
  });

  $(".next_payment").click(function(){
    if (!$('#appointment_date').val()){
    Swal.fire({
      icon: 'error',
      title: 'Oops...',
      text: 'Select Appointment Date!'
    });
    return false;
    }
    if($("#address-line1").val() == "" || $("#city-town").val() == "" || $("#postcode").val() == "")
    {
      Swal.fire({
      icon: 'error',
      title: 'Oops...',
      text: 'Please fill all the required address information!'
    });
    return false;
    }
    if($("#first-name").val() == "" || $("#last-name").val() == "" || $("#email").val() == "" || $("#contact").val() == "")
    {
      Swal.fire({
      icon: 'error',
      title: 'Oops...',
      text: 'Please fill all the required contact details!'
    });
    return false;
    }
    $("#priceBox").hide(0);
    $("#contactBox").hide(0);
    $("#addressBox").hide(0);
    $("#dateBox").hide(0);
    $("#paymentBox").slideDown(100);
    $("html, body").animate({ scrollTop: $('#togglePaymentBox').offset().top - 100 }, 1);
  });

  $("#togglePriceBox").click(function(){
    
    $("#dateBox").hide(0);
    $("#contactBox").hide(0);
    $("#paymentBox").hide(0);
    $("#addressBox").hide(0);
    $("#priceBox").slideToggle(100);
    $("html, body").animate({ scrollTop: $('#togglePriceBox').offset().top - 100 }, 1);

  });

  $("#toggleDateBox").click(function(){
    $("#contactBox").hide(0);
    $("#paymentBox").hide(0);
    $("#addressBox").hide(0);
    $("#priceBox").hide(0);
    $("#dateBox").slideToggle(100);
    $("html, body").animate({ scrollTop: $('#toggleDateBox').offset().top - 100 }, 1);
  });

  $("#toggleAddressBox").click(function(){
    if (!$('#appointment_date').val()){
    Swal.fire({
      icon: 'error',
      title: 'Oops...',
      text: 'Select Appointment Date!'
    });
    return false;
    }
    // if($("#address-line1").val() == "" || $("#city-town").val() == "" || $("#postcode").val() == "")
    // {
    //   Swal.fire({
    //   icon: 'error',
    //   title: 'Oops...',
    //   text: 'Please fill all the required address information!'
    // });
    // return false;
    // }
    // if($("#first-name").val() == "" || $("#last-name").val() == "" || $("#email").val() == "" || $("#contact").val() == "")
    // {
    //   Swal.fire({
    //   icon: 'error',
    //   title: 'Oops...',
    //   text: 'Please fill all the required contact details!'
    // });
    // return false;
    // }
    $("#dateBox").hide(0);
    $("#contactBox").hide(0);
    $("#paymentBox").hide(0);
    $("#priceBox").hide(0);
    $("#addressBox").slideToggle(100);
    $("html, body").animate({ scrollTop: $('#toggleAddressBox').offset().top - 100 }, 1);
  });

  $("#toggleContactBox").click(function(){
    if (!$('#appointment_date').val()){
    Swal.fire({
      icon: 'error',
      title: 'Oops...',
      text: 'Select Appointment Date!'
    });
    return false;
    }
    if($("#address-line1").val() == "" || $("#city-town").val() == "" || $("#postcode").val() == "")
    {
      Swal.fire({
      icon: 'error',
      title: 'Oops...',
      text: 'Please fill all the required address information!'
    });
    return false;
    }
    // if($("#first-name").val() == "" || $("#last-name").val() == "" || $("#email").val() == "" || $("#contact").val() == "")
    // {
    //   Swal.fire({
    //   icon: 'error',
    //   title: 'Oops...',
    //   text: 'Please fill all the required contact details!'
    // });
    // return false;
    // }
    $("#dateBox").hide(0);
    $("#addressBox").hide(0);
    $("#paymentBox").hide(0);
    $("#priceBox").hide(0);
    $("#contactBox").slideToggle(100);
    $("html, body").animate({ scrollTop: $('#toggleContactBox').offset().top - 100 }, 1);
  });

  $("#togglePaymentBox").click(function(){
    if (!$('#appointment_date').val()){
    Swal.fire({
      icon: 'error',
      title: 'Oops...',
      text: 'Select Appointment Date!'
    });
    return false;
    }
    if($("#address-line1").val() == "" || $("#city-town").val() == "" || $("#postcode").val() == "")
    {
      Swal.fire({
      icon: 'error',
      title: 'Oops...',
      text: 'Please fill all the required address information!'
    });
    return false;
    }
    if($("#first-name").val() == "" || $("#last-name").val() == "" || $("#email").val() == "" || $("#contact").val() == "")
    {
      Swal.fire({
      icon: 'error',
      title: 'Oops...',
      text: 'Please fill all the required contact details!'
    });
    return false;
    }
    $("#dateBox").hide(0);
    $("#contactBox").hide(0);
    $("#addressBox").hide(0);
    $("#priceBox").hide(0);
    $("#paymentBox").slideToggle(100);
    $("html, body").animate({ scrollTop: $('#togglePaymentBox').offset().top - 100 }, 1);
  });



var cBoiler = "";
$(".save_this_quote").click(function(event){
    cBoiler = $(this).attr("data-boiler");
    $("#save-quote").show();
});
$("#save-quote-btn").click(function(event){
  event.preventDefault();
  $("#emailErr").html("");
  var email = $("#email-quote").val();
  var contact = $("#contact-quote").val();
  if(email != "")
  {
    if(!validateEmail(email))
    {
      $("#emailErr").html("Please enter a valid email");
      return false;
    }
  }else{
    if(!validateEmail(email))
    {
      $("#emailErr").html("Please enter your email address");
      return false;
    }
  }
  var choice = JSON.stringify(selection);

  var url = '{!! route("save.quote") !!}';

  var saved_url = "{{url()->current()}}";

  $.ajax({
      url: url, 
      type: "POST",
      data: {
                selection: choice,
                boiler: cBoiler,
                email: email,
                contact: contact,
                saved_url: saved_url
            },
      dataType: "json",      
      headers: {
          'X-CSRF-TOKEN': "{!! csrf_token() !!}"
      },
      beforeSend: function () {
          $('.loader').show();
      },
      complete: function () {
          $('.loader').hide();
      },     
      success:function(data)
      {
        Swal.fire({
          title: 'Done',
          text: data.message,
          icon: 'success',
          showCancelButton: false,
          showCloseButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Close'
          }).then((result) => {
          if (result.isConfirmed) {
            $('#save-quote').modal('hide');
          }
          });
      }

  });
});
</script>
@endsection

@include('pages.booking.paypal')
@include('pages.booking.pay_with_finance')
