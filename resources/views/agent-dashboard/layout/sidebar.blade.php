<div id="sidebar" class=" text-white">
  <div class="position-relative img-bg ">
    <div class="p-3">
      <a href="{{url('agent/dashboard')}}"><img class="sidebar-logo" src="{{ url('assets/images/main_logo.png') }}" alt=""></a>
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
                <a class="nav-link text-white" data-name="Dashboard" data-url="{{url('agent/dashboard')}}" href="{{url('agent/dashboard')}}">Dashboard</a>
              </li>
              <li class="nav-item {{ request()->routeIs('agent.list.buyer') || request()->routeIs('agent.show.buyer') ? 'activenavitem' : '' }}">
                <img src="{{ url('assets/images/Buyers.png') }}">
                <a class="nav-link" href="{{route('agent.list.buyer')}}">Buyers</a>
              </li>
              <li class="nav-item {{ request()->routeIs('agent.all.listing') || request()->routeIs('agent.listing.form') || request()->routeIs('agent.edit.listing.form') || request()->routeIs('agent.show.listing') ? 'activenavitem' : '' }}">
                <img src="{{ url('assets/images/Listing.png') }}">
                <a class="nav-link" href="{{route('agent.all.listing')}}">Listings</a>
              </li>
              <li class="nav-item {{ request()->routeIs('agent.all.leads') || request()->routeIs('agent.show.lead') ? 'activenavitem' : '' }}">
                <img src="{{ url('assets/images/Lead.png') }}">
                <a class="nav-link" href="{{route('agent.all.leads')}}">Leads</a>
              </li>
              <li class="nav-item {{ request()->routeIs('agent.buyer.listing.visit') ? 'activenavitem' : '' }}"><img src="{{ url('assets/images/Buyers.png') }}"><a class="nav-link" href="{{route('agent.buyer.listing.visit')}}">Buyer Visit</a></li>
              <li class="nav-item {{ request()->routeIs('agent.all.message.info') ? 'activenavitem' : '' }}"><img src="{{ url('assets/images/Buyers.png') }}"><a class="nav-link" href="{{route('agent.all.message.info')}}">Messages</a></li>
              <li class="nav-item {{ request()->routeIs('agent.buyer.referrals.list') ? 'activenavitem' : '' }}"><img src="{{ url('assets/images/Referrals.png') }}"><a class="nav-link" href="{{route('agent.buyer.referrals.list')}}">Referral</a></li>
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
              <li class="nav-item {{ request()->routeIs('agent.reports') ? 'activenavitem' : '' }}"><a class="nav-link-dropdown" href="{{route('agent.reports')}}">Reports</a></li>
              <li class="nav-item {{ request()->routeIs('agent.email.buyer') ? 'activenavitem' : '' }}"><a class="nav-link-dropdown" href="{{route('agent.email.buyer')}}">Email Buyer</a></li>
             
              <li class="nav-item"><a class="nav-link-dropdown" href="{{route('agent.download.hotsheet')}}">Download Hotsheet</a></li>
              
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
              <li class="nav-item {{ request()->routeIs('agent.reset.password') ? 'activenavitem' : '' }}">
                <a class="nav-link-dropdown" href="{{route('agent.reset.password')}}">Reset Pwd</a>
              </li>
              <li class="nav-item {{ request()->routeIs('agent.login.activities') ? 'activenavitem' : '' }}">
                <a class="nav-link-dropdown" href="{{route('agent.login.activities')}}">Login List</a>
              </li>
            </ul>
          </div>
        </div>
      </div>
    </ul>
  </div>
</div>