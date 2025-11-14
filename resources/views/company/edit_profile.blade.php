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
                
                        
                                @include('flash::message') 
                                <!-- Personal Information -->
                                @include('company.inc.profile')
                           
                   
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