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
          <li class="breadcrumb-item"><a class="nav-link" href="{{url('admin/dashboard')}}">Home</a></li>
          @if ($route == 'create.listing.step1' || $route == 'create.listing.step2' || $route == 'create.listing.step3' || $route == 'create.listing.step4' || $route == 'create.listing.step5' || $route == 'edit.listing.step1' || $route == 'edit.listing.step2' || $route == 'edit.listing.step3' || $route == 'edit.listing.step4' || $route == 'edit.listing.step5' || $route == 'show.listing')
          <li class="breadcrumb-item">
            <a class="nav-link" href="{{ route('all.listing') }}">Listing</a>
          </li>
          @endif
          @php
          // Define route names and their corresponding breadcrumb labels
          $breadcrumbs = [
          'admin.dashboard' => 'Dashboard',
          'all.listing' => 'Listing',
          'all.lead' => 'Lead',
          'create.lead' => 'Lead',
          'all.offer' => 'Offer',
          'offer.form' => 'Offer',
          'list.agent' => 'Agent',
          'create.agent' => 'Agent',
          'list.buyer' => 'Buyer',
          'all.contact' => 'Contact',
          'create.contact' => 'Contact',
          'all.referral' => 'Referral',
          'create.referral' => 'Referral',
          'all.showing' => 'Showing',
          'create.showing' => 'Showing',
          'probmatch' => 'Prob Match',
          'edit.probmatch'=>'Edit Prob Match',
          'criteriarank' => 'Criteria Rank',
          'edit.criteriarank' => 'Edit Criteria Rank',
          'contact-type' => 'Contact Type',
          'edit.contact-type' => 'Edit Contact Type',
          'referral-type' => 'Referral Type',
          'edit.referral-type' => 'Edit Referral Type',
          'categories' => 'Categories',
          'edit.categories' => 'Edit Categories',
          'reset.password' => 'Change Password',
          'login.activities' => 'Login Activities',
          'email.buyer' => 'Email Buyer',
          'show.lead' => 'View Lead',
          'edit.lead' => 'Edit Lead',
          'edit.offer.form' => 'Edit Offer',
          'show.offer' => 'View Offer',
          'edit.agent' => 'Edit Agent',
          'show.agent' => 'View Agent',
          'show.buyer' => 'View buyer',
          'edit.contact.form' => 'Edit Contact',
          'show.contact' => 'View Contact',
          'edit.referral' => 'Edit Referral',
          'show.referral' => 'View Referral',
          'edit.showing' => 'Edit Showing',
          'show.showing' => 'View Showing',
          ];
          @endphp

          @foreach ($breadcrumbs as $key => $label)
          @if ($route == $key)
          @if ($route == 'email.buyer')
          <li class="breadcrumb-item"><a class="nav-link" href="#">Report</a></li>
          <li class="breadcrumb-item">
            <a class="nav-link" href="{{ route($route) }}">{{ $breadcrumbs[$route] }}</a>
          </li>
          @elseif (in_array($route, ['edit.probmatch','edit.criteriarank','edit.contact-type','edit.referral-type','edit.categories','probmatch', 'criteriarank', 'contact-type', 'referral-type', 'categories', 'reset.password', 'login.activities']))
          <li class="breadcrumb-item"><a class="nav-link" href="#">System</a></li>
          @if($route == 'edit.probmatch' && !empty($id))
          <li class="breadcrumb-item">
            <a class="nav-link" href="{{ route('probmatch') }}">Prob Match</a>
          </li>
          <li class="breadcrumb-item">
            <a class="nav-link" href="{{ route($route,$id)}}">{{ $label }}</a>
          </li>
          @elseif($route == 'edit.criteriarank' && !empty($id))
          <li class="breadcrumb-item">
            <a class="nav-link" href="{{ route('criteriarank') }}">Criteria Rank</a>
          </li>
          <li class="breadcrumb-item">
            <a class="nav-link" href="{{ route($route,$id)}}">{{ $label }}</a>
          </li>
          @elseif($route == 'edit.contact-type' && !empty($id))
          <li class="breadcrumb-item">
            <a class="nav-link" href="{{ route('contact-type') }}">Contact Type</a>
          </li>
          <li class="breadcrumb-item">
            <a class="nav-link" href="{{ route($route,$id)}}">{{ $label }}</a>
          </li>
          @elseif($route == 'edit.referral-type' && !empty($id))
          <li class="breadcrumb-item">
            <a class="nav-link" href="{{ route('referral-type') }}">Referral Type</a>
          </li>
          <li class="breadcrumb-item">
            <a class="nav-link" href="{{ route($route,$id)}}">{{ $label }}</a>
          </li>
          @elseif($route == 'edit.categories' && !empty($id))
          <li class="breadcrumb-item">
            <a class="nav-link" href="{{ route('categories') }}">Categories</a>
          </li>
          <li class="breadcrumb-item">
            <a class="nav-link" href="{{ route($route,$id)}}">{{ $label }}</a>
          </li>
          @else
          <li class="breadcrumb-item">
            <a class="nav-link" href="{{ route($route) }}">{{ $breadcrumbs[$route] }}</a>
          </li>
          @endif
          @elseif (in_array($route, ['show.lead', 'edit.lead']))
          <li class="breadcrumb-item">
            <a class="nav-link" href="{{ route('all.lead') }}">Lead</a>
          </li>
          <li class="breadcrumb-item">
            <a class="nav-link" href="{{ route($route,$id)}}">{{ $label }}</a>
          </li>
          @elseif (in_array($route, ['show.offer', 'edit.offer.form']))
          <li class="breadcrumb-item">
            <a class="nav-link" href="{{ route('all.offer') }}">Offer</a>
          </li>
          <li class="breadcrumb-item">
            <a class="nav-link" href="{{ route($route,$id)}}">{{ $label }}</a>
          </li>
          @elseif (in_array($route, ['show.agent', 'edit.agent']))
          <li class="breadcrumb-item">
            <a class="nav-link" href="{{ route('list.agent') }}">Agent</a>
          </li>
          <li class="breadcrumb-item">
            <a class="nav-link" href="{{ route($route,$id)}}">{{ $label }}</a>
          </li>
          @elseif (in_array($route, ['show.buyer']))
          <li class="breadcrumb-item">
            <a class="nav-link" href="{{ route('list.buyer') }}">Buyer</a>
          </li>
          <li class="breadcrumb-item">
            <a class="nav-link" href="{{ route($route,$id)}}">{{ $label }}</a>
          </li>
          @elseif (in_array($route, ['show.contact', 'edit.contact.form']))
          <li class="breadcrumb-item">
            <a class="nav-link" href="{{ route('all.contact') }}">Contact</a>
          </li>
          <li class="breadcrumb-item">
            <a class="nav-link" href="{{ route($route,$id)}}">{{ $label }}</a>
          </li>
          @elseif (in_array($route, ['show.referral', 'edit.referral']))
          <li class="breadcrumb-item">
            <a class="nav-link" href="{{ route('all.referral') }}">Referral</a>
          </li>
          <li class="breadcrumb-item">
            <a class="nav-link" href="{{ route($route,$id)}}">{{ $label }}</a>
          </li>
          @elseif (in_array($route, ['show.showing', 'edit.showing']))
          <li class="breadcrumb-item">
            <a class="nav-link" href="{{ route('all.showing') }}">Showing</a>
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