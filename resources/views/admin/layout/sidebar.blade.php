<div id="sidebar" class=" text-white">
  <div class="position-relative img-bg ">
    <div class="p-3">
      <a href="{{url('admin/dashboard')}}"><img class="sidebar-logo" src="{{ url('assets/images/SidebarLogo.png') }}" alt=""></a>
      <button class="close-btn" aria-label="Close">&times;</button>
    </div>

  </div>
  <div class="scrollable-div">
    <ul class="nav custom-fontsize2 flex-column" style="margin-bottom: 30px;">
    <div class="accordion-item">
        <h2 class="accordion-header" id="headingOne">
          <button class="accordion-button accordion-button-main" type="button" data-bs-toggle="collapse" data-bs-target="#collapseMainMenu" aria-expanded="true" aria-controls="collapseMainMenu">
            Main Menu
          </button>
        </h2>
        <div id="collapseMainMenu" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
          <div class="accordion-body">
            <ul class="nav custom-fontsize flex-column px-2">
              <li class="nav-item">
                <img src="{{ url('assets/images/Dashboard.png') }}">
                <a class="nav-link text-white" data-name="Dashboard" data-url="{{url('admin/dashboard')}}" href="{{url('admin/dashboard')}}">Dashboard</a>
              </li>
              <li class="nav-item {{ request()->routeIs('all.listing') ||  request()->routeIs('create.listing.step*') || request()->routeIs('show.listing') || request()->routeIs('edit.listing.form') || request()->routeIs('edit.listing.step*') ? 'activenavitem' : '' }}">
                <img src="{{ url('assets/images/Listing.png') }}">
                <a class="nav-link" data-name="Listings" data-url="{{route('all.listing')}}" href="{{route('all.listing')}}">Listings</a>
              </li>
              <li class="nav-item {{ request()->routeIs('all.lead') || request()->routeIs('create.lead') || request()->routeIs('edit.lead') || request()->routeIs('show.lead') ? 'activenavitem' : '' }}">
                <img src="{{ url('assets/images/Lead.png') }}">
                <a class="nav-link" data-name="Leads" data-url="{{route('all.lead')}}" href="{{route('all.lead')}}">Leads</a>
              </li>
              <li class="nav-item {{ request()->routeIs('all.offer') || request()->routeIs('offer.form') || request()->routeIs('edit.offer.form') || request()->routeIs('show.offer') ? 'activenavitem' : '' }}">
                <img src="{{ url('assets/images/Off-Esc-Close.png') }}">
                <a class="nav-link" data-name="Off/ Esc/ Close" data-url="#" href="{{route('all.offer')}}">Off/ Esc/ Close</a>
              </li>
              <li class="nav-item {{ request()->routeIs('list.agent') || request()->routeIs('create.agent') || request()->routeIs('edit.agent') || request()->routeIs('show.agent') ? 'activenavitem' : '' }}">
                <img src="{{ url('assets/images/Agents.png') }}">
                <a class="nav-link" data-name="Agents" data-url="{{route('list.agent')}}" href="{{route('list.agent')}}">Agents</a>
              </li>
              <li class="nav-item {{ request()->routeIs('list.buyer') || request()->routeIs('show.buyer') ? 'activenavitem' : '' }}">
                <img src="{{ url('assets/images/Buyers.png') }}">
                <a class="nav-link" data-name="Buyers" data-url="#" href="{{route('list.buyer')}}">Buyers</a>
              </li>
              <li class="nav-item {{ request()->routeIs('all.contact') || request()->routeIs('create.contact') || request()->routeIs('edit.contact.form') || request()->routeIs('show.contact') ? 'activenavitem' : '' }}">
                <img src="{{ url('assets/images/Contacts.png') }}">
                <a class="nav-link" data-name="Contacts" data-url="#" href="{{route('all.contact')}}">Contacts</a>
              </li>
              <li class="nav-item {{ request()->routeIs('all.referral') || request()->routeIs('create.referral') || request()->routeIs('edit.referral') || request()->routeIs('show.referral') ? 'activenavitem' : '' }}">
                <img src="{{ url('assets/images/Referrals.png') }}">
                <a class="nav-link" data-name="Referrals" data-url="#" href="{{route('all.referral')}}">Referrals</a>
              </li>
              <li class="nav-item {{ request()->routeIs('all.showing') || request()->routeIs('create.showing') || request()->routeIs('edit.showing') || request()->routeIs('show.showing') ? 'activenavitem' : '' }}">
                <img src="{{ url('assets/images/Showings.png') }}">
                <a class="nav-link" data-name="Showings" data-url="#" href="{{route('all.showing')}}">Showings</a>
              </li>
            </ul>
          </div>
        </div>
      </div>
      <div class="accordion-item px-2 my-2">
        <button id="reportAccordionButton" style="background-color: #93744B; padding: 11px 13px;"
          class="accordion-button text-white default text-end" type="button" data-bs-toggle="collapse"
          data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
          Report
        </button>
        <div id="collapseOne" class="accordion-collapse collapse " aria-labelledby="headingOne"
          data-bs-parent="#accordionExample">
          <div class="accordion-body">
            <ul class="acc-list" style="list-style-type: none; padding: 0;">
              <li class="nav-item">Reports</li>
              <li class="nav-item {{ request()->routeIs('email.buyer') ? 'activenavitem' : '' }}"><a class="nav-link-dropdown" href="{{route('email.buyer')}}">Email Buyer</a></li>
              <li class="nav-item">Welcome</li>
            </ul>
          </div>
        </div>
      </div>

      <div class="accordion-item px-2">
        <button id="reportAccordionButton" style="background-color: #93744B; padding: 11px 13px;"
          class="accordion-button default text-end" type="button" data-bs-toggle="collapse"
          data-bs-target="#collapsetwo" aria-expanded="true" aria-controls="collapseOne">
          System
        </button>
        <div id="collapsetwo" class="accordion-collapse collapse " aria-labelledby="headingOne"
          data-bs-parent="#accordionExample">
          <div class="accordion-body">
            <ul class="acc-list" style="list-style-type: none; padding: 0;">
              <li class="nav-item {{ request()->routeIs('probmatch') || request()->routeIs('create.probmatch') || request()->routeIs('edit.probmatch') ? 'activenavitem' : '' }}"><a class="nav-link-dropdown" href="{{route('probmatch')}}">Prob Matches</a></li>

              <li class="nav-item {{ request()->routeIs('criteriarank') || request()->routeIs('create.criteriarank') || request()->routeIs('edit.criteriarank') ? 'activenavitem' : '' }}"><a class="nav-link-dropdown" href="{{route('criteriarank')}}">Criteria Rank</a></li>

              <li class="nav-item {{ request()->routeIs('contact-type') || request()->routeIs('create.contact-type') || request()->routeIs('edit.contact-type') ? 'activenavitem' : '' }}"><a class="nav-link-dropdown" href="{{route('contact-type')}}">Contact Type</a></li>

              <li class="nav-item {{ request()->routeIs('referral-type') || request()->routeIs('create.referral-type') || request()->routeIs('edit.referral-type') ? 'activenavitem' : '' }}"><a class="nav-link-dropdown" href="{{route('referral-type')}}">Ref Types</a></li>

              <!-- <li class="nav-item">Locales</li> -->
              <li class="nav-item {{ request()->routeIs('categories') || request()->routeIs('create.category') || request()->routeIs('edit.categories') ? 'activenavitem' : '' }}"><a class="nav-link-dropdown" href="{{route('categories')}}">Categories</a></li>

              <!-- <li class="nav-item">Settings</li> -->
              <li class="nav-item {{ request()->routeIs('reset.password') ? 'activenavitem' : '' }}"><a class="nav-link-dropdown" href="{{route('reset.password')}}">Change Pwd</a></li>

              <li class="nav-item {{ request()->routeIs('login.activities') ? 'activenavitem' : '' }}"><a class="nav-link-dropdown" href="{{route('login.activities')}}">Login List</a></li>
            </ul>
          </div>
        </div>
      </div>
    </ul>
  </div>
</div>