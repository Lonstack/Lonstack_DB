@extends('layouts.guest')
@section('content')
<!-- Page-title -->
<div class="page-title-home">
  <div class="mask mask-home-1">
    <svg xmlns="http://www.w3.org/2000/svg" width="800" height="800" fill="none">
      <circle cx="400" cy="400" r="325" stroke="url(#a)" stroke-width="150" />
      <defs>
        <linearGradient id="a" x1="176" x2="569" y1="70.5" y2="674">
          <stop offset="0" stop-color="#fff" stop-opacity="0.05" />
          <stop offset="1" stop-color="#fff" stop-opacity="0" />
        </linearGradient>
      </defs>
    </svg>
  </div>
  <div class="mask mask-home-2">
    <svg xmlns="http://www.w3.org/2000/svg" width="800" height="800" fill="none">
      <circle cx="400" cy="400" r="325" stroke="url(#a1)" stroke-width="150" />
      <defs>
        <linearGradient id="a1" x1="176" x2="569" y1="70.5" y2="674">
          <stop offset="0" stop-color="#fff" stop-opacity="0.05" />
          <stop offset="1" stop-color="#fff" stop-opacity="0" />
        </linearGradient>
      </defs>
    </svg>
  </div>
  <div class="tf-container">
    <div class="row">
      <div class="col-12">
        <div class="top-page-title">
          <div class="sub-title body-2 fw-5 split-text effect-right">
            Welcome to LonStack Software
          </div>
          <h1 class="title fw-6 lh-85 hero-headline">
            Building Custom Software That Helps
            <span class="hero-headline__break"><span class="highlight text-uppercase">Businesses</span>
              Scale</span>
          </h1>
        </div>
      </div>
    </div>
    <div class="row justify-content-between rg-70">
      <div class="col-lg-5">
        <div class="content-left">

          <div class="desc text-animation">
            <p class="fs-18 lh-40">
              We design and build web / mobile applications, data-driven platforms, and blockchain
              solutions, while providing experienced engineers to support and extend your teams.
            </p>
          </div>

          <div class="wg-counter flex align-items-center justify-content-between">

            <div class="counter-item">
              <div class="counter">
                <div class="number-counter flex fs-65 fw-6">
                  <span class="number odometer color-primary" data-to="20" data-inviewport="yes"> 0
                  </span>
                  <span class="color-primary">+</span>
                </div>
                <p class="title-counter body-2 lh-30">
                  Delivered Projects
                </p>
              </div>
            </div>

            <div class="counter-item">
              <div class="counter">
                <div class="number-counter flex fs-65 fw-6">
                  <span class="number odometer color-primary" data-to="2" data-inviewport="yes"> 0
                  </span>
                  <span class="color-primary">+</span>
                </div>
                <p class="title-counter body-2 lh-30">
                  Years Building Software
                </p>
              </div>
            </div>

          </div>

          <a href="{{ route('services') }}" class="tf-btn">
            <span>Explore Our Services</span>
            <i class="icon-arrow-right"></i>
          </a>
        </div>

      </div>
      <div class="col-lg-7">
        <div class="image tf-animate-1">
          <img src="image/page-title/img-page-title.jpg" data-src="image/page-title/img-page-title.jpg"
            alt="" class="lazyload">
        </div>
      </div>

    </div>
  </div>
</div>
<!-- /.page-title -->

