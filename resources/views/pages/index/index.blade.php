@extends('pages.layouts.master')

@section('progress-bar')
<div class="progress-bar" role="progressbar" style="width: 10%" aria-valuenow="10" aria-valuemin="0" aria-valuemax="100"></div>
@endsection

@php $completed_wizards = [] @endphp

@section('content')
<div class="row justify-content-center" style="display: none">
            <div class="col-md-8">
                <h2 class="text-center">Currently, what kind of boiler do you have?</h2>
                <p class="text-center text-black-light mb-5">How to find out?</p>
            </div>
        <div class="row justify-content-center mb-5">
            <div class="col-lg-3 col-md-4">
                <div class="card-questionaire text-center">
                    <div class="questionaire-img">
                        <img src="{!! asset('assets/img/combi.jpg') !!}" alt="Combi" class="img-fluid mb-2">
                        <h4>Combi</h4>
                    </div>
                    <div class="questionaire-detail">
                        <p class="p-4">If you have a hot water storage cylinder but no cold water tank in the loft, you're likely to have a System boiler. The boiler will normally have a pressure gauge on the assets of it.</p>
                        <a href="boiler.html" class="btn btn-secondary text-white">Select</a>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-4">
                <div class="card-questionaire text-center">
                    <div class="questionaire-img">
                        <img src="{!! asset('assets/img/system.jpg') !!}" alt="System" class="img-fluid mb-2">
                        <h4>System</h4>
                    </div>
                    <div class="questionaire-detail">
                        <p class="p-4">If you have a hot water storage cylinder but no cold water tank in the loft, you're likely to have a System boiler. The boiler will normally have a pressure gauge on the assets of it.</p>
                        <a href="boiler.html" class="btn btn-secondary text-white">Select</a>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-4">
                <div class="card-questionaire text-center">
                    <div class="questionaire-img">
                        <img src="{!! asset('assets/img/standard.jpg') !!}" alt="Standard" class="img-fluid mb-2">
                        <h4>Standard</h4>
                    </div>
                    <div class="questionaire-detail">
                        <p class="p-4">If you have a hot water storage cylinder but no cold water tank in the loft, you're likely to have a System boiler. The boiler will normally have a pressure gauge on the assets of it.</p>
                        <a href="boiler.html" class="btn btn-secondary text-white">Select</a>
                    </div>
                </div>
            </div>
        </div>
</div>

@include ('pages.questions.include-questions')

@endsection

