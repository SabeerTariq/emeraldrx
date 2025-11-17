@extends('layouts.app')
@section('content') 
<!-- Header start --> 
@include('includes.header') 
<!-- Header end --> 

@include('flash::message')

@php
$company = $job->getCompany();
@endphp

<div class="listpgWraper applicant-profile-wrapper">
    <div class="container applicant-profile-container">  
        @include('flash::message')  
        
        <!-- Job Profile start -->
        <div class="row justify-content-center">
            <div class="col-lg-8 col-xl-8">    
                <!-- Cover Image -->
                <div class="usercoverimg">
                    @if(!empty($company->logo))
                        <img src="{{ asset('company_logos/'.$company->logo) }}" alt="{{$company->name}}" style="width: 100%; height: 100%; object-fit: cover;">
                    @else
                        <div style="width: 100%; height: 100%; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); display: flex; align-items: center; justify-content: center; color: #fff; font-size: 24px; font-weight: bold;">
                            {{$company->name}}
                        </div>
                    @endif
                </div>

                <!-- Main Info Section -->
                <div class="userMaininfo">                
                    <div class="userPic">
                        <a href="{{route('company.detail',$company->slug)}}">{{$company->printCompanyImage()}}</a>
                    </div>					
                    <div class="title">
                        <h3>{{$job->title}} <span>({{$company->name}})</span></h3>
                        <div class="desi"><i class="fa fa-map-marker" aria-hidden="true"></i> @if((bool)$job->is_freelance) {{__('Freelance')}} @else {{$job->getLocation()}} @endif</div>
                        <div class="membersinc"><i class="far fa-calendar" aria-hidden="true"></i> {{__('Date Posted')}}: {{$job->created_at->format('M d, Y')}}</div>
                        @if(!(bool)$job->hide_salary)
                        <div class="membersinc" style="color: #27bcbb; font-weight: 600;"><i class="fas fa-dollar-sign" aria-hidden="true"></i> {{$job->salary_currency ? $job->salary_currency : ''}} {{number_format($job->salary_from)}} - {{$job->salary_currency ? $job->salary_currency : ''}} {{number_format($job->salary_to)}}</div>
                        @endif
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="userlinkstp">  
                    @if(Auth::check() && Auth::user()->isAppliedOnJob($job->id))
                        <button class="btn" disabled style="background: #28a745; cursor: not-allowed;"><i class="fas fa-check-circle"></i> {{__('Already Applied')}}</button>
                    @else
                        @if(!Auth::check())
                            @if($job->application_url != '')
                                <a href="{{route('job.apply', $job->slug)}}" class="btn"><i class="fas fa-paper-plane"></i> {{__('Apply Now')}}</a>
                            @else
                                <a href="{{route('apply.job', $job->slug)}}" class="btn"><i class="fas fa-paper-plane"></i> {{__('Apply Now')}}</a>
                            @endif
                        @else
                            @php
                                $user = Auth::user();
                                $profileIncomplete = count($user->getProfileProjectsArray()) == 0 ||
                                                    count($user->getProfileCvsArray()) == 0 ||
                                                    count($user->profileExperience()->get()) == 0 ||
                                                    count($user->profileEducation()->get()) == 0 ||
                                                    count($user->profileSkills()->get()) == 0;
                            @endphp

                            @if($profileIncomplete)
                                <a href="{{ route('my.profile') }}" class="btn" style="background: #ffc107; color: #333;"><i class="fas fa-exclamation-circle"></i> {{__('Complete your profile to apply')}}</a>
                            @else
                                @if($job->application_url != '')
                                    <a href="{{route('job.apply', $job->slug)}}" class="btn"><i class="fas fa-paper-plane"></i> {{__('Apply Now')}}</a>
                                @else
                                    <a href="{{route('apply.job', $job->slug)}}" class="btn"><i class="fas fa-paper-plane"></i> {{__('Apply Now')}}</a>
                                @endif
                            @endif
                        @endif
                    @endif

                    <a href="{{route('email.to.friend', $job->slug)}}" class="btn"><i class="fas fa-envelope"></i> {{__('Email to Friend')}}</a>
                    @if(Auth::check() && Auth::user()->isFavouriteJob($job->slug))
                        <a href="{{route('remove.from.favourite', $job->slug)}}" class="btn"><i class="fas fa-heart"></i> {{__('Remove From Favourite')}}</a>
                    @else
                        <a href="{{route('add.to.favourite', $job->slug)}}" class="btn"><i class="far fa-heart"></i> {{__('Add to Favourite')}}</a>
                    @endif
                    <a href="{{route('report.abuse', $job->slug)}}" class="btn report"><i class="fas fa-exclamation-triangle"></i> {{__('Report Abuse')}}</a>
                </div>

                <!-- Job Details -->
                <div class="userdetailbox">
                    <h3>{{__('Job Details')}}</h3>
                    <div class="job-details-grid" style="display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 20px; margin-top: 20px;">
                        <div class="job-detail-item" style="display: flex; align-items: flex-start; gap: 15px; padding: 20px; background: #f8f9fa; border-radius: 10px;">
                            <div class="detail-icon" style="width: 45px; height: 45px; display: flex; align-items: center; justify-content: center; background: #e8f4f8; border-radius: 10px; color: #27bcbb; font-size: 20px; flex-shrink: 0;"><i class="fas fa-map-marker-alt"></i></div>
                            <div class="detail-content" style="flex: 1;">
                                <span class="detail-label" style="font-size: 12px; color: #777; text-transform: uppercase; letter-spacing: 0.5px; font-weight: 600; display: block; margin-bottom: 5px;">{{__('Location')}}</span>
                                <span class="detail-value" style="font-size: 15px; color: #333; font-weight: 600;">@if((bool)$job->is_freelance) {{__('Freelance')}} @else {{$job->getLocation()}} @endif</span>
                            </div>
                        </div>
                        
                        <div class="job-detail-item" style="display: flex; align-items: flex-start; gap: 15px; padding: 20px; background: #f8f9fa; border-radius: 10px;">
                            <div class="detail-icon" style="width: 45px; height: 45px; display: flex; align-items: center; justify-content: center; background: #e8f4f8; border-radius: 10px; color: #27bcbb; font-size: 20px; flex-shrink: 0;"><i class="fas fa-briefcase"></i></div>
                            <div class="detail-content" style="flex: 1;">
                                <span class="detail-label" style="font-size: 12px; color: #777; text-transform: uppercase; letter-spacing: 0.5px; font-weight: 600; display: block; margin-bottom: 5px;">{{__('Job Type')}}</span>
                                <span class="detail-value" style="font-size: 15px; color: #333; font-weight: 600;">{{$job->job_type_id ? $job->job_type_id : 'N/A'}}</span>
                            </div>
                        </div>
                        
                        <div class="job-detail-item" style="display: flex; align-items: flex-start; gap: 15px; padding: 20px; background: #f8f9fa; border-radius: 10px;">
                            <div class="detail-icon" style="width: 45px; height: 45px; display: flex; align-items: center; justify-content: center; background: #e8f4f8; border-radius: 10px; color: #27bcbb; font-size: 20px; flex-shrink: 0;"><i class="fas fa-clock"></i></div>
                            <div class="detail-content" style="flex: 1;">
                                <span class="detail-label" style="font-size: 12px; color: #777; text-transform: uppercase; letter-spacing: 0.5px; font-weight: 600; display: block; margin-bottom: 5px;">{{__('Shift')}}</span>
                                <span class="detail-value" style="font-size: 15px; color: #333; font-weight: 600;">{{$job->job_shift_id ? $job->job_shift_id : 'N/A'}}</span>
                            </div>
                        </div>
                        
                        <div class="job-detail-item" style="display: flex; align-items: flex-start; gap: 15px; padding: 20px; background: #f8f9fa; border-radius: 10px;">
                            <div class="detail-icon" style="width: 45px; height: 45px; display: flex; align-items: center; justify-content: center; background: #e8f4f8; border-radius: 10px; color: #27bcbb; font-size: 20px; flex-shrink: 0;"><i class="fas fa-chart-line"></i></div>
                            <div class="detail-content" style="flex: 1;">
                                <span class="detail-label" style="font-size: 12px; color: #777; text-transform: uppercase; letter-spacing: 0.5px; font-weight: 600; display: block; margin-bottom: 5px;">{{__('Career Level')}}</span>
                                <span class="detail-value" style="font-size: 15px; color: #333; font-weight: 600;">{{$job->getCareerLevel('career_level')}}</span>
                            </div>
                        </div>
                        
                        <div class="job-detail-item" style="display: flex; align-items: flex-start; gap: 15px; padding: 20px; background: #f8f9fa; border-radius: 10px;">
                            <div class="detail-icon" style="width: 45px; height: 45px; display: flex; align-items: center; justify-content: center; background: #e8f4f8; border-radius: 10px; color: #27bcbb; font-size: 20px; flex-shrink: 0;"><i class="fas fa-users"></i></div>
                            <div class="detail-content" style="flex: 1;">
                                <span class="detail-label" style="font-size: 12px; color: #777; text-transform: uppercase; letter-spacing: 0.5px; font-weight: 600; display: block; margin-bottom: 5px;">{{__('Positions')}}</span>
                                <span class="detail-value" style="font-size: 15px; color: #333; font-weight: 600;">{{$job->num_of_positions}}</span>
                            </div>
                        </div>
                        
                        <div class="job-detail-item" style="display: flex; align-items: flex-start; gap: 15px; padding: 20px; background: #f8f9fa; border-radius: 10px;">
                            <div class="detail-icon" style="width: 45px; height: 45px; display: flex; align-items: center; justify-content: center; background: #e8f4f8; border-radius: 10px; color: #27bcbb; font-size: 20px; flex-shrink: 0;"><i class="fas fa-calendar-alt"></i></div>
                            <div class="detail-content" style="flex: 1;">
                                <span class="detail-label" style="font-size: 12px; color: #777; text-transform: uppercase; letter-spacing: 0.5px; font-weight: 600; display: block; margin-bottom: 5px;">{{__('Experience')}}</span>
                                <span class="detail-value" style="font-size: 15px; color: #333; font-weight: 600;">{{$job->getJobExperience('job_experience')}}</span>
                            </div>
                        </div>
                        
                        <div class="job-detail-item" style="display: flex; align-items: flex-start; gap: 15px; padding: 20px; background: #f8f9fa; border-radius: 10px;">
                            <div class="detail-icon" style="width: 45px; height: 45px; display: flex; align-items: center; justify-content: center; background: #e8f4f8; border-radius: 10px; color: #27bcbb; font-size: 20px; flex-shrink: 0;"><i class="fas fa-venus-mars"></i></div>
                            <div class="detail-content" style="flex: 1;">
                                <span class="detail-label" style="font-size: 12px; color: #777; text-transform: uppercase; letter-spacing: 0.5px; font-weight: 600; display: block; margin-bottom: 5px;">{{__('Gender')}}</span>
                                <span class="detail-value" style="font-size: 15px; color: #333; font-weight: 600;">{{$job->getGender('gender')}}</span>
                            </div>
                        </div>
                        
                    </div>
                </div>
                
                <!-- Job Description -->
                <div class="userdetailbox">
                    <h3>{{__('Job Description')}}</h3>
                    <div class="job-content-body">
                        {!! $job->description !!}
                    </div>
                </div>
                
                <!-- Benefits -->
                @if (!empty($job->benefits))
                <div class="userdetailbox">
                    <h3>{{__('Benefits')}}</h3>
                    <div class="job-content-body">
                        {!! $job->benefits !!}
                    </div>
                </div>
                @endif
                
                <!-- Skills Required -->
                <div class="userdetailbox">
                    <h3>{{__('Skills Required')}}</h3>
                    <div class="job-skills-list">
                        {!!$job->getJobSkillsList()!!}
                    </div>
                </div>
            </div>

            <!-- Right Column: Sidebar -->
            <div class="col-lg-4 col-xl-8"> 
                <!-- Company Info Card -->
                <div class="job-header">
                    <div class="jobdetail">
                        <h3>{{__('Company Overview')}}</h3>
                        <div class="candidateinfo" style="text-align: center; margin-bottom: 20px;">
                            <div style="margin-bottom: 15px;">
                                <a href="{{route('company.detail',$company->slug)}}">{{$company->printCompanyImage()}}</a>
                            </div>
                            <h4 style="margin-bottom: 10px;"><a href="{{route('company.detail',$company->slug)}}" style="color: #333; text-decoration: none;">{{$company->name}}</a></h4>
                            <p style="color: #666; margin-bottom: 15px;"><i class="fas fa-map-marker-alt"></i> {{$company->getLocation()}}</p>
                            <div style="margin-bottom: 15px;">
                                <a href="{{route('company.detail',$company->slug)}}" style="color: #27bcbb; font-weight: 600; text-decoration: none;">
                                    <i class="fas fa-briefcase"></i> {{App\Company::countNumJobs('company_id', $company->id)}} {{__('Current Jobs Openings')}}
                                </a>
                            </div>
                        </div>
                        <div style="text-align: left; margin-top: 20px; padding-top: 20px; border-top: 1px solid #eee;">
                            <p style="color: #555; font-size: 14px; line-height: 1.8; margin-bottom: 0;">{{\Illuminate\Support\Str::limit(strip_tags($company->description), 200, '...')}} <a href="{{route('company.detail',$company->slug)}}" style="color: #27bcbb; font-weight: 600; text-decoration: none;">Read More</a></p>
                        </div>
                    </div>
                </div>
                
                <!-- Google Map Card -->
                @if(!empty($company->map))
                <div class="userdetailbox profileproject">
                    <h3>{{__('Location Map')}}</h3>
                    <iframe src="https://maps.google.it/maps?q={{urlencode(strip_tags($company->map))}}&output=embed" allowfullscreen style="width: 100%; height: 400px; border-radius: 8px;"></iframe>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>

