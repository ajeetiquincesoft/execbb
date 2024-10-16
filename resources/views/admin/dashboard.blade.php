@extends('admin.layout.master')

@section('content')
    <div class="container-fluid content bg-light">
      <h1>Electronic Broker Information System</h1>
      <p class="sub-heading">Administration Dashboard</p>
      <div class="row">
        <div class="col-sm-6 col-md-6 col-lg-4 col-xl-3 ">
          <div class="card view-data">
            <div>
              <h3>Active Listings</h3>
              <span>781</span>
            </div>
            <div><img src="{{ url('assets/images/Active-Listings.svg') }}"></div>
          </div>
        </div>

        <div class="col-sm-6 col-md-6 col-lg-4 col-xl-3">
          <div class="card view-data">
            <div>
              <h3>Total Agents</h3>
              <span>27</span>
            </div>
            <div><img src="{{ url('assets/images/Total-Agents.svg') }}"></div>
          </div>
        </div>

        <div class="col-sm-6 col-md-6 col-lg-4 col-xl-3">
          <div class="card view-data">
            <div>
              <h3>Total Buyers</h3>
              <span>37234</span>
            </div>
            <div><img src="{{ url('assets/images/Total-Buyers.svg') }}"></div>
          </div>
        </div>

        <div class="col-sm-6 col-md-6 col-lg-4 col-xl-3">
          <div class="card view-data">
            <div>
              <h3>Showings</h3>
              <span>1499</span>
            </div>
            <div><img src="{{ url('assets/images/Showings.svg') }}"></div>
          </div>
        </div>

        <div class="col-sm-6 col-md-6 col-lg-4 col-xl-3">
          <div class="card view-data">
            <div>
              <h3>Offers</h3>
              <span>125</span>
            </div>
            <div><img src="{{ url('assets/images/Offers.svg') }}"></div>
          </div>
        </div>

        <div class="col-sm-6 col-md-6 col-lg-4 col-xl-3">
          <div class="card view-data">
            <div>
              <h3>Total Leads</h3>
              <span>53</span>
            </div>
            <div><img src="{{ url('assets/images/Total-Leads.svg') }}"></div>
          </div>
        </div>

        <div class="col-sm-6 col-md-6 col-lg-4 col-xl-3">
          <div class="card view-data">
            <div>
              <h3>Closings</h3>
              <span>41</span>
            </div>
            <div><img src="{{ url('assets/images/Closings.svg') }}"></div>
          </div>
        </div>

        <div class="col-sm-6 col-md-6 col-lg-4 col-xl-3">
          <div class="card view-data">
            <div>
              <h3>Assigned</h3>
              <span>1784</span>
            </div>
            <div><img src="{{ url('assets/images/Assigned.svg') }}"></div>
          </div>
        </div>

      </div>
      <div class="row mt-1">
        <div class="col-md-6">
          <div class="card" style="height: 360px;">
            <div class="card-body">
              <p class="text-start text-5A102A">Overview</p>
              <canvas id="myChart"></canvas>
            </div>
          </div>
        </div>
        <div class="col-md-6">
          <div class="card" style="height: 360px;">
            <div class="card-body text-center">
              <p class="text-start text-5A102A">Active Listings</p>
              <h3 class="text-start text-5E5E5E">781</h3>
              <div class="d-flex justify-content-center align-items-center">
                <div class="legend-container">
                  <ul style="list-style-type: none; ">
                    <li><span style="color:#4C1A2A;">&#9679;</span> 75%</li>
                    <li><span style="color:#9D6B77;">&#9679;</span> 20%</li>
                    <li><span style="color:#D3B0B7;">&#9679;</span> 5%</li>
                  </ul>
                </div>
                <div class="chart-container" style="width: 100%; max-width: 300px;">
                  <canvas id="myDonutChart"></canvas>
                </div>

              </div>
            </div>
          </div>
        </div>

      </div>
    </div>
@endsection