<div class="main-content">
  <section class="section-about tf-spacing-2">
    <div class="about-top">
      <div class="tf-marquee">
        <div class="marquee-wrapper">
          <div class="initial-child-container">
            <div class="big-text">
              Software Development
            </div>
            <div class="big-text">
              Software Development
            </div>
            <div class="big-text">
              Software Development
            </div>
            <div class="big-text">
              Software Development
            </div>
            <div class="big-text">
              Software Development
            </div>
            <div class="big-text">
              Software Development
            </div>
            <div class="big-text">
              Software Development
            </div>
            <div class="big-text">
              Software Development
            </div>
            <div class="big-text">
              Software Development
            </div>
            <div class="big-text">
              Software Development
            </div>
            <div class="big-text">
              Software Development
            </div>
            <div class="big-text">
              Software Development
            </div>
            <div class="big-text">
              Software Development
            </div>
            <div class="big-text">
              Software Development
            </div>
            <div class="big-text">
              Software Development
            </div>
            <div class="big-text">
              Software Development
            </div>
            <div class="big-text">
              Software Development
            </div>
            <div class="big-text">
              Software Development
            </div>
            <div class="big-text">
              Software Development
            </div>
            <div class="big-text">
              Software Development
            </div>
            <div class="big-text">
              Software Development
            </div>
            <div class="big-text">
              Software Development
            </div>
            <div class="big-text">
              Software Development
            </div>
            <div class="big-text">
              Software Development
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="tf-container">
      <div class="about-inner flex g-30">
        <div class="left">
          <div class="wg-curve-text">
            <div class="icon">
              <i class="icon-arrow-up"></i>
            </div>
            <div class="text-rotate">
              <svg width="270 " height="270 " viewBox="0 0 270  270 "
                xmlns="http://www.w3.org/2000/svg">
                <defs>
                  <path id="textPathCircle"
                    d="M 135,135 m -110,0 a 110,110 0 1,1 220,0 a 110,110 0 1,1 -220,0"
                    fill="none" />
                </defs>
                <text>
                  <textPath href="#textPathCircle" startOffset="0" textLength="690"
                    lengthAdjust="spacing">
                    - Digital - Software - Solutions&nbsp;
                  </textPath>
                </text>
              </svg>
            </div>
          </div>
        </div>
        <div class="right">
          <div class="heading-section mb-30">
            <div class="sub-title body-2 fw-7 mb-17 title-animation">
              We Are Lonstack Software Company
            </div>
            <h2 class="title fw-6 title-animation">
              Innovate Soft Solutions to
              <span class="fw-3">Grow Tech Business</span>
            </h2>
          </div>
          <div class="section-content">
            <div class="desc mb-40 text-animation">
              <p class="lh-30">
                With a portfolio of successful projects spanning various industries
                our team has consistently demonstrated the ability to transform ideas into
                high-performing, user-friendly applications.
              </p>
            </div>
            <div class="title-animation">
              <a href="{{ route('about') }}" class="tf-btn no-bg text-underline">
                <span>Learn More Us</span>
                <i class="icon-arrow-right"></i>
              </a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <section class="section-counting tf-spacing-2">
    <div class="mask mask-1">
      <svg xmlns="http://www.w3.org/2000/svg" width="700" height="700" fill="none">
        <circle cx="350" cy="350" r="285" stroke="url(#a2)" stroke-width="130" />
        <defs>
          <linearGradient id="a2" x1="154" x2="497.875" y1="61.688" y2="589.75">
            <stop offset="0" stop-color="#fff" stop-opacity="0.05" />
            <stop offset="1" stop-color="#fff" stop-opacity="0" />
          </linearGradient>
        </defs>
      </svg>
    </div>
    <div class="tf-container w-1810">
      <div class="section-counting-inner flex">
        <div class="left">
          <div class="image tf-animate-1">
            <img src="image/section/img-section-counting-1.jpg"
              data-src="image/section/img-section-counting-1.jpg" alt="" class="lazyload">
          </div>
          <div class="box-logo tf-animate-2">
            <img src="image/logo/favicon.png" alt="">
            <h4 class="title">LonStack</h4>
          </div>
          <div class="box-avatar tf-animate-3">
            <div class="text">
              <p class="fs-20 fw-6">
                20+ Trusted
                <br>Global Clients
              </p>
              <img src="image/icon/icon-box-avatar.png" data-src="image/icon/icon-box-avatar.png"
                class="lazyload" alt="">
            </div>
            <div class="list-agent">
              <div class="agent agent-1">
                <img src="image/avatar/agent-1.jpg" data-src="image/avatar/agent-1.jpg"
                  alt="" class="lazyload">
              </div>
              <div class="agent agent-2">
                <img src="image/avatar/agent-2.jpg" data-src="image/avatar/agent-2.jpg"
                  alt="" class="lazyload">
              </div>
              <div class="agent agent-3">
                <img src="image/avatar/agent-3.jpg" data-src="image/avatar/agent-3.jpg"
                  alt="" class="lazyload">
              </div>
              <div class="agent agent-plus">
                <span>
                  +
                </span>
              </div>
            </div>
          </div>
        </div>
        <div class="right">
          <div class="heading-section mb-60">
            <div class="sub-title body-2 fw-7 mb-17 title-animation">
              Explore Our Achievement
            </div>
            <h2 class="title fw-6 title-animation">
              Premier Tech Innovations
              <span class="fw-3">LonStack Software</span>
            </h2>
          </div>
          <div class="wg-counter flex g-30">

            <div class="counter-item style-2 style-bg-primary px-md-15">
              <div class="icon">
                <i class="icon-check"></i>
              </div>
              <div class="counter">

                <div class="number-counter flex fs-65 fw-7">
                  <span class="number odometer" data-to="20" data-inviewport="yes"> 0
                  </span>
                  <span class="title-counter">+</span>
                </div>
                <h6 class="title-counter lh-30 fw-5">
                  Trusted Global Clients
                </h6>
              </div>
            </div>

            <div class="counter-item style-2 style-bg-surface px-md-15">
              <div class="icon">
                <i class="icon-check"></i>
              </div>
              <div class="counter">
                <div class="number-counter flex fs-65 fw-7">
                  <span class="number odometer" data-to="20" data-inviewport="yes"> 0
                  </span>
                  <span class="title-counter">+</span>
                </div>
                <h6 class="title-counter lh-30 fw-5">
                  Best Project Complete
                </h6>
              </div>
            </div>

          </div>
        </div>
      </div>
    </div>
  </section>

  <section class="section-company tf-spacing-3">
    <div class="tf-container w-1810">
      <div class="section-company-inner">
        <div class="left-section">
          <div class="heading-section mb-53">
            <div class="sub-title body-2 fw-7 mb-17 title-animation">
              Grow & Development
            </div>
            <h2 class="title fw-6 title-animation">
              Modern Technology and
              <span class="fw-3">Advancement Incentives</span>
            </h2>
          </div>
          <div class="wg-according" id="According1">
            <div class="according-item">
              <h5 class="fw-5">
                <a href="#according1" data-bs-toggle="collapse" class="title-according">Learn
                  Our Company Mission<span></span></a>
              </h5>
              <div id="according1" class="collapse show" data-bs-parent="#According1">
                <div class="according-content">
                  <div class="image left">
                    <img src="image/section/img-according-1.jpg"
                      data-src="image/section/img-according-1.jpg" alt=""
                      class="lazyload">
                  </div>
                  <div class="right">
                    <div class="desc lh-30">
                      Our mission is to empower businesses worldwide by building innovative and
                      scalable digital solutions that drive efficiency, accelerate growth, and
                      unlock long-term value in an evolving digital economy.
                    </div>
                    <div class="list-benefit">
                      <div class="benefit-item">
                        <i class="icon-star-of-life"></i>
                        <span class="fw-5">Next-Generation Technology Solutions</span>
                      </div>
                      <div class="benefit-item">
                        <i class="icon-star-of-life"></i>
                        <span class="fw-5">Enterprise-Grade Digital Systems</span>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="according-item">
              <h5 class="fw-5">
                <a href="#according2" data-bs-toggle="collapse" class="title-according collapsed">Our
                  Company Vision<span></span></a>
              </h5>
              <div id="according2" class="collapse" data-bs-parent="#According1">
                <div class="according-content">
                  <div class="image left">
                    <img src="image/section/img-according-1.jpg"
                      data-src="image/section/img-according-1.jpg" alt=""
                      class="lazyload">
                  </div>
                  <div class="right">
                    <div class="desc lh-30">
                      Our vision is to design and scale intelligent digital ecosystems that
                      empower organizations worldwide to operate with greater efficiency,
                      security, and innovation in a rapidly evolving technological landscape
                    </div>
                    <div class="list-benefit">
                      <div class="benefit-item">
                        <i class="icon-star-of-life"></i>
                        <span class="fw-5">Intelligent Digital Ecosystems</span>
                      </div>
                      <div class="benefit-item">
                        <i class="icon-star-of-life"></i>
                        <span class="fw-5">Enterprise-Grade Innovation Systems</span>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="according-item">
              <h5 class="fw-5">
                <a href="#according3" data-bs-toggle="collapse" class="title-according collapsed">Our
                  Philosophy<span></span></a>
              </h5>
              <div id="according3" class="collapse" data-bs-parent="#According1">
                <div class="according-content">
                  <div class="image left">
                    <img src="image/section/img-according-1.jpg"
                      data-src="image/section/img-according-1.jpg" alt=""
                      class="lazyload">
                  </div>
                  <div class="right">
                    <div class="desc lh-30">
                      Our philosophy is built on innovation, scalability, and trust. We believe
                      technology should not only solve problems but also create sustainable
                      digital ecosystems that enable long-term growth, efficiency, and
                      transformation for businesses worldwide.

                    </div>
                    <div class="list-benefit">
                      <div class="benefit-item">
                        <i class="icon-star-of-life"></i>
                        <span class="fw-5">Human-Centered Digital Design</span>
                      </div>
                      <div class="benefit-item">
                        <i class="icon-star-of-life"></i>
                        <span class="fw-5">Security, Trust & Transparency</span>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="according-item">
              <h5 class="fw-5">
                <a href="#according4" data-bs-toggle="collapse" class="title-according collapsed">Our
                  Strategy<span></span></a>
              </h5>
              <div id="according4" class="collapse" data-bs-parent="#According1">
                <div class="according-content">
                  <div class="image left">
                    <img src="image/section/img-according-1.jpg"
                      data-src="image/section/img-according-1.jpg" alt=""
                      class="lazyload">
                  </div>
                  <div class="right">
                    <div class="desc lh-30">
                      Our strategy is centered on designing scalable digital ecosystems that
                      integrate engineering excellence, automation, and intelligence-driven
                      decision-making to accelerate sustainable business growth.
                    </div>
                    <div class="list-benefit">
                      <div class="benefit-item">
                        <i class="icon-star-of-life"></i>
                        <span class="fw-5">Scalable Digital Ecosystem Design</span>
                      </div>
                      <div class="benefit-item">
                        <i class="icon-star-of-life"></i>
                        <span class="fw-5">Intelligence-Driven Automation</span>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="right-section d-none d-lg-block">
          <div class="image image-section tf-animate-1">
            <img src="image/section/img-section-company.jpg"
              data-src="image/section/img-section-company.jpg" alt="" class="lazyload">
          </div>
        </div>
      </div>
    </div>

  </section>




  <section class="section-services tf-spacing-2">

    {{-- Background mask --}}
    <div class="mask mask-1">
      <svg xmlns="http://www.w3.org/2000/svg" width="800" height="800" fill="none">
        <circle cx="400" cy="400" r="325" stroke="url(#a3)" stroke-width="150" />
        <defs>
          <linearGradient id="a3" x1="176" x2="569" y1="70.5" y2="674">
            <stop offset="0" stop-color="#fff" stop-opacity="0.05" />
            <stop offset="1" stop-color="#fff" stop-opacity="0" />
          </linearGradient>
        </defs>
      </svg>
    </div>

    {{-- Marquee ticker --}}
    <div class="section-top">
      <div class="tf-marquee">
        <div class="marquee-wrapper">
          <div class="initial-child-container">
            @for ($i = 0; $i < 12; $i++)
              <div class="big-text">
              Explore <span class="text-stroke">Popular</span> Services
              <span class="marquee-dot">&#8226;</span>
          </div>
          @endfor
        </div>
      </div>
    </div>
