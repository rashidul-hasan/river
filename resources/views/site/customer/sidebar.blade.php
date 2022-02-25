<div class="account-nav flex-grow-1">
<h4 class="account-nav__title">Navigation</h4>
   <ul>
      <li class="account-nav__item {{ $active === 'dashboard' ? 'account-nav__item--active' : ''}}">
         <a href="{{ route('customer.dashboard') }}">Dashboard</a>
      </li>
      <li class="account-nav__item {{ $active === 'my-orders' ? 'account-nav__item--active' : ''}}">
         <a href="{{ route('customer.orders.index') }}">My Orders</a>
      </li>
      <li class="account-nav__item {{ $active === 'profile' ? 'account-nav__item--active' : ''}}">
         <a href="{{ route('customer.myprofile') }}">My Profile</a>
      </li>
      <li class="account-nav__item {{ $active === 'edit-profile' ? 'account-nav__item--active' : ''}}">
         <a href="{{ route('customer.editprofile') }}">Edit Profile</a>
      </li>
      <li class="account-nav__item {{ $active === 'change-password' ? 'account-nav__item--active' : ''}}">
         <a href="{{ route('customer.changepass.show') }}">Change Password</a>
      </li>

      <li class="account-nav__item"><a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a></li>
      <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
         {{ csrf_field() }}
      </form>
   </ul>
</div>