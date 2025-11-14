<div class="col-lg-3 dashboard-sidebar">
	<!-- Dashboard Sidebar Logo -->
	<div class="dashboard-sidebar-logo">
		<a href="{{url('/')}}" class="logo">
			<img src="{{ asset('/') }}sitesetting_images/thumb/{{ $siteSetting->site_logo }}" alt="{{ $siteSetting->site_name }}" />
		</a>
	</div>
	
	<div class="usernavwrap">
    <ul class="usernavdash">
        <li class="{{ Request::url() == route('company.home') ? 'active' : '' }}"><a href="{{route('company.home')}}"><i class="fas fa-tachometer" aria-hidden="true"></i> {{__('Dashboard')}}</a></li>
        <li class="{{ Request::url() == route('company.profile') ? 'active' : '' }}"><a href="{{ route('company.profile') }}"><i class="fas fa-pencil" aria-hidden="true"></i> {{__('Edit Account Details')}}</a></li>
        <li><a href="{{ route('company.detail', Auth::guard('company')->user()->slug) }}"><i class="fas fa-user-alt" aria-hidden="true"></i> {{__('Company Public Profile')}}</a></li>
        <li class="{{ Request::url() == route('post.job') ? 'active' : '' }}"><a href="{{ route('post.job') }}"><i class="fas fa-desktop" aria-hidden="true"></i> {{__('Post a Job')}}</a></li>
        <li class="{{ Request::url() == route('posted.jobs') ? 'active' : '' }}"><a href="{{ route('posted.jobs') }}"><i class="fab fa-black-tie"></i> {{__('Manage Jobs')}}</a></li>
        <li><a href="{{ route('company.logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i class="fas fa-sign-out" aria-hidden="true"></i> {{__('Logout')}}</a>
            <form id="logout-form" action="{{ route('company.logout') }}" method="POST" style="display: none;">{{ csrf_field() }}</form>
        </li>
    </ul>
	</div>
    <!-- <div class="row">
        <div class="col-md-12">{!! $siteSetting->dashboard_page_ad !!}</div>
    </div> -->
</div>