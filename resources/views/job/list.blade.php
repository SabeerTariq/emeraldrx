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

@include('flash::message')

@if($isDashboardPage === false)
@include('includes.inner_top_search')
@endif

<!-- Inner Page Title end -->

<div class="listpgWraper">

    <div class="container">

        @if($isDashboardPage)
        <div class="row">
            @include('includes.user_dashboard_menu')
            <div class="col-lg-9 dashboard-content">
                @include('includes.dashboard_content_header')
                
                <!-- Advanced Search Bar for Dashboard -->
                <div class="dashboard-advanced-search mb-4">
                    <form action="{{route('job.list')}}" method="get" id="dashboard-job-search-form">
                        <div class="search-form-wrapper">
                            <div class="row g-2">
                                <div class="col-md-4">
                                    <input type="text" name="search" id="jbsearch" value="{{Request::get('search', '')}}" class="form-control" placeholder="{{__('Enter Skills or job title')}}" autocomplete="off" />
                                </div>
                                <div class="col-md-3">
                                    {!! Form::select('functional_area_id[]', ['' => __('Select Functional Area')]+$functionalAreas, Request::get('functional_area_id', null), array('class'=>'form-control', 'id'=>'functional_area_id')) !!}
                                </div>
                                <div class="col-md-2">
                                    {!! Form::select('country_id[]', ['' => __('Select Country')]+$countries, Request::get('country_id', null), array('class'=>'form-control', 'id'=>'country_id')) !!}
                                </div>
                                <div class="col-md-2">
                                    <span id="state_dd">
                                        {!! Form::select('state_id[]', ['' => __('Select State')], Request::get('state_id', null), array('class'=>'form-control', 'id'=>'state_id')) !!}
                                    </span>
                                </div>
                                <div class="col-md-1">
                                    <button type="submit" class="btn btn-primary w-100"><i class="fas fa-search"></i></button>
                                </div>
                            </div>
                            <div class="row g-2 mt-2" id="showAdvanceSearchRow" style="display: none;">
                                <div class="col-md-3">
                                    <span id="city_dd">
                                        {!! Form::select('city_id[]', ['' => __('Select City')], Request::get('city_id', null), array('class'=>'form-control', 'id'=>'city_id')) !!}
                                    </span>
                                </div>
                                <div class="col-md-3">
                                    {!! Form::select('job_type_id[]', ['' => __('Select Job Type')]+$jobTypes, Request::get('job_type_id', null), array('class'=>'form-control', 'id'=>'job_type_id')) !!}
                                </div>
                                <div class="col-md-3">
                                    {!! Form::select('job_experience_id[]', ['' => __('Select Experience')]+$jobExperiences, Request::get('job_experience_id', null), array('class'=>'form-control', 'id'=>'job_experience_id')) !!}
                                </div>
                                <div class="col-md-3">
                                    {!! Form::select('salary_currency', ['' => __('Select Currency')]+$currencies, Request::get('salary_currency', ''), array('class'=>'form-control', 'id'=>'salary_currency')) !!}
                                </div>
                            </div>
                            <div class="row mt-2">
                                <div class="col-12">
                                    <a href="javascript:void(0);" id="advSearch" onclick="showAdvanceSearch()" class="text-primary">
                                        <i class="fas fa-filter"></i> {{__('Advanced Search')}}
                                    </a>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
        @endif

        <form action="{{route('job.list')}}" method="get" @if($isDashboardPage) style="display: none;" @endif>

            <!-- Search Result and sidebar start -->

            <div class="row"> 

                @if($isDashboardPage === false)
                @include('includes.job_list_side_bar')
                @endif

                <div class="{{ $isDashboardPage ? 'col-12' : 'col-lg-9' }}">

                    <!-- TEST OUTPUT - Should always show -->
                    <div style="background: yellow; padding: 20px; margin: 20px 0; border: 2px solid red;">
                        <strong>TEST: Page is loading!</strong><br>
                        Jobs variable exists: {{ isset($jobs) ? 'YES' : 'NO' }}<br>
                        @if(isset($jobs))
                        Jobs Total: {{ $jobs->total() }}<br>
                        Jobs Count: {{ $jobs->count() }}<br>
                        @endif
                    </div>

                    <!-- Search List -->
                     <h3>{{ isset($jobs) ? $jobs->total() : 0 }} Jobs Found</h3>    
                    <div class="topstatinfo mb-0">
                    @if(isset($jobs) && $jobs->total() > 0)
                    {{__('Showing Jobs')}} : {{ $jobs->firstItem() ?? 0 }} - {{ $jobs->lastItem() ?? 0 }} {{__('Total')}} {{ $jobs->total() }}
                    @else
                    {{__('No jobs available')}}
                    @endif
                    </div>

                    <!-- Debug Info -->
                    @if(config('app.debug'))
                    <div class="alert alert-info">
                        <strong>Debug Info:</strong><br>
                        Jobs Total: {{ $jobs->total() }}<br>
                        Jobs Count: {{ $jobs->count() }}<br>
                        Jobs isset: {{ isset($jobs) ? 'Yes' : 'No' }}<br>
                        First Item: {{ $jobs->firstItem() ?? 'N/A' }}<br>
                        Last Item: {{ $jobs->lastItem() ?? 'N/A' }}
                    </div>
                    @endif

                    <ul class="featuredlist row">

                        <!-- job start --> 

                        @if(isset($jobs) && $jobs->count() > 0) <?php $count_1 = 1; $jobs_without_company = 0; $jobs_with_inactive_company = 0; $jobs_displayed = 0; ?> 
                        @foreach($jobs as $job) 
                        @php 
                        $company = $job->company; // Use relationship directly
                        if(!$company) { 
                            $jobs_without_company++; 
                            \Log::info("Job {$job->id}: Company is NULL");
                        } else {
                            if($company->is_active != 1) { 
                                $jobs_with_inactive_company++; 
                                \Log::info("Job {$job->id}: Company {$company->id} is inactive");
                            }
                        }
                        @endphp

                             <?php 
                             // Debug output for each job
                             if(config('app.debug')) {
                                 echo "<!-- Job {$job->id}: Company=" . ($company ? $company->id : 'NULL') . ", Active=" . ($company ? ($company->is_active ? 'Yes' : 'No') : 'N/A') . " -->";
                             }
                             
                             if($company && $company->is_active == 1)
                            {
                                $jobs_displayed++;
                            ?>

                            <?php if($count_1 == 7) {?>

                                <li class="col-lg-12"><div class="jobint text-center">{!! $siteSetting->listing_page_horizontal_ad !!}</div></li>

                            <?php }else{ ?>

                          
                                


              <li class="col-lg-4 col-md-6 @if($job->is_featured == 1) featured @endif">
                <div class="jobint">
                @if($job->is_featured == 1) <span class="promotepof-badge"><i class="fa fa-bolt" title="{{__('This Job is Featured')}}"></i></span> @endif
                


                    <div class="d-flex">
                        <div class="fticon"><i class="fas fa-briefcase"></i> {{$job->getJobType('job_type')}}</div>                        
                    </div>

                    <h4><a href="{{route('job.detail', [$job->slug])}}" title="{{$job->title}}">{!! \Illuminate\Support\Str::limit($job->title, $limit = 20, $end = '...') !!}</a>
                    
                    
                </h4>
                @if(!(bool)$job->hide_salary)                    
                    <div class="salary mb-2">Salary: <strong>{{$job->salary_currency.''.$job->salary_from}} - {{$job->salary_currency.''.$job->salary_to}}/{{$job->getSalaryPeriod('salary_period')}}</strong></div>
                    @endif 


                    <strong><i class="fas fa-map-marker-alt"></i> {{$job->getCity('city')}}</strong> 
                    
                    <div class="jobcompany">
                     <div class="ftjobcomp">
                        <span>{{$job->created_at->format('M d, Y')}}</span>
                        <a href="{{route('company.detail', $company->slug)}}" title="{{$company->name}}">{{$company->name}}</a>
                     </div>
                    <a href="{{route('company.detail', $company->slug)}}" class="company-logo" title="{{$company->name}}">{{$company->printCompanyImage()}} </a>
                    </div>
                </div>
            </li>







						 <?php } ?>

                            <?php $count_1++; ?>

						

						 <?php } ?>

                        <!-- job end --> 

                        @endforeach
                        @if(config('app.debug'))
                        <li class="col-12">
                            <div style="background: #fff3cd; padding: 15px; margin: 20px 0; border: 1px solid #ffc107;">
                                <strong>Debug Summary:</strong><br>
                                Jobs in loop: {{ isset($jobs) ? $jobs->count() : 0 }}<br>
                                Jobs displayed: {{ isset($jobs_displayed) ? $jobs_displayed : 0 }}<br>
                                Jobs without company: {{ isset($jobs_without_company) ? $jobs_without_company : 0 }}<br>
                                Jobs with inactive company: {{ isset($jobs_with_inactive_company) ? $jobs_with_inactive_company : 0 }}
                            </div>
                        </li>
                        @endif
                        @else
                        <li class="col-12">
                            <div class="alert alert-info text-center" style="padding: 40px;">
                                <i class="fas fa-info-circle" style="font-size: 48px; margin-bottom: 20px; color: #27bcbb;"></i>
                                <h4>{{__('No Jobs Found')}}</h4>
                                <p>{{__('We couldn\'t find any jobs matching your criteria. Try adjusting your search filters.')}}</p>
                                @if(config('app.debug'))
                                <p><small>Debug: Jobs isset: {{ isset($jobs) ? 'Yes' : 'No' }}, Jobs count: {{ isset($jobs) ? $jobs->count() : 'N/A' }}</small></p>
                                @endif
                            </div>
                        </li>
                        @endif

						

						

						

                           

                       

                            <!-- job end -->

                            

						

						

						

                    </ul>



                    <!-- Pagination Start -->

                    <div class="pagiWrap mt-5">

                        <div class="row">

                            <div class="col-lg-5">

                                <div class="showreslt">

                                    {{__('Showing Jobs')}} : {{ $jobs->firstItem() }} - {{ $jobs->lastItem() }} {{__('Total')}} {{ $jobs->total() }}

                                </div>

                            </div>

                            <div class="col-lg-7 text-right">

                                @if(isset($jobs) && $jobs->count() > 0)

                                {{ $jobs->appends(request()->query())->links() }}

                                @endif

                            </div>

                        </div>

                    </div>

                    <!-- Pagination end --> 

                   



                </div>

            </div>

        </form>

        @if($isDashboardPage)
            </div>
        </div>
        @endif

    </div>

