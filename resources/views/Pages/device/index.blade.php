@extends('pages.layouts.master')

@section('title') Smart Device @endsection

@section('container-css') pb-5 @endsection

@section('progress-bar')
<div class="progress-bar" role="progressbar" style="width: 80%" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100"></div>
@endsection

@php $completed_wizards = ['boiler','control','radiator'] @endphp

@section('content')
<div class="row justify-content-center">
            <div class="col-md-8">
                <h2 class="text-center mb-4">Add Smart Devices</h2>
                <p class="text-center text-black-light mb-5">We’ll install your smart home devices, connect them up & show you how they work</p>
            </div>
        </div>

        <div class="control-listing">
            <div class="row">
                <div class="col-lg-8">
                    <div class="row">
                        <div class="col-md-6 mb-4">
                            <div class="card control-item">
                                <div class="card-img control-img">
                                    <img src="{!! asset('assets/img/trv.jpg') !!}" alt="Thermostatic radiator valve (TRV)">
                                </div>
                                <div class="control-detail text-center p-4 px-lg-5">
                                    <h4 class="f-20 font-medium">Thermostatic radiator valve (TRV)</h4>
                                    <span class="text-secondary font-semibold d-block mb-4">£35</span>
                                    <p class="m-0"><small>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas fermentum lacus vitae urna auctor gravida.</small></p>
                                    <a href="#" class="text-secondary d-block mb-4"><small>More Info</small></a>

                                    <div class="input-group input-inc-dec mb-3">
                                        <button class="btn btn-outline-secondary decrease" type="button">-</button>
                                        <input type="text" class="form-control" placeholder="0" aria-label="Quantity">
                                        <button class="btn btn-outline-secondary increase" type="button">+</button>
                                    </div>
                                    <div class="text-center">
                                        <a href="#" class="btn btn-outline-secondary px-5">Add</a>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="col-md-6 mb-4">
                            <div class="card control-item">
                                <div class="card-img control-img">
                                    <img src="{!! asset('assets/img/nest-mini.jpg') !!}" alt="Nest Mini">
                                </div>
                                <div class="control-detail text-center p-4 px-lg-5">
                                    <h4 class="f-20 font-medium">Nest Mini</h4>
                                    <span class="text-secondary font-semibold d-block mb-4">£49</span>
                                    <p class="m-0"><small>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas fermentum lacus vitae urna auctor gravida.</small></p>
                                    <a href="#" class="text-secondary d-block mb-4"><small>More Info</small></a>

                                    <div class="input-group input-inc-dec mb-3">
                                        <button class="btn btn-outline-secondary decrease" type="button">-</button>
                                        <input type="text" class="form-control" placeholder="0" aria-label="Quantity">
                                        <button class="btn btn-outline-secondary increase" type="button">+</button>
                                    </div>
                                    <div class="text-center">
                                        <a href="#" class="btn btn-outline-secondary px-5">Add</a>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="col-md-6 mb-4">
                            <div class="card control-item">
                                <div class="card-img control-img">
                                    <img src="{!! asset('assets/img/nest-hub-g2.jpg') !!}" alt="Nest Hub Gen 2">
                                </div>
                                <div class="control-detail text-center p-4 px-lg-5">
                                    <h4 class="f-20 font-medium">Nest Hub Gen 2</h4>
                                    <span class="text-secondary font-semibold d-block mb-4">£79.99</span>
                                    <p class="m-0"><small>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas fermentum lacus vitae urna auctor gravida.</small></p>
                                    <a href="#" class="text-secondary d-block mb-4"><small>More Info</small></a>

                                    <div class="input-group input-inc-dec mb-3">
                                        <button class="btn btn-outline-secondary decrease" type="button">-</button>
                                        <input type="text" class="form-control" placeholder="0" aria-label="Quantity">
                                        <button class="btn btn-outline-secondary increase" type="button">+</button>
                                    </div>
                                    <div class="text-center">
                                        <a href="#" class="btn btn-outline-secondary px-5">Add</a>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="col-md-6 mb-4">
                            <div class="card control-item">
                                <div class="card-img control-img">
                                    <img src="{!! asset('assets/img/nest-alarm.jpg') !!}" alt="Nest Protect smoke and CO alarm">
                                </div>
                                <div class="control-detail text-center p-4 px-lg-5">
                                    <h4 class="f-20 font-medium">Nest Protect smoke and CO alarm</h4>
                                    <span class="text-secondary font-semibold d-block mb-4">£109</span>
                                    <p class="m-0"><small>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas fermentum lacus vitae urna auctor gravida.</small></p>
                                    <a href="#" class="text-secondary d-block mb-4"><small>More Info</small></a>

                                    <div class="input-group input-inc-dec mb-3">
                                        <button class="btn btn-outline-secondary decrease" type="button">-</button>
                                        <input type="text" class="form-control" placeholder="0" aria-label="Quantity">
                                        <button class="btn btn-outline-secondary increase" type="button">+</button>
                                    </div>
                                    <div class="text-center">
                                        <a href="#" class="btn btn-outline-secondary px-5">Add</a>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="col-md-6 mb-4">
                            <div class="card control-item">
                                <div class="card-img control-img">
                                    <img src="{!! asset('assets/img/cam.jpg') !!}" alt="Nest Cam Indoor">
                                </div>
                                <div class="control-detail text-center p-4 px-lg-5">
                                    <h4 class="f-20 font-medium">Nest Cam Indoor</h4>
                                    <span class="text-secondary font-semibold d-block mb-4">£129.99</span>
                                    <p class="m-0"><small>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas fermentum lacus vitae urna auctor gravida.</small></p>
                                    <a href="#" class="text-secondary d-block mb-4"><small>More Info</small></a>

                                    <div class="input-group input-inc-dec mb-3">
                                        <button class="btn btn-outline-secondary decrease" type="button">-</button>
                                        <input type="text" class="form-control" placeholder="0" aria-label="Quantity">
                                        <button class="btn btn-outline-secondary increase" type="button">+</button>
                                    </div>
                                    <div class="text-center">
                                        <a href="#" class="btn btn-outline-secondary px-5">Add</a>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="col-md-6 mb-4">
                            <div class="card control-item">
                                <div class="card-img control-img">
                                    <img src="{!! asset('assets/img/cam-doorbell.jpg') !!}" alt="Google Nest Doorbell">
                                </div>
                                <div class="control-detail text-center p-4 px-lg-5">
                                    <h4 class="f-20 font-medium">Google Nest Doorbell</h4>
                                    <span class="text-secondary font-semibold d-block mb-4">£179.99</span>
                                    <p class="m-0"><small>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas fermentum lacus vitae urna auctor gravida.</small></p>
                                    <a href="#" class="text-secondary d-block mb-4"><small>More Info</small></a>

                                    <div class="input-group input-inc-dec mb-3">
                                        <button class="btn btn-outline-secondary decrease" type="button">-</button>
                                        <input type="text" class="form-control" placeholder="0" aria-label="Quantity">
                                        <button class="btn btn-outline-secondary increase" type="button">+</button>
                                    </div>
                                    <div class="text-center">
                                        <a href="#" class="btn btn-outline-secondary px-5">Add</a>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="card p-4">
                        <div class="card-light p-4 text-center mb-4">
                            <p class="text-primary">Your fixed price including installation & radiators</p>
                            <h3 class="m-0">£2675.79</h3>
                            <small class="d-block mb-4">including VAT</small>
                            <a href="booking.html" class="btn btn-secondary d-block mb-4">Next</a>
                            <a href="#" class="text-secondary d-flex align-items-center justify-content-center" data-bs-toggle="modal" data-bs-target="#save-quote"><i class="fa-solid fa-envelope me-2"></i> Save Quote</a>
                        </div>
                        <div class="card-light p-4 mb-4">
                            <p class="f-18 font-medium side-card-title text-primary">Smart Devices</p>
                            <ul class="side-card-list list-unstyled">
                                <li>
                                    <p class="f-15 font-medium mb-0">1x Thermostatic radiator valve (TRV)</p>
                                    <p class="m-0">£35</p>
                                    <a href="#" class="text-danger mb-2 d-block">Remove</a>
                                </li>
                                <li>
                                    <p class="f-15 font-medium mb-0">2x Nest Mini</p>
                                    <p class="m-0">£98</p>
                                    <a href="#" class="text-danger mb-2 d-block">Remove</a>
                                </li>
                            </ul>
                        </div>
                        <div class="card-light p-4 mb-4">
                            <p class="f-18 font-medium side-card-title text-primary">Control</p>
                            <ul class="side-card-list list-unstyled">
                                <li>
                                    <p class="f-15 text-secondary mb-0">Control Selected</p>
                                    <p class="f-15 font-medium mb-2">Google Nest 3rd Gen FREE</p>
                                </li>
                            </ul>
                        </div>
                        <div class="card-light p-4 mb-4">
                            <p class="f-18 font-medium side-card-title text-primary">Boiler information</p>
                            <ul class="side-card-list list-unstyled">
                                <li>
                                    <p class="f-15 text-secondary mb-0">Boiler Selected</p>
                                    <p class="f-15 font-medium mb-2">Vaillant ecoFIT Pure Combi 25kw £2542.79</p>
                                </li>
                                <li>
                                    <p class="f-15 text-secondary mb-0">Current boiler type</p>
                                    <p class="f-15 font-medium mb-2">Combi</p>
                                </li>
                                <li>
                                    <p class="f-15 text-secondary mb-0">Moving boiler to</p>
                                    <p class="f-15 font-medium mb-2">
                                        <span class="d-block">Utility Room</span>
                                        £700
                                    </p>
                                </li>
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