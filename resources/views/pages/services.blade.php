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
  <div class="section-top" style="overflow:hidden; border-top:1px solid var(--stroke-2); border-bottom:1px solid var(--stroke-2);">
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
      @php $allServices = $categories->flatMap(fn($c) => $c->activeServices); @endphp
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

      {{-- Tab content --}}
      <div class="tab-content">

        {{-- All tab --}}
        <div class="tab-pane active show" id="tab-all" role="tabpanel">
          <div class="row rg-30">
            @foreach ($categories as $category)
              @foreach ($category->activeServices as $service)
              <div class="col-lg-4 col-md-6">
                <div class="services-item-card" style="
                    border:1px solid var(--stroke-2); border-radius:16px;
                    padding:36px 30px; height:100%; display:flex; flex-direction:column;
                    transition:border-color .3s, background .3s; position:relative; overflow:hidden;"
                    onmouseover="this.style.borderColor='rgba(67,186,255,0.35)'; this.style.background='rgba(67,186,255,0.03)'"
                    onmouseout="this.style.borderColor='var(--stroke-2)'; this.style.background=''">

                  {{-- Badge --}}
                  @if ($service->badge)
                  <span style="position:absolute; top:20px; right:20px; font-size:11px; font-weight:700;
                                padding:3px 10px; border-radius:20px;
                                background:{{ $service->badge === 'hot' ? 'rgba(245,158,11,0.15)' : 'rgba(72,187,120,0.15)' }};
                                color:{{ $service->badge === 'hot' ? '#f59e0b' : '#48bb78' }};">
                    {{ $service->badge_label }}
                  </span>
                  @endif

                  {{-- Icon --}}
                  <div style="width:52px; height:52px; border-radius:12px;
                              background:rgba(67,186,255,0.1); display:flex;
                              align-items:center; justify-content:center; margin-bottom:22px; flex-shrink:0;">
                    <i class="{{ $category->icon ?? 'icon-custom-software' }}"
                       style="font-size:22px; color:var(--primary);"></i>
                  </div>

                  {{-- Title --}}
                  <h5 class="fw-6 mb-14" style="font-size:18px; line-height:1.4;">
                    <a href="{{ route('services.show', $service->slug) }}"
                       style="color:inherit; text-decoration:none;">
                      {{ $service->name }}
                    </a>
                  </h5>

                  {{-- Description --}}
                  @if ($service->short_description)
                  <p class="lh-30 mb-25" style="color:rgba(255,255,255,0.55); font-size:14px; flex:1;">
                    {{ Str::limit($service->short_description, 110) }}
                  </p>
                  @endif

                  {{-- CTA --}}
                  <a href="{{ route('services.show', $service->slug) }}" class="tf-btn-readmore mt-auto">
                    <span class="plus">+</span>
                    <span class="text">Learn More</span>
                  </a>
                </div>
              </div>
              @endforeach
            @endforeach
          </div>
        </div>

        {{-- Per-category tabs --}}
        @foreach ($categories->filter(fn($c) => $c->activeServices->isNotEmpty()) as $category)
        <div class="tab-pane" id="tab-{{ $category->id }}" role="tabpanel">
          <div class="row rg-30">
            @foreach ($category->activeServices as $service)
            <div class="col-lg-4 col-md-6">
              <div style="border:1px solid var(--stroke-2); border-radius:16px;
                          padding:36px 30px; height:100%; display:flex; flex-direction:column;
                          transition:border-color .3s, background .3s; position:relative; overflow:hidden;"
                   onmouseover="this.style.borderColor='rgba(67,186,255,0.35)'; this.style.background='rgba(67,186,255,0.03)'"
                   onmouseout="this.style.borderColor='var(--stroke-2)'; this.style.background=''">

                @if ($service->badge)
                <span style="position:absolute; top:20px; right:20px; font-size:11px; font-weight:700;
                              padding:3px 10px; border-radius:20px;
                              background:{{ $service->badge === 'hot' ? 'rgba(245,158,11,0.15)' : 'rgba(72,187,120,0.15)' }};
                              color:{{ $service->badge === 'hot' ? '#f59e0b' : '#48bb78' }};">
                  {{ $service->badge_label }}
                </span>
                @endif

                <div style="width:52px; height:52px; border-radius:12px;
                            background:rgba(67,186,255,0.1); display:flex;
                            align-items:center; justify-content:center; margin-bottom:22px; flex-shrink:0;">
                  <i class="{{ $category->icon ?? 'icon-custom-software' }}"
                     style="font-size:22px; color:var(--primary);"></i>
                </div>

                <h5 class="fw-6 mb-14" style="font-size:18px; line-height:1.4;">
                  <a href="{{ route('services.show', $service->slug) }}" style="color:inherit; text-decoration:none;">
                    {{ $service->name }}
                  </a>
                </h5>

                @if ($service->short_description)
                <p class="lh-30 mb-25" style="color:rgba(255,255,255,0.55); font-size:14px; flex:1;">
                  {{ Str::limit($service->short_description, 110) }}
                </p>
                @endif

                <a href="{{ route('services.show', $service->slug) }}" class="tf-btn-readmore mt-auto">
                  <span class="plus">+</span>
                  <span class="text">Learn More</span>
                </a>
              </div>
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
