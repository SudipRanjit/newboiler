@extends('pages.layouts.master')

@section('title') Booking @endsection

@section('container-css') pb-5 @endsection

@section('progress-bar')
<div class="progress-bar" role="progressbar" style="width: 100%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
@endsection

@php $completed_wizards = ['boiler','control','radiator','smart-device'] @endphp

@php $Selection = Session()->get('selection') @endphp

@section('content')
<div class="row justify-content-center">
            <div class="col-md-8">
                <h2 class="text-center mb-4">Booking</h2>
                <p class="text-center text-black-light mb-5">Choose up to 10 new radiators and we’ll fit these during your boiler installation. We can only fit new radiators in place of existing ones, not in new locations.</p>
            </div>
        </div>

        <div class="control-listing">
            <div class="row">
                <div class="col-lg-8">
                    <div class="card py-4 mb-4">
                        <h3 class="mb-5 px-4 px-lg-5">Appointment Date</h3>
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
                        <div class="address border-top-light-1 pt-4 px-4 px-lg-5 mt-4">
                            <h3 class="mb-5">Installation address</h3>
                            <div class="row justify-content-center">
                                <div class="col-md-8">
                                    <div class="mb-4">
                                        <label for="address-line1" class="form-label ps-4">Address line 1</label>
                                        <input type="text" class="form-control" id="address-line1" placeholder="Address line 1" value="105 Broadway">
                                    </div>
                                    <div class="mb-4">
                                        <label for="address-line2" class="form-label ps-4">Address line 2 (optional)</label>
                                        <input type="text" class="form-control" id="address-line2" placeholder="Address line 2 (optional)">
                                    </div>
                                    <div class="mb-4">
                                        <label for="address-line3" class="form-label ps-4">Address line 3 (optional)</label>
                                        <input type="text" class="form-control" id="address-line3" placeholder="Address line 3 (optional)">
                                    </div>
                                    <div class="mb-4">
                                        <label for="city-town" class="form-label ps-4">City or Town</label>
                                        <input type="text" class="form-control" id="city-town" placeholder="City or Town">
                                    </div>
                                    <div class="mb-4">
                                        <label for="county" class="form-label ps-4">County (optional)</label>
                                        <input type="text" class="form-control" id="county" placeholder="County (optional)">
                                    </div>
                                    <div class="mb-4">
                                        <label for="postcode" class="form-label ps-4">Postcode</label>
                                        <input type="text" class="form-control" id="postcode" placeholder="Postcode">
                                    </div>
                                    <div class="mb-4">
                                        <label for="note" class="form-label ps-4">A note for the enginner</label>
                                        <textarea name="note" id="note" class="form-control" placeholder="A note for the enginner"></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="your-detail border-top-light-1 pt-4 px-4 px-lg-5 mt-4">
                            <h3 class="mb-5">Your details</h3>
                            <div class="row justify-content-center">
                                <div class="col-md-8">
                                    <div class="mb-4">
                                        <label for="first-name" class="form-label ps-4">First name</label>
                                        <input type="text" class="form-control" id="first-name" placeholder="First name">
                                    </div>
                                    <div class="mb-4">
                                        <label for="surname" class="form-label ps-4">Surname</label>
                                        <input type="text" class="form-control" id="surname" placeholder="Surname">
                                    </div>
                                    <div class="mb-4">
                                        <label for="email" class="form-label ps-4">Email address</label>
                                        <input type="email" class="form-control" id="email" placeholder="Email address">
                                    </div>
                                    <div class="mb-4">
                                        <label for="contact" class="form-label ps-4">Contact number</label>
                                        <input type="text" class="form-control" id="contact" placeholder="Contact number">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="payment-option border-top-light-1 pt-4 px-4 px-lg-5 mt-4">
                            <h3 class="mb-5">Payment options</h3>
                            <div class="row justify-content-center">
                                <div class="col-md-8">
                                    <div class="mb-4">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="flexRadioDefault" id="pay-card">
                                            <label class="form-check-label" for="pay-card">
                                                <span class="f-20 font-semibold">Pay by card</span>
                                                <p class="m-0"><small>Morbi condimentum odio sed ex cursus euismod. Ut iaculis, leo placerat efficitur facilisis, tortor turpis dapibus</small></p>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="mb-4">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="flexRadioDefault" id="pay-paypal">
                                            <label class="form-check-label" for="pay-paypal">
                                                <span class="f-20 font-semibold">Pay using Paypal</span>
                                                <p class="m-0"><small>Morbi condimentum odio sed ex cursus euismod. Ut iaculis, leo placerat efficitur facilisis, tortor turpis dapibus</small></p>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="payment-option border-top-light-1 text-center pt-4 px-4 px-lg-5 mt-4">
                            <button class="btn btn-lg btn-secondary" type="submit">Complete Booking</button>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="card p-4">
                        <div class="card-light p-4 text-center mb-4">
                            <p class="text-primary">Your fixed price including installation & radiators</p>
                            <h3 class="m-0">£{{ $Selection['total_price'] }}</h3>
                            <small class="d-block mb-4">including VAT</small>
                            <a href="#" class="text-secondary d-flex align-items-center justify-content-center" data-bs-toggle="modal" data-bs-target="#save-quote"><i class="fa-solid fa-envelope me-2"></i> Save Quote</a>
                        </div>

                        @if(!empty($radiator))
                        <div class="card-light p-4 mb-4">
                            <p class="f-18 font-medium side-card-title text-primary">Radiator</p>
                            <ul class="side-card-list list-unstyled">
                                <li>
                                    <p class="f-15 font-medium mb-0"><span class="basket_count"><a href="{!! route('page.radiators') !!}">{{$Selection['radiator']['quantity']}}</span>x {{$radiator->radiator_name}}</a></p>
                                    <p class="m-0">£<span class="total_price">{{round($Selection['radiator']['quantity']*$radiator->price,2);}}</span></p>
                                    @if(!empty($Selection['radiator_type']))
                                    <p class="m-0">Type: {{ $radiator_type->type}}</p>
                                    @endif
                                    @if(!empty($Selection['radiator_height']))
                                    <p class="m-0">Height: {{ $radiator_height->height }}mm</p>
                                    @endif
                                    @if(!empty($Selection['radiator_length']))
                                    <p class="m-0">Length: {{ $radiator_length->length }}mm</p>
                                    @endif

                                </li>
                            </ul>
                        </div>
                        @endif

                        <div class="card-light p-4 mb-4">
                            <p class="f-18 font-medium side-card-title text-primary">Smart Devices</p>
                            <ul class="side-card-list list-unstyled" id="added_devices">
                                 @if($devices)
                                    @foreach($devices as $device)
                                    <li id="added_devices_li_{{$device->id}}">
                                        <p class="f-15 font-medium mb-0"><a href="{!! route('page.smart-devices') !!}"><span class="device-quantity">{{ $Selection['devices'][$device->id]['quantity'] }}</span>x  <span class="device-name">{{$device->device_name}}</span></a></p>
                                        <p class="m-0  device-price">
                                            @if($Selection['devices'][$device->id]['quantity']>1)
                                                £{{round($device->price * $Selection['devices'][$device->id]['quantity'],2)}} (£{{$device->price}}*{{$Selection['devices'][$device->id]['quantity']}})
                                            @else
                                                £{{$device->price}}
                                            @endif    
                                        </p>
                                    </li>
                                    @endforeach
                                @endif
                            </ul>
                        </div>

                        <div class="card-light p-4 mb-4">
                            <p class="f-18 font-medium side-card-title text-primary">Control</p>
                            <ul class="side-card-list list-unstyled">
                                <li>
                                    <p class="f-15 text-secondary mb-0">Control Selected</p>
                                    <p class="f-15 font-medium mb-2"><a href="{!! route('page.controls') !!}">{{ $addon->addon_name}}</a></p>
                                </li>
                            </ul>
                        </div>

                        <div class="card-light p-4 mb-4">
                            <p class="f-18 font-medium side-card-title text-primary">Boiler information</p>
                            <ul class="side-card-list list-unstyled">
                                <li>
                                    <p class="f-15 text-secondary mb-0">Boiler Selected</p>
                                    <p class="f-15 font-medium mb-2"><a href="{!! route('page.boiler', ['id' => $boiler->id]) !!}">{{ $boiler->boiler_name }} £{{ $boiler->price - $boiler->discount??0 }}</a></p>
                                </li>
                                <li>
                                    <p class="f-15 text-secondary mb-0">Current boiler type</p>
                                    <p class="f-15 font-medium mb-2">{{ $boiler->boiler_type }}</p>
                                </li>

                                @if (!empty($Selection['moving_boiler']['type']))
                                <li>
                                    <p class="f-15 text-secondary mb-0">Moving boiler to</p>
                                    <p class="f-15 font-medium mb-2">
                                        <span class="d-block">{{ $Selection['moving_boiler']['type'] }}</span>
                                        £{{ $Selection['moving_boiler']['price'] }}
                                    </p>
                                </li>
                                @endif

                                @if (!empty($Selection['conversion_charge']))
                                <li>
                                    <p class="f-15 text-secondary mb-0">Conversion charge (converting to a Combi boiler)</p>
                                    <p class="f-15 font-medium mb-2">
                                        £{{ $Selection['conversion_charge'] }}
                                    </p>
                                </li>
                                @endif

                            </ul>
                        </div>

                        <div class="card-light p-4">
                            <p class="f-18 font-medium side-card-title text-primary">Extras included</p>
                            <ul class="side-card-list list-unstyled side-card-extras">
                                <li>
                                    <p class="f-15 font-medium">
                                        <span class="side-card-extra-title">Extended Warranty</span>
                                        <span>12 years</span>
                                    </p>
                                </li>
                                <li>
                                    <p class="f-15 font-medium">
                                        <span class="side-card-extra-title">Carbon Monoxide Alarm</span>
                                        <span>Free</span>
                                    </p>
                                </li>
                                <li>
                                    <p class="f-15 font-medium">
                                        <span class="side-card-extra-title">Magnetic Filter </span>
                                        <span>Free</span>
                                    </p>
                                </li>
                                <li>
                                    <p class="f-15 font-medium">
                                        <span class="side-card-extra-title">Chemical Flush</span>
                                        <span>Free</span>
                                    </p>
                                </li>
                                <li>
                                    <p class="f-15 font-medium">
                                        <span class="side-card-extra-title">Fernox Magnetic Scale Remover</span>
                                        <span>Free</span>
                                    </p>
                                </li>
                                <li>
                                    <p class="f-15 font-medium">
                                        <span class="side-card-extra-title">Fernox F1 Central Heating Protector</span>
                                        <span>Free</span>
                                    </p>
                                </li>
                                <li>
                                    <p class="f-15 font-medium">
                                        <span class="side-card-extra-title">Fernox F3 Central Heating Cleaner</span>
                                        <span>Free</span>
                                    </p>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>

@endsection

@section('custom-scripts')

<script src="{!! asset('assets/js/CalendarPicker.js') !!}"></script>
<script>
    const months = ["Jan","Feb","Mar","Apr","May","Jun","Jul","Aug","Sep","Oct","Nov","Dec"];
    const nextYear = new Date().getFullYear() + 1;
    const myCalender = new CalendarPicker('#myCalendarWrapper', {
        // If max < min or min > max then the only available day will be today.
        min: new Date(),
        max: new Date(nextYear, 10), // NOTE: new Date(nextYear, 10) is "Nov 01 <nextYear>"
        locale: 'en-US', // Can be any locale or language code supported by Intl.DateTimeFormat, defaults to 'en-US'
        showShortWeekdays: true // Can be used to fit calendar onto smaller (mobile) screens, defaults to false
    });

    const currentToDateString = document.getElementById('current-datestring');
    currentToDateString.textContent = myCalender.value.getDate()+' '+months[myCalender.value.getMonth()]+' '+myCalender.value.getFullYear();


    myCalender.onValueChange((currentValue) => {
        currentToDateString.textContent = currentValue.getDate()+' '+months[currentValue.getMonth()]+' '+myCalender.value.getFullYear();
    });
</script>

@endsection
