@extends('layouts.app')

@section('content')

<!-- Header start -->
@include('includes.header')
<!-- Header end -->

@include('flash::message')

<div class="listpgWraper applicant-profile-wrapper">
    <div class="container applicant-profile-container">  
        @include('flash::message')  
        
        <!-- Company Profile start -->
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
                    <div class="userPic">{{$company->printCompanyImage()}}</div>					
                    <div class="title">
                        <h3>{{$company->name}} <span>({{$company->getIndustry('industry')}})</span></h3>
                        <div class="desi"><i class="fa fa-map-marker" aria-hidden="true"></i> {{$company->getLocation()}}</div>
                        <div class="membersinc"><i class="fa fa-history" aria-hidden="true"></i> {{__('Member Since')}}, {{$company->created_at->format('M d, Y')}}</div>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="userlinkstp">  
                    @if(Auth::guard('web')->check() && Auth::guard('web')->user()->isFavouriteCompany($company->slug))
                        <a href="{{ route('remove.from.favourite.company', $company->slug) }}" class="btn">
                            <i class="fa fa-floppy-o" aria-hidden="true"></i> {{ __('Remove from Favourite') }}
                        </a>
                    @else
                        <a href="{{ route('add.to.favourite.company', $company->slug) }}" class="btn">
                            <i class="fa fa-floppy-o" aria-hidden="true"></i> {{ __('Add to Favourite') }}
                        </a>
                    @endif

                    @if(Auth::check())
                        <a href="javascript:;" onclick="send_message()" class="btn">
                            <i class="fa fa-envelope" aria-hidden="true"></i> {{__('Send Message')}}
                        </a>
                    @endif

                    <a href="{{ route('report.abuse.company', $company->slug) }}" class="btn report">
                        <i class="fa fa-exclamation-triangle" aria-hidden="true"></i> {{ __('Report Abuse') }}
                    </a> 
                </div>

                <!-- About Company start -->
                <div class="userdetailbox">
                    <h3>{{__('About Company')}}</h3>
                    <p>{!! $company->description !!}</p>
                </div>

                <!-- Current Openings start -->
                @if(isset($company->jobs) && count($company->jobs))
                <div class="userdetailbox">
                    <h3>{{__('Current Openings')}}</h3>
                    <ul class="featuredlist row" style="list-style: none; padding: 0; margin: 0;">
                        @foreach($company->jobs as $companyJob)
                        <li class="col-lg-6 col-md-6" style="margin-bottom: 20px;">
                            <div class="jobint" style="background: #fff; padding: 20px; border-radius: 10px; box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);">
                                <div class="d-flex">
                                    <div class="fticon"><i class="fas fa-briefcase"></i> {{$companyJob->getJobType('job_type')}}</div>                        
                                </div>
                                <h4 style="margin: 10px 0;"><a href="{{route('job.detail', [$companyJob->slug])}}" title="{{$companyJob->title}}">{!! \Illuminate\Support\Str::limit($companyJob->title, $limit = 30, $end = '...') !!}</a></h4>
                                @if(!(bool)$companyJob->hide_salary)                    
                                    <div class="salary mb-2">Salary: <strong>{{$companyJob->salary_currency.''.$companyJob->salary_from}} - {{$companyJob->salary_currency.''.$companyJob->salary_to}}/{{$companyJob->getSalaryPeriod('salary_period')}}</strong></div>
                                @endif 
                                <strong><i class="fas fa-map-marker-alt"></i> {{$companyJob->getCity('city')}}</strong> 
                                <div style="margin-top: 10px;">
                                    <span style="color: #666; font-size: 14px;">{{$companyJob->created_at->format('M d, Y')}}</span>
                                </div>
                            </div>
                        </li>
                        @endforeach
                    </ul>
                </div>
                @endif
            </div>

            <!-- Right Column: Sidebar -->
            <div class="col-lg-4 col-xl-8"> 
                <!-- Contact Information -->
                @if(!empty($company->email) || !empty($company->phone) || !empty($company->website))
                <div class="job-header">
                    <div class="jobdetail">
                        <h3>{{__('Contact Information')}}</h3>
                        <div class="candidateinfo">            
                            @if(!empty($company->phone))
                            <div class="loctext"><i class="fa fa-phone" aria-hidden="true"></i> <a href="tel:{{$company->phone}}">{{$company->phone}}</a></div>
                            @endif
                            @if(!empty($company->email))
                            <div class="loctext"><i class="fa fa-envelope" aria-hidden="true"></i> <a href="mailto:{{$company->email}}">{{$company->email}}</a></div>
                            @endif
                            @if(!empty($company->website))
                            <div class="loctext"><i class="fa fa-globe" aria-hidden="true"></i> <a href="{{$company->website}}" target="_blank">{{$company->website}}</a></div>
                            @endif
                            @if(!empty($company->location))
                            <div class="loctext"><i class="fa fa-map-marker" aria-hidden="true"></i> {{$company->location}}</div>
                            @endif
                        </div>  
                    </div>
                </div>
                @endif
                
                <!-- Company Details -->
                <div class="job-header">
                    <div class="jobdetail">
                        <h3>{{__('Company Details')}}</h3>
                        <ul class="jbdetail row">
                            <li class="col-lg-6 col-md-6 col-6">
                                <div class="jbitlist">
                                    <span class="material-symbols-outlined">verified</span>
                                    <div class="jbitdata">
                                        <strong>{{__('Verified')}}</strong>
                                        <span>{{((bool)$company->verified)? 'Yes':'No'}}</span>
                                    </div>
                                </div>
                            </li>
                            <li class="col-lg-6 col-md-6 col-6">
                                <div class="jbitlist">
                                    <span class="material-symbols-outlined">group</span>
                                    <div class="jbitdata">
                                        <strong>{{__('Company Size')}}</strong>
                                        <span>{{$company->no_of_employees}}</span>
                                    </div>
                                </div>
                            </li>
                            <li class="col-lg-6 col-md-6 col-6">
                                <div class="jbitlist">
                                    <span class="material-symbols-outlined">cake</span>
                                    <div class="jbitdata">
                                        <strong>{{__('Founded In')}}</strong>
                                        <span>{{$company->established_in}}</span>
                                    </div>
                                </div>
                            </li>
                            <li class="col-lg-6 col-md-6 col-6">
                                <div class="jbitlist">
                                    <span class="material-symbols-outlined">corporate_fare</span>
                                    <div class="jbitdata">
                                        <strong>{{__('Organization Type')}}</strong>
                                        <span>{{$company->getOwnershipType('ownership_type')}}</span>
                                    </div>
                                </div>
                            </li>
                            <li class="col-lg-6 col-md-6 col-6">
                                <div class="jbitlist">
                                    <span class="material-symbols-outlined">corporate_fare</span>
                                    <div class="jbitdata">
                                        <strong>{{__('Total Offices')}}</strong>
                                        <span>{{$company->no_of_offices}}</span>
                                    </div>
                                </div>
                            </li>
                            <li class="col-lg-6 col-md-6 col-6">
                                <div class="jbitlist">
                                    <span class="material-symbols-outlined">cases</span>
                                    <div class="jbitdata">
                                        <strong>{{__('Open Jobs')}}</strong>
                                        <span>{{$company->countNumJobs('company_id',$company->id)}}</span>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>

                <!-- Location Map -->
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

