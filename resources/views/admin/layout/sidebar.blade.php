<div id="sidebar" class=" text-white">
    <div class="position-relative img-bg ">
      <div class="p-3">
        <a href="{{url('admin/dashboard')}}"><img class="sidebar-logo" src="{{ url('assets/images/SidebarLogo.png') }}" alt=""></a>
        <button class="close-btn" aria-label="Close">&times;</button>
      </div>

    </div>
    <div class="scrollable-div">
      <ul class="nav custom-fontsize flex-column px-2">
        <li>Main Menu</li>
        <li class="nav-item">
          <!-- <i class="fas fa-home"></i> -->
          <img src="{{ url('assets/images/Dashboard.png') }}">
          <a class="nav-link text-white" data-name="Dashboard" data-url="{{url('admin/dashboard')}}" href="{{url('admin/dashboard')}}">Dashboard</a>
        </li>
        <li class="nav-item">
          <!--  <i class="fas fa-briefcase"></i> -->
          <img src="{{ url('assets/images/Listing.png') }}">
          <a class="nav-link" data-name="Listings" data-url="{{route('all.listing')}}" href="{{route('all.listing')}}">Listings</a>
        </li>
        <li class="nav-item">
          <!-- <i class="fas fa-tasks"></i> -->
          <img src="{{ url('assets/images/Lead.png') }}">
          <a class="nav-link" data-name="Leads" data-url="{{route('all.lead')}}" href="{{route('all.lead')}}">Leads</a>
        </li>
        <li class="nav-item">
          <!-- <i class="fas fa-list"></i> -->
          <img src="{{ url('assets/images/Off-Esc-Close.png') }}">
          <a class="nav-link" data-name="Off/ Esc/ Close" data-url="#" href="{{route('all.offer')}}">Off/ Esc/ Close</a>
        </li>
        <li class="nav-item">
          <!-- <i class="fas fa-clock"></i> -->
          <img src="{{ url('assets/images/Agents.png') }}">
          <a class="nav-link" data-name="Agents" data-url="{{route('list.agent')}}" href="{{route('list.agent')}}">Agents</a>
        </li>
        <li class="nav-item">
          <!-- <i class="fas fa-exchange-alt"></i> -->
          <img src="{{ url('assets/images/Buyers.png') }}">
          <a class="nav-link" data-name="Buyers" data-url="#" href="{{route('list.buyer')}}">Buyers</a>
        </li>
        <li class="nav-item">
          <!-- <i class="fas fa-address-book"></i> -->
          <img src="{{ url('assets/images/Contacts.png') }}">
          <a class="nav-link" data-name="Contacts" data-url="#" href="#">Contacts</a>
        </li>
        <li class="nav-item">
          <!-- <i class="fas fa-calendar-alt"></i> -->
          <img src="{{ url('assets/images/Referrals.png') }}">
          <a class="nav-link" data-name="Referrals" data-url="#" href="#">Referrals</a>
        </li>
        <li class="nav-item">
          <!-- <i class="fas fa-calendar-alt"></i> -->
          <img src="{{ url('assets/images/Showings.png') }}">
          <a class="nav-link" data-name="Showings" data-url="#" href="#">Showings</a>
        </li>
      </ul>
      <ul class="nav custom-fontsize2 flex-column" style="margin-bottom: 30px;">
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
                <li class="nav-item">Email Buyer</li>
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
                <li class="nav-item">Prob Matches</li>
                <li class="nav-item">Criteria Rank</li>
                <li class="nav-item">Con / Ref Types</li>
                <li class="nav-item">Locales</li>
                <li class="nav-item">Categories</li>
                <li class="nav-item">Settings</li>
                <li class="nav-item">Change Pwd</li>
                <li class="nav-item">Login List</li>
              </ul>
            </div>
          </div>
        </div>
      </ul>
    </div>
  </div>