@include('includes.footer')
@endsection

@push('styles')
<style type="text/css">
    .view_more{display:none !important;}
    .job-skills-list ul {
        list-style: none;
        padding: 0;
        margin: 0;
        display: flex;
        flex-wrap: wrap;
        gap: 10px;
    }
    .job-skills-list ul li {
        display: inline-block;
        margin: 0;
        padding: 0;
    }
    .job-skills-list ul li a {
        display: inline-block;
        background: #f0f4f8;
        color: #555;
        padding: 10px 20px;
        border-radius: 25px;
        font-weight: 600;
        font-size: 14px;
        text-decoration: none;
        transition: all 0.3s ease;
        border: 1px solid #e0e6ed;
    }
    .job-skills-list ul li a:hover {
        background: #27bcbb;
        color: #fff;
        border-color: #27bcbb;
        transform: translateY(-2px);
        box-shadow: 0 4px 8px rgba(39, 188, 187, 0.3);
    }
</style>
@endpush

@push('scripts') 
<script>
    $(document).ready(function ($) {
        $("form").submit(function () {
            $(this).find(":input").filter(function () {
                return !this.value;
            }).attr("disabled", "disabled");
            return true;
        });
        $("form").find(":input").prop("disabled", false);

        $(".view_more_ul").each(function () {
            if ($(this).height() > 100)
            {
                $(this).css('height', 100);
                $(this).css('overflow', 'hidden');
                $(this).next().removeClass('view_more');
            }
        });
    });
</script> 
@endpush
