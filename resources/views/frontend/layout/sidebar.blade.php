<div class="sidebar">
    <div class="sidebar-header">
        <h4>Buyer Dashboard</h4>
    </div>
    <ul class="sidebar-menu">
        <li>
            <a href="{{route('buyer.dashboard')}}" class="{{ Route::currentRouteName() == 'buyer.dashboard' ? 'active' : '' }}"><i class="fa fa-home"></i> Dashboard</a>
        </li>
       <!--  <li>
            <a href="#"><i class="fa fa-shopping-cart"></i> My Orders</a>
        </li> -->
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
            <a href="{{route('buyer.all.showing')}}" class="{{ Route::currentRouteName() == 'buyer.all.showing' ? 'active' : '' }}"><i class="fa fa-eye"></i> Showings</a>
        </li>
        <li>
            <a href="{{route('buyer.all.offer')}}" class="{{ Route::currentRouteName() == 'buyer.all.offer' ? 'active' : '' }}"><i class="fa fa-times-circle-o"></i> Offers</a>
        </li>
        <!-- Collapsible Settings -->
       <!--  <li class="nav-item">
            <a href="javascript:void(0);" class="nav-link collapsed showing-menu" data-toggle="collapse" data-target="#showings-collapse" aria-expanded="false">Showings <span class="caret ml-auto">&#9660;</span>
            </a>
            <div id="showings-collapse" class="collapse">
                <ul class="list-unstyled buyer-dash">
                    <li><a href="{{route('buyer.all.showing')}}"> - All Showing</a></li>
                </ul>
            </div>
        </li> -->
        <li>
            <a href="{{ route('signout') }}" class="{{ Route::currentRouteName() == 'signout' ? 'active' : '' }}"><i class="fa fa-sign-out"></i> Logout</a>
        </li>
    </ul>
</div>
<style>
    /* Ensure the caret is positioned to the right */
    .nav-link {
        display: flex;
        justify-content: space-between;
        /* Aligns text and caret */
        align-items: center;
    }

    .caret {
        margin-left: 10px;
        /* Add some space between text and caret */
        font-size: 14px;
        /* Adjust size if necessary */
    }

    .ml-auto {
        margin-left: auto;
        /* Moves the caret to the far right */
    }
</style>
<script>
  /*   $(document).ready(function() {
        // Handle the collapse and expand of settings
        $('#settings-collapse').on('show.bs.collapse', function() {
            // Change the caret to up (▲) when expanding
            $('.caret').html('&#9650;'); // Up caret (▲)
        }).on('hide.bs.collapse', function() {
            // Change the caret back to down (▼) when collapsing
            $('.caret').html('&#9660;'); // Down caret (▼)
        });
    }); */
</script>