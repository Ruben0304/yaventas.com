<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">



  <!--     Fonts and icons     -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
  <!-- Nucleo Icons -->
  <link href="assets/css/nucleo-icons.css" rel="stylesheet" />
  <link href="assets/css/nucleo-svg.css" rel="stylesheet" />
  <!-- Font Awesome Icons -->
  <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
  <link href="assets/pedidos/css/nucleo-svg.css" rel="stylesheet" />
  <!-- CSS Files -->
  <link id="pagestyle" href="assets/pedidos/css/soft-ui-dashboard.css?v=1.0.3" rel="stylesheet" />

  <style>
    .form-group{
        width: 40%;
    }
    .formularios{
      margin-left:5%;
    }
#tablita{
    width: 100%;
}
@media (max-width: 640px){
  .pedidos{
        margin-left: 0px;
        margin-right: 0px;
        padding: 0px;
    }
    }

  </style>

<body>
    <div class="col-lg-8 col-md-6 mb-md-0 mb-4" id="tablita">

          <div class="card-body px-0 pb-2">
            <div class="table-responsive">
              <table class="table align-items-center mb-0">
                <thead>
                  <tr>
                    {{-- <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Companies</th> --}}
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Productos</th>
                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Total</th>
                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Estado</th>
                  </tr>
                </thead>
                <tbody>
                @foreach ($ordenes as $orden)
                    <tr>
                        <td>
                            <div class="avatar-group mt-2">
                                @foreach ($orden->ordersDetails as $detalle)
                                    @if ($detalle->producto) <!-- Verifica si producto no es null -->
                                    <a href="{{ route('detalles', ['id' => $detalle->producto->id]) }}" target="_parent"
                                       class="avatar avatar-xs rounded-circle" data-bs-toggle="tooltip"
                                       data-bs-placement="bottom" title="{{ $detalle->producto->nombre }}">
                                        <img src="{{ $detalle->producto->foto }}" alt="{{ $detalle->producto->nombre }}"
                                             style="width: 30px; height: 30px;">
                                    </a>
                                    @endif
                                @endforeach
                            </div>
                        </td>

                        <td class="align-middle text-center text-sm">
                            <span class="text-xs font-weight-bold"> ${{ $orden->total }} </span>
                        </td>

                        <td class="align-middle">
                            <div class="progress-wrapper w-75 mx-auto">
                                <div class="progress-info">
                                    <div class="progress-percentage">
                                        <span class="text-xs font-weight-bold">{{ $orden->estado }}</span>
                                    </div>
                                </div>

                                <div class="progress">
                                    @php
                                        // Determina el ancho de la barra de progreso en función del estado
                                        $progressWidth = match($orden->estado) {
                                            'Procesando' => '40%',
                                            'Completado' => '100%',
                                            default => '0%'
                                        };
                                        $progressClass = $orden->estado === 'Completado' ? 'bg-gradient-success' : 'bg-gradient-info';
                                    @endphp

                                    <div class="progress-bar {{ $progressClass }} w-{{ $progressWidth }}" role="progressbar"
                                         aria-valuenow="{{ trim($progressWidth, '%') }}" aria-valuemin="0" aria-valuemax="100">
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                @endforeach


                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>


    <script src="assets/pedidos/js/core/popper.min.js"></script>
<script src="assets/pedidos/js/core/bootstrap.min.js"></script>
<script src="assets/pedidos/js/plugins/perfect-scrollbar.min.js"></script>
<script src="assets/pedidos/js/plugins/smooth-scrollbar.min.js"></script>
<script src="assets/pedidos/js/plugins/chartjs.min.js"></script>
<script>
var ctx = document.getElementById("chart-bars").getContext("2d");

