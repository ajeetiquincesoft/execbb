<nav class="navbar navbar-expand-lg navbar-light navstickey ">
      <div class="container-fluid">
        <div class="d-flex justify-content-between w-100">
          <div class="d-flex align-items-center">
            @php
              $route = Route::currentRouteName();
            @endphp
            <button id="sidebarToggle" class="btn">☰</button>
            <ol class="my_menu breadcrumb breadcrumb-list m-0 ms-2">
              <li class="breadcrumb-item"><a class="nav-link" href="{{route('agent.dashboard')}}">Home</a></li>
              @php
              // Define route names and their corresponding breadcrumb labels
              $breadcrumbs = [
                  'agent.dashboard' => 'Dashboard',
                  'agent.all.listing' => 'Listing',
                  'all.lead' => 'Lead',
                  'all.offer' => 'Offer',
                  'list.agent' => 'Agent',
                  'agent.list.buyer' => 'Buyer',
                  'all.contact' => 'Contact',
                  'all.referral' => 'Referral',
                  'all.showing' => 'Showing',
                  'probmatch' => 'Prob Match',
                  'criteriarank' => 'Criteria Rank',
                  'contact-type' => 'Contact Type',
                  'referral-type' => 'Referral Type',
                  'categories' => 'Categories',
                  'reset.password' => 'Change Password',
                  'login.activities' => 'Login Activities'
                  ];
                @endphp

                @foreach ($breadcrumbs as $key => $label)
                    @if ($route == $key)
                        @if (in_array($route, ['probmatch', 'criteriarank', 'contact-type', 'referral-type', 'categories', 'reset.password', 'login.activities']))
                            <li class="breadcrumb-item"><a class="nav-link" href="#">System</a></li>
                            <li class="breadcrumb-item">
                                <a class="nav-link" href="{{ route($route) }}">{{ $breadcrumbs[$route] }}</a>
                            </li>
                        @else
                        <li class="breadcrumb-item">
                            <a class="nav-link" href="{{ route($key) }}">{{ $label }}</a>
                        </li>
                        @endif
                    @endif
                @endforeach

              
            </ol>
          </div>
          <div class="header-right profile-dropdown d-flex align-items-center">
            <div class="dropdown">
              <button class="btn dropdown-toggle contact-available profile" type="button" id="dropdownMenuButton"
                data-bs-toggle="dropdown" aria-expanded="false">
                @if(auth()->user()->agent_info->image)
                <img src="{{ asset('assets/uploads/images/' . auth()->user()->agent_info->image) }}" alt="User Profile" class="rounded-circle" width="35" height="35">
                @else
                <img src="{{ url('assets/images/user.png') }}" alt="User Profile" class="rounded-circle" width="35" height="35">
                @endif
               
              </button>
              <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuButton">
                <li>
                  <a class="dropdown-item d-flex align-items-center" href="{{route('agent.show.profile')}}">
                    <i class="fas fa-user me-2 icon-font"></i>
                    Profile
                  </a>
                </li>
                <li>
                  <a class="dropdown-item d-flex align-items-center" href="{{route('agent.reset.password')}}">
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