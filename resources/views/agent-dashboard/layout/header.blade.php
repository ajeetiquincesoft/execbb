<nav class="navbar navbar-expand-lg navbar-light navstickey ">
      <div class="container-fluid">
        <div class="d-flex justify-content-between w-100">
          <div class="d-flex align-items-center">
            <button id="sidebarToggle" class="btn">☰</button>
            <ol class="breadcrumb breadcrumb-list m-0 ms-2">
              <li class="breadcrumb-item"><a href="">Home</a></li>
              <li class="breadcrumb-item"><a href="">Dashboard</a></li>
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