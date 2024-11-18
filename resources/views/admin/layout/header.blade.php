<nav class="navbar navbar-expand-lg navbar-light navstickey ">
      <div class="container-fluid">
        <div class="d-flex justify-content-between w-100">
          <div class="d-flex align-items-center">
            @php
              $route = Route::currentRouteName();
            @endphp
            <button id="sidebarToggle" class="btn">☰</button>
            <ol class="my_menu breadcrumb breadcrumb-list m-0 ms-2">
              <li class="breadcrumb-item"><a class="nav-link" href="{{url('admin/dashboard')}}">Home</a></li>
              @if($route == 'admin.dashboard')
              <li class="breadcrumb-item">
                  <a class="nav-link" href="{{ route($route) }}">Dashboard</a>
              </li>
              @elseif($route == 'all.listing')
              <li class="breadcrumb-item">
                  <a class="nav-link" href="{{ route($route) }}">Listing</a>
              </li>
              @elseif($route == 'all.lead')
              <li class="breadcrumb-item">
                  <a class="nav-link" href="{{ route($route) }}">Lead</a>
              </li>
              @elseif($route == 'all.offer')
              <li class="breadcrumb-item">
                  <a class="nav-link" href="{{ route($route) }}">Offer</a>
              </li>
              @elseif($route == 'list.agent')
              <li class="breadcrumb-item">
                  <a class="nav-link" href="{{ route($route) }}">Agent</a>
              </li>
              @elseif($route == 'list.buyer')
              <li class="breadcrumb-item">
                  <a class="nav-link" href="{{ route($route) }}">Buyer</a>
              </li>
              @elseif($route == 'all.contact')
              <li class="breadcrumb-item">
                  <a class="nav-link" href="{{ route($route) }}">Contact</a>
              </li>
              @elseif($route == 'all.referral')
              <li class="breadcrumb-item">
                  <a class="nav-link" href="{{ route($route) }}">Referral</a>
              </li>
              @elseif($route == 'all.showing')
              <li class="breadcrumb-item">
                  <a class="nav-link" href="{{ route($route) }}">Showing</a>
              </li>
              @endif
            </ol>
          </div>
          <div class="header-right profile-dropdown d-flex align-items-center">
            <div class="dropdown">
              <button class="btn dropdown-toggle contact-available profile" type="button" id="dropdownMenuButton"
                data-bs-toggle="dropdown" aria-expanded="false">
                <img src="{{ url('assets/images/user.png') }}" alt="User Profile" class="rounded-circle" width="35" height="35">
              </button>
              <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuButton">
                <li>
                  <a class="dropdown-item d-flex align-items-center" href="{{route('show.profile')}}">
                    <i class="fas fa-user me-2 icon-font"></i>
                    Profile
                  </a>
                </li>
                <li>
                  <a class="dropdown-item d-flex align-items-center" href="{{route('reset.password')}}">
                    <i class="fas fa-user me-2 icon-font"></i>
                    Reset Password
                  </a>
                </li>
                <li>
                  <a class="dropdown-item d-flex align-items-center" href="#">
                    <i class="fas fa-question-circle me-2 icon-font"></i>
                    Help
                  </a>
                </li>
                <li>
                  <a class="dropdown-item d-flex align-items-center" href="{{ route('signout') }}">
                    <i class="fas fa-sign-out-alt me-2 icon-font"></i>
                    Logout
                  </a>
                </li>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </nav>