new Chart(ctx, {
  type: "bar",
  data: {
    labels: ["Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
    datasets: [{
      label: "Sales",
      tension: 0.4,
      borderWidth: 0,
      borderRadius: 4,
      borderSkipped: false,
      backgroundColor: "#fff",
      data: [450, 200, 100, 220, 500, 100, 400, 230, 500],
      maxBarThickness: 6
    }, ],
  },
  options: {
    responsive: true,
    maintainAspectRatio: false,
    plugins: {
      legend: {
        display: false,
      }
    },
    interaction: {
      intersect: false,
      mode: 'index',
    },
    scales: {
      y: {
        grid: {
          drawBorder: false,
          display: false,
          drawOnChartArea: false,
          drawTicks: false,
        },
        ticks: {
          suggestedMin: 0,
          suggestedMax: 500,
          beginAtZero: true,
          padding: 15,
          font: {
            size: 14,
            family: "Open Sans",
            style: 'normal',
            lineHeight: 2
          },
          color: "#fff"
        },
      },
      x: {
        grid: {
          drawBorder: false,
          display: false,
          drawOnChartArea: false,
          drawTicks: false
        },
        ticks: {
          display: false
        },
      },
    },
  },
});


var ctx2 = document.getElementById("chart-line").getContext("2d");

var gradientStroke1 = ctx2.createLinearGradient(0, 230, 0, 50);

gradientStroke1.addColorStop(1, 'rgba(203,12,159,0.2)');
gradientStroke1.addColorStop(0.2, 'rgba(72,72,176,0.0)');
gradientStroke1.addColorStop(0, 'rgba(203,12,159,0)'); //purple colors

var gradientStroke2 = ctx2.createLinearGradient(0, 230, 0, 50);

gradientStroke2.addColorStop(1, 'rgba(20,23,39,0.2)');
gradientStroke2.addColorStop(0.2, 'rgba(72,72,176,0.0)');
gradientStroke2.addColorStop(0, 'rgba(20,23,39,0)'); //purple colors

new Chart(ctx2, {
  type: "line",
  data: {
    labels: ["Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
    datasets: [{
        label: "Mobile apps",
        tension: 0.4,
        borderWidth: 0,
        pointRadius: 0,
        borderColor: "#cb0c9f",
        borderWidth: 3,
        backgroundColor: gradientStroke1,
        fill: true,
        data: [50, 40, 300, 220, 500, 250, 400, 230, 500],
        maxBarThickness: 6

      },
      {
        label: "Websites",
        tension: 0.4,
        borderWidth: 0,
        pointRadius: 0,
        borderColor: "#3A416F",
        borderWidth: 3,
        backgroundColor: gradientStroke2,
        fill: true,
        data: [30, 90, 40, 140, 290, 290, 340, 230, 400],
        maxBarThickness: 6
      },
    ],
  },
  options: {
    responsive: true,
    maintainAspectRatio: false,
    plugins: {
      legend: {
        display: false,
      }
    },
    interaction: {
      intersect: false,
      mode: 'index',
    },
    scales: {
      y: {
        grid: {
          drawBorder: false,
          display: true,
          drawOnChartArea: true,
          drawTicks: false,
          borderDash: [5, 5]
        },
        ticks: {
          display: true,
          padding: 10,
          color: '#b2b9bf',
          font: {
            size: 11,
            family: "Open Sans",
            style: 'normal',
            lineHeight: 2
          },
        }
      },
      x: {
        grid: {
          drawBorder: false,
          display: false,
          drawOnChartArea: false,
          drawTicks: false,
          borderDash: [5, 5]
        },
        ticks: {
          display: true,
          color: '#b2b9bf',
          padding: 20,
          font: {
            size: 11,
            family: "Open Sans",
            style: 'normal',
            lineHeight: 2
          },
        }
      },
    },
  },
});
</script>
<script>
var win = navigator.platform.indexOf('Win') > -1;
if (win && document.querySelector('#sidenav-scrollbar')) {
  var options = {
    damping: '0.5'
  }
  Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
}
</script>
<!-- Github buttons -->
<script async defer src="https://buttons.github.io/buttons.js"></script>
<!-- Control Center for Soft Dashboard: parallax effects, scripts for the example pages etc -->
<script src="assets/pedidos/js/soft-ui-dashboard.min.js?v=1.0.3"></script>
</body>
</html>
