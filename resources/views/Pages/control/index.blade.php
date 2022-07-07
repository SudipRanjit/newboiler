@extends('pages.layouts.master')

@section('title') Control @endsection

@section('container-css') pb-5 @endsection

@section('progress-bar')
<div class="progress-bar" role="progressbar" style="width: 40%" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100"></div>
@endsection

@php $completed_wizards = ['boiler'] @endphp

@section('content')
<div class="row justify-content-center">
            <div class="col-md-8">
                <h2 class="text-center mb-4">Choose a Control</h2>
                <p class="text-center text-black-light mb-5">Choose a control for the boiler. We will help you with the installation and usage</p>
            </div>
        </div>

        <div class="control-listing">
            <div class="row">
                <div class="col-lg-8">
                    <div class="row">
                        <div class="col-md-6 mb-4">
                            <div class="card control-item">
                                <div class="card-img control-img">
                                    <img src="{!! asset('assets/img/nest.jpg') !!}" alt="Nest">
                                </div>
                                <div class="control-detail text-center p-4 px-lg-5">
                                    <h4 class="f-20 font-medium">Google Nest 3rd Gen</h4>
                                    <span class="font-semibold text-secondary d-block mb-4">FREE</span>
                                    <p class="m-0"><small>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas fermentum lacus vitae urna auctor gravida.</small></p>
                                    <a href="#" class="text-secondary d-block mb-4"><small>More Info</small></a>
                                    <a href="#" class="btn btn-outline-secondary d-block">Added</a>
                                </div>

                            </div>
                        </div>
                        <div class="col-md-6 mb-4">
                            <div class="card control-item">
                                <div class="card-img control-img">
                                    <img src="{!! asset('assets/img/hive.jpg') !!}" alt="hive">
                                </div>
                                <div class="control-detail text-center p-4 px-lg-5">
                                    <h4 class="f-20 font-medium">Google Hive</h4>
                                    <span class="font-semibold text-secondary d-block mb-4">FREE</span>
                                    <p class="m-0"><small>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas fermentum lacus vitae urna auctor gravida.</small></p>
                                    <a href="#" class="text-secondary d-block mb-4"><small>More Info</small></a>
                                    <a href="#" class="btn btn-outline-secondary w-100">Choose</a>
                                </div>

                            </div>
                        </div>
                        <div class="col-md-6 mb-4">
                            <div class="card control-item">
                                <div class="card-img control-img">
                                    <img src="{!! asset('assets/img/control-3.jpg') !!}" alt="control-3">
                                </div>
                                <div class="control-detail text-center p-4 px-lg-5">
                                    <h4 class="f-20 font-medium">Control 3</h4>
                                    <span class="font-semibold text-secondary d-block mb-4">£199</span>
                                    <p class="m-0"><small>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas fermentum lacus vitae urna auctor gravida.</small></p>
                                    <a href="#" class="text-secondary d-block mb-4"><small>More Info</small></a>
                                    <a href="#" class="btn btn-outline-secondary w-100">Choose</a>
                                </div>

                            </div>
                        </div>
                        <div class="col-md-6 mb-4">
                            <div class="card control-item">
                                <div class="card-img control-img">
                                    <img src="{!! asset('assets/img/control-4.jpg') !!}" alt="control-4">
                                </div>
                                <div class="control-detail text-center p-4 px-lg-5">
                                    <h4 class="f-20 font-medium">Control 4</h4>
                                    <span class="font-semibold text-secondary d-block mb-4">£299</span>
                                    <p class="m-0"><small>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas fermentum lacus vitae urna auctor gravida.</small></p>
                                    <a href="#" class="text-secondary d-block mb-4"><small>More Info</small></a>
                                    <a href="#" class="btn btn-outline-secondary w-100">Choose</a>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="card p-4">
                        <div class="card-light p-4 text-center mb-4">
                            <p class="text-primary">Your fixed price including installation & radiators</p>
                            <h3 class="m-0">£2542.79</h3>
                            <small class="d-block mb-4">including VAT</small>
                            <a href="radiator.html" class="btn btn-secondary d-block mb-4">Next</a>
                            <a href="#" class="text-secondary d-flex align-items-center justify-content-center" data-bs-toggle="modal" data-bs-target="#save-quote"><i class="fa-solid fa-envelope me-2"></i> Save Quote</a>
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