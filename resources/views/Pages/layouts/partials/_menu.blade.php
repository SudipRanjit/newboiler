@php $route_name = Route::currentRouteName() @endphp
<div class="wizard-container py-sm-2">
            <ul class="wizard-list list-unstyled d-flex justify-content-md-center align-items-center">
                <li>
                    <a href="{!! route('page.boiler') !!}" class="nav-link {{ $route_name=='page.boiler'?'wizard-active':'' }} {{ in_array('boiler',$completed_wizards)?'wizard-complete':'' }}">
                        Boiler
                    </a>
                </li>
                <li>
                    <a href="{!! route('page.control') !!}" class="nav-link {{ $route_name=='page.control'?'wizard-active':'' }} {{ in_array('control',$completed_wizards)?'wizard-complete':'' }}">
                        Control
                    </a>
                </li>
                <li>
                    <a href="{!! route('page.radiator') !!}" class="nav-link {{ $route_name=='page.radiator'?'wizard-active':'' }} {{ in_array('radiator',$completed_wizards)?'wizard-complete':'' }}">
                        Radiators
                    </a>
                </li>
                <li>
                    <a href="{!! route('page.smart-device') !!}" class="nav-link {{ $route_name=='page.smart-device'?'wizard-active':'' }} {{ in_array('smart-device',$completed_wizards)?'wizard-complete':'' }}">
                        Smart Device
                    </a>
                </li>
                <li>
                    <a href="{!! route('page.booking') !!}" class="nav-link {{ $route_name=='page.booking'?'wizard-active':'' }} ">
                        Booking
                    </a>
                </li>
            </ul>
            <div class="progress mb-5">
                @yield('progress-bar')
            </div>
        </div>