<!DOCTYPE html>
<html lang="en" data-layout-mode="light_mode">

<head>

    <!-- Meta Tags -->
    <base href="/public">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content=".">
    <meta name="keywords" content="">
    <meta name="robots" content="index, follow">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $pageTitle ?? 'Property Management' }}</title>

    <link rel="shortcut icon" href="{{ asset('assets/img/favicon.png') }}" type="image/x-icon">

    <script src="{{asset('dashboard_assets/js/theme-script.js')}}" type=""></script>


    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{ asset('dashboard_assets/css/bootstrap.min.css') }}">

    <!-- Datetimepicker CSS -->
    <link rel="stylesheet" href="{{ asset('dashboard_assets/css/bootstrap-datetimepicker.min.css') }}">

    <!-- animation CSS -->
    <link rel="stylesheet" href="{{ asset('dashboard_assets/css/animate.css') }}">

    <!-- Select2 CSS -->
    <link rel="stylesheet" href="{{ asset('dashboard_assets/plugins/select2/css/select2.min.css') }}">

    <!-- Daterangepikcer CSS -->
    <link rel="stylesheet" href="{{ asset('dashboard_assets/plugins/daterangepicker/daterangepicker.css') }}">

    <!-- Tabler Icon CSS -->
    <link rel="stylesheet" href="{{ asset('dashboard_assets/plugins/tabler-icons/tabler-icons.min.css') }}">

    <!-- Fontawesome CSS -->
    <link rel="stylesheet" href="{{ asset('dashboard_assets/plugins/fontawesome/css/fontawesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('dashboard_assets/plugins/fontawesome/css/all.min.css') }}">

    <!-- Color Picker Css -->
    <link rel="stylesheet" href="{{ asset('dashboard_assets/plugins/%40simonwep/pickr/themes/nano.min.css') }}">

    <!-- Main CSS -->
    <link rel="stylesheet" href="{{ asset('dashboard_assets/css/style.css') }}">



    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <link rel="stylesheet" href="{{ asset('dashboard_assets/cutom.css') }}">

    <style>
        .padding-10 {
            padding: 5px;
        }
    </style>

    <!-- iziToast CSS -->
    <link rel="stylesheet" href="{{ asset('dashboard_assets/css/iziToast.min.css') }}">

    @stack('styles')
    <script src="{{ asset('dashboard_assets/js/custom.js') }}"></script>

    <!-- Google Tag Manager -->
<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
})(window,document,'script','dataLayer','GTM-T38G8QQJ');</script>
<!-- End Google Tag Manager -->

</head>



