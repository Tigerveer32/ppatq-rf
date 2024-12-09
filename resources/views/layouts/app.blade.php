<!DOCTYPE html>

@if (\Request::is('rtl'))
  <html dir="rtl" lang="ar">
@else
  <html lang="en">
@endif

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('assets/img/apple-icon.png') }}">
  <link rel="icon" type="image/png" href="{{ asset('assets/img/favicon.png') }}">
  <title>PPATQ-Rf</title>
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
  <link href="{{ asset('assets/css/nucleo-icons.css') }}" rel="stylesheet" />
  <link href="{{ asset('assets/css/nucleo-svg.css') }}" rel="stylesheet" />
  <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
  <link id="pagestyle" href="{{ asset('assets/css/soft-ui-dashboard.css?v=1.0.3') }}" rel="stylesheet" />
  <link href="{{ asset('assets/css/dropdown.css') }}" rel="stylesheet" />

  <style>
    html, body {
      height: 100%;
      margin: 0;
    }

    body {
      display: flex;
      flex-direction: column;
    }

    .content {
      flex: 1; /* Memungkinkan konten untuk mengambil ruang yang tersisa */
    }

    .footer {
      background-color: #f8f9fa; /* Ganti sesuai dengan warna footer Anda */
      padding: 20px;
      text-align: center; /* Atur sesuai kebutuhan */
    }
    
    /* Styling untuk pesan sukses */
    .message-box {
      position: fixed;
      bottom: 20px;
      right: 20px;
      padding: 15px 25px;
      border-radius: 8px;
      font-size: 16px;
      color: #fff;
      max-width: 300px;
      z-index: 1000;
      display: flex;
      align-items: center;
      justify-content: space-between;
      box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
    }

    .message-box ul {
      margin: 0;
      padding: 0;
    }

    .message-box ul li {
      font-size: 14px;
      margin-bottom: 5px;
    }

    /* Styling untuk pesan error */
    .bg-success {
      background-color: #28a745;
    }

    .bg-danger {
      background-color: #dc3545;
    }
    
    /* Menambahkan animasi untuk munculnya pesan */
    .message-box {
      animation: fadeIn 0.5s ease-out;
    }

    @keyframes fadeIn {
      from {
        opacity: 0;
        transform: translateY(20px);
      }
      to {
        opacity: 1;
        transform: translateY(0);
      }
    }
  </style>
</head>

<body class="g-sidenav-show bg-gray-100 {{ (\Request::is('rtl') ? 'rtl' : (Request::is('virtual-reality') ? 'virtual-reality' : '')) }} ">
  @auth
    @yield('auth')
  @endauth
  @yield('tahfidz')
  @yield('santri')
  @yield('murobby')
  @guest
    @yield('guest')
  @endguest

  <div class="content">
  @if(session()->has('success'))
      <div x-data="{ show: true}"
          x-init="setTimeout(() => show = false, 4000)"
          x-show="show"
          class="message-box bg-success">
        <p class="m-0">{{ session('success')}}</p>
      </div>
    @endif

    <!-- Menampilkan pesan error jika ada -->
    @if ($errors->any())
      <div x-data="{ show: true}"
          x-init="setTimeout(() => show = false, 4000)"
          x-show="show"
          class="message-box bg-danger">
        <ul class="m-0">
          @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
          @endforeach
        </ul>
      </div>
    @endif

    <!-- Tambahkan konten utama Anda di sini -->
    <div>
      <!-- Konten Anda -->
    </div>
  </div>

  <footer class="footer">
  @include('layouts.footers.auth.footer')
  </footer>

  <script src="{{ asset('assets/js/core/popper.min.js') }}"></script>
  <script src="{{ asset('assets/js/core/bootstrap.min.js') }}"></script>
  <script src="{{ asset('assets/js/plugins/perfect-scrollbar.min.js') }}"></script>
  <script src="{{ asset('assets/js/plugins/smooth-scrollbar.min.js') }}"></script>
  <script src="{{ asset('assets/js/plugins/fullcalendar.min.js') }}"></script>
  <script src="{{ asset('assets/js/plugins/chartjs.min.js') }}"></script>
  @stack('rtl')
  @stack('dashboard')
  <script>
    var win = navigator.platform.indexOf('Win') > -1;
    if (win && document.querySelector('#sidenav-scrollbar')) {
      var options = {
        damping: '0.5'
      }
      Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
    }
  </script>
  <script async defer src="https://buttons.github.io/buttons.js"></script>
  <script src="{{ asset('assets/js/soft-ui-dashboard.min.js?v=1.0.3') }}"></script>
</body>

</html>