</div>




@if($isDashboardPage === false)
@include('includes.footer')
@endif

@endsection

@push('styles')

<style type="text/css">

    .searchList li .jobimg {

        min-height: 80px;

    }

    .hide_vm_ul{

        height:100px;

        overflow:hidden;

    }

    .hide_vm{

        display:none !important;

    }

    .view_more{

        cursor:pointer;

    }

</style>

@endpush

@push('scripts') 

<script>

$(document).ready(function($) {
	$("#search-job-list").submit(function() {
		$(this).find(":input").filter(function() {
			return !this.value;
		}).attr("disabled", "disabled");
		return true;
	});


	$("#search-job-list").find(":input").prop("disabled", false);

	$(".view_more_ul").each(function () {
    if ($(this).height() > 100) {
        $(this).addClass("hide_vm_ul");
        $(this).next(".view_more").removeClass("hide_vm");
    }
});

// "View More" click event
$(".view_more").on("click", function (e) {
    e.preventDefault();
    $(this).prev(".view_more_ul").removeClass("hide_vm_ul");
    $(this).addClass("hide_vm");
    $(this).next(".view_less").removeClass("hide_vm");
});

// "View Less" click event
$(".view_less").on("click", function (e) {
    e.preventDefault();
    $(this).prev(".view_more").removeClass("hide_vm");
    $(this).prevAll(".view_more_ul").addClass("hide_vm_ul");
    $(this).addClass("hide_vm");
});

});


$(document).on('click', '.swal-button--Login', function() {
	window.location.href = "{{route('login')}}";
})
$(document).on('click', '.swal-button--register', function() {
	window.location.href = "{{route('register')}}";
})

</script>

@include('includes.country_state_city_js')

@if($isDashboardPage)
<script>
function showAdvanceSearch(){
    $("#showAdvanceSearchRow").slideToggle();
    if($("#advSearch").text().includes("{{__('Advanced Search')}}")) {
        $("#advSearch").html('<i class="fas fa-filter"></i> {{__('Hide Advanced Search')}}');
    } else {
        $("#advSearch").html('<i class="fas fa-filter"></i> {{__('Advanced Search')}}');
    }
}

// Initialize autocomplete for dashboard search
$(document).ready(function() {
    $("#dashboard-job-search-form #jbsearch").autocomplete({
        source: function(request, response) {
            $.ajax({
                url: "{{ route('jobs.autocomplete') }}",
                dataType: "json",
                data: {
                    term: request.term
                },
                success: function(data) {
                    response(data);
                }
            });
        },
        minLength: 2,
        select: function(event, ui) {
            // Action after selecting a suggestion
        }
    });
});
</script>
@endif

@endpush