</div>

<div class="tf-container">

  {{-- Section heading --}}
  <div class="row">
    <div class="col-12">
      <div class="heading-section mb-60 text-center">
        <div class="sub-title body-2 fw-7 mb-17 title-animation">
          Our Popular Services
        </div>
        <h2 class="title fw-6 title-animation">
          We Run All Kinds Of IT Services
          <br><span class="fw-3">that vow Your Success</span>
        </h2>
      </div>
    </div>
  </div>

  {{-- Services grid -- desktop only --}}
  <div class="row d-none d-md-block">
    <div class="col-12">
      <div class="srv-new-grid">

        @if($homeFeaturedService)
        <div class="srv-featured-card">
          <div class="srv-featured-inner">
            <div class="srv-featured-icon">
              <i class="{{ $homeFeaturedService->category->icon ?? 'icon-custom-software' }}"></i>
            </div>
            <div class="srv-featured-badge">Featured Service</div>
            <h4 class="srv-featured-title">
              {{ $homeFeaturedService->name }}
              @if($homeFeaturedService->badge === 'hot')<span class="badge-hot">HOT 🔥</span>@endif
              @if($homeFeaturedService->badge === 'new')<span class="badge-new">NEW</span>@endif
            </h4>
            <p class="srv-featured-desc">{{ $homeFeaturedService->short_description }}</p>
          </div>
          <div class="srv-featured-footer">
            <a href="{{ route('services.show', $homeFeaturedService->slug) }}" class="tf-btn tf-btn--sm">
              <span>Get Started</span>
              <i class="icon-arrow-right"></i>
            </a>
            <a href="{{ route('services') }}" class="srv-view-all-link">
              View all services <i class="icon-arrow-right"></i>
            </a>
          </div>
        </div>
        @endif

        <div class="srv-mini-grid">
          @foreach($homeOtherServices->take(4) as $srv)
          <div class="srv-mini-card">
            <div class="srv-mini-icon"><i class="{{ $srv->category->icon ?? 'icon-custom-software' }}"></i></div>
            <h6 class="srv-mini-title">
              {{ $srv->name }}
              @if($srv->badge === 'hot')<span class="badge-hot">HOT 🔥</span>@endif
              @if($srv->badge === 'new')<span class="badge-new">NEW</span>@endif
            </h6>
            <p class="srv-mini-desc">{{ $srv->short_description }}</p>
            <a href="{{ route('services.show', $srv->slug) }}" class="tf-btn-readmore mt-auto">
              <span class="plus">+</span><span class="text">Read More</span>
            </a>
          </div>
          @endforeach
        </div>

        @foreach($homeOtherServices->slice(4) as $srv)
        <div class="srv-bottom-card">
          <div class="srv-mini-icon"><i class="{{ $srv->category->icon ?? 'icon-custom-software' }}"></i></div>
          <h6 class="srv-mini-title">
            {{ $srv->name }}
            @if($srv->badge === 'hot')<span class="badge-hot">HOT 🔥</span>@endif
            @if($srv->badge === 'new')<span class="badge-new">NEW</span>@endif
          </h6>
          <p class="srv-mini-desc">{{ $srv->short_description }}</p>
          <a href="{{ route('services.show', $srv->slug) }}" class="tf-btn-readmore mt-auto">
            <span class="plus">+</span><span class="text">Read More</span>
          </a>
        </div>
        @endforeach

      </div>
    </div>
  </div>

  {{-- Services carousel -- mobile only --}}
  <div class="d-md-none srv-mobile-carousel">

    @if($homeFeaturedService)
    <div class="srv-featured-card srv-featured-card--mobile">
      <div class="srv-featured-inner">
        <div class="srv-featured-icon">
          <i class="{{ $homeFeaturedService->category->icon ?? 'icon-custom-software' }}"></i>
        </div>
        <div class="srv-featured-badge">Featured Service</div>
        <h4 class="srv-featured-title">
          {{ $homeFeaturedService->name }}
          @if($homeFeaturedService->badge === 'hot')<span class="badge-hot">HOT 🔥</span>@endif
          @if($homeFeaturedService->badge === 'new')<span class="badge-new">NEW</span>@endif
        </h4>
        <p class="srv-featured-desc">{{ $homeFeaturedService->short_description }}</p>
      </div>
      <div class="srv-featured-footer">
        <a href="{{ route('services.show', $homeFeaturedService->slug) }}" class="tf-btn tf-btn--sm">
          <span>Get Started</span>
          <i class="icon-arrow-right"></i>
        </a>
        <a href="{{ route('services') }}" class="srv-view-all-link">
          View all <i class="icon-arrow-right"></i>
        </a>
      </div>
    </div>
    @endif

    <div class="srv-mobile-swiper-wrap">
      <div class="swiper tf-swiper sw-srv-mobile"
        data-swiper='{
          "slidesPerView": 1.1,
          "spaceBetween": 14,
          "speed": 600,
          "loop": false,
          "navigation": {
            "nextEl": ".srv-mobile-next",
            "prevEl": ".srv-mobile-prev"
          },
          "pagination": {
            "el": ".srv-mobile-pagination",
            "clickable": true,
            "dynamicBullets": true
          },
          "breakpoints": {
            "480": { "slidesPerView": 1.6, "spaceBetween": 16 }
          }
        }'>
        <div class="swiper-wrapper">
          @foreach($homeOtherServices as $srv)
          <div class="swiper-slide">
            <div class="srv-mini-card srv-mini-card--mobile">
              <div class="srv-mini-icon"><i class="{{ $srv->category->icon ?? 'icon-custom-software' }}"></i></div>
              <h6 class="srv-mini-title">
                {{ $srv->name }}
                @if($srv->badge === 'hot')<span class="badge-hot">HOT 🔥</span>@endif
                @if($srv->badge === 'new')<span class="badge-new">NEW</span>@endif
              </h6>
              <p class="srv-mini-desc">{{ $srv->short_description }}</p>
              <a href="{{ route('services.show', $srv->slug) }}" class="tf-btn-readmore mt-auto">
                <span class="plus">+</span><span class="text">Read More</span>
              </a>
            </div>
          </div>
          @endforeach
        </div>
      </div>

      {{-- Prev / Next arrows + pagination --}}
      <div class="srv-mobile-controls">
        <button class="srv-mobile-prev arrow-btn style-border w-50">
          <i class="icon-arrow-left2"></i>
        </button>
        <div class="srv-mobile-pagination sw-pagination"></div>
        <button class="srv-mobile-next arrow-btn style-border w-50">
          <i class="icon-arrow-right2"></i>
        </button>
      </div>

    </div>{{-- /.srv-mobile-swiper-wrap --}}
  </div>{{-- /.srv-mobile-carousel --}}

