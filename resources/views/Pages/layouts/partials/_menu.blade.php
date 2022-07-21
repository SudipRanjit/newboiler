@php $route_name = Route::currentRouteName() @endphp
<div class="wizard-container py-sm-2">
            <ul class="wizard-list list-unstyled d-flex justify-content-md-center align-items-center">
                <li>
                    <a href="{!! route('page.boilers') !!}" class="nav-link {{ in_array($route_name,['page.boilers','page.boiler'])?'wizard-active':'' }} {{ in_array('boilers',$completed_wizards)?'wizard-complete':'' }}">
                        Boiler
                    </a>
                </li>
                <li>
                    <a href="{!! route('page.controls') !!}" class="nav-link {{ $route_name=='page.controls'?'wizard-active':'' }} {{ in_array('controls',$completed_wizards)?'wizard-complete':'' }}">
                        Control
                    </a>
                </li>
                <li>
                    <a href="{!! route('page.radiators') !!}" class="nav-link {{ $route_name=='page.radiators'?'wizard-active':'' }} {{ in_array('radiators',$completed_wizards)?'wizard-complete':'' }}">
                        Radiators
                    </a>
                </li>
                <li>
                    <a href="{!! route('page.smart-devices') !!}" class="nav-link {{ $route_name=='page.smart-devices'?'wizard-active':'' }} {{ in_array('smart-devices',$completed_wizards)?'wizard-complete':'' }}">
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