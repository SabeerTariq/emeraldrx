<ul class="row profilestat">
    <li class="col-md-6 col-6">
        <a href="{{route('posted.jobs')}}" class="inbox"> 
            <i class="fas fa-briefcase" aria-hidden="true"></i>
            <h6>
                @if(isset($totalJobs))
                    {{ $totalJobs }}
                @else
                    {{Auth::guard('company')->user()->jobs()->count()}}
                @endif
                <strong>{{__('Jobs Posted')}}</strong>
            </h6>
        </a>
    </li>
    <li class="col-md-6 col-6">
        <a href="#" class="inbox"> 
            <i class="fas fa-users" aria-hidden="true"></i>
            <h6>
                @if(isset($totalApplications))
                    {{ $totalApplications }}
                @else
                    @php
                        $company = Auth::guard('company')->user();
                        $jobIds = $company->jobs()->pluck('id');
                        $appCount = App\JobApply::whereIn('job_id', $jobIds)->count();
                    @endphp
                    {{ $appCount }}
                @endif
                <strong>{{__('People Applied')}}</strong>
            </h6>
        </a>
    </li>
</ul>