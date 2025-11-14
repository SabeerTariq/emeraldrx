<!-- Dashboard Content Header (Sticky) -->
<div class="dashboard-content-header">
    <div class="dashboard-header-inner">
        <h1 class="dashboard-page-title">
            @if(isset($pageTitle))
                {{ $pageTitle }}
            @elseif(Request::routeIs('home'))
                {{__('Dashboard')}}
            @elseif(Request::routeIs('job.list'))
                {{__('Search Jobs')}}
            @elseif(Request::routeIs('my.profile'))
                {{__('My Profile')}}
            @elseif(Request::routeIs('my.job.applications'))
                {{__('My Job Applications')}}
            @elseif(Request::routeIs('my.favourite.jobs'))
                {{__('My Favourite Jobs')}}
            @elseif(Request::routeIs('my.messages'))
                {{__('My Messages')}}
            @elseif(Request::routeIs('my.followings'))
                {{__('My Followings')}}
            @elseif(Request::routeIs('build.resume'))
                {{__('Build Resume')}}
            @elseif(Request::routeIs('resume'))
                {{__('Print Resume')}}
            @elseif(Request::routeIs('company.home'))
                {{__('Dashboard')}}
            @elseif(Request::routeIs('company.profile'))
                {{__('Company Profile')}}
            @elseif(Request::routeIs('post.job'))
                {{__('Post a Job')}}
            @elseif(Request::routeIs('posted.jobs'))
                {{__('Manage Jobs')}}
            @elseif(Request::routeIs('company.messages'))
                {{__('Company Messages')}}
            @elseif(Request::routeIs('company.followers'))
                {{__('Company Followers')}}
            @else
                {{__('Dashboard')}}
            @endif
        </h1>
        <div class="dashboard-profile-dropdown">
            @if(Auth::check() && !Auth::guard('company')->check())
                <div class="dropdown userbtn">
                    <a href="#" class="dropdown-toggle profile-icon-link" data-bs-toggle="dropdown" aria-expanded="false">
                        {{ Auth::user()->printUserImage() }}
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end">
                        <li class="nav-item"><a href="{{route('home')}}" class="nav-link"><i class="fa fa-tachometer" aria-hidden="true"></i> {{__('Dashboard')}}</a> </li>
                        <li class="nav-item"><a href="{{ route('my.profile') }}" class="nav-link"><i class="fa fa-user" aria-hidden="true"></i> {{__('My Profile')}}</a> </li>
                        <li class="nav-item"><a href="{{ route('view.public.profile', Auth::user()->id) }}" class="nav-link"><i class="fa fa-eye" aria-hidden="true"></i> {{__('View Public Profile')}}</a> </li>
                        <li><a href="{{ route('my.job.applications') }}" class="nav-link"><i class="fa fa-desktop" aria-hidden="true"></i> {{__('My Job Applications')}}</a> </li>
                        <li class="nav-item"><a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form-dashboard').submit();" class="nav-link"><i class="fa fa-sign-out" aria-hidden="true"></i> {{__('Logout')}}</a> </li>
                        <form id="logout-form-dashboard" action="{{ route('logout') }}" method="POST" style="display: none;">
                            {{ csrf_field() }}
                        </form>
                    </ul>
                </div>
            @elseif(Auth::guard('company')->check())
                <div class="dropdown userbtn">
                    <a href="#" class="dropdown-toggle profile-icon-link" data-bs-toggle="dropdown" aria-expanded="false">
                        {{ Auth::guard('company')->user()->printCompanyImage() }}
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end">
                        <li class="nav-item"><a href="{{route('company.home')}}" class="nav-link"><i class="fa fa-tachometer" aria-hidden="true"></i> {{__('Dashboard')}}</a> </li>
                        <li class="nav-item"><a href="{{ route('company.profile') }}" class="nav-link"><i class="fa fa-user" aria-hidden="true"></i> {{__('Company Profile')}}</a></li>
                        <li class="nav-item"><a href="{{ route('post.job') }}" class="nav-link"><i class="fa fa-desktop" aria-hidden="true"></i> {{__('Post Job')}}</a></li>
                        <!-- <li class="nav-item"><a href="{{route('company.messages')}}" class="nav-link"><i class="fa fa-envelope" aria-hidden="true"></i> {{__('Company Messages')}}</a></li> -->
                        <li class="nav-item"><a href="{{ route('company.logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form-dashboard-company').submit();" class="nav-link"><i class="fa fa-sign-out" aria-hidden="true"></i> {{__('Logout')}}</a> </li>
                        <form id="logout-form-dashboard-company" action="{{ route('company.logout') }}" method="POST" style="display: none;">
                            {{ csrf_field() }}
                        </form>
                    </ul>
                </div>
            @endif
        </div>
    </div>
</div>

