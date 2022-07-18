<!DOCTYPE html>
<html lang="en">

@include('pages.layouts.partials._links')

<body class="bg-s-light">
<div class="navbar-grad gasking-header">

    @include('pages.layouts.partials._header')

    @include('pages.layouts.partials._nav')

</div>

<div class="main-container mt-4r">
    <div class="gasking-title-top">
        <div class="container">
            <div class="gasking-title-container d-lg-flex align-items-center justify-content-md-between">
                <div class="gasking-title">
                    <h1 class="text-secondary">New Boiler</h1>
                    <p class="text-white mb-4 mb-lg-0">New Boiler Installations in London and the surrounding area </p>
                </div>
                <div class="gasking-btn-container d-sm-flex">
                    <a href="#" class="btn btn-outline-secondary text-white px-2 px-sm-4 my-2 m-sm-2 d-flex justify-content-center  align-items-center" data-bs-toggle="modal" data-bs-target="#see-everything">
                        <i class="fa-solid fa-plus me-2"></i>
                        See everything included
                    </a>
                    <a href="{!! route('page.index') !!}" class="btn btn-secondary text-white px-2 px-sm-4 my-2 m-sm-2 d-flex justify-content-center  align-items-center">
                        <i class="fa-solid fa-arrow-rotate-right me-2"></i>
                        Restart
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="container @yield('container-css')">

        @include('pages.layouts.partials._menu')

        @yield('content')

        <div class="loader">
            <img src="{!! asset('assets/img/loader.svg') !!}" style="display">        
        </div> 
           
    </div>

@include('pages.layouts.partials._footer')

<div class="modal fade" id="save-quote" tabindex="-1" aria-labelledby="save-quoteLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body p-4 p-lg-5">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                <div class="row justify-content-center">
                    <div class="col-lg-8 col-md-10 text-center">
                        <h2 class="modal-title mb-4" id="save-quoteLabel">Save Your Quote</h2>
                        <p class="mb-5">Maecenas consequat felis nisi, in ullamcorper tortor viverra quis. Sed gravida diam ullamcorper purus vulputate accumsan. </p>
                    </div>
                </div>
                <div class="row justify-content-center">
                    <div class="col-lg-6 col-md-10">
                        <form action="#">
                            <div class="mb-4">
                                <label for="email-quota" class="form-label ps-4">Email address</label>
                                <input type="text" class="form-control" id="email-quota" placeholder="Email address">
                            </div>
                            <div class="mb-4">
                                <label for="contact-quota" class="form-label ps-4">Contact number</label>
                                <input type="text" class="form-control" id="contact-quota" placeholder="Contact number">
                            </div>
                            <div class="form-check mb-5">
                                <input class="form-check-input" type="radio" name="flexRadioDefault" id="agree-quota">
                                <label class="form-check-label" for="agree-quota">
                                    <small>I’m happy to...Fusce eget leo at lacus blandit luctus. Donec lacus libero, ultrices sed molestie sed, elementum nec sem. Phasellus dapibus molestie massa id mattis. Fusce in ligula augue. Donec euismod nibh ac lacinia consectetur.</small>
                                    <a href="#" class="text-secondary"><small>Privacy Policy</small></a>
                                </label>
                            </div>
                            <button class="btn btn-secondary w-100">Save Quote</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="see-everything" tabindex="-1" aria-labelledby="see-everythingLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body p-4 p-lg-5">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                <div class="row justify-content-center">
                    <div class="col-lg-8 col-md-10 text-center">
                        <h2 class="modal-title mb-4" id="see-everythingLabel">Included in your fixed price</h2>
                        <p class="mb-5">We include everything needed to make your installation hassle-free and your heating system run like a dream.</p>
                    </div>
                </div>
                <div class="row justify-content-center">
                    <div class="col-lg-8 col-md-10">
                        <div class="accordion" id="faqAccordian">
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="headingOne">
                                    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                    Boiler & pipework installation, including any alterations and upgrades</button>
                                </h2>
                                <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#faqAccordian">
                                    <div class="accordion-body pb-4">
                                        We'll install your new boiler and won't leave until it's working and tested. We know every job is different so we include all pipework alterations to accommodate your new boiler within your fixed price. We will also install your condensate pipe, and upgrade the pipe from your gas meter to boiler, if required.
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="headingTwo">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                        Removal and safe disposal of your old boiler
                                    </button>
                                </h2>
                                <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#faqAccordian">
                                    <div class="accordion-body pb-4">
                                        We'll install your new boiler and won't leave until it's working and tested. We know every job is different so we include all pipework alterations to accommodate your new boiler within your fixed price. We will also install your condensate pipe, and upgrade the pipe from your gas meter to boiler, if required.
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="headingThree">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                        Removal of old tanks & reconfiguring pipework for a combi boiler
                                    </button>
                                </h2>
                                <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#faqAccordian">
                                    <div class="accordion-body pb-4">
                                        We'll install your new boiler and won't leave until it's working and tested. We know every job is different so we include all pipework alterations to accommodate your new boiler within your fixed price. We will also install your condensate pipe, and upgrade the pipe from your gas meter to boiler, if required.
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@include('pages.layouts.partials._scripts')

</body>
</html>
