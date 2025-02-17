<div class="sidebar">
    <div class="sidebar-header">
        <h4>Buyer Dashboard</h4>
    </div>
    <ul class="sidebar-menu">
        <li>
            <a href="{{route('buyer.dashboard')}}" class="{{ Route::currentRouteName() == 'buyer.dashboard' ? 'active' : '' }}"><i class="fa fa-home"></i> Dashboard</a>
        </li>
        <li>
            <a href="#"><i class="fa fa-shopping-cart"></i> My Orders</a>
        </li>
        <li>
            <a href="{{route('buyer.save.search')}}" class="{{ Route::currentRouteName() == 'buyer.save.search' ? 'active' : '' }}"><i class="fa fa-search"></i> Save Searches</a>
        </li>
        <li>
            <a href="{{route('buyer.favorite.listings')}}" class="{{ Route::currentRouteName() == 'buyer.favorite.listings' ? 'active' : '' }}"><i class="fa fa-heart"></i> Favourites</a>
        </li>
        <li>
            <a href="{{route('buyer.all.message')}}" class="{{ Route::currentRouteName() == 'buyer.all.message' ? 'active' : '' }}"><i class="fa fa-comments"></i> Messages</a>
        </li>
        <li>
            <a href="{{route('buyer.profile')}}" class="{{ Route::currentRouteName() == 'buyer.profile' ? 'active' : '' }}"><i class="fa fa-user"></i> Profile</a>
        </li>
        <li>
            <a href="{{route('buyer.change.password')}}" class="{{ Route::currentRouteName() == 'buyer.change.password' ? 'active' : '' }}"><i class="fa fa-key"></i> Change Password</a>
        </li>
        <li>
            <a href="#"><i class="fa fa-cog"></i> Settings</a>
        </li>
        <li>
            <a href="{{ route('signout') }}" class="{{ Route::currentRouteName() == 'signout' ? 'active' : '' }}"><i class="fa fa-sign-out"></i> Logout</a>
        </li>
    </ul>
</div>
