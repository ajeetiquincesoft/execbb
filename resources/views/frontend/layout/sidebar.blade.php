<div class="sidebar">
    <div class="sidebar-header">
        <h4>Buyer Dashboard</h4>
    </div>
    <ul class="sidebar-menu">
        <li class="{{ Route::currentRouteName() == 'buyer.dashboard' ? 'active' : '' }}">
            <a href="{{route('buyer.dashboard')}}"><i class="fa fa-home"></i> Dashboard</a>
        </li>
        <li class="">
            <a href="#"><i class="fa fa-shopping-cart"></i> My Orders</a>
        </li>
        <li class="{{ Route::currentRouteName() == 'buyer.save.search' ? 'active' : '' }}">
            <a href="{{route('buyer.save.search')}}"><i class="fa fa-search"></i> Save Searches</a>
        </li>
        <li class="{{ Route::currentRouteName() == 'buyer.favorite.listings' ? 'active' : '' }}">
            <a href="{{route('buyer.favorite.listings')}}"><i class="fa fa-heart"></i> Favourites</a>
        </li>
        <li class="{{ Route::currentRouteName() == 'buyer.all.message' ? 'active' : '' }}">
            <a href="{{route('buyer.all.message')}}"><i class="fa fa-comments"></i> Messages</a>
        </li>
        <li class="{{ Route::currentRouteName() == 'buyer.profile' ? 'active' : '' }}">
            <a href="{{route('buyer.profile')}}"><i class="fa fa-user"></i> Profile</a>
        </li>
        <li class="{{ Route::currentRouteName() == 'buyer.change.password' ? 'active' : '' }}">
            <a href="{{route('buyer.change.password')}}"><i class="fa fa-key"></i> Change Password</a>
        </li>
        <li class="">
            <a href="#"><i class="fa fa-cog"></i> Settings</a>
        </li>
        <li class="{{ Route::currentRouteName() == 'signout' ? 'active' : '' }}">
            <a href="{{ route('signout') }}"><i class="fa fa-sign-out"></i> Logout</a>
        </li>
    </ul>
</div>