</div>{{-- /.tf-container --}}
</section>



<div class="wg-cta tf-spacing-2 alert alert-dismissible fade show" role="alert">
  <div class="tf-container">
    <div class="cta-inner flex align-items-center">
      <div class="left flex align-items-center">
        <div class="icon">
          <i class="icon-chat-2"></i>
        </div>
        <h5 class="fw-4 title">Let's <span class="fw-6">Discuss & Start</span> IT Consultations
        </h5>
        <a href="#" class="tf-btn no-bg text-underline hover-color-main-dark">
          <span>Let's Talk</span>
          <i class="icon-arrow-right"></i>
        </a>
      </div>
      <div class="right flex align-items-center g-15">
        <div class="flex flex-wrap rg-15">
          <div class="list-agent">
            <a href="#" class="agent agent-1 style-border">
              <img src="image/avatar/agent-4.jpg" data-src="image/avatar/agent-4.jpg"
                alt="" class=" ls-is-cached lazyloaded">
            </a>
            <a href="#" class="agent agent-2 style-border">
              <img src="image/avatar/agent-5.jpg" data-src="image/avatar/agent-5.jpg"
                alt="" class=" ls-is-cached lazyloaded">
            </a>
            <a href="#" class="agent agent-3 style-border">
              <img src="image/avatar/agent-6.jpg" data-src="image/avatar/agent-6.jpg"
                alt="" class=" ls-is-cached lazyloaded">
            </a>
            <div class="agent agent-plus style-border">
              <span>
                +
              </span>
            </div>
          </div>
          <div class="text">
            <h5>
              20+ <span class="fw-5">Trusted Clients</span>
            </h5>
            <div class="img-line tf-animate-1">
              <img src="image/icon/line-2.png" data-src="image/icon/line-2.png" alt=""
                class="lazyload">
            </div>
          </div>
        </div>
        <a class="tf-btn-close" data-bs-dismiss="alert" aria-label="Close">
          <i class="icon-close-2"></i>
        </a>
      </div>
    </div>
  </div>
