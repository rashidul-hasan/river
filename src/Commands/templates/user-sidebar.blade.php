<ul class="list-group list-group-flush">
    <li class="list-group-item {{ $active === 'dashboard' ? 'active' : ''}}">
        <a href="{{ route('riversite.customer.dashboard') }}">Dashboard</a>
    </li>
    <li class="list-group-item {{ $active === 'editProfile' ? 'active' : ''}}">
        <a href="{{ route('riversite.customer.editProfile') }}">Edit Profile</a>
    </li>
    <li class="list-group-item {{ $active === 'updatePassword' ? 'active' : ''}}">
        <a href="{{ route('riversite.update.passwordPage') }}">Update Password</a>
    </li>
    <li class="list-group-item">
        <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
    </li>
</ul>
<form id="logout-form" action="{{ route('riversite.logout') }}" method="POST" style="display: none;">
    {{ csrf_field() }}
</form>
