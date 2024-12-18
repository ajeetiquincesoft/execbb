<nav class="navbar navbar-expand-lg navbar-light navstickey ">
      <div class="container-fluid">
        <div class="d-flex justify-content-between w-100">
          <div class="d-flex align-items-center">
            @php
              $route = Route::currentRouteName();
              $id = request()->route('id');
            @endphp
            <button id="sidebarToggle" class="btn">☰</button>
            <ol class="my_menu breadcrumb breadcrumb-list m-0 ms-2">
              <li class="breadcrumb-item"><a class="nav-link" href="{{route('agent.dashboard')}}">Home</a></li>
              @php
              // Define route names and their corresponding breadcrumb labels
            $breadcrumbs = [
                  'agent.dashboard' => 'Dashboard',
                  'agent.all.listing' => 'Listing',
                  'agent.listing.form' => 'Listing',
                  'agent.list.buyer' => 'Buyer',
                  'agent.show.buyer' => 'View Buyer',
                  'agent.show.listing' => 'View Listing',
                  'agent.edit.listing.form' => 'Edit Listing',
                  'agent.reset.password' => 'Change Password',
                  'agent.login.activities' => 'Login Activities',
                  'agent.email.buyer' => 'Email Buyer',
                  'agent.reports' => 'Reports',
                  ];
                @endphp

                @foreach ($breadcrumbs as $key => $label)
                    @if ($route == $key)
                      @if ($route == 'agent.email.buyer' || $route == 'agent.reports')
                        <li class="breadcrumb-item"><a class="nav-link" href="#">Report</a></li>
                        <li class="breadcrumb-item">
                          <a class="nav-link" href="{{ route($route) }}">{{ $breadcrumbs[$route] }}</a>
                        </li>
                        @elseif (in_array($route, ['agent.reset.password', 'agent.login.activities']))
                            <li class="breadcrumb-item"><a class="nav-link" href="#">System</a></li>
                            <li class="breadcrumb-item">
                                <a class="nav-link" href="{{ route($route) }}">{{ $breadcrumbs[$route] }}</a>
                            </li>
                            @elseif (in_array($route, ['agent.show.buyer']))
                          <li class="breadcrumb-item">
                            <a class="nav-link" href="{{ route('agent.list.buyer') }}">Buyer</a>
                          </li>
                          <li class="breadcrumb-item">
                            <a class="nav-link" href="{{ route($route,$id)}}">{{ $label }}</a>
                          </li>
                          @elseif (in_array($route, ['agent.show.listing', 'agent.edit.listing.form']))
                          <li class="breadcrumb-item">
                            <a class="nav-link" href="{{ route('agent.all.listing') }}">Listing</a>
                          </li>
                          <li class="breadcrumb-item">
                            <a class="nav-link" href="{{ route($route,$id)}}">{{ $label }}</a>
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
                <img src="{{ url('assets/images/user.png') }}" alt="User Profile" class="rounded-circle" width="35" height="35">
              </button>
              <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuButton">
                <li>
                  <a class="dropdown-item d-flex align-items-center" href="#">
                    <i class="fas fa-user me-2 icon-font"></i>
                    Profile
                  </a>
                </li>
                <li>
                  <a class="dropdown-item d-flex align-items-center" href="#">
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