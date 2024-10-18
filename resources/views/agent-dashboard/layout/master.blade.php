<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <title>Executive Business Brokers</title>
  <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@400;500;700&display=swap" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap" rel="stylesheet">
  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  {!! Html::style('assets/css/custom.css') !!}
  {!! Html::style('assets/css/main.css') !!}
  <!-- jQuery and Bootstrap JS -->
  <style>
    .accordion-button.collapsed {
      background: white;
      color: #000;
      /* Optional: Change the text color to black for better contrast */
    }

    .accordion-button.collapsed::after {
      background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 16 16' fill='%23fff'%3e%3cpath fill-rule='evenodd' d='M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z'/%3e%3c/svg%3e");
    }

    .accordion-button.collapsed::before {
      background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 16 16' fill='%23fff'%3e%3cpath fill-rule='evenodd' d='M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z'/%3e%3c/svg%3e");
    }
  </style>

</head>

<body>
  <!-- Sidebar -->
  @include('agent-dashboard.layout.sidebar')

  <!-- Content -->
  <div id="content">
   <!--header section-->
    @include('agent-dashboard.layout.header')
   <!--end header section-->
   <!--start content section-->
    @yield('content')
    <!--end contant section-->
    <!--footer section start-->
    @include('agent-dashboard.layout.footer')
    <!--end footer section-->
  </div>


  <!-- Bootstrap JS and Popper.js -->
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

  <!-- Custom JS -->
  <script>
    document.getElementById('sidebarToggle').addEventListener('click', function () {
      document.getElementById('sidebar').classList.toggle('collapsed');
      document.getElementById('content').classList.toggle('collapsed');
    });

    document.addEventListener('DOMContentLoaded', function () {
      document.querySelector('.close-btn').addEventListener('click', function () {
        document.getElementById('sidebar').classList.toggle('collapsed');
        document.getElementById('content').classList.toggle('collapsed');
      });
    });

    const ctx1 = document.getElementById('myChart').getContext('2d');
    const myChart = new Chart(ctx1, {
      type: 'line',
      data: {
        labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
        datasets: [{
          label: 'Dataset 1',
          data: [200, 300, 500, 700, 600, 900, 800, 1200, 1100, 1300, 1000, 1400],
          borderColor: '#965a3e',
          fill: false,
          tension: 0.4,
        }, {
          label: 'Dataset 2',
          data: [150, 250, 400, 600, 550, 850, 750, 1100, 1000, 1250, 900, 1300],
          borderColor: '#cccccc',
          fill: false,
          tension: 0.4,
        }]
      },
      options: {
        responsive: true,
        plugins: {
          legend: { display: false }
        },
        scales: { y: { beginAtZero: true, ticks: { stepSize: 200 } } }
      }
    });

    const ctx2 = document.getElementById('myDonutChart').getContext('2d');
    const myDonutChart = new Chart(ctx2, {
      type: 'doughnut',
      data: {
        labels: ['75%', '20%', '5%'],
        datasets: [{
          data: [75, 20, 5],
          backgroundColor: ['#4b0a26', '#b0848c', '#e3c8cb'],
        }]
      },
      options: {
        cutout: '70%',
        responsive: true,
        maintainAspectRatio: false, // Makes the chart responsive to size changes
        plugins: {
          legend: { display: false }
        }
      }
    });

  </script>
</body>
</html>