<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('assets/img/apple-icon.png') }}" />
  <link rel="icon" type="image/png" href="{{ asset('assets/img/favicon.png') }}" />
  <title>Money Management</title>

  <!-- Fonts and icons -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />

  <!-- Font Awesome Icons -->
  <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>

  <!-- Nucleo Icons -->
  <link href="{{ asset('assets/css/nucleo-icons.css') }}" rel="stylesheet" />
  <link href="{{ asset('assets/css/nucleo-svg.css') }}" rel="stylesheet" />

  <!-- Tailwind CDN should be at the end -->
  <link href="https://cdn.jsdelivr.net/npm/tailwindcss@3.3.2/dist/tailwind.min.css" rel="stylesheet">

  <!-- Popper -->
  <script src="https://unpkg.com/@popperjs/core@2"></script>

  <!-- Main Styling -->
  <link href="{{ asset('assets/css/soft-ui-dashboard-tailwind.css?v=1.0.5') }}" rel="stylesheet" />

  <!-- Nepcha Analytics (nepcha.com) -->
  <script defer data-site="YOUR_DOMAIN_HERE" src="https://api.nepcha.com/js/nepcha-analytics.js"></script>

  <style>
    /* Active class for the currently selected menu item */
    .active {
      background: linear-gradient(135deg, #7F5AF0 0%, #6246EA 100%);
      color: #FFF;
      box-shadow: 0px 8px 20px rgba(0, 0, 0, 0.15);
      border-radius: 12px;
      transition: all 0.4s ease-in-out;

    }

    .active:hover {
      transform: scale(1.08);
      background: linear-gradient(135deg, #4ADEDE 0%, #2D9CDB 100%);
    }

    /* Ensure the SVG icon remains black in the active state */
    .active svg {
      fill: #000;
    }

    /* Default state for the menu links */
    .menu-link {
      color: #444;
      transition: color 0.3s ease-in-out;
    }

    /* Normal li hover effect */
    li:hover {
      background-color: #F0F0F0;
      /* Light grey background on hover */
      border-radius: 12px;
      /* Add rounded corners on hover */
      transition: background-color 0.3s ease-in-out;
      /* Smooth transition */
    }

    /* Make sure SVG icons stay black for non-active li elements */
    li:hover svg {
      fill: #000;
      /* Black icon on hover */
    }
  </style>

</head>

<body class="m-0 font-sans text-base antialiased font-normal leading-default bg-gray-50 text-slate-500">
  <!-- sidenav  -->
  @include('layout.aside')

  <main class="ease-soft-in-out xl:ml-68.5 relative h-full max-h-screen rounded-xl transition-all duration-200">
    <!-- Navbar -->
    @include('layout.nav')
    <!-- cards -->
    <div class="w-full px-6 py-6 mx-auto">

      @yield('content')

      @include('layout.footer')
    </div>
    <!-- end cards -->
  </main>
</body>
<!-- plugin for charts  -->
<script src="{{('./assets/js/plugins/chartjs.min.js')}}" async></script>
<!-- plugin for scrollbar  -->
<script src="{{('./assets/js/plugins/perfect-scrollbar.min.js')}}" async></script>
<!-- github button -->
<script async defer src="https://buttons.github.io/buttons.js"></script>
<!-- main script file  -->
<script src="{{('./assets/js/soft-ui-dashboard-tailwind.js?v=1.0.5')}}" async></script>

</html>