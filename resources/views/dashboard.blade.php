@extends('layouts.user_type.auth')

@section('content')
<div class="container-fluid" style="background-image: url('../assets/img/curved-images/login.png'); background-size: cover; background-position: center;"></div>
  <div class="row">
    <!-- Card for Jumlah Santri -->
    <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
      <div class="card">
        <div class="card-body p-3">
          <div class="row">
            <div class="col-8">
              <div class="numbers">
                <p class="text-sm mb-0 text-capitalize font-weight-bold">Jumlah Santri</p>
                <h5 class="font-weight-bolder mb-0">
                  300
                </h5>
              </div>
            </div>
            <div class="col-4 text-end">
              <div class="icon icon-shape bg-primary text-white rounded-circle shadow">
                <i class="ni ni-hat-3"></i>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Card for Jumlah Sudah Bayar Bulan Ini -->
    <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
      <div class="card">
        <div class="card-body p-3">
          <div class="row">
            <div class="col-8">
              <div class="numbers">
                <p class="text-sm mb-0 text-capitalize font-weight-bold">Sudah Bayar Bulan Ini</p>
                <h5 class="font-weight-bolder mb-0">
                  250
                </h5>
              </div>
            </div>
            <div class="col-4 text-end">
              <div class="icon icon-shape bg-success text-white rounded-circle shadow">
                <i class="ni ni-check-bold"></i>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Card for Jumlah Pegawai -->
    <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
      <div class="card">
        <div class="card-body p-3">
          <div class="row">
            <div class="col-8">
              <div class="numbers">
                <p class="text-sm mb-0 text-capitalize font-weight-bold">Jumlah Pegawai</p>
                <h5 class="font-weight-bolder mb-0">
                  96
                </h5>
              </div>
            </div>
            <div class="col-4 text-end">
              <div class="icon icon-shape bg-warning text-white rounded-circle shadow">
                <i class="ni ni-single-02"></i>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Card for Santri Belum Melaporkan Pembayaran -->
    <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
      <div class="card">
        <div class="card-body p-3">
          <div class="row">
            <div class="col-8">
              <div class="numbers">
                <p class="text-sm mb-0 text-capitalize font-weight-bold">Belum Melaporkan Pembayaran</p>
                <h5 class="font-weight-bolder mb-0">
                  50
                </h5>
              </div>
            </div>
            <div class="col-4 text-end">
              <div class="icon icon-shape bg-danger text-white rounded-circle shadow">
                <i class="ni ni-fat-remove"></i>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>



@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
<script>
  var options = {
    series: [{
      name: 'Jumlah',
      data: [250, 50]
    }],
    chart: {
      type: 'bar',
      height: 350
    },
    plotOptions: {
      bar: {
        horizontal: false,
        columnWidth: '55%',
        endingShape: 'rounded'
      },
    },
    dataLabels: {
      enabled: false
    },
    stroke: {
      show: true,
      width: 2,
      colors: ['transparent']
    },
    xaxis: {
      categories: ['Sudah Bayar', 'Belum Bayar'],
    },
    yaxis: {
      title: {
        text: 'Jumlah'
      }
    },
    fill: {
      opacity: 1
    },
    tooltip: {
      y: {
        formatter: function (val) {
          return val + " santri"
        }
      }
    }
  };

  var chart = new ApexCharts(document.querySelector("#chart"), options);
  chart.render();
</script>
@endsection
