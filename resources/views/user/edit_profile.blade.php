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
            @include('includes.user_dashboard_menu')

            <div class="col-md-9 col-sm-8">
                @include('includes.dashboard_content_header')
              
                        <div class="userccount">
                            <div class="formpanel mt0"> @include('flash::message') 
                                <!-- Personal Information -->
                                @include('user.inc.profile')                              
                            </div>
                        </div>
						
						<div class="userccount">
                            <div class="formpanel mt0">
                                @include('user.inc.summary')                                
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
@push('scripts')
@include('includes.immediate_available_btn')

<script>
    $(document).on('click', '.btn-close', function() {
        $('.modal').css('display','none');
        $('.modal-backdrop').remove();
        $('.modal').removeAttr('style');
        $('body').removeClass('modal-open');
        $('.modal-backdrop').remove();
        $('body').removeAttr('style');    
    });
</script>

@endpush