<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en-US" lang="en-US">

<head>
    <base href="/public">
    <meta charset="utf-8" />
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Google tag (gtag.js) -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-LJK800KXFR"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());

        gtag('config', 'G-LJK800KXFR');
    </script>
   <title>@yield('title', 'Lonstack | Software Development & Blockchain Solutions')</title>
  <meta name="description" content="Lonstack is a global technology company delivering custom software development, blockchain development, cloud engineering, cybersecurity, IT consulting, DevOps, and dedicated development teams to help businesses innovate and scale.">

<meta name="keywords" content="Lonstack, software development company, custom software development, blockchain development, Web3 development, cloud solutions, DevOps services, cybersecurity, mobile app development, web development, UI UX design, IT consulting, dedicated development team, IT outstaffing, enterprise software, digital transformation, SaaS development, fintech development">

<meta name="author" content="Lonstack">

<meta name="robots" content="index, follow">

<meta name="application-name" content="Lonstack">

<meta name="generator" content="Laravel">

<!-- Open Graph Meta Tags -->
<meta property="og:type" content="website">
<meta property="og:site_name" content="Lonstack">
<meta property="og:locale" content="en_GB">

<meta property="og:title" content="Lonstack | AI, Software Development & Blockchain Solutions">

<meta property="og:description" content="Lonstack helps businesses innovate through AI, custom software development, blockchain solutions, cloud engineering, cybersecurity, DevOps, and enterprise technology consulting.">

<meta property="og:url" content="{{ url()->current() }}">

<meta property="og:image" content="{{ asset('image/seo/og-image.jpg') }}">
<meta property="og:image:secure_url" content="{{ asset('image/seo/og-image.jpg') }}">
<meta property="og:image:type" content="image/jpeg">
<meta property="og:image:width" content="1200">
<meta property="og:image:height" content="630">
<meta property="og:image:alt" content="Lonstack - AI, Software Development & Blockchain Solutions">

    <!-- Mobile Specific Metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=5">
    <meta name="theme-color" content="#19272b">

    <link rel="canonical" href="{{ url()->current() }}">

    <meta name="twitter:card" content="summary_large_image">
<meta name="twitter:title" content="Lonstack | Software Development & Blockchain Solutions">
<meta name="twitter:description" content="Lonstack helps businesses innovate through AI, software engineering, blockchain, cloud, cybersecurity and digital transformation.">
<meta name="twitter:image" content="{{ asset('image/seo/og-image.jpg') }}">

<!-- Social Profiles -->
<meta property="og:see_also" content="https://www.linkedin.com/company/lonstacksoftware">
<meta property="og:see_also" content="https://www.instagram.com/lonstacksoftware">
<meta property="og:see_also" content="https://www.tiktok.com/@lonstacksoftware">

<!-- Business Contact -->
<meta property="business:contact_data:website" content="https://lonstack.com">

<!-- Brand -->
<meta property="og:brand" content="Lonstack">

<!-- Language -->
<meta property="og:locale:alternate" content="en_US">

    <!-- Bootstrap -->
    <link rel="stylesheet" type="text/css" href="css/bootstrap.css" />
    <!-- Animate -->
    <link rel="stylesheet" type="text/css" href="css/animate.min.css" />
    <!-- Magnific-popup -->
    <link rel="stylesheet" type="text/css" href="css/magnific-popup.min.css" />
    <!-- Swiper -->
    <link rel="stylesheet" href="css/swiper-bundle.min.css">
    <!-- Nice select -->
    <link rel="stylesheet" href="css/nice-select.css">
    <!-- Odometer -->
    <link rel="stylesheet" href="css/odometer-theme-default.css">
    <!-- Textanimation -->
    <link rel="stylesheet" href="css/textanimation.css">

    <!-- Theme Style -->
    <link rel="stylesheet" href="https://sibforms.com/forms/end-form/build/sib-styles.css">
    <link rel="stylesheet" type="text/css" href="css/styles.css" />

    <!-- Tabler Icon CSS -->
    <link rel="stylesheet" href="{{ asset('dashboard_assets/plugins/tabler-icons/tabler-icons.min.css') }}">
    <link rel="stylesheet" href="{{ asset('dashboard_assets/css/feather.css') }}">
    <link rel="stylesheet" type="text/css" href="css/custom.css" />

    <!-- Icon -->
    <link rel="stylesheet" type="text/css" href="icons/icomoon/style.css" />

    <!-- Favicon and Touch Icons  -->
    <link rel="shortcut icon" href="image/logo/favicon.png" />
    <link rel="apple-touch-icon-precomposed" href="image/logo/favicon.png" />

    @stack('styles')
