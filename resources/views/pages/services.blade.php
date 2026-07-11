@extends('layouts.guest')
@section('content')

{{-- ── Page Title ── --}}
<div class="page-title">
  <div class="tf-container">
    <div class="page-title-content text-center">
      <h1 class="title split-text effect-right">Our Services</h1>
      <div class="breadkcum">
        <a href="{{ route('home') }}" class="link-breadkcum body-2 fw-7 split-text effect-right">Home</a>
        <span class="dot"></span>
        <span class="page-breadkcum body-2 fw-7 split-text effect-right">Services</span>
      </div>
    </div>
  </div>
</div>

<div class="main-content">

  {{-- ── Intro strip ── --}}
  <section class="tf-spacing-3">
    <div class="tf-container">
      <div class="row align-items-center rg-40">

        {{-- Left: label + headline --}}
        <div class="col-lg-5">
          <div class="heading-section">
            <div class="sub-title body-2 fw-7 mb-17 title-animation">What We Do</div>
            <h2 class="title fw-6 title-animation">
              End-to-End Software Solutions
              <span class="fw-3">Built to Scale</span>
            </h2>
          </div>
        </div>

        {{-- Right: description + button --}}
        <div class="col-lg-7">
          <div class="desc lh-30 text-animation mb-40" style="color:rgba(255,255,255,0.65);">
            <p>
              From centralized platforms to decentralized blockchain solutions, we design, develop, and maintain custom software and digital products that drive real business results. Every project begins with understanding your goals to deliver solutions that create lasting value.
            </p>
          </div>
          <div class="title-animation">
            <a href="{{ route('contact-us') }}" class="tf-btn">
              <span>Start a Project</span>
              <i class="icon-arrow-right"></i>
            </a>
          </div>
        </div>

      </div>
    </div>
  </section>

  {{-- ── Marquee ── --}}
  <div class="section-top" style="overflow:hidden; border-top:1px solid var(--stroke-2); border-bottom:1px solid var(--stroke-2); margin-bottom:70px;">
    <div class="tf-marquee">
      <div class="marquee-wrapper">
        <div class="initial-child-container">
          @for ($i = 0; $i < 10; $i++)
          <div class="big-text">
            Explore <span class="text-stroke">All</span> Services
            <span class="marquee-dot">&#8226;</span>
          </div>
          @endfor
        </div>
      </div>
    </div>
  </div>

  {{-- ── Services by category ── --}}
  <section class="tf-spacing-3">
    <div class="tf-container">

      @php
      $hasServices = $categories->contains(fn($c) => $c->activeServices->isNotEmpty());
      @endphp

      @if (!$hasServices)
      <div class="text-center py-5" style="color:rgba(255,255,255,0.4);">
        <i class="icon-stack" style="font-size:48px; display:block; margin-bottom:16px; color:var(--primary);"></i>
        <p class="body-2">No services available yet. Check back soon.</p>
      </div>
      @else

      {{-- Category tabs --}}
      <div class="flat-animate-tab mb-60">
        <div class="wg-tab style-2">
          <ul class="tab-product" role="tablist">
            <li class="nav-tab-item" role="presentation">
              <a href="#tab-all" data-bs-toggle="tab" role="tab" class="active fw-5 body-2">
                All Services
              </a>
            </li>
            @foreach ($categories->filter(fn($c) => $c->activeServices->isNotEmpty()) as $cat)
            <li class="nav-tab-item" role="presentation">
              <a href="#tab-{{ $cat->id }}" data-bs-toggle="tab" role="tab" class="fw-5 body-2">
                {{ $cat->name }}
              </a>
            </li>
            @endforeach
          </ul>
        </div>
      </div>

      {{-- Tab content — pure Bootstrap grid on ALL screen sizes, no Swiper --}}
      <div class="tab-content">

        {{-- All tab --}}
        <div class="tab-pane active show" id="tab-all" role="tabpanel">
          @php $allFlat = $categories->flatMap(fn($c) => $c->activeServices->map(fn($s) => ['service' => $s, 'category' => $c])); @endphp
          <div class="row rg-30">
            @foreach ($allFlat as $item)
            <div class="col-lg-4 col-sm-6">
              @include('pages.services._card', ['service' => $item['service'], 'category' => $item['category']])
            </div>
            @endforeach
          </div>
        </div>

        {{-- Per-category tabs --}}
        @foreach ($categories->filter(fn($c) => $c->activeServices->isNotEmpty()) as $category)
        <div class="tab-pane" id="tab-{{ $category->id }}" role="tabpanel">
          <div class="row rg-30">
            @foreach ($category->activeServices as $service)
            <div class="col-lg-4 col-sm-6">
              @include('pages.services._card', ['service' => $service, 'category' => $category])
            </div>
            @endforeach
          </div>
        </div>
        @endforeach

      </div>
      {{-- /.tab-content --}}

      @endif
    </div>
  </section>

  {{-- ── CTA strip ── --}}
  <div class="tf-container tf-spacing-2">
    <div style="border:1px solid var(--stroke-2); border-radius:20px; padding:60px 50px;
                background:rgba(67,186,255,0.04);
                display:flex; align-items:center; justify-content:space-between;
                flex-wrap:wrap; gap:30px;">
      <div>
        <div class="sub-title body-2 fw-7 mb-10">Ready to get started?</div>
        <h3 class="title fw-6" style="font-size:clamp(20px,2.5vw,30px);">
          Let's Build Something <span class="fw-3">Great Together</span>
        </h3>
      </div>
      <a href="{{ route('contact-us') }}" class="tf-btn" style="flex-shrink:0;">
        <span>Contact Us Today</span>
        <i class="icon-arrow-right"></i>
      </a>
    </div>
  </div>


</div>
@endsection
