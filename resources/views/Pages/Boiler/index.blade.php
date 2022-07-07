@extends('pages.layouts.master')

@section('title') Boiler @endsection

@section('container-css') pb-5 @endsection

@section('progress-bar')
<div class="progress-bar" role="progressbar" style="width: 20%" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100"></div>
@endsection

@php $completed_wizards = ['boiler'] @endphp

@section('content')
<div class="row justify-content-center">
            <div class="col-md-8">
                <h2 class="text-center mb-4">Select a new boiler</h2>
            </div>
</div>

<div class="select-boiler d-flex flex-wrap justify-content-center mb-5">
            <span class="select-boiler-item">
                <img src="{!! asset('assets/img/icon-bed.png') !!}" alt="Bed">
                <span class="text-primary text-small">2 Bed</span>
            </span>
            <span class="select-boiler-item">
                <img src="{!! asset('assets/img/icon-bath.png') !!}" alt="bath">
                <span class="text-primary text-small">1 Bath</span>
            </span>
            <span class="select-boiler-item">
                <img src="{!! asset('assets/img/icon-shower.png') !!}" alt="shower">
                <span class="text-primary text-small">1 Shower</span>
            </span>
            <span class="select-boiler-edit" data-bs-toggle="modal" data-bs-target="#edit-answer">
                <span>Edit Answer</span>
            </span>
        </div>

        <div class="filter_params d-flex flex-wrap justify-content-between mb-4">
            <div class="btn-group my-2">
                <button type="button" class="btn dropdown-toggle dropdown-toggle-split" data-bs-toggle="dropdown" aria-expanded="false">Select Manufacturer</button>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="#">Manufacturer 1</a></li>
                    <li><a class="dropdown-item" href="#">Manufacturer 2</a></li>
                </ul>
            </div>
            <div class="btn-group my-2">
                <button type="button" class="btn dropdown-toggle dropdown-toggle-split" data-bs-toggle="dropdown" aria-expanded="false">Sort by: <span>Recommended</span></button>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="#">Price: High To Low</a></li>
                    <li><a class="dropdown-item" href="#">Price: Low To High</a></li>
                    <li><a class="dropdown-item" href="#">Newest First</a></li>
                    <li><a class="dropdown-item" href="#">Oldest First</a></li>
                </ul>
            </div>
        </div>

        <div class="boiler-listing">
                            <div class="boiler-item">
                    <div class="boiler-img order-md-1 order-xl-1">
                        <img src="{!! asset('assets/img/boiler-select.jpg') !!}" alt="Boiler">
                    </div>
                    <div class="boiler-detail order-md-3 order-xl-2">
                        <div class="boiler-pro mb-3">
                            <span class="boiler-latest">
                                <img src="{!! asset('assets/img/boiler-icons/sun.jpg') !!}" alt="Latest">
                                Latest
                            </span>
                            <span class="boiler-popular">
                                <img src="{!! asset('assets/img/boiler-icons/star.jpg') !!}" alt="Popular">
                                Popular
                            </span>
                        </div>
                        <h3>Vaillant ecoFIT pure combi 25kw</h3>
                        <p class="text-small">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas fermentum lacus vitae urna auctor gravida. Curabitur eu lectus ac arcu vulputate.</p>
                        <a href="#" class="text-secondary d-block mb-4"><small>More Info</small></a>
                        <ul class="list-unstyled boiler-features">
                            <li class="boiler-feature mb-2">
                                <span class="boiler-feature-title">
                                    <img src="{!! asset('assets/img/boiler-icons/water-drop.png') !!}" alt="Water Flow">
                                    Hot water flow rate
                                </span>
                                <span class="boiler-feature-desc">
                                    10.4
                                    <span class="text-black-50">litres/min</span>
                                </span>
                            </li>
                            <li class="boiler-feature mb-2">
                                <span class="boiler-feature-title">
                                    <img src="{!! asset('assets/img/boiler-icons/fire.png') !!}" alt="KiloWats">
                                    Centrala heating output
                                </span>
                                <span class="boiler-feature-desc">
                                    25
                                    <span class="text-black-50">kilowatts</span>
                                </span>
                            </li>
                            <li class="boiler-feature mb-2">
                                <span class="boiler-feature-title">
                                    <img src="{!! asset('assets/img/boiler-icons/warranty.png') !!}" alt="Warranty">
                                    Warranty
                                </span>
                                <span class="boiler-feature-desc">
                                    10
                                    <span class="text-black-50">years</span>
                                </span>
                            </li>
                            <li class="boiler-feature mb-2">
                                <span class="boiler-feature-title">
                                    <img src="{!! asset('assets/img/boiler-icons/warranty.png') !!}" alt="Dimension">
                                    Dimension
                                    <span class="text-black-50">(WxDxH)</span>
                                </span>
                                <span class="boiler-feature-desc">
                                    700 x 390 x 295
                                    <span class="text-black-50">mm</span>
                                </span>
                            </li>
                        </ul>
                    </div>
                    <div class="boiler-pricing text-center order-md-2 order-xl-3">
                        <p class="m-0">
                            Your fix price including installation
                        </p>
                        <a href="#" class="text-secondary d-block mb-4">+ See everything included</a>
                        <h3>£2542.79</h3>
                        <h5 class="text-danger mb-3"><s>£2562.79</s></h5>
                        <a href="control.html" class="btn btn-secondary text-white w-100 mt-3 mb-4">Choose Boiler</a>
                        <a href="#" class="text-secondary d-flex align-items-center" data-bs-toggle="modal" data-bs-target="#save-quote"><i class="fa-solid fa-envelope me-2"></i> Save Quote</a>
                    </div>
                </div>
                            <div class="boiler-item">
                    <div class="boiler-img order-md-1 order-xl-1">
                        <img src="{!! asset('assets/img/boiler-select.jpg') !!}" alt="Boiler">
                    </div>
                    <div class="boiler-detail order-md-3 order-xl-2">
                        <div class="boiler-pro mb-3">
                            <span class="boiler-latest">
                                <img src="{!! asset('assets/img/boiler-icons/sun.jpg') !!}" alt="Latest">
                                Latest
                            </span>
                            <span class="boiler-popular">
                                <img src="{!! asset('assets/img/boiler-icons/star.jpg') !!}" alt="Popular">
                                Popular
                            </span>
                        </div>
                        <h3>Vaillant ecoFIT pure combi 25kw</h3>
                        <p class="text-small">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas fermentum lacus vitae urna auctor gravida. Curabitur eu lectus ac arcu vulputate.</p>
                        <a href="#" class="text-secondary d-block mb-4"><small>More Info</small></a>
                        <ul class="list-unstyled boiler-features">
                            <li class="boiler-feature mb-2">
                                <span class="boiler-feature-title">
                                    <img src="{!! asset('assets/img/boiler-icons/water-drop.png') !!}" alt="Water Flow">
                                    Hot water flow rate
                                </span>
                                <span class="boiler-feature-desc">
                                    10.4
                                    <span class="text-black-50">litres/min</span>
                                </span>
                            </li>
                            <li class="boiler-feature mb-2">
                                <span class="boiler-feature-title">
                                    <img src="{!! asset('assets/img/boiler-icons/fire.png') !!}" alt="KiloWats">
                                    Centrala heating output
                                </span>
                                <span class="boiler-feature-desc">
                                    25
                                    <span class="text-black-50">kilowatts</span>
                                </span>
                            </li>
                            <li class="boiler-feature mb-2">
                                <span class="boiler-feature-title">
                                    <img src="{!! asset('assets/img/boiler-icons/warranty.png') !!}" alt="Warranty">
                                    Warranty
                                </span>
                                <span class="boiler-feature-desc">
                                    10
                                    <span class="text-black-50">years</span>
                                </span>
                            </li>
                            <li class="boiler-feature mb-2">
                                <span class="boiler-feature-title">
                                    <img src="{!! asset('assets/img/boiler-icons/warranty.png') !!}" alt="Dimension">
                                    Dimension
                                    <span class="text-black-50">(WxDxH)</span>
                                </span>
                                <span class="boiler-feature-desc">
                                    700 x 390 x 295
                                    <span class="text-black-50">mm</span>
                                </span>
                            </li>
                        </ul>
                    </div>
                    <div class="boiler-pricing text-center order-md-2 order-xl-3">
                        <p class="m-0">
                            Your fix price including installation
                        </p>
                        <a href="#" class="text-secondary d-block mb-4">+ See everything included</a>
                        <h3>£2542.79</h3>
                        <h5 class="text-danger mb-3"><s>£2562.79</s></h5>
                        <a href="control.html" class="btn btn-secondary text-white w-100 mt-3 mb-4">Choose Boiler</a>
                        <a href="#" class="text-secondary d-flex align-items-center" data-bs-toggle="modal" data-bs-target="#save-quote"><i class="fa-solid fa-envelope me-2"></i> Save Quote</a>
                    </div>
                </div>
                            <div class="boiler-item">
                    <div class="boiler-img order-md-1 order-xl-1">
                        <img src="{!! asset('assets/img/boiler-select.jpg') !!}" alt="Boiler">
                    </div>
                    <div class="boiler-detail order-md-3 order-xl-2">
                        <div class="boiler-pro mb-3">
                            <span class="boiler-latest">
                                <img src="{!! asset('assets/img/boiler-icons/sun.jpg') !!}" alt="Latest">
                                Latest
                            </span>
                            <span class="boiler-popular">
                                <img src="{!! asset('assets/img/boiler-icons/star.jpg') !!}" alt="Popular">
                                Popular
                            </span>
                        </div>
                        <h3>Vaillant ecoFIT pure combi 25kw</h3>
                        <p class="text-small">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas fermentum lacus vitae urna auctor gravida. Curabitur eu lectus ac arcu vulputate.</p>
                        <a href="#" class="text-secondary d-block mb-4"><small>More Info</small></a>
                        <ul class="list-unstyled boiler-features">
                            <li class="boiler-feature mb-2">
                                <span class="boiler-feature-title">
                                    <img src="{!! asset('assets/img/boiler-icons/water-drop.png') !!}" alt="Water Flow">
                                    Hot water flow rate
                                </span>
                                <span class="boiler-feature-desc">
                                    10.4
                                    <span class="text-black-50">litres/min</span>
                                </span>
                            </li>
                            <li class="boiler-feature mb-2">
                                <span class="boiler-feature-title">
                                    <img src="{!! asset('assets/img/boiler-icons/fire.png') !!}" alt="KiloWats">
                                    Centrala heating output
                                </span>
                                <span class="boiler-feature-desc">
                                    25
                                    <span class="text-black-50">kilowatts</span>
                                </span>
                            </li>
                            <li class="boiler-feature mb-2">
                                <span class="boiler-feature-title">
                                    <img src="{!! asset('assets/img/boiler-icons/warranty.png') !!}" alt="Warranty">
                                    Warranty
                                </span>
                                <span class="boiler-feature-desc">
                                    10
                                    <span class="text-black-50">years</span>
                                </span>
                            </li>
                            <li class="boiler-feature mb-2">
                                <span class="boiler-feature-title">
                                    <img src="{!! asset('assets/img/boiler-icons/warranty.png') !!}" alt="Dimension">
                                    Dimension
                                    <span class="text-black-50">(WxDxH)</span>
                                </span>
                                <span class="boiler-feature-desc">
                                    700 x 390 x 295
                                    <span class="text-black-50">mm</span>
                                </span>
                            </li>
                        </ul>
                    </div>
                    <div class="boiler-pricing text-center order-md-2 order-xl-3">
                        <p class="m-0">
                            Your fix price including installation
                        </p>
                        <a href="#" class="text-secondary d-block mb-4">+ See everything included</a>
                        <h3>£2542.79</h3>
                        <h5 class="text-danger mb-3"><s>£2562.79</s></h5>
                        <a href="control.html" class="btn btn-secondary text-white w-100 mt-3 mb-4">Choose Boiler</a>
                        <a href="#" class="text-secondary d-flex align-items-center" data-bs-toggle="modal" data-bs-target="#save-quote"><i class="fa-solid fa-envelope me-2"></i> Save Quote</a>
                    </div>
                </div>
                            <div class="boiler-item">
                    <div class="boiler-img order-md-1 order-xl-1">
                        <img src="{!! asset('assets/img/boiler-select.jpg') !!}" alt="Boiler">
                    </div>
                    <div class="boiler-detail order-md-3 order-xl-2">
                        <div class="boiler-pro mb-3">
                            <span class="boiler-latest">
                                <img src="{!! asset('assets/img/boiler-icons/sun.jpg') !!}" alt="Latest">
                                Latest
                            </span>
                            <span class="boiler-popular">
                                <img src="{!! asset('assets/img/boiler-icons/star.jpg') !!}" alt="Popular">
                                Popular
                            </span>
                        </div>
                        <h3>Vaillant ecoFIT pure combi 25kw</h3>
                        <p class="text-small">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas fermentum lacus vitae urna auctor gravida. Curabitur eu lectus ac arcu vulputate.</p>
                        <a href="#" class="text-secondary d-block mb-4"><small>More Info</small></a>
                        <ul class="list-unstyled boiler-features">
                            <li class="boiler-feature mb-2">
                                <span class="boiler-feature-title">
                                    <img src="{!! asset('assets/img/boiler-icons/water-drop.png') !!}" alt="Water Flow">
                                    Hot water flow rate
                                </span>
                                <span class="boiler-feature-desc">
                                    10.4
                                    <span class="text-black-50">litres/min</span>
                                </span>
                            </li>
                            <li class="boiler-feature mb-2">
                                <span class="boiler-feature-title">
                                    <img src="{!! asset('assets/img/boiler-icons/fire.png') !!}" alt="KiloWats">
                                    Centrala heating output
                                </span>
                                <span class="boiler-feature-desc">
                                    25
                                    <span class="text-black-50">kilowatts</span>
                                </span>
                            </li>
                            <li class="boiler-feature mb-2">
                                <span class="boiler-feature-title">
                                    <img src="{!! asset('assets/img/boiler-icons/warranty.png') !!}" alt="Warranty">
                                    Warranty
                                </span>
                                <span class="boiler-feature-desc">
                                    10
                                    <span class="text-black-50">years</span>
                                </span>
                            </li>
                            <li class="boiler-feature mb-2">
                                <span class="boiler-feature-title">
                                    <img src="{!! asset('assets/img/boiler-icons/warranty.png') !!}" alt="Dimension">
                                    Dimension
                                    <span class="text-black-50">(WxDxH)</span>
                                </span>
                                <span class="boiler-feature-desc">
                                    700 x 390 x 295
                                    <span class="text-black-50">mm</span>
                                </span>
                            </li>
                        </ul>
                    </div>
                    <div class="boiler-pricing text-center order-md-2 order-xl-3">
                        <p class="m-0">
                            Your fix price including installation
                        </p>
                        <a href="#" class="text-secondary d-block mb-4">+ See everything included</a>
                        <h3>£2542.79</h3>
                        <h5 class="text-danger mb-3"><s>£2562.79</s></h5>
                        <a href="control.html" class="btn btn-secondary text-white w-100 mt-3 mb-4">Choose Boiler</a>
                        <a href="#" class="text-secondary d-flex align-items-center" data-bs-toggle="modal" data-bs-target="#save-quote"><i class="fa-solid fa-envelope me-2"></i> Save Quote</a>
                    </div>
                </div>
                            <div class="boiler-item">
                    <div class="boiler-img order-md-1 order-xl-1">
                        <img src="{!! asset('assets/img/boiler-select.jpg') !!}" alt="Boiler">
                    </div>
                    <div class="boiler-detail order-md-3 order-xl-2">
                        <div class="boiler-pro mb-3">
                            <span class="boiler-latest">
                                <img src="{!! asset('assets/img/boiler-icons/sun.jpg') !!}" alt="Latest">
                                Latest
                            </span>
                            <span class="boiler-popular">
                                <img src="{!! asset('assets/img/boiler-icons/star.jpg') !!}" alt="Popular">
                                Popular
                            </span>
                        </div>
                        <h3>Vaillant ecoFIT pure combi 25kw</h3>
                        <p class="text-small">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas fermentum lacus vitae urna auctor gravida. Curabitur eu lectus ac arcu vulputate.</p>
                        <a href="#" class="text-secondary d-block mb-4"><small>More Info</small></a>
                        <ul class="list-unstyled boiler-features">
                            <li class="boiler-feature mb-2">
                                <span class="boiler-feature-title">
                                    <img src="{!! asset('assets/img/boiler-icons/water-drop.png') !!}" alt="Water Flow">
                                    Hot water flow rate
                                </span>
                                <span class="boiler-feature-desc">
                                    10.4
                                    <span class="text-black-50">litres/min</span>
                                </span>
                            </li>
                            <li class="boiler-feature mb-2">
                                <span class="boiler-feature-title">
                                    <img src="{!! asset('assets/img/boiler-icons/fire.png') !!}" alt="KiloWats">
                                    Centrala heating output
                                </span>
                                <span class="boiler-feature-desc">
                                    25
                                    <span class="text-black-50">kilowatts</span>
                                </span>
                            </li>
                            <li class="boiler-feature mb-2">
                                <span class="boiler-feature-title">
                                    <img src="{!! asset('assets/img/boiler-icons/warranty.png') !!}" alt="Warranty">
                                    Warranty
                                </span>
                                <span class="boiler-feature-desc">
                                    10
                                    <span class="text-black-50">years</span>
                                </span>
                            </li>
                            <li class="boiler-feature mb-2">
                                <span class="boiler-feature-title">
                                    <img src="{!! asset('assets/img/boiler-icons/warranty.png') !!}" alt="Dimension">
                                    Dimension
                                    <span class="text-black-50">(WxDxH)</span>
                                </span>
                                <span class="boiler-feature-desc">
                                    700 x 390 x 295
                                    <span class="text-black-50">mm</span>
                                </span>
                            </li>
                        </ul>
                    </div>
                    <div class="boiler-pricing text-center order-md-2 order-xl-3">
                        <p class="m-0">
                            Your fix price including installation
                        </p>
                        <a href="#" class="text-secondary d-block mb-4">+ See everything included</a>
                        <h3>£2542.79</h3>
                        <h5 class="text-danger mb-3"><s>£2562.79</s></h5>
                        <a href="control.html" class="btn btn-secondary text-white w-100 mt-3 mb-4">Choose Boiler</a>
                        <a href="#" class="text-secondary d-flex align-items-center" data-bs-toggle="modal" data-bs-target="#save-quote"><i class="fa-solid fa-envelope me-2"></i> Save Quote</a>
                    </div>
                </div>
                            <div class="boiler-item">
                    <div class="boiler-img order-md-1 order-xl-1">
                        <img src="{!! asset('assets/img/boiler-select.jpg') !!}" alt="Boiler">
                    </div>
                    <div class="boiler-detail order-md-3 order-xl-2">
                        <div class="boiler-pro mb-3">
                            <span class="boiler-latest">
                                <img src="{!! asset('assets/img/boiler-icons/sun.jpg') !!}" alt="Latest">
                                Latest
                            </span>
                            <span class="boiler-popular">
                                <img src="{!! asset('assets/img/boiler-icons/star.jpg') !!}" alt="Popular">
                                Popular
                            </span>
                        </div>
                        <h3>Vaillant ecoFIT pure combi 25kw</h3>
                        <p class="text-small">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas fermentum lacus vitae urna auctor gravida. Curabitur eu lectus ac arcu vulputate.</p>
                        <a href="#" class="text-secondary d-block mb-4"><small>More Info</small></a>
                        <ul class="list-unstyled boiler-features">
                            <li class="boiler-feature mb-2">
                                <span class="boiler-feature-title">
                                    <img src="{!! asset('assets/img/boiler-icons/water-drop.png') !!}" alt="Water Flow">
                                    Hot water flow rate
                                </span>
                                <span class="boiler-feature-desc">
                                    10.4
                                    <span class="text-black-50">litres/min</span>
                                </span>
                            </li>
                            <li class="boiler-feature mb-2">
                                <span class="boiler-feature-title">
                                    <img src="{!! asset('assets/img/boiler-icons/fire.png') !!}" alt="KiloWats">
                                    Centrala heating output
                                </span>
                                <span class="boiler-feature-desc">
                                    25
                                    <span class="text-black-50">kilowatts</span>
                                </span>
                            </li>
                            <li class="boiler-feature mb-2">
                                <span class="boiler-feature-title">
                                    <img src="{!! asset('assets/img/boiler-icons/warranty.png') !!}" alt="Warranty">
                                    Warranty
                                </span>
                                <span class="boiler-feature-desc">
                                    10
                                    <span class="text-black-50">years</span>
                                </span>
                            </li>
                            <li class="boiler-feature mb-2">
                                <span class="boiler-feature-title">
                                    <img src="{!! asset('assets/img/boiler-icons/warranty.png') !!}" alt="Dimension">
                                    Dimension
                                    <span class="text-black-50">(WxDxH)</span>
                                </span>
                                <span class="boiler-feature-desc">
                                    700 x 390 x 295
                                    <span class="text-black-50">mm</span>
                                </span>
                            </li>
                        </ul>
                    </div>
                    <div class="boiler-pricing text-center order-md-2 order-xl-3">
                        <p class="m-0">
                            Your fix price including installation
                        </p>
                        <a href="#" class="text-secondary d-block mb-4">+ See everything included</a>
                        <h3>£2542.79</h3>
                        <h5 class="text-danger mb-3"><s>£2562.79</s></h5>
                        <a href="control.html" class="btn btn-secondary text-white w-100 mt-3 mb-4">Choose Boiler</a>
                        <a href="#" class="text-secondary d-flex align-items-center" data-bs-toggle="modal" data-bs-target="#save-quote"><i class="fa-solid fa-envelope me-2"></i> Save Quote</a>
                    </div>
                </div>
                            <div class="boiler-item">
                    <div class="boiler-img order-md-1 order-xl-1">
                        <img src="{!! asset('assets/img/boiler-select.jpg') !!}" alt="Boiler">
                    </div>
                    <div class="boiler-detail order-md-3 order-xl-2">
                        <div class="boiler-pro mb-3">
                            <span class="boiler-latest">
                                <img src="{!! asset('assets/img/boiler-icons/sun.jpg') !!}" alt="Latest">
                                Latest
                            </span>
                            <span class="boiler-popular">
                                <img src="{!! asset('assets/img/boiler-icons/star.jpg') !!}" alt="Popular">
                                Popular
                            </span>
                        </div>
                        <h3>Vaillant ecoFIT pure combi 25kw</h3>
                        <p class="text-small">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas fermentum lacus vitae urna auctor gravida. Curabitur eu lectus ac arcu vulputate.</p>
                        <a href="#" class="text-secondary d-block mb-4"><small>More Info</small></a>
                        <ul class="list-unstyled boiler-features">
                            <li class="boiler-feature mb-2">
                                <span class="boiler-feature-title">
                                    <img src="{!! asset('assets/img/boiler-icons/water-drop.png') !!}" alt="Water Flow">
                                    Hot water flow rate
                                </span>
                                <span class="boiler-feature-desc">
                                    10.4
                                    <span class="text-black-50">litres/min</span>
                                </span>
                            </li>
                            <li class="boiler-feature mb-2">
                                <span class="boiler-feature-title">
                                    <img src="{!! asset('assets/img/boiler-icons/fire.png') !!}" alt="KiloWats">
                                    Centrala heating output
                                </span>
                                <span class="boiler-feature-desc">
                                    25
                                    <span class="text-black-50">kilowatts</span>
                                </span>
                            </li>
                            <li class="boiler-feature mb-2">
                                <span class="boiler-feature-title">
                                    <img src="{!! asset('assets/img/boiler-icons/warranty.png') !!}" alt="Warranty">
                                    Warranty
                                </span>
                                <span class="boiler-feature-desc">
                                    10
                                    <span class="text-black-50">years</span>
                                </span>
                            </li>
                            <li class="boiler-feature mb-2">
                                <span class="boiler-feature-title">
                                    <img src="{!! asset('assets/img/boiler-icons/warranty.png') !!}" alt="Dimension">
                                    Dimension
                                    <span class="text-black-50">(WxDxH)</span>
                                </span>
                                <span class="boiler-feature-desc">
                                    700 x 390 x 295
                                    <span class="text-black-50">mm</span>
                                </span>
                            </li>
                        </ul>
                    </div>
                    <div class="boiler-pricing text-center order-md-2 order-xl-3">
                        <p class="m-0">
                            Your fix price including installation
                        </p>
                        <a href="#" class="text-secondary d-block mb-4">+ See everything included</a>
                        <h3>£2542.79</h3>
                        <h5 class="text-danger mb-3"><s>£2562.79</s></h5>
                        <a href="control.html" class="btn btn-secondary text-white w-100 mt-3 mb-4">Choose Boiler</a>
                        <a href="#" class="text-secondary d-flex align-items-center" data-bs-toggle="modal" data-bs-target="#save-quote"><i class="fa-solid fa-envelope me-2"></i> Save Quote</a>
                    </div>
                </div>
</div>
@endsection