</div>

<section class="section-team tf-spacing-2">
  <div class="mask mask-1">
    <svg xmlns="http://www.w3.org/2000/svg" width="700" height="700" fill="none">
      <circle cx="350" cy="350" r="285" stroke="url(#a8)" stroke-width="130" />
      <defs>
        <linearGradient id="a8" x1="154" x2="497.875" y1="61.688" y2="589.75">
          <stop offset="0" stop-color="#fff" stop-opacity="0.05" />
          <stop offset="1" stop-color="#fff" stop-opacity="0" />
        </linearGradient>
      </defs>
    </svg>
  </div>
  <div class="tf-container">
    <div class="row">
      <div class="col-lg-3">
        <div class="heading-section">
          <div class="sub-title body-2 fw-7 mb-17 title-animation">
            Our Professionals
          </div>
          <h2 class="title fw-6 mb-60 title-animation">
            Meet Our Experience
            <span class="fw-3">Members</span>
          </h2>
          <div class="list-btn flex align-items-center g-15">
            <div class="scrolling-effect effectBottom">
              <a class="arrow-btn style-border arrow-prev team-prev">
                <i class="icon-arrow-left2"></i>
              </a>
            </div>
            <div class="scrolling-effect effectBottom">
              <a class="arrow-btn style-border arrow-next team-next">
                <i class="icon-arrow-right2"></i>
              </a>
            </div>
          </div>
        </div>
      </div>
      <div class="col-lg-9">
        <div class="swiper tf-swiper sw-team sw-border"
          data-swiper='{
                                "slidesPerView": 1,
                                "spaceBetween": 30,
                                "speed": 800,
                                "pagination": { "el": ".sw-pagination-team", "clickable": true },
                                "navigation": {
                                    "clickable": true,
                                    "nextEl": ".team-next",
                                    "prevEl": ".team-prev"
                                },
                                "breakpoints": {
                                    "450": { "slidesPerView": 2, "slidesPerGroup": 2},
                                    "1200": { "slidesPerView": 3, "slidesPerGroup": 1}
                                    }
                                }'>
          <div class="swiper-wrapper">
            @forelse ($homeTeam as $member)
            <div class="swiper-slide">
              <div class="team-item hover-image">
                <div class="top-item">
                  <a class="image">
                    @if ($member->photo)
                    <img src="{{ asset('storage/' . $member->photo) }}"
                      data-src="{{ asset('storage/' . $member->photo) }}"
                      alt="{{ $member->name }}" class="lazyload"
                      style="width:100%; height:80%; object-fit:cover; display:block;">
                    @else
                    <div class="d-flex align-items-center justify-content-center w-100 h-100"
                      style="background:rgba(67,186,255,0.12); font-size:52px; font-weight:700;
                                  color:var(--primary); aspect-ratio:1;">
                      {{ $member->initial }}
                    </div>
                    @endif
                  </a>

                  {{-- Social overlay (shows on hover via theme CSS) --}}
                  @if ($member->facebook || $member->twitter || $member->linkedin || $member->youtube)
                  <div class="social-item">
                    <ul class="post-social">
                      @if ($member->facebook)
                      <li><a href="{{ $member->facebook }}" target="_blank"
                          class="icon-social"><i class="icon-fb"></i></a>
                      </li>
                      @endif
                      @if ($member->twitter)
                      <li><a href="{{ $member->twitter }}" target="_blank"
                          class="icon-social"><i class="icon-X"></i></a>
                      </li>
                      @endif
                      @if ($member->linkedin)
                      <li><a href="{{ $member->linkedin }}" target="_blank"
                          class="icon-social"><i
                            class="icon-linkedin"></i></a></li>
                      @endif
                      @if ($member->youtube)
                      <li><a href="{{ $member->youtube }}" target="_blank"
                          class="icon-social"><i
                            class="icon-youtube"></i></a></li>
                      @endif
                    </ul>
                  </div>
                  @endif
                </div>
                <div class="item-content">
                  <h6 class="title"><a>{{ $member->name }}</a></h6>
                  <p class="sub-title">{{ $member->role }}</p>
                </div>
              </div>
            </div>
            @empty
            {{-- No members yet — shown as a single non-swipeable slide --}}
            <div class="swiper-slide">
              <div class="d-flex flex-column align-items-center justify-content-center text-center"
                style="padding:60px 30px; opacity:0.5;">
                <i class="icon-users"
                  style="font-size:48px; display:block; margin-bottom:16px; color:var(--primary);"></i>
                <p class="body-2 fw-5">Our team profiles are coming soon.</p>
                <p class="text-medium" style="font-size:13px;">Check back shortly.</p>
              </div>
            </div>
            @endforelse
          </div>
        </div>
        <div class="sw-pagination-team sw-pagination d-lg-none mt-15 justify-content-center"></div>
      </div>
    </div>
  </div>
