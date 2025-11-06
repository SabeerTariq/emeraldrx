@php
// Check if this is a dashboard page
// All dashboard pages require authentication and include dashboard menu
$isDashboardPage = (Auth::check() || Auth::guard('company')->check());
@endphp

