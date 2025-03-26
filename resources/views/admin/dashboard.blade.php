@extends('admin.layout.master')

@section('content')
    <div class="container-fluid content bg-light">
      <h1>Electronic Broker Information System</h1>
      <p class="sub-heading">Administration Dashboard</p>
      <div class="row">
        <div class="col-sm-6 col-md-6 col-lg-4 col-xl-3 ">
          <div class="card view-data">
            <div>
              <h3>Total Listings</h3>
              <span>{{$listings}}</span>
            </div>
            <div><img src="{{ url('assets/images/Active-Listings.svg') }}"></div>
          </div>
        </div>

        <div class="col-sm-6 col-md-6 col-lg-4 col-xl-3">
          <div class="card view-data">
            <div>
              <h3>Total Agents</h3>
              <span>{{$agents}}</span>
            </div>
            <div><img src="{{ url('assets/images/Total-Agents.svg') }}"></div>
          </div>
        </div>

        <div class="col-sm-6 col-md-6 col-lg-4 col-xl-3">
          <div class="card view-data">
            <div>
              <h3>Total Buyers</h3>
              <span>{{$buyers}}</span>
            </div>
            <div><img src="{{ url('assets/images/Total-Buyers.svg') }}"></div>
          </div>
        </div>

        <div class="col-sm-6 col-md-6 col-lg-4 col-xl-3">
          <div class="card view-data">
            <div>
              <h3>Showings</h3>
              <span>{{$showings}}</span>
            </div>
            <div><img src="{{ url('assets/images/Showings.svg') }}"></div>
          </div>
        </div>

        <div class="col-sm-6 col-md-6 col-lg-4 col-xl-3">
          <div class="card view-data">
            <div>
              <h3>Offers</h3>
              <span>{{$offers}}</span>
            </div>
            <div><img src="{{ url('assets/images/Offers.svg') }}"></div>
          </div>
        </div>

        <div class="col-sm-6 col-md-6 col-lg-4 col-xl-3">
          <div class="card view-data">
            <div>
              <h3>Total Leads</h3>
              <span>{{$leads}}</span>
            </div>
            <div><img src="{{ url('assets/images/Total-Leads.svg') }}"></div>
          </div>
        </div>

        <div class="col-sm-6 col-md-6 col-lg-4 col-xl-3">
          <div class="card view-data">
            <div>
              <h3>Closings</h3>
              <span>{{$closeListings}}</span>
            </div>
            <div><img src="{{ url('assets/images/Closings.svg') }}"></div>
          </div>
        </div>

        <div class="col-sm-6 col-md-6 col-lg-4 col-xl-3">
          <div class="card view-data">
            <div>
              <h3>Assigned</h3>
              <span>{{$assignListings}}</span>
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
              <p class="text-start text-5A102A">Total Listings</p>
              <h3 class="text-start text-5E5E5E">{{$listings}}</h3>
              <div class="d-flex justify-content-center align-items-center">
                <div class="legend-container">
                  <ul style="list-style-type: none; ">
                    <li><span style="color:#4C1A2A;">&#9679;</span>{{number_format($activeListingsPercentage, 2) . '%'}}</li>
                    <li><span style="color:#D3B0B7;">&#9679;</span>{{number_format($inactiveListingsPercentage, 2) . '%'}}</li>
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
    <script>
      // Line Chart
const ctx1 = document.getElementById('myChart').getContext('2d');
const myChart = new Chart(ctx1, {
    type: 'line',
    data: {!! json_encode($lineChartData) !!},
    options: {
        responsive: true,
        plugins: {
            legend: { display: false }
        },
        scales: { 
             y: { 
                beginAtZero: true, 
                min: 0,   // Set the minimum value to 0
                max: 100,
                ticks: { stepSize: 20 } 
            }
        }
    }
});

// Donut Chart
const ctx2 = document.getElementById('myDonutChart').getContext('2d');
const myDonutChart = new Chart(ctx2, {
    type: 'doughnut',
    data: {!! json_encode($donutChartData) !!},
    options: {
        cutout: '70%',
        responsive: true,
        maintainAspectRatio: false, 
        plugins: {
            legend: { display: false }
        }
    }
});
      </script>
@endsection