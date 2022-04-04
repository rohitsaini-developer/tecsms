<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="title" content="Tecsms">
        <meta name="description" content="Web software or application to manage purchase sms packages and get credits in the wallet">
        <meta name="keywords" content="sms package management, payment, sms, package management, online software, online web application, web application">
        <meta name="robots" content="index, follow">
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <meta name="language" content="English">
        <title>{{ pageTitle() }} | {{ config('app.name', 'Laravel') }}</title>
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500&display=swap" rel="stylesheet">
        <link rel="shortcut icon" href="{{ asset(getSettingDetail('favicon')->value) }}">
        <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
        <link rel="stylesheet" href="{{ asset('plugins/fontawesome/css/fontawesome.min.css')}}">
        <link rel="stylesheet" href="{{ asset('plugins/fontawesome/css/all.min.css') }}">
        <link rel="stylesheet" href="{{ asset('css/style.css') }}">
        <link href="//cdnjs.cloudflare.com/ajax/libs/select2/4.0.0/css/select2.min.css" rel="stylesheet" />
        <!-- Datatable -->
        <link rel="stylesheet" href="{{ asset('plugins/datatables/datatables.min.css') }}">
        <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.dataTables.min.css">

        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <style>
            .select2-container .select2-selection--single {
                background: #ffffff;
                padding: 10px 20px;
                font-size: 14px;
                border-color: #ced4da;
                height: 43px;
            }
            .select2-container .select2-selection--single .select2-selection__rendered {
                line-height: 20px;
                padding: 0;
            }
            .select2-container .select2-selection--single .select2-selection__arrow {
                height: 41px;
            }
        </style>
        @yield('styles')
    </head>
<body>
    <div class="main-wrapper">
        <!-- [ Header ] start -->
        @include('admin.partials.header')
        <!-- [ Header ] end -->

        <!-- [Sidebar] start -->
        @include('admin.partials.sidebar')
        <!-- [Sidebar] end -->

        <!-- [ Main Content ] start -->
        @yield("content")
        <!-- [ Main Content ] end -->
    </div>

    <!-- Required Js -->
    <script src="{{ asset('js/jquery-3.6.0.min.js') }}"></script>
    <script src="{{ asset('js/popper.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('js/feather.min.js') }}"></script>
    <script src="{{ asset('plugins/slimscroll/jquery.slimscroll.min.js') }}"></script>
    <script src="{{ asset('js/script.js') }}"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.8/js/select2.min.js" defer></script>

    <!-- Datatables -->
    <script src="{{ asset('vendor/datatables/buttons.server-side.js')}}"></script>
    <script src="https://cdn.datatables.net/buttons/1.6.1/js/dataTables.buttons.min.js"></script>

    <script src="{{ URL::asset('plugins/slimscroll/jquery.slimscroll.min.js') }}"></script>
    <script src="{{ URL::asset('plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ URL::asset('plugins/datatables/datatables.min.js') }}"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>
    <!-- End Datatables -->

    <script>
        $(document).ready(function() {
            $('.select2').select2();
            $(".nav-item").on('click', function(){

                var active_tab_id = $(this).find('.has-ripple.active').attr('href')
                $('#last_tab').val(active_tab_id);
                checkvalidation();
            });

            $('a[data-toggle="tab"]').on('shown.bs.tab', function(e) {
                localStorage.setItem('activeTab', $(e.target).attr('href'));
            });

            var activeTab = "{{ session()->get('_old_input')['active_tab'] ?? 'site' }}";

            if (activeTab) {
                $('#settingsGroupTab a[href="'+ activeTab +'"]').tab('show');
                $(this).parent('.tab-pane').addClass('active').siblings().removeClass('active');
            }

        });
        function checkvalidation(){
            var tabval = $('.has-ripple.active').attr('data-active');
            $(".setval").val(tabval);
        }
    </script>
    
    @yield('scripts')
</body>

</html>