<body>
    <!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-T38G8QQJ"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->
    <div id="global-loader">
        <div class="whirly-loader">
            <div></div>
            <div></div>
            <div></div>
            <div></div>
            <div></div>
            <div></div>
            <div></div>
            <div></div>
            <div></div>
            <div></div>
            <div></div>
            <div></div>
        </div>
    </div>

    <!-- Main Wrapper -->
    <div class="main-wrapper">
        @yield('content')
    </div>


    <script src="{{asset('dashboard_assets/js/jquery-3.7.1.min.js')}}" type=""></script>

    <!-- iziToast JS -->
    <script src="{{ asset('dashboard_assets/js/iziToast.min.js') }}"></script>



    <!-- Feather Icon JS -->
    <script src="{{asset('dashboard_assets/js/feather.min.js')}}" type="bba39571e659c7cea8b06dff-text/javascript"></script>

    <!-- Slimscroll JS -->
    <script src="{{asset('dashboard_assets/js/jquery.slimscroll.min.js')}}" type="bba39571e659c7cea8b06dff-text/javascript"></script>

    <!-- Bootstrap Core JS -->
    <script src="{{asset('dashboard_assets/js/bootstrap.bundle.min.js')}}" type="bba39571e659c7cea8b06dff-text/javascript"></script>

    <!-- ApexChart JS -->
    <script src="{{asset('dashboard_assets/plugins/apexchart/apexcharts.min.js')}}" type="bba39571e659c7cea8b06dff-text/javascript"></script>
    <script src="{{asset('dashboard_assets/plugins/apexchart/chart-data.js')}}" type="bba39571e659c7cea8b06dff-text/javascript"></script>
    <script src="{{ asset('dashboard_assets/js/countries.js') }}"></script>
    <!-- Chart JS -->
    <script src="{{asset('dashboard_assets/plugins/chartjs/chart.min.js')}}" type="bba39571e659c7cea8b06dff-text/javascript"></script>
    <script src="{{asset('dashboard_assets/plugins/chartjs/chart-data.js')}}" type="bba39571e659c7cea8b06dff-text/javascript"></script>

    <!-- Daterangepikcer JS -->
    <script src="{{asset('dashboard_assets/js/moment.min.js')}}" type="bba39571e659c7cea8b06dff-text/javascript"></script>
    <script src="{{asset('dashboard_assets/plugins/daterangepicker/daterangepicker.js')}}" type="bba39571e659c7cea8b06dff-text/javascript"></script>

    <!-- Select2 JS -->
    <script src="{{asset('dashboard_assets/plugins/select2/js/select2.min.js')}}" type="bba39571e659c7cea8b06dff-text/javascript"></script>

    <!-- Color Picker JS -->
    <script src="{{asset('dashboard_assets/plugins/%40simonwep/pickr/pickr.es5.min.js')}}" type="bba39571e659c7cea8b06dff-text/javascript"></script>

    <!-- Custom JS -->
    <script src="{{asset('dashboard_assets/js/theme-colorpicker.js')}}" type="bba39571e659c7cea8b06dff-text/javascript"></script>
    <script src="{{asset('dashboard_assets/js/script.js')}}" type="bba39571e659c7cea8b06dff-text/javascript"></script>





    <script src="https://dreamspos.dreamstechnologies.com/cdn-cgi/scripts/7d0fa10a/cloudflare-static/rocket-loader.min.js"
        data-cf-settings="bba39571e659c7cea8b06dff-|49" defer></script>
    <script defer src="https://static.cloudflareinsights.com/beacon.min.js/vcd15cbe7772f49c399c6a5babf22c1241717689176015"
        integrity="sha512-ZpsOmlRQV6y907TI0dKBHq9Md29nnaEIPlkf84rnaERnq6zvWvPUqr2ft8M1aS28oN72PdrCzSjY4U6VaAw1EQ=="
        data-cf-beacon='{"rayId":"981f747f9e57776c","version":"2025.9.1","serverTiming":{"name":{"cfExtPri":true,"cfEdge":true,"cfOrigin":true,"cfL4":true,"cfSpeedBrain":true,"cfCacheStatus":true}},"token":"3ca157e612a14eccbb30cf6db6691c29","b":1}'
        crossorigin="anonymous"></script>

    <!-- Initialize Feather Icons -->
    <script>
        feather.replace();
    </script>

    <!-- Handle Session Messages with iziToast -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            if (window.iziToastInitialized) return;
            window.iziToastInitialized = true;

            @if (session('success'))
                iziToast.success({
                    message: @json(session('success')),
                    position: 'topRight',
                    timeout: 5000,
                    pauseOnHover: true,
                    progressBar: true,
                    animateInside: true,
                    transitionIn: 'flipInX',
                    transitionOut: 'flipOutX',
                    resetOnHover: true,
                });
            @elseif (session('error'))
                iziToast.error({
                    message: @json(session('error')),
                    position: 'topRight',
                    timeout: 5000,
                    pauseOnHover: true,
                    progressBar: true,
                    animateInside: true,
                    transitionIn: 'flipInX',
                    transitionOut: 'flipOutX',
                    resetOnHover: true,
                });
            @elseif (session('info'))
                iziToast.info({
                    message: @json(session('info')),
                    position: 'topRight',
                    timeout: 5000,
                    pauseOnHover: true,
                    progressBar: true,
                    animateInside: true,
                    transitionIn: 'flipInX',
                    transitionOut: 'flipOutX',
                    resetOnHover: true,
                });
            @elseif (session('warning'))
                iziToast.warning({
                    message: @json(session('warning')),
                    position: 'topRight',
                    timeout: 5000,
                    pauseOnHover: true,
                    progressBar: true,
                    animateInside: true,
                    transitionIn: 'flipInX',
                    transitionOut: 'flipOutX',
                    resetOnHover: true,
                });
            @endif
        });
    </script>

    <script>
        // Reusable form submission handler with Bootstrap
        document.addEventListener('DOMContentLoaded', function() {
            // Initialize all forms with the data-submit-spinner attribute
            const forms = document.querySelectorAll('form[data-submit-spinner]');

            forms.forEach(form => {
                form.addEventListener('submit', function(e) {
                    const submitButton = this.querySelector('button[type="submit"]');
                    const originalText = submitButton.innerHTML;

                    if (submitButton && !submitButton.disabled) {
                        // Disable button and show spinner
                        submitButton.disabled = true;
                        submitButton.classList.add('opacity-75', 'pe-none');

                        // Get custom spinner text or use default
                        const spinnerText = this.getAttribute('data-spinner-text') ||
                            'Processing...';

                        submitButton.innerHTML = `
                    <span class="d-flex align-items-center justify-content-center">
                        <span class="spinner-border spinner-border-sm me-2" role="status" aria-hidden="true"></span>
                        ${spinnerText}
                    </span>
                `;

                        // Store original content for potential reset
                        submitButton.setAttribute('data-original-content', originalText);
                    }
                });
            });

            // Function to reset form button (useful for form validation errors)
            window.resetFormButton = function(formId) {
                const form = document.getElementById(formId);
                if (form) {
                    const submitButton = form.querySelector('button[type="submit"]');
                    const originalContent = submitButton.getAttribute('data-original-content');

                    if (submitButton && originalContent) {
                        submitButton.disabled = false;
                        submitButton.classList.remove('opacity-75', 'pe-none');
                        submitButton.innerHTML = originalContent;
                    }
                }
            };
        });
    </script>



    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

    @stack('scripts')
</body>

</html>