</section>

<section class="section-project tf-spacing-2">
  <div class="tf-container">
    <div class="heading-section mb-60 text-center">
      <div class="sub-title body-2 fw-7 mb-17 title-animation">
        Our Case Studies
      </div>
      <h2 class="title fw-6 title-animation">
        Explore Our
        <span class="fw-3">Recent Case Studies</span>
      </h2>
    </div>
  </div>
  <div class="swiper tf-swiper sw-project "
    data-swiper='{
                    "slidesPerView": 1,
                    "spaceBetween": 30,
                    "speed": 800,
                    "pagination": { "el": ".sw-pagination-project", "clickable": true },
                    "navigation": {
                        "clickable": true,
                        "nextEl": ".team-project",
                        "prevEl": ".team-project"
                    }
                    }'>
    <div class="swiper-wrapper">
      @forelse ($homePortfolios as $p)
      <div class="swiper-slide">
        <div class="project-item hover-image">
          <div class="item-content px-sm-15">
            <div class="top-content">
              <div class="sub-title body-2 fw-7">
                {{ $p->service->name ?? '' }}
              </div>
              <h3 class="title-project">
                <a href="{{ route('portfolio-details', $p->slug) }}">{{ $p->title }}</a>
              </h3>
              @if ($p->excerpt)
              <div class="desc lh-30">{{ Str::limit($p->excerpt, 100) }}</div>
              @endif
            </div>
            <div class="bottom-content">
              <a href="{{ route('portfolio-details', $p->slug) }}" class="tf-btn-readmore">
                <span class="plus">+</span>
                <span class="text">Read More</span>
              </a>
            </div>
          </div>
          <a href="{{ route('portfolio-details', $p->slug) }}" class="image"
            style="display:block; overflow:hidden;">
            @if ($p->cover_image)
            <img src="{{ asset('storage/' . $p->cover_image) }}"
              data-src="{{ asset('storage/' . $p->cover_image) }}"
              alt="{{ $p->title }}" class="lazyload"
              style="width:100%; height:420px; object-fit:cover; display:block;">
            @else
            <img src="{{ asset('image/project-item/project-item-1.jpg') }}"
              data-src="{{ asset('image/project-item/project-item-1.jpg') }}"
              alt="{{ $p->title }}" class="lazyload"
              style="width:100%; height:420px; object-fit:cover; display:block;">
            @endif
          </a>
        </div>
      </div>
      @empty
      <div class="swiper-slide">
        <div class="project-item hover-image">
          <div class="item-content px-sm-15">
            <div class="top-content">
              <div class="sub-title body-2 fw-7">Software Development</div>
              <h3 class="title-project"><a href="{{ route('portfolio') }}">Our Latest Work</a>
              </h3>
              <div class="desc lh-30">Explore our portfolio of successful projects.</div>
            </div>
            <div class="bottom-content">
              <a href="{{ route('portfolio') }}" class="tf-btn-readmore">
                <span class="plus">+</span>
                <span class="text">View Portfolio</span>
              </a>
            </div>
          </div>
          <a href="{{ route('portfolio') }}" class="image"
            style="display:block; overflow:hidden;">
            <img src="{{ asset('image/project-item/project-item-1.jpg') }}"
              data-src="{{ asset('image/project-item/project-item-1.jpg') }}" alt=""
              class="lazyload"
              style="width:100%; height:420px; object-fit:cover; display:block;">
          </a>
        </div>
      </div>
      @endforelse
    </div>
  </div>
  <div class="sw-pagination-project sw-pagination mt-70 justify-content-center"></div>