<!-- Modal -->
<div class="modal fade" id="sendmessage" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <form action="" id="send-form">
                @csrf
                <input type="hidden" name="company_id" id="company_id" value="{{$company->id}}">
                <div class="modal-header">                    
                    <h4 class="modal-title">Send Message</h4>
                    <button type="button" class="close" data-bs-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <textarea class="form-control" name="message" id="message" cols="10" rows="7"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>

@include('includes.footer')

@endsection

@push('styles')
<style type="text/css">
    .formrow iframe {
        height: 78px;
    }
</style>
@endpush

@push('scripts')
<script type="text/javascript">
$(document).ready(function() {
    $(document).on('click', '#send_company_message', function() {
        var postData = $('#send-company-message-form').serialize();
        $.ajax({
            type: 'POST',
            url: "{{ route('contact.company.message.send') }}",
            data: postData,
            success: function(data) {
                response = JSON.parse(data);
                var res = response.success;
                if (res == 'success') {
                    var errorString = '<div role="alert" class="alert alert-success popmessage">' +
                        response.message + '</div>';
                    $('#alert_messages').html(errorString);
                    $('#send-company-message-form').hide('slow');
                    $(document).scrollTo('.alert', 2000);
                } else {
                    var errorString = '<div class="alert alert-danger" role="alert"><ul>';
                    response = JSON.parse(data);
                    $.each(response, function(index, value) {
                        errorString += '<li>' + value + '</li>';
                    });
                    errorString += '</ul></div>';
                    $('#alert_messages').html(errorString);
                    $(document).scrollTo('.alert', 2000);
                }
            },
        });
    });
});

function send_message() {
    const el = document.createElement('div')
    el.innerHTML = "Please <a class='btn' href='{{route('login')}}' onclick='set_session()'>log in</a> as a Candidate and try again."
    @if(Auth::check())
    $('#sendmessage').modal('show');
    @else
    swal({
        title: "You are not Loged in",
        content: el,
        icon: "error",
        button: "OK",
    });
    @endif
}

if ($("#send-form").length > 0) {
    $("#send-form").validate({
        validateHiddenInputs: true,
        ignore: "",
        rules: {
            message: {
                required: true,
                maxlength: 5000
            },
        },
        messages: {
            message: {
                required: "Message is required",
            }
        },
        submitHandler: function(form) {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            @if(null !== (Auth::user()))
            $.ajax({
                url: "{{route('submit-message')}}",
                type: "POST",
                data: $('#send-form').serialize(),
                success: function(response) {
                    $("#send-form").trigger("reset");
                    $('#sendmessage').modal('hide');
                    swal({
                        title: "Success",
                        text: response["msg"],
                        icon: "success",
                        button: "OK",
                    });
                }
            });
            @endif
        }
    })
}
</script>
@endpush
