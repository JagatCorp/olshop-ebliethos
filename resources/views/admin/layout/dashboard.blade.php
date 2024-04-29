<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="description" content="Ekka - Admin Dashboard eCommerce HTML Template.">

    <title>@yield('title')| Ebliethos</title>

    <!-- GOOGLE FONTS -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Montserrat:wght@200;300;400;500;600;700;800&family=Poppins:wght@300;400;500;600;700;800;900&family=Roboto:wght@400;500;700;900&display=swap"
        rel="stylesheet">

    <link href="https://cdn.materialdesignicons.com/4.4.95/css/materialdesignicons.min.css" rel="stylesheet" />

    <!-- PLUGINS CSS STYLE -->
    <link href="{{ asset('assets-admin') }}/plugins/daterangepicker/daterangepicker.css" rel="stylesheet">
    <link href="{{ asset('assets-admin') }}/plugins/simplebar/simplebar.css" rel="stylesheet" />

    <!-- Ekka CSS -->
    <link id="ekka-css" href="{{ asset('assets-admin') }}/css/ekka.css" rel="stylesheet" />

    <!-- FAVICON -->
    <link rel="icon" href="{{ asset('/images/ebli2.png') }}" sizes="32x32" />
    <link rel="apple-touch-icon" href="{{ asset('/images/ebli2.png') }}" />
    <meta name="msapplication-TileImage" content="{{ asset('/images/ebli2.png') }}" />



    <!-- Data Tables -->
    <link href="{{ asset('assets-admin') }}/plugins/data-tables/datatables.bootstrap5.min.css" rel='stylesheet'>
    <link href="{{ asset('assets-admin') }}/plugins/data-tables/responsive.datatables.min.css" rel='stylesheet'>
    <!-- Font Awsome iCon Kit Script -->
    <script src="https://kit.fontawesome.com/5488d9796f.js" crossorigin="anonymous"></script>
    @stack('style-alt')
    
      <meta name="csrf-token" content="{{ csrf_token() }}">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
    <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>

</head>

<body class="ec-header-fixed ec-sidebar-fixed ec-sidebar-light ec-header-light" id="body">

    <!--  WRAPPER  -->
    <div class="wrapper">
        @include('sweetalert::alert')

        <!-- LEFT MAIN SIDEBAR -->
        @include('admin.layout.sidebar')

        <!--  PAGE WRAPPER -->
        <div class="ec-page-wrapper">

            <!-- Header -->
            @include('admin.layout.header')

            <!-- CONTENT WRAPPER -->
            <div class="ec-content-wrapper">

                @yield('content')
            </div> <!-- End Content Wrapper -->

            <!-- Footer -->
            @include('admin.layout.footer')
        </div> <!-- End Page Wrapper -->
    </div> <!-- End Wrapper -->

    <!-- Common Javascript -->
    <!-- <script src="{{ asset('assets-admin') }}/plugins/jquery/jquery-3.5.1.min.js"></script>
<script src="{{ asset('assets-admin') }}/js/bootstrap.bundle.min.js"></script>
<script src="{{ asset('assets-admin') }}/plugins/simplebar/simplebar.min.js"></script>
<script src="{{ asset('assets-admin') }}/plugins/jquery-zoom/jquery.zoom.min.js"></script>
<script src="{{ asset('assets-admin') }}/plugins/slick/slick.min.js"></script> -->

    <!-- Chart -->
    <!-- <script src="{{ asset('assets-admin') }}/plugins/charts/Chart.min.js"></script>
<script src="{{ asset('assets-admin') }}/js/chart.js"></script> -->

    <!-- Google map chart -->
    <!-- <script src="{{ asset('assets-admin') }}/plugins/charts/google-map-loader.js"></script>
<script src="{{ asset('assets-admin') }}/plugins/charts/google-map.js"></script> -->

    <!-- Date Range Picker -->
    <!-- <script src="{{ asset('assets-admin') }}/plugins/daterangepicker/moment.min.js"></script>
<script src="{{ asset('assets-admin') }}/plugins/daterangepicker/daterangepicker.js"></script>
<script src="{{ asset('assets-admin') }}/js/date-range.js"></script> -->

    <!-- Option Switcher -->
    <!-- <script src="{{ asset('assets-admin') }}/plugins/options-sidebar/optionswitcher.js"></script> -->

    <!-- Ekka Custom -->
    <!-- <script src="{{ asset('assets-admin') }}/js/ekka.js"></script> -->


    <!-- Common Javascript -->
    <script src="{{ asset('assets-admin') }}/plugins/jquery/jquery-3.5.1.min.js"></script>
    <script src="{{ asset('assets-admin') }}/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('assets-admin') }}/plugins/simplebar/simplebar.min.js"></script>
    <script src="{{ asset('assets-admin') }}/plugins/jquery-zoom/jquery.zoom.min.js"></script>
    <script src="{{ asset('assets-admin') }}/plugins/slick/slick.min.js"></script>

    <!-- Data Tables -->
    <script src="{{ asset('assets-admin') }}/plugins/data-tables/jquery.datatables.min.js"></script>
    <script src="{{ asset('assets-admin') }}/plugins/data-tables/datatables.bootstrap5.min.js"></script>
    <script src="{{ asset('assets-admin') }}/plugins/data-tables/datatables.responsive.min.js"></script>

    <!-- Option Switcher -->
    <script src="{{ asset('assets-admin') }}/plugins/options-sidebar/optionswitcher.js"></script>

    <!-- Ekka Custom -->
    <script src="{{ asset('assets-admin') }}/js/ekka.js"></script>
    <script src="https://cdn.ckeditor.com/ckeditor5/41.0.0/classic/ckeditor.js"></script>

    @stack('script-alt')
    @yield('ckeditor')
</body>

</html>