</section>

<section class="section-testimonial tf-spacing-2">
  <div class="mask mask-1">
    <svg xmlns="http://www.w3.org/2000/svg" width="800" height="800" fill="none">
      <circle cx="400" cy="400" r="325" stroke="url(#a4)" stroke-width="150" />
      <defs>
        <linearGradient id="a4" x1="176" x2="569" y1="70.5" y2="674">
          <stop offset="0" stop-color="#fff" stop-opacity="0.05" />
          <stop offset="1" stop-color="#fff" stop-opacity="0" />
        </linearGradient>
      </defs>
    </svg>
  </div>
  <div class="tf-container">
    <div class="row justify-content-between rg-50">
      <div class="col-lg-7">
        <div class="heading-section mb-60">
          <div class="sub-title body-2 fw-7 mb-17 title-animation">
            Clients Feedback
          </div>
          <h2 class="title fw-6 title-animation">
            Real Experiences.
            <span class="fw-3">Genuine Feedback.</span>
          </h2>
        </div>
        <div class="swiper tf-swiper sw-testimonial"
          data-swiper='{
                                "slidesPerView": 1,
                                "spaceBetween": 30,
                                "speed": 1000,
                                "pagination": { "el": ".sw-pagination-testimonial", "clickable": true }
                                }'>
          <div class="swiper-wrapper">
            @forelse ($homeTestimonials as $ht)
            <div class="swiper-slide">
              <div class="testimonial-item">
                <div class="icon">
                  <i class="icon-quote2"></i>
                </div>
                <div class="text lh-30" style="font-size:16px;color:rgba(255,255,255,0.75);">
                  {{ $ht->content }}
                </div>
                <div class="user-testimonial">
                  <a href="javascript:void(0)" class="name-user body-2">{{ $ht->name }}</a>
                  <a href="javascript:void(0)" class="position text-medium">
                    {{ $ht->position }}
                    @if ($ht->company)
                    &middot; {{ $ht->company }}
                    @endif
                  </a>
                </div>
              </div>
            </div>
            @empty
            <div class="swiper-slide">
              <div class="testimonial-item">
                <div class="icon"><i class="icon-quote2"></i></div>
                <div class="text lh-30" style="font-size:16px;color:rgba(255,255,255,0.75);">
                  Working with LonStack was the best technology decision we made.
                  They delivered beyond expectations every step of the way.
                </div>
                <div class="user-testimonial">
                  <a href="#" class="name-user body-2">A Happy Client</a>
                  <a href="#" class="position text-medium">CEO, Tech Company</a>
                </div>
              </div>
            </div>
            @endforelse
          </div>
        </div>
        <div class="sw-pagination-testimonial sw-pagination mt-50"></div>
      </div>
      <div class="col-lg-4">
        <div class="list-image">
          <div class="img-section img-1 img-elip tf-animate-1">
            <img src="image/section/section-testimonial-1.jpg"
              data-src="image/section/section-testimonial-1.jpg" alt="" class="lazyload">
          </div>
          <div class="img-section img-2 tf-animate-2">
            <img src="image/section/section-testimonial-2.jpg"
              data-src="image/section/section-testimonial-2.jpg" alt="" class="lazyload">
          </div>
          <div class="img-section img-3 tf-animate-3">
            <img src="image/section/section-testimonial-3.jpg"
              data-src="image/section/section-testimonial-3.jpg" alt="" class="lazyload">
          </div>
          <div class="img-section img-4 img-elip tf-animate-4">
            <img src="image/section/section-testimonial-4.jpg"
              data-src="image/section/section-testimonial-4.jpg" alt="" class="lazyload">
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<section class="section-form tf-spacing-4">
  <div class="section-inner flex">
    <div class="left">
      <div class="image tf-animate-1">
        <img src="image/section/img-section-form-1.jpg" data-src="image/section/img-section-form-1.jpg"
          alt="" class="lazyload">
      </div>
      <div class="section-content section-form-content tf-animate-2">
        <div class="sub-title body-2 fw-7 mb-17">
          Work Inquiry
        </div>
        <h2 class="title fw-6">
          Let's Work For your
          Next Projects ?
        </h2>
        <a href="{{ route('contact-us') }}" class="tf-btn style-bg-white hover-bg-main-dark">
          <span>Contact Us</span>
          <i class="icon-arrow-right"></i>
        </a>
      </div>
    </div>
    <div class="right">
      <x-contact-form :categories="$navCategories" />
    </div>
  </div>
