@extends('layouts.guest')
@section('content')
<!-- Page-title -->
<div class="page-title">
  <div class="tf-container">
    <div class="page-title-content text-center">
      <h1 class="title split-text effect-right">
        SERVICES
      </h1>
      <div class="breadkcum">
        <a href="{{ route('home') }}" class="link-breadkcum body-2 fw-7 split-text effect-right">Home</a>
        <span class="dot"></span>
        <span class="page-breadkcum body-2 fw-7 split-text effect-right">Services</span>
      </div>
    </div>
  </div>
</div>
<!-- /.page-title -->

<!-- Main-content -->
<div class="main-content position-relative">
  <div class="mask mask-service-4">
    <svg xmlns="http://www.w3.org/2000/svg" width="800" height="800" fill="none">
      <circle cx="400" cy="400" r="325" stroke="url(#b6)" stroke-width="150" />
      <defs>
        <linearGradient id="b6" x1="176" x2="569" y1="70.5" y2="674">
          <stop offset="0" stop-color="#fff" stop-opacity="0.05" />
          <stop offset="1" stop-color="#fff" stop-opacity="0" />
        </linearGradient>
      </defs>
    </svg>
  </div>
  <section class="section-about p-services tf-spacing-3">
    <div class="tf-container">
      <div class="row">
        <div class="col-lg-6">
          <div class="left">
            <div class="image tf-animate-2">
              <img src="image/section/img-section-about-p-serveic-1.jpg"
                data-src="image/section/img-section-about-p-serveic-1.jpg" alt=""
                class="lazyload">
            </div>
            <div class="img-secion-item img-1 tf-animate-3">
              <img src="image/section/img-section-about-p-serveic-2.jpg"
                data-src="image/section/img-section-about-p-serveic-2.jpg" alt=""
                class="lazyload">
            </div>
          </div>
        </div>
        <div class="col-lg-6">
          <div class="right">
            <div class="heading-section mb-45">
              <div class="sub-title body-2 fw-7 mb-17 title-animation">
                We Are Lonstack Software Company
              </div>
              <h2 class="title fw-6 title-animation">
                Innovate Soft Solutions to
                <span class="fw-3">Grow Tech Business</span>
              </h2>
            </div>
            <div class="section-content">
              <div class="desc mb-57 text-animation">
                <p class="lh-30">
                  With a portfolio of successful projects spanning various industries
                  our team has consistently demonstrated the ability to transform
                </p>
              </div>
              <div class="list-benefit">
                <div class="benefit-item style-big title-animation">
                  <i class="icon-star-of-life"></i>
                  <span class="fs-20">3+ Years Of Experience</span>
                </div>
                <div class="benefit-item style-big title-animation">
                  <i class="icon-star-of-life"></i>
                  <span class="fs-20">Professional Web Developers</span>
                </div>
                <div class="benefit-item style-big title-animation">
                  <i class="icon-star-of-life"></i>
                  <span class="fs-20">Mobile Apps Design</span>
                </div>
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
    </div>
  </section>

  <section class="section-services p-services tf-spacing-2">
    <div class="top-section">
      <div class="tf-marquee">
        <div class="marquee-wrapper">
          <div class="initial-child-container">
            <div class="big-text">
              Explore <span class="text-stroke">Popular</span> Services
            </div>
            <div class="big-text">
              Explore <span class="text-stroke">Popular</span> Services
            </div>
            <div class="big-text">
              Explore <span class="text-stroke">Popular</span> Services
            </div>
            <div class="big-text">
              Explore <span class="text-stroke">Popular</span> Services
            </div>
            <div class="big-text">
              Explore <span class="text-stroke">Popular</span> Services
            </div>
            <div class="big-text">
              Explore <span class="text-stroke">Popular</span> Services
            </div>
            <div class="big-text">
              Explore <span class="text-stroke">Popular</span> Services
            </div>
            <div class="big-text">
              Explore <span class="text-stroke">Popular</span> Services
            </div>
            <div class="big-text">
              Explore <span class="text-stroke">Popular</span> Services
            </div>
            <div class="big-text">
              Explore <span class="text-stroke">Popular</span> Services
            </div>
            <div class="big-text">
              Explore <span class="text-stroke">Popular</span> Services
            </div>
            <div class="big-text">
              Explore <span class="text-stroke">Popular</span> Services
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="tf-container">
      @php
      $hasServices = $categories->contains(fn ($category) => $category->activeServices->isNotEmpty());
      @endphp

      @if(!$hasServices)
      <div class="col-12 text-center py-5">
        <p class="text-muted">No services available at the moment.</p>
      </div>
      @else

      {{-- Desktop: grid layout --}}
      <div class="list-services services-grid-desktop flex flex-wrap">
        @foreach($categories as $category)
        @foreach($category->activeServices as $service)
        <div class="services-item px-lg-15 no-img">
          <div class="icon">
            <i class="{{ $category->icon ?? 'icon-custom-software' }}"></i>
          </div>
          <h5 class="lh-30 fw-6">
            <a href="{{ route('services.show', $service->slug) }}" class="title-service">
              {{ $service->name }}
            </a>
          </h5>
          <div class="desc lh-30">
            {{ $service->short_description }}
          </div>
          <div class="bottom-item">
            <a href="{{ route('services.show', $service->slug) }}" class="tf-btn-readmore">
              <span class="plus">+</span>
              <span class="text">Read More</span>
            </a>
          </div>
        </div>
        @endforeach
        @endforeach
      </div>

      {{-- Mobile: auto-playing swiper carousel --}}
      <div class="services-slider-mobile">
        <div class="swiper tf-swiper sw-services-page sw-border"
          data-swiper='{
              "slidesPerView": 1,
              "spaceBetween": 20,
              "speed": 800,
              "loop": true,
              "autoplay": {
                "delay": 4000,
                "disableOnInteraction": false,
                "pauseOnMouseEnter": true
              },
              "pagination": {
                "el": ".sw-pagination-services",
                "clickable": true
              },
              "observer": true,
              "observeParents": true
            }'>
          <div class="swiper-wrapper">
            @foreach($categories as $category)
            @foreach($category->activeServices as $service)
            <div class="swiper-slide">
              <div class="services-item px-lg-15 no-img">
                <div class="icon">
                  <i class="{{ $category->icon ?? 'icon-custom-software' }}"></i>
                </div>
                <h5 class="lh-30 fw-6">
                  <a href="{{ route('services.show', $service->slug) }}" class="title-service">
                    {{ $service->name }}
                  </a>
                </h5>
                <div class="desc lh-30">
                  {{ $service->short_description }}
                </div>
                <div class="bottom-item">
                  <a href="{{ route('services.show', $service->slug) }}" class="tf-btn-readmore">
                    <span class="plus">+</span>
                    <span class="text">Read More</span>
                  </a>
                </div>
              </div>
            </div>
            @endforeach
            @endforeach
          </div>
        </div>
        <div class="sw-pagination-services sw-pagination mt-20 justify-content-center"></div>
      </div>

      @endif
    </div>
  </section>

  <div class="wg-cta tf-spacing-2 alert alert-dismissible fade show" role="alert">
    <div class="tf-container">
      <div class="cta-inner flex align-items-center">
        <div class="left flex align-items-center">
          <div class="icon">
            <i class="icon-chat-2"></i>
          </div>
          <h5 class="fw-4 title">Let’s <span class="fw-6">Discuss & Start</span> IT Consultations</h5>
          <a href="#" class="tf-btn no-bg text-underline hover-color-main-dark">
            <span>Let’s Talk</span>
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
              <div class="img-line">
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

  <section class="section-company tf-spacing-2">
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
                <a href="#according1" data-bs-toggle="collapse" class="title-according">Learn Our
                  Company Mission<span></span></a>
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
                      Our mission is to revolutionize the digital landscape delivering innovative
                      software solutions to empower businesses to achieve their full potential
                    </div>
                    <div class="list-benefit">
                      <div class="benefit-item">
                        <i class="icon-star-of-life"></i>
                        <span class="fw-5">Premier Tech Innovations</span>
                      </div>
                      <div class="benefit-item">
                        <i class="icon-star-of-life"></i>
                        <span class="fw-5">Nexus Tech Systems</span>
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
                      Our mission is to revolutionize the digital landscape delivering innovative
                      software solutions to empower businesses to achieve their full potential
                    </div>
                    <div class="list-benefit">
                      <div class="benefit-item">
                        <i class="icon-star-of-life"></i>
                        <span class="fw-5">Premier Tech Innovations</span>
                      </div>
                      <div class="benefit-item">
                        <i class="icon-star-of-life"></i>
                        <span class="fw-5">Nexus Tech Systems</span>
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
                      Our mission is to revolutionize the digital landscape delivering innovative
                      software solutions to empower businesses to achieve their full potential
                    </div>
                    <div class="list-benefit">
                      <div class="benefit-item">
                        <i class="icon-star-of-life"></i>
                        <span class="fw-5">Premier Tech Innovations</span>
                      </div>
                      <div class="benefit-item">
                        <i class="icon-star-of-life"></i>
                        <span class="fw-5">Nexus Tech Systems</span>
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
                      Our mission is to revolutionize the digital landscape delivering innovative
                      software solutions to empower businesses to achieve their full potential
                    </div>
                    <div class="list-benefit">
                      <div class="benefit-item">
                        <i class="icon-star-of-life"></i>
                        <span class="fw-5">Premier Tech Innovations</span>
                      </div>
                      <div class="benefit-item">
                        <i class="icon-star-of-life"></i>
                        <span class="fw-5">Nexus Tech Systems</span>
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

  <section class="section-testimonial p-services tf-spacing-2">
    <div class="tf-container w-1650">
      <div class="section-testimonials-inner flex justify-content-between">

        <div class="heading-section left">
          <div class="sub-title body-2 fw-7 mb-17 title-animation">
            Clients Testimonials
          </div>
          <h2 class="title fw-6 mb-21 title-animation">
            What Our Clients
            <span class="fw-3">Say About Us</span>
          </h2>
          <div class="desc mb-60 text-animation">
            <p class="lh-30">
              Real feedback from real clients who trusted us to build their digital products.
            </p>
          </div>
          <div class="list-btn flex align-items-center g-10">
            <div class="scrolling-effect effectBottom">
              <a class="arrow-btn style-border w-50 arrow-prev testimonials-prev">
                <i class="icon-arrow-left2"></i>
              </a>
            </div>
            <div class="scrolling-effect effectBottom">
              <a class="arrow-btn style-border w-50 arrow-next testimonials-next">
                <i class="icon-arrow-right2"></i>
              </a>
            </div>
          </div>
        </div>

        <div class="right">
          <div class="swiper tf-swiper sw-testimonials"
            data-swiper='{
                                "slidesPerView": 1,
                                "spaceBetween": 30,
                                "speed": 800,
                                "pagination": { "el": ".sw-pagination-testimonials", "clickable": true },
                                "navigation": {
                                    "clickable": true,
                                    "nextEl": ".testimonials-next",
                                    "prevEl": ".testimonials-prev"
                                },
                                "breakpoints": {
                                    "575": { "slidesPerView": 2, "slidesPerGroup": 1},
                                    "1200": { "slidesPerView": 2, "slidesPerGroup": 1}
                                    }
                                }'>
            <div class="swiper-wrapper">

              @forelse ($serviceTestimonials as $t)
              <div class="swiper-slide">
                <div class="testimonial-item style-2">
                  <div class="top-item">
                    <div class="icon">
                      <i class="icon-quote2"></i>
                    </div>
                    <div class="image-avatar" style="position:relative;">
                      @if ($t->avatar)
                        <img src="{{ asset('storage/' . $t->avatar) }}"
                             alt="{{ $t->name }}"
                             style="width:100%;height:100%;border-radius:50%;object-fit:cover;display:block;">
                      @else
                        <img src="{{ asset('image/avatar/avatar-tes-1.jpg') }}"
                             alt="{{ $t->name }}"
                             style="width:100%;height:100%;border-radius:50%;object-fit:cover;display:block;
                                    filter:brightness(0.3);">
                        <span style="position:absolute;top:50%;left:50%;transform:translate(-50%,-50%);
                                     font-weight:700;font-size:22px;color:#fff;pointer-events:none;">
                          {{ $t->initial }}
                        </span>
                      @endif
                    </div>
                  </div>
                  <div class="text lh-30">
                    {{ $t->content }}
                  </div>
                  <div class="user-testimonial">
                    <h5 class="fw-5 name-user">
                      <a href="#">{{ $t->name }}</a>
                    </h5>
                    <a href="#" class="position text-medium">
                      {{ $t->position }}@if ($t->company) · {{ $t->company }}@endif
                    </a>
                  </div>
                </div>
              </div>
              @empty
              <div class="swiper-slide">
                <div class="testimonial-item style-2">
                  <div class="top-item">
                    <div class="icon"><i class="icon-quote2"></i></div>
                  </div>
                  <div class="text lh-30">
                    Working with LonStack was the best technology decision we made.
                    They delivered beyond expectations every step of the way.
                  </div>
                  <div class="user-testimonial">
                    <h5 class="fw-5 name-user"><a href="#">A Happy Client</a></h5>
                    <a href="#" class="position text-medium">CEO, Tech Company</a>
                  </div>
                </div>
              </div>
              @endforelse

            </div>
          </div>
          <div class="sw-pagination-testimonials sw-pagination d-xl-none mt-15 justify-content-center"></div>
        </div>

      </div>
    </div>
  </section>

</div>
<!-- /.main-content -->
@endsection