</head>

<body class="counter-scroll @yield('body-class')">



    @if (request()->routeIs('home', 'about', 'services', 'contact-us', 'privacy-policy', 'portfolio'))
        <!-- Promo Modal -->
        <div class="promo-modal-overlay" id="promoModalOverlay">
            <div class="promo-modal">
                <button class="promo-modal-close" id="promoModalClose" aria-label="Close">&times;</button>
                {{-- <div class="promo-modal-icon">🎉</div> --}}
                <h3 class="promo-modal-title">Refer a Client &amp; Earn 10%!</h3>
                <p class="promo-modal-desc">Refer a client and receive <strong>10% of the total project value</strong>
                    when
                    completed.</p>
                <div class="promo-modal-dates">📅 Promo Period: 13 July 2026 – 30 September 2026</div>
                <button class="promo-modal-terms" id="openTermsModal">Terms &amp; Conditions Apply</button>
            </div>
        </div>


        <!-- Terms & Conditions Modal -->
        <div class="terms-modal-overlay" id="termsModalOverlay">
            <div class="terms-modal">
                <button class="terms-modal-close" id="termsModalClose" aria-label="Close">&times;</button>

                <div class="terms-modal-scroll">
                    <div class="terms-hero">
                        <h2>📄 Referral Promotion Terms &amp; Conditions</h2>
                        <p>Clear rules for Lonstack referral reward program</p>
                    </div>

                    <div class="terms-card">
                        <h4>1. Promotion Overview</h4>
                        <p>This referral promotion is offered by <strong>Lonstack Software</strong>. following the relaunch of our website and the introduction of our enhanced digital services. Participants earn a reward
                            when
                            they refer a new client who successfully completes a paid project.</p>
                    </div>

                    <div class="terms-card">
                        <h4>2. Eligibility</h4>
                        <ul>
                            <li>Open to all individuals and existing clients.</li>
                            <li>Employees and immediate family members may be excluded.</li>
                        </ul>
                    </div>

                    <div class="terms-card">
                        <h4>3. Referral Reward</h4>
                        <ul>
                            <li>You earn <strong>10% of the total project value</strong>.</li>
                            <li>Paid only after full project completion and payment.</li>
                            <li>Unpaid or incomplete projects do not qualify.</li>
                        </ul>
                    </div>

                    <div class="terms-card">
                        <h4>4. Qualified Referral</h4>
                        <ul>
                            <li>Must be a new client (not previously registered).</li>
                            <li>Referral must be verified by Lonstack.</li>
                            <li>Client must complete a paid project.</li>
                        </ul>
                    </div>

                    <div class="terms-card">
                        <h4>5. Payment of Reward</h4>
                        <ul>
                            <li>Paid after project completion and final payment.</li>
                            <li>Payment method will be agreed (e.g. bank transfer).</li>
                            <li>Processing time: 7–14 business days.</li>
                        </ul>
                    </div>

                    <div class="terms-card terms-card--highlight">
                        <h4>6. Promotion Period</h4>
                        <p class="terms-promo-dates">📅 13 July 2026 – 30 September 2026</p>
                    </div>

                    <div class="terms-card">
                        <h4>7. Fraud &amp; Abuse</h4>
                        <ul>
                            <li>Fake or self-referrals are not allowed.</li>
                            <li>All referrals are subject to verification.</li>
                        </ul>
                    </div>

                    <div class="terms-card">
                        <h4>8. General</h4>
                        <ul>
                            <li>Lonstack reserves the right to modify or terminate the promotion.</li>
                            <li>All decisions are final.</li>
                        </ul>
                    </div>

                    <div class="terms-footer">
                        © {{ date('Y') }} Lonstack. All rights reserved.
                    </div>
                </div>
            </div>
        </div>
    @endif

    <!-- .preload -->
    <div id="loading">
        <div id="loading-center">
            <div class="loader-container">
                <div class="wrap-loader">
                    <div class="loader">
                    </div>
                    <div class="icon">
                        <img src="{{ asset('image/logo/favicon.png') }}" alt="logo">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /.preload -->
    <div class="wrapper position-relative">

        <!-- Top-bar -->
        @include('partials.guest.topbar')
        <!-- /.top-bar -->

        <!-- Header -->
        @include('partials.guest.header')
        <!-- /.header -->




        <!-- Main-content -->
        @yield('content')
        <!-- /.main-content -->

        @include('partials.guest.footer')


        <!-- Mobile-nav-wrap -->
        @include('partials.guest.mobile-nav')
        <!-- /.mobile-nav-wrap -->

        <!-- OffcanvasMegamenu -->
        @include('partials.guest.offcanvasmegamenu')
        <!-- /.offcanvasMegamenu -->

        <!-- Go-top -->
        <div class="progress-wrap">
            <svg class="progress-circle svg-content" width="100%" height="100%" viewBox="-1 -1 102 102">
                <path d="M50,1 a49,49 0 0,1 0,98 a49,49 0 0,1 0,-98"
                    style="transition: stroke-dashoffset 10ms linear; stroke-dasharray: 307.919, 307.919; stroke-dashoffset: 277.672;">
                </path>
            </svg>
        </div>
        <!-- /.go-top -->

        <div class="overlay-filter" id="overlay-filter"></div>

    </div>

    <!-- Javascript -->
    <script src="js/bootstrap.min.js"></script>
    <script src="js/jquery.min.js"></script>
    <script src="js/jquery.nice-select.min.js"></script>
    <script src="js/lazysize.min.js"></script>
    <script src="js/magnific-popup.min.js"></script>
    <script src="js/gsap.min.js"></script>
    <script src="js/gsap-animation.js"></script>
    <script src="js/ScrollTrigger.min.js"></script>
    <script src="js/Splitetext.js"></script>
    <script src="js/wow.min.js"></script>
    <script src="js/ScrollSmooth.js"></script>
    <script src="js/swiper-bundle.min.js"></script>
    <script src="js/carousel.js"></script>
    <script src="js/odometer.min.js"></script>
    <script src="js/jquery-validate.js"></script>
    <script src="js/textanimation.js"></script>
    <script src="js/newsletter.js"></script>
    <!-- Feather Icon JS -->
    <script src="{{asset('dashboard_assets/js/feather.min.js')}}" type="bba39571e659c7cea8b06dff-text/javascript"></script>


    <script type="text/javascript" src="js/main.js"></script>
    <script src="js/sibforms.js" defer></script>
    <script>
        window.REQUIRED_CODE_ERROR_MESSAGE = 'Please choose a country code';
        window.LOCALE = 'en';
        window.EMAIL_INVALID_MESSAGE = window.SMS_INVALID_MESSAGE =
            "The information provided is invalid. Please review the field format and try again.";

        window.REQUIRED_ERROR_MESSAGE = "This field cannot be left blank. ";

        window.GENERIC_INVALID_MESSAGE =
            "The information provided is invalid. Please review the field format and try again.";

        window.translation = {
            common: {
                selectedList: '{quantity} list selected',
                selectedLists: '{quantity} lists selected'
            }
        };

        var AUTOHIDE = Boolean(0);
    </script>

    <!-- /Javascript -->
    @stack('scripts')

    <!--Start of Tawk.to Script-->
    <script type="text/javascript">
        var Tawk_API = Tawk_API || {},
            Tawk_LoadStart = new Date();
        (function() {
            var s1 = document.createElement("script"),
                s0 = document.getElementsByTagName("script")[0];
            s1.async = true;
            s1.src = 'https://embed.tawk.to/6a44afecb271bd1d477e9571/1jse4udh2';
            s1.charset = 'UTF-8';
            s1.setAttribute('crossorigin', '*');
            s0.parentNode.insertBefore(s1, s0);
        })();
    </script>
    <!--End of Tawk.to Script-->

</body>

</html>