</section>

<section class="section-blog tf-spacing-2">
  <div class="mask mask-1">
    <svg xmlns="http://www.w3.org/2000/svg" width="700" height="700" fill="none">
      <circle cx="350" cy="350" r="285" stroke="url(#a5)" stroke-width="130" />
      <defs>
        <linearGradient id="a5" x1="154" x2="497.875" y1="61.688" y2="589.75">
          <stop offset="0" stop-color="#fff" stop-opacity="0.05" />
          <stop offset="1" stop-color="#fff" stop-opacity="0" />
        </linearGradient>
      </defs>
    </svg>
  </div>

  <div class="tf-container">
    <div class="heading-section mb-60 text-center">
      <div class="sub-title body-2 fw-7 mb-17 title-animation">
        Latest News & Blog
      </div>
      <h2 class="title fw-6 title-animation">
        Read Our Latest
        <span class="fw-3">News & Blog</span>
      </h2>
    </div>
  </div>

  <div class="tf-container">

    {{-- Blog swiper — works on both desktop and mobile --}}
    <div class="swiper tf-swiper sw-home-blog"
      data-swiper='{
        "slidesPerView": 1,
        "spaceBetween": 30,
        "speed": 700,
        "loop": false,
        "navigation": {
          "nextEl": ".home-blog-next",
          "prevEl": ".home-blog-prev"
        },
        "pagination": {
          "el": ".home-blog-pagination",
          "clickable": true
        },
        "breakpoints": {
          "768": { "slidesPerView": 2, "spaceBetween": 30 }
        }
      }'>
      <div class="swiper-wrapper">
        @foreach ($homeBlogs as $homeBlog)
        <div class="swiper-slide">
          <div class="home-blog-card">
            {{-- Image — always on top --}}
            <a href="{{ route('blog-details', $homeBlog->slug) }}" class="home-blog-card__image">
              @if ($homeBlog->image)
              <img src="{{ asset('storage/' . $homeBlog->image) }}"
                alt="{{ $homeBlog->title }}" class="lazyload">
              @else
              <img src="image/blog/post-list-4.jpg" alt="{{ $homeBlog->title }}"
                class="lazyload">
              @endif
            </a>
            {{-- Content — always below --}}
            <div class="home-blog-card__content">
              <div class="post-meta"
                style="display:flex; align-items:center; gap:10px; margin-bottom:14px;">
                <a href="{{ route('blog-details', $homeBlog->slug) }}" class="text-medium"
                  style="color:rgba(255,255,255,0.5);">
                  {{ ($homeBlog->published_at ?? $homeBlog->created_at)->format('d F Y') }}
                </a>
                <span
                  style="width:1px; height:12px; background:rgba(255,255,255,0.2); display:inline-block;"></span>
                <a href="javascript:void(0)" class="text-medium" style="color:rgba(255,255,255,0.5);">
                  Comment({{ $homeBlog->comments_count ?? 0 }})
                </a>
              </div>
              <h5 class="title fw-5" style="margin-bottom:14px; line-height:1.4;">
                <a
                  href="{{ route('blog-details', $homeBlog->slug) }}">{{ $homeBlog->title }}</a>
              </h5>
              <div class="desc lh-30"
                style="color:rgba(255,255,255,0.55); font-size:14px; margin-bottom:20px;">
                {{ Str::limit($homeBlog->excerpt ?? strip_tags($homeBlog->description ?? ''), 100) }}
              </div>
              <a href="{{ route('blog-details', $homeBlog->slug) }}"
                class="tf-btn-readmore style-open">
                <span class="plus">+</span>
                <span class="text">Read More</span>
              </a>
            </div>
          </div>
        </div>
        @endforeach
      </div>
    </div>

    {{-- Prev / Next + pagination --}}
    <div class="home-blog-controls">
      <button class="home-blog-prev arrow-btn style-border w-50">
        <i class="icon-arrow-left2"></i>
      </button>
      <div class="home-blog-pagination sw-pagination"></div>
      <button class="home-blog-next arrow-btn style-border w-50">
        <i class="icon-arrow-right2"></i>
      </button>
    </div>

  </div>
</section>
</div>

@endsection
