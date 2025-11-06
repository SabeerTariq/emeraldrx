@extends('layouts.app')
@section('content') 
<!-- Header start --> 
@php
$isDashboardPage = (Auth::check() || Auth::guard('company')->check());
@endphp
@if($isDashboardPage === false)
@include('includes.header') 
@endif
<!-- Header end --> 
<div class="listpgWraper">
    <div class="container">
        <div class="row">
            @include('includes.company_dashboard_menu')

            <div class="col-md-9 col-sm-8">
                @include('includes.dashboard_content_header') 
                <div class="row">
                    <div class="col-md-12">
                        <div class="userccount">
                            <div class="formpanel mt-0"> @include('flash::message') 
                                <!-- Personal Information -->
                                @include('job.inc.job')
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@if($isDashboardPage === false)
@include('includes.footer')
@endif
@endsection
@push('styles')
<style type="text/css">
    .userccount p{ text-align:left !important;}
</style>
@endpush