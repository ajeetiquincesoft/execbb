<div class="sidebar">
    <div class="sidebar-header">
        <h4>Buyer Dashboard</h4>
    </div>
    <ul class="sidebar-menu">
        <li><a href="{{route('buyer.dashboard')}}"><i class="fa fa-home"></i> Dashboard</a></li>
        <li><a href="#"><i class="fa fa-shopping-cart"></i> My Orders</a></li>
        <li><a href="{{route('buyer.save.search')}}"><i class="fa fa-search"></i> Save Searches</a></li>
        <li><a href="{{route('buyer.favorite.listings')}}"><i class="fa fa-heart"></i> Favourites</a></li>
        <li><a href="{{route('buyer.all.message')}}"><i class="fa fa-comments"></i> Messages</a></li>
        <li><a href="{{route('buyer.profile')}}"><i class="fa fa-user"></i> Profile</a></li>
        <li><a href="{{route('buyer.change.password')}}"><i class="fa fa-key"></i> Change Password</a></li>
        <li><a href="#"><i class="fa fa-cog"></i> Settings</a></li>
        <li><a href="{{ route('signout') }}"><i class="fa fa-sign-out"></i> Logout</a></li>
    </ul>
</div>