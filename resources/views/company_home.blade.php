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

    <div class="container">@include('flash::message')

        <div class="row"> @include('includes.company_dashboard_menu')
        <?php $company = auth()->guard('company')->user(); ?>

        <div class="col-md-9 col-sm-8 dashboard-content">
            @include('includes.dashboard_content_header') 
            <?php if ($company->is_active == 1 && (($company->package_end_date === null) || 
                (\Carbon\Carbon::parse($company->package_end_date)->lt(\Carbon\Carbon::now())) || 
                ($company->jobs_quota <= $company->availed_jobs_quota))) { ?>    

                <div class="userprofilealert">
                    <h5>
                        <i class="fas fa-check"></i> 
                        {{_('Your account is active now, Start Posting Jobs.')}}
                    </h5>
                </div>

            <?php } elseif ($company->is_active != 1) { ?> 
                <div class="userprofilealert">
                    <h5>
                        <i class="fas fa-times"></i> 
                        {{__('Your account is currently inactive due to pending verification.')}}
                    </h5>
                </div>
            <?php } ?> 
      

            
            
            @include('includes.company_dashboard_stats')

           @if($company->getPackage('id') == 13 && $company->package_end_date !== null && Carbon\Carbon::parse($company->package_end_date)->gt(Carbon\Carbon::now()) && $company->jobs_quota > $company->availed_jobs_quota)
                <div class="freepackagebox">                   
                    <div class="frpkgct">                    
                        <h5>{{__('Congratulations Your Account is Active now')}}</h5>
                        <p>{{__('You have got')}} {{$company->jobs_quota - $company->availed_jobs_quota}} {{__('free jobs postings, valid for 48 hours. Hurry Up before it ends')}}</p>
                    </div>
                    <a href="{{url('/post-job')}}">{{_('Post a Job')}}</a>
                </div>
            @endif



        <?php
        if((bool)config('company.is_company_package_active')){        
        $packages = App\Package::where('package_for', 'like', 'employer')->get();
        $package = Auth::guard('company')->user()->getPackage();
        ?>

        

        <?php } ?>

        <!-- Jobs Posted Section -->
        <div class="profbox mt-4">
            <h3>{{__('Recent Jobs Posted')}} <a href="{{route('posted.jobs')}}" style="float: right; font-size: 14px;">{{__('View All')}} <i class="fas fa-arrow-right"></i></a></h3>
            @if(isset($jobs) && count($jobs) > 0)
                <ul class="featuredlist row">
                    @foreach($jobs as $job)
                        <li class="col-lg-6 col-md-6 @if($job->is_featured == 1) featured @endif">
                            <div class="jobint">
                                @if($job->is_featured == 1) 
                                    <span class="promotepof-badge"><i class="fa fa-bolt" title="{{__('Featured Job')}}"></i></span> 
                                @endif
                                <div class="d-flex">
                                    <div class="fticon"><i class="fas fa-briefcase"></i> {{$job->getJobType('job_type')}}</div>                        
                                </div>
                                <h4>
                                    <a href="{{route('job.detail', [$job->slug])}}" title="{{$job->title}}">
                                        {!! \Illuminate\Support\Str::limit($job->title, 30, '...') !!}
                                        </a>
                                </h4>
                                @if(!(bool)$job->hide_salary && $job->salary_from)                    
                                    <div class="salary mb-2">Salary: 
                                        <strong>{{$job->salary_currency}}{{$job->salary_from}} - {{$job->salary_currency}}{{$job->salary_to}}/{{$job->getSalaryPeriod('salary_period')}}</strong>
                        </div>
                    @endif
                                <strong><i class="fas fa-map-marker-alt"></i> {{$job->getCity('city')}}</strong>
                                <div class="jobcompany">
                                    <div class="ftjobcomp">
                                        <span>{{$job->created_at->format('M d, Y')}}</span>
                                        @php
                                            $appliedCount = App\JobApply::where('job_id', $job->id)->count();
                                        @endphp
                                        <span style="margin-left: 10px;"><i class="fas fa-users"></i> {{$appliedCount}} {{__('Applications')}}</span>
                                    </div>
                                </div>
                                <div class="mt-2">
                                    <a href="{{route('list.applied.users', $job->id)}}" class="btn btn-sm btn-primary">{{__('View Applications')}}</a>
                        </div>
                            </div>
                                        </li>
                    @endforeach
                </ul>
            @else
                <div class="alert alert-info">{{__('No jobs posted yet')}}. <a href="{{route('post.job')}}">{{__('Post your first job')}}</a></div>
                                @endif
        </div>

        <!-- People Applied Section -->
        <div class="profbox mt-4">
            <h3>{{__('Recent Applications')}}</h3>
            @if(isset($recentApplications) && count($recentApplications) > 0)
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead class="table-dark">
                            <tr>
                                <th>{{__('Applicant Name')}}</th>
                                <th>{{__('Job Title')}}</th>
                                <th>{{__('Applied Date')}}</th>
                                <th>{{__('Status')}}</th>
                                <th>{{__('Action')}}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($recentApplications as $application)
                                @php
                                    $user = $application->user;
                                    $job = $application->job;
                                @endphp
                                @if($user && $job)
                                    <tr>
                                        <td>
                                            <strong>{{$user->name}}</strong><br>
                                            <small>{{$user->email}}</small>
                                        </td>
                                        <td>
                                            <a href="{{route('job.detail', [$job->slug])}}" title="{{$job->title}}">
                                                {{ \Illuminate\Support\Str::limit($job->title, 30, '...') }}
                                            </a>
                                        </td>
                                        <td>{{$application->created_at->format('M d, Y')}}</td>
                                        <td>
                                            <span class="badge badge-{{$application->status == 'applied' ? 'primary' : ($application->status == 'shortlisted' ? 'success' : 'secondary')}}">
                                                {{ucfirst($application->status)}}
                                            </span>
                                        </td>
                                        <td>
                                            <a href="{{route('list.applied.users', $job->id)}}" class="btn btn-sm btn-primary">{{__('View')}}</a>
                                        </td>
                                    </tr>
                                @endif
                            @endforeach
                        </tbody>
                    </table>
                        </div>
            @else
                <div class="alert alert-info">{{__('No applications received yet')}}</div>
                    @endif
        </div>

        </div>
        </div>
    </div>
</div>




@if($isDashboardPage === false)
@include('includes.footer')
@endif

@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://sandbox.paypal.com/sdk/js?client-id={{ env('PAYPAL_CLIENT_ID')}}"></script>
@if(session('success'))
    <script>
        Swal.fire({
            icon: 'success',
            title: '{{ __("Success") }}',
            text: '{{ session("success") }}',
            confirmButtonText: '{{ __("OK") }}'
        });
    </script>
@endif
<script>
    paypal.Buttons({
        createOrder: function(data, actions) {
            return fetch('/paypal/order', {
                method: 'post',
                headers: {
                    'content-type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({
                    package_id:'3'  // Pass the relevant package_id
                })
            }).then(function(res) {
                return res.json();
            }).then(function(orderData) {
                return orderData.id;
            });
        },
        onApprove: function(data, actions) {
            return fetch('/paypal/order/3/capture', {
                method: 'post',
                headers: {
                    'content-type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                }
            }).then(function(res) {
                return res.json();
            }).then(function(orderData) {
                // Handle the captured order details
                console.log('Capture result', orderData);
            });
        }
    }).render('#paypal-button-container');
</script>

@include('includes.immediate_available_btn')

@endpush

