<div id="sidebar" class=" text-white">
    <div class="position-relative img-bg ">
      <div class="p-3">
        <img class="sidebar-logo" src="{{ url('assets/images/SidebarLogo.png') }}" alt="">
        <button class="close-btn" aria-label="Close">&times;</button>
      </div>

    </div>
    <div class="scrollable-div">
      <ul class="nav custom-fontsize flex-column px-2">
        <li>Main Menu</li>
        <li class="nav-item activenavitem">
          <!-- <i class="fas fa-home"></i> -->
          <img src="{{ url('assets/images/Dashboard.png') }}">
          <a class="nav-link text-white" href="#">Dashboard</a>
        </li>
        <li class="nav-item">
          <!-- <i class="fas fa-exchange-alt"></i> -->
          <img src="{{ url('assets/images/Buyers.png') }}">
          <a class="nav-link" href="#">Buyers</a>
        </li>
        <li class="nav-item">
          <!--  <i class="fas fa-briefcase"></i> -->
          <img src="{{ url('assets/images/Listing.png') }}">
          <a class="nav-link" href="#">Listings</a>
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
                <li class="nav-item">Report Item 1</li>
                <li class="nav-item">Report Item 1</li>
                <li class="nav-item">Report Item 1</li>
              </ul>
            </div>
          </div>
        </div>

        <div class="accordion-item px-2">
          <button id="reportAccordionButton" style="background-color: #93744B; padding: 11px 13px;"
            class="accordion-button default text-end" type="button" data-bs-toggle="collapse"
            data-bs-target="#collapsetwo" aria-expanded="true" aria-controls="collapseOne">
            Report
          </button>
          <div id="collapsetwo" class="accordion-collapse collapse " aria-labelledby="headingOne"
            data-bs-parent="#accordionExample">
            <div class="accordion-body">
              <ul class="acc-list" style="list-style-type: none; padding: 0;">
                <li class="nav-item">Report Item 1</li>
                <li class="nav-item">Report Item 1</li>
                <li class="nav-item">Report Item 1</li>
              </ul>
            </div>
          </div>
        </div>
      </ul>
    </div